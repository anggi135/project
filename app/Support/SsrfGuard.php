<?php

namespace App\Support;

/**
 * SsrfGuard
 *
 * Helper terpusat untuk mencegah Server-Side Request Forgery (SSRF).
 * Dipakai bersama oleh PentestApiController (fitur Fetch URL / API tester)
 * dan RunFuzzJob (fitur fuzzing) agar logic validasi tidak terduplikasi
 * dan tidak lagi "menggantung" di file yang tidak ter-route.
 */
trait SsrfGuard
{
    /**
     * Cek apakah URL mengarah ke host privat/loopback/link-local
     * atau memakai skema selain http/https.
     */
    protected function isPrivateHost(string $url): bool
    {
        $scheme = parse_url($url, PHP_URL_SCHEME);
        if (!in_array(strtolower((string) $scheme), ['http', 'https'], true)) {
            return true;
        }

        $host = parse_url($url, PHP_URL_HOST);
        if (!$host) {
            return true;
        }

        // Blokir akses langsung ke nama host metadata cloud yang umum.
        $blockedHosts = ['metadata.google.internal', 'localhost'];
        if (in_array(strtolower($host), $blockedHosts, true)) {
            return true;
        }

        $ips = filter_var($host, FILTER_VALIDATE_IP) ? [$host] : gethostbynamel($host);
        if (!$ips) {
            // Gagal resolve DNS => anggap tidak aman, jangan diteruskan.
            return true;
        }

        foreach ($ips as $ip) {
            if ($this->ipIsPrivate($ip)) {
                return true;
            }
        }

        return false;
    }

    /** Daftar rentang IP privat/loopback/link-local yang harus diblokir. */
    private static function privateIpRanges(): array
    {
        return [
            '127.0.0.0/8',
            '10.0.0.0/8',
            '172.16.0.0/12',
            '192.168.0.0/16',
            '169.254.0.0/16', // AWS/GCP/Azure metadata range
            '0.0.0.0/8',
            '::1/128',
            'fe80::/10',
        ];
    }

    protected function ipIsPrivate(string $ip): bool
    {
        foreach (self::privateIpRanges() as $range) {
            if ($this->cidrMatch($ip, $range)) {
                return true;
            }
        }

        return false;
    }

    protected function cidrMatch(string $ip, string $range): bool
    {
        if (strpos($range, '/') === false) {
            return $ip === $range;
        }

        [$subnet, $bits] = explode('/', $range);

        if ($this->isIpv6($ip) || $this->isIpv6($subnet)) {
            return $this->cidrMatchIpv6($ip, $subnet);
        }

        return $this->cidrMatchIpv4($ip, $subnet, (int) $bits);
    }

    private function isIpv6(string $ip): bool
    {
        return strpos($ip, ':') !== false;
    }

    private function cidrMatchIpv6(string $ip, string $subnet): bool
    {
        // Simplified: hanya cocokkan persis (cukup untuk blok ::1 / fe80::).
        return strtolower($ip) === strtolower($subnet);
    }

    private function cidrMatchIpv4(string $ip, string $subnet, int $bits): bool
    {
        $ipLong = ip2long($ip);
        $subnetLong = ip2long($subnet);

        if ($ipLong === false || $subnetLong === false) {
            return true; // gagal parse => anggap berbahaya, blokir
        }

        $mask = (-1 << (32 - $bits)) & 0xFFFFFFFF;

        return ($ipLong & $mask) === ($subnetLong & $mask);
    }
}
