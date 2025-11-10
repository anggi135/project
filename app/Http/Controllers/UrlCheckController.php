<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class UrlCheckController extends Controller
{
    public function showForm()
    {
        // arahkan ke view check-url/check-url.blade.php
        return view('check-url.check-url');
    }

    public function check(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        $inputUrl = $request->input('url');
        $domain = $this->extractDomain($inputUrl);

        // Ambil daftar blackbook dan cache selama 1 jam
        $blacklist = Cache::remember('blackbook_list', 3600, function () {
            $url = 'https://raw.githubusercontent.com/stamparm/blackbook/master/blackbook.txt';
            try {
                $res = Http::timeout(10)->get($url);
                if ($res->ok()) {
                    $lines = preg_split('/\r\n|\r|\n/', $res->body());
                    return array_filter(array_map('trim', $lines));
                }
            } catch (\Throwable $e) {
                return [];
            }
            return [];
        });

        // cek domain & subdomain
        $domainLower = strtolower($domain);
        $isBlacklisted = false;

        foreach ($blacklist as $entry) {
            $entry = strtolower($entry);
            if ($entry === '' || str_starts_with($entry, '#')) continue;

            // cocok langsung atau subdomain
            if ($domainLower === $entry || Str::endsWith($domainLower, '.' . $entry)) {
                $isBlacklisted = true;
                $matched = $entry;
                break;
            }
        }

        $result = [
            'domain' => $domain,
            'status' => $isBlacklisted ? 'danger' : 'safe',
            'message' => $isBlacklisted
                ? 'Situs ini termasuk dalam daftar blacklist (berpotensi malware/phishing).'
                : 'Situs ini tidak ditemukan dalam daftar blacklist (aman sejauh ini).',
            'source' => 'https://raw.githubusercontent.com/stamparm/blackbook/master/blackbook.txt'
        ];

        return view('check-url.check-url', compact('result', 'inputUrl'))
            ->with('url', $inputUrl);
    }

    private function extractDomain(string $url): string
    {
        $parts = parse_url($url);
        return isset($parts['host']) ? strtolower($parts['host']) : $url;
    }
}
