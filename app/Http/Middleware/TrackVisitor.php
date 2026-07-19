<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * Logs a lightweight visitor record for front-end page views only,
     * skipping admin routes, API calls, and asset/file requests.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->shouldTrack($request)) {
            $this->logVisit($request);
        }

        return $next($request);
    }

    protected function shouldTrack(Request $request): bool
    {
        if (! $request->isMethod('get')) {
            return false;
        }

        if ($request->is('admin*', 'api*', 'storage*', 'laravel-filemanager*')) {
            return false;
        }

        return true;
    }

    protected function logVisit(Request $request): void
    {
        try {
            // Guard: only track if the visitors table exists
            if (! Schema::hasTable('visitors')) {
                return;
            }

            $agent = $request->header('User-Agent', '');

            Visitor::create([
                'ip_address'   => $request->ip(),
                'browser'      => $this->detectBrowser($agent),
                'platform'     => $this->detectPlatform($agent),
                'device'       => $this->detectDevice($agent),
                'country'      => $request->header('CF-IPCountry'),
                'page_url'     => $request->path(),
                'visited_date' => now()->toDateString(),
            ]);
        } catch (\Throwable $e) {
            // Never let visitor tracking break the main request.
            report($e);
        }
    }

    protected function detectBrowser(string $agent): string
    {
        return match (true) {
            str_contains($agent, 'Edg/')                                           => 'Edge',
            str_contains($agent, 'Chrome/') && ! str_contains($agent, 'Edg/')     => 'Chrome',
            str_contains($agent, 'Firefox/')                                       => 'Firefox',
            str_contains($agent, 'Safari/') && ! str_contains($agent, 'Chrome/')  => 'Safari',
            str_contains($agent, 'OPR/') || str_contains($agent, 'Opera')         => 'Opera',
            default                                                                => 'Other',
        };
    }

    protected function detectPlatform(string $agent): string
    {
        return match (true) {
            str_contains($agent, 'Windows') => 'Windows',
            str_contains($agent, 'Mac OS')  => 'macOS',
            str_contains($agent, 'Android') => 'Android',
            str_contains($agent, 'iPhone') || str_contains($agent, 'iPad') => 'iOS',
            str_contains($agent, 'Linux')   => 'Linux',
            default                         => 'Other',
        };
    }

    protected function detectDevice(string $agent): string
    {
        if (str_contains($agent, 'Mobi') || str_contains($agent, 'Android')) {
            return 'Mobile';
        }
        if (str_contains($agent, 'iPad') || str_contains($agent, 'Tablet')) {
            return 'Tablet';
        }
        return 'Desktop';
    }
}
