<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Models\FuzzJob;
use App\Models\FuzzResult;
use App\Support\SsrfGuard;
use Throwable;
use Exception;

class RunFuzzJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use SsrfGuard;

    /** @var int */
    public $jobId;

    /** Maksimum waktu percobaan job (menit) */
    public $timeout = 120;

    public function __construct(int $jobId)
    {
        $this->jobId = $jobId;
    }

    public function handle(): void
    {
        $fuzzJob = FuzzJob::find($this->jobId);

        if (!$fuzzJob) {
            Log::warning("RunFuzzJob: Job {$this->jobId} not found");
            return;
        }

        // Hindari jalan ulang job yang sudah selesai
        if ($fuzzJob->status === 'finished') {
            Log::info("RunFuzzJob: Job {$this->jobId} already finished, skipping");
            return;
        }

        // Set status running bila belum aktif
        if (!in_array($fuzzJob->status, ['running'])) {
            $fuzzJob->update(['status' => 'running']);
        }

        // Mitigasi SSRF (A10:2021): tolak target privat/loopback/link-local
        // sebelum job mulai melakukan ribuan request.
        if ($this->isPrivateHost($fuzzJob->target)) {
            $this->failJob($fuzzJob, 'Target host tidak diizinkan (private/loopback/link-local).');
            return;
        }

        // Ambil wordlist dari storage atau resource
        $content = $this->loadWordlist($fuzzJob);

        if (is_null($content)) {
            $this->failJob($fuzzJob, "Wordlist not found");
            return;
        }

        $lines = preg_split("/\r\n|\n|\r/", $content);
        $words = array_values(array_filter(array_map('trim', $lines), fn($l) => $l !== ''));

        if (empty($words)) {
            $this->failJob($fuzzJob, "Wordlist empty");
            return;
        }

        // Inisialisasi meta dan cache
        $meta = $fuzzJob->meta ?? [];
        $meta['done'] = 0;
        $meta['started_at'] = now();
        $fuzzJob->update(['meta' => $meta]);

        Cache::put("fuzz:{$this->jobId}:total", count($words), now()->addHours(2));
        Cache::put("fuzz:{$this->jobId}:done", 0, now()->addHours(2));

        $rate = max(0.1, floatval($fuzzJob->rate_limit ?? 2.0));
        $delayMicro = intval((1 / $rate) * 1_000_000);

        $stopFlagKey = "fuzz:{$fuzzJob->id}:stop";

        foreach ($words as $word) {
            $fuzzJob->refresh();

            // Jika status berubah atau ada flag stop → hentikan
            if (
                $fuzzJob->status === 'stopped' ||
                Cache::get($stopFlagKey, false) === true
            ) {
                Log::info("RunFuzzJob: Job {$fuzzJob->id} stopped by user.");
                break;
            }

            $this->processWord($fuzzJob, $word);

            // Update progress
            $meta['done']++;
            $fuzzJob->update(['meta' => $meta]);
            Cache::put("fuzz:{$this->jobId}:done", $meta['done'], now()->addHours(2));

            usleep($delayMicro);
        }

        // Tandai selesai jika tidak dihentikan
        $fuzzJob->refresh();
        if ($fuzzJob->status !== 'stopped') {
            $meta['finished_at'] = now();
            $fuzzJob->update([
                'status' => 'finished',
                'meta' => $meta,
            ]);
            Log::info("RunFuzzJob: Job {$this->jobId} finished successfully.");
        }
    }

    /**
     * Memproses satu kata dari wordlist dan menyimpan hasilnya.
     */
    protected function processWord(FuzzJob $fuzzJob, string $word): void
    {
        $target = rtrim($fuzzJob->target, '/');
        $url = Str::startsWith($word, ['http://', 'https://'])
            ? $word
            : "{$target}/" . ltrim($word, '/');

        // Cegah celah SSRF kedua: wordlist bisa berisi URL absolut
        // (http://... ) yang menimpa target asli, jadi divalidasi lagi per kata.
        if ($this->isPrivateHost($url)) {
            FuzzResult::create([
                'fuzz_job_id'  => $fuzzJob->id,
                'matched_word' => $word,
                'url'          => $url,
                'status'       => null,
                'length'       => 0,
                'snippet'      => 'BLOCKED: target host tidak diizinkan (private/loopback).',
            ]);
            return;
        }

        try {
            // SSL verification tetap aktif secara default; jangan gunakan
            // withoutVerifying() kecuali target sudah divalidasi & di-allowlist.
            $response = Http::timeout(10)->get($url);

            $status = $response->status();
            $body = (string) $response->body();
            $length = strlen($body);
            $snippet = Str::limit(strip_tags($body), 500);

            FuzzResult::create([
                'fuzz_job_id'  => $fuzzJob->id,
                'matched_word' => $word,
                'url'          => $url,
                'status'       => $status,
                'length'       => $length,
                'snippet'      => $snippet,
            ]);
        } catch (Throwable $e) {
            Log::warning("RunFuzzJob: Exception at job {$fuzzJob->id} word={$word}: {$e->getMessage()}");

            FuzzResult::create([
                'fuzz_job_id'  => $fuzzJob->id,
                'matched_word' => $word,
                'url'          => $url,
                'status'       => null,
                'length'       => 0,
                'snippet'      => 'ERROR: ' . Str::limit($e->getMessage(), 300),
            ]);
        }
    }

    /**
     * Ambil isi wordlist dari berbagai sumber.
     */
    protected function loadWordlist(FuzzJob $fuzzJob): ?string
    {
        if ($fuzzJob->wordlist_path && Storage::exists($fuzzJob->wordlist_path)) {
            return Storage::get($fuzzJob->wordlist_path);
        }

        $diskPath = 'wordlists/' . $fuzzJob->wordlist_name;
        if ($fuzzJob->wordlist_name && Storage::exists($diskPath)) {
            return Storage::get($diskPath);
        }

        $localResource = resource_path('wordlists/' . $fuzzJob->wordlist_name);
        if ($fuzzJob->wordlist_name && file_exists($localResource)) {
            return file_get_contents($localResource);
        }

        return null;
    }

    /**
     * Tangani kegagalan saat inisialisasi job.
     */
    protected function failJob(FuzzJob $job, string $reason): void
    {
        $job->update(['status' => 'failed']);
        Log::error("RunFuzzJob: {$reason} (job {$job->id})");
    }
}
