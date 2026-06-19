<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Models\FuzzJob;
use App\Models\FuzzResult;
use App\Jobs\RunFuzzJob;
use App\Support\SsrfGuard;

class FuzzController extends Controller
{
    use SsrfGuard;
    /**
     * Tampilkan daftar semua job milik user.
     */
    public function index()
    {
        $jobs = FuzzJob::where('user_id', auth()->id())
            ->withCount('results')
            ->latest()
            ->paginate(10);

        return view('Fuzz.index', compact('jobs'));
    }

    /**
     * Buat job fuzz baru.
     */
    public function create(Request $request)
    {
        $request->validate([
            'target' => 'required|url',
            'wordlist_upload' => 'nullable|file|mimes:txt|max:2048',
            'concurrency' => 'nullable|integer|min:1|max:100',
            'rate_limit' => 'nullable|numeric|min:0.1',
            'legal' => 'accepted',
        ]);

        // Mitigasi SSRF (A10:2021): tolak di awal sebelum job di-dispatch.
        if ($this->isPrivateHost($request->target)) {
            return back()->withErrors(['target' => 'Target host tidak diizinkan (private/loopback/link-local).']);
        }

        $wordlistPath = null;
        $wordlistName = $request->input('wordlist') ?? null;

        // Simpan file wordlist jika ada upload
        if ($request->hasFile('wordlist_upload')) {
            $path = $request->file('wordlist_upload')->store('wordlists');
            $wordlistPath = $path;
            $wordlistName = basename($path);
        }

        // Buat job baru
        $job = FuzzJob::create([
            'user_id' => auth()->id(),
            'target' => $request->target,
            'scope_regex' => $request->input('scope_regex'),
            'wordlist_name' => $wordlistName,
            'wordlist_path' => $wordlistPath,
            'concurrency' => $request->input('concurrency', 5),
            'rate_limit' => $request->input('rate_limit', 2.0),
            'respect_robots' => (bool) $request->input('respect_robots'),
            'status' => 'pending',
            'meta' => ['done' => 0, 'started_at' => now()],
        ]);

        // Cache status
        Cache::put("fuzz:{$job->id}:done", 0, now()->addHours(6));
        Cache::put("fuzz:{$job->id}:total", 0, now()->addHours(6));
        Cache::put("fuzz:{$job->id}:stop", false, now()->addHours(6));

        // Dispatch job
        RunFuzzJob::dispatch($job->id);

        return redirect()->route('fuzz.show', $job->id)
            ->with('success', 'Job berhasil dibuat dan sedang diproses.');
    }

    /**
     * Detail hasil job tertentu.
     */
    public function show($id)
    {
        $job = FuzzJob::with('results')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('Fuzz.show', compact('job'));
    }

    /**
     * Ambil progres job.
     */
    public function progress($id)
    {
        $job = FuzzJob::where('user_id', auth()->id())->findOrFail($id);

        $done = Cache::get("fuzz:{$id}:done", $job->meta['done'] ?? 0);
        $total = Cache::get("fuzz:{$id}:total", 0);

        $words = $job->results()
            ->select(['matched_word', 'status', 'url', 'snippet', 'updated_at'])
            ->latest()
            ->limit(30)
            ->get()
            ->map(fn($r) => [
                'word' => $r->matched_word,
                'status' => $r->status,
                'url' => $r->url,
                'snippet' => str($r->snippet)->limit(200),
                'last_seen' => optional($r->updated_at)->diffForHumans(),
            ]);

        return response()->json([
            'status' => $job->status,
            'done' => $done,
            'total' => $total,
            'words' => $words,
        ]);
    }

    /**
     * Jalankan job fuzz yang dihentikan.
     */
    public function start($id)
    {
        $job = FuzzJob::where('user_id', auth()->id())->findOrFail($id);

        if ($job->status === 'running') {
            return response()->json(['message' => 'Job sudah berjalan']);
        }

        $job->update([
            'status' => 'running',
            'meta->resumed_at' => now(),
        ]);

        Cache::put("fuzz:{$job->id}:stop", false, now()->addHours(6));
        RunFuzzJob::dispatch($job->id);

        return response()->json(['message' => 'Job berhasil dimulai']);
    }

    /**
     * Hentikan job fuzz yang sedang berjalan.
     */
    public function stop($id)
    {
        $job = FuzzJob::where('user_id', auth()->id())->findOrFail($id);

        if ($job->status !== 'running') {
            return response()->json(['message' => 'Job tidak sedang berjalan']);
        }

        $job->update([
            'status' => 'stopped',
            'meta->stopped_at' => now(),
        ]);

        Cache::put("fuzz:{$job->id}:stop", true, now()->addHours(6));

        return response()->json(['message' => 'Job berhasil dihentikan']);
    }

    /**
     * Hapus satu job fuzz tertentu.
     */
    public function destroy($id)
    {
        $job = FuzzJob::where('user_id', auth()->id())->find($id);

        if (!$job) {
            return redirect()->route('fuzz.index')->with('error', 'Job tidak ditemukan.');
        }

        // Hapus hasilnya
        FuzzResult::where('fuzz_job_id', $job->id)->delete();

        // Hapus cache spesifik job
        Cache::forget("fuzz:{$job->id}:done");
        Cache::forget("fuzz:{$job->id}:total");
        Cache::forget("fuzz:{$job->id}:stop");

        $job->delete();

        return redirect()->route('fuzz.index')->with('success', 'Job berhasil dihapus.');
    }

    /**
     * Hapus semua job milik user.
     */
    public function destroyAll()
    {
        $user = auth()->user();

        DB::transaction(function () use ($user) {
            $jobIds = $user->fuzzJobs()->pluck('id');

            if ($jobIds->isNotEmpty()) {
                FuzzResult::whereIn('fuzz_job_id', $jobIds)->delete();
                FuzzJob::whereIn('id', $jobIds)->delete();
            }
        });

        // Hapus cache terkait fuzz tanpa akses Redis langsung
        foreach (Cache::getMultiple([
            "fuzz:*:done", "fuzz:*:total", "fuzz:*:stop"
        ]) as $key => $value) {
            Cache::forget($key);
        }

        return redirect()->route('fuzz.index')
            ->with('success', 'Semua job fuzz Anda telah dihapus.');
    }
}
