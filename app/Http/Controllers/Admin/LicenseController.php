<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class LicenseController extends Controller
{
    public function index()
    {
        $installed = class_exists(\Mrh\License\Facades\License::class);
        $status = [];
        $error = null;

        if ($installed) {
            try {
                $status = \Mrh\License\Facades\License::status();
            } catch (\Throwable $e) {
                $error = $e->getMessage();
            }
        }

        $s = fn ($k, $d = '—') => (isset($status[$k]) && $status[$k] !== null && $status[$k] !== '') ? $status[$k] : $d;

        $license = [
            'product'         => config('app.name', 'Portfolio CMS'),
            'installed'       => $installed,
            'error'           => $error,
            'status'          => is_string($s('status')) ? $s('status') : ($s('status') === true ? 'active' : 'pending'),
            'activated'       => (bool) ($status['activated'] ?? false),
            'installation_id' => $s('installation_id'),
            'server_type'     => $s('server_type'),
            'domain'          => $s('normalized_domain', request()->getHost()),
            'expires_at'      => $this->fmt($status['expires_at'] ?? null),
            'last_verified'   => $this->fmt($status['last_verified_at'] ?? null),
            'next_verify'     => $this->fmt($status['next_verify_by'] ?? null),
            'grace_ends'      => $this->fmt($status['grace_ends_at'] ?? null),
        ];

        return view('admin.license.index', compact('license'));
    }

    private function fmt(?string $iso): string
    {
        if (!$iso) {
            return '—';
        }
        try {
            return \Illuminate\Support\Carbon::parse($iso)->format('d M Y, H:i');
        } catch (\Throwable $e) {
            return $iso;
        }
    }
}
