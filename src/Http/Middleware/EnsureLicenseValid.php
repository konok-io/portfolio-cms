<?php

declare(strict_types=1);

namespace Mrh\License\Http\Middleware;

use Closure;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Mrh\License\Enums\LicenseStatus;
use Mrh\License\Repositories\Contracts\LicenseRepositoryInterface;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * EnsureLicenseValid
 * ------------------
 * Global, route-structure-independent license guard. Registered on the
 * host app's `web` group so it protects every route without the host
 * declaring anything per-route.
 *
 * Flow:
 *   - guard disabled OR excluded URI  → pass through
 *   - no license (never activated)    → redirect to activation
 *   - suspended / blocked / killed    → 403 suspended page
 *   - expired (past grace)            → 403 expired page
 *   - active / grace (operational)    → continue
 *
 * State is read locally (no network on the request hot path). The scheduled
 * `license:verify` command / VerdictStore keeps that local state fresh.
 */
class EnsureLicenseValid
{
    public function __construct(
        private readonly LicenseRepositoryInterface $licenses,
        private readonly Config $config,
    ) {
    }

    public function handle(Request $request, Closure $next): SymfonyResponse
    {
        // 1. Master switch — allow everything when the guard is off.
        if (! $this->config->get('mrh-license.guard.enabled', true)) {
            return $next($request);
        }

        // 2. Never guard excluded URIs (auth, password reset, assets,
        //    license endpoints, health checks). Route-independent: matches
        //    on the request path, not on route names.
        if ($this->isExcluded($request)) {
            return $next($request);
        }

        $setting = $this->licenses->current();

        // 3. No license row at all — installation has never been activated.
        if ($setting === null) {
            return $this->redirectToActivation($request);
        }

        $status = $this->statusOf($setting);

        // 4. Branch on the denormalized local status.
        return match ($status) {
            LicenseStatus::Pending  => $this->redirectToActivation($request),
            LicenseStatus::Blocked  => $this->suspendedResponse($request),
            LicenseStatus::Expired  => $this->expiredResponse($request),
            LicenseStatus::VerificationFailed => $this->verificationFailedResponse($request),
            LicenseStatus::Active,
            LicenseStatus::Grace    => $next($request),
        };
    }

    /** Whether the current request path matches any excluded pattern. */
    private function isExcluded(Request $request): bool
    {
        $path = $request->path(); // e.g. "login", "css/app.css", "/" → "/"

        /** @var array<int, string> $patterns */
        $patterns = (array) $this->config->get('mrh-license.guard.except', []);

        foreach ($patterns as $pattern) {
            if ($path === $pattern || Str::is($pattern, $path)) {
                return true;
            }
        }

        return false;
    }

    /** Resolve the setting's status into the enum (defensive default). */
    private function statusOf($setting): LicenseStatus
    {
        return LicenseStatus::tryFrom((string) $setting->status)
            ?? LicenseStatus::Pending;
    }

    /**
     * Redirect unlicensed traffic to activation. For JSON/expects-JSON
     * requests, return a 402 envelope instead of an HTML redirect.
     */
    private function redirectToActivation(Request $request): SymfonyResponse
    {
        if ($this->wantsJson($request)) {
            return response()->json([
                'success'     => false,
                'data'        => null,
                'error'       => [
                    'code'    => 'LICENSE_REQUIRED',
                    'message' => 'This installation is not activated.',
                    'details' => null,
                ],
                'server_time' => now()->toIso8601String(),
            ], 402);
        }

        $target = (string) $this->config->get('mrh-license.guard.redirect_to', 'license/activate');

        // Prefer a named route if the host app registered one.
        if (app('router')->has($target)) {
            return redirect()->route($target);
        }

        return redirect()->to('/' . ltrim($target, '/'));
    }

    /** 403 suspended/blocked page (or JSON). */
    private function suspendedResponse(Request $request): SymfonyResponse
    {
        if ($this->wantsJson($request)) {
            return $this->jsonBlock('LICENSE_SUSPENDED', 'This license is suspended.');
        }

        return response(
            view('mrh-license::pages.suspended'),
            Response::HTTP_FORBIDDEN,
        );
    }

    /** 403 expired page (or JSON). */
    private function expiredResponse(Request $request): SymfonyResponse
    {
        if ($this->wantsJson($request)) {
            return $this->jsonBlock('LICENSE_EXPIRED', 'This license has expired.');
        }

        return response(
            view('mrh-license::pages.expired'),
            Response::HTTP_FORBIDDEN,
        );
    }

    /** 403 verification-failed page (or JSON). */
    private function verificationFailedResponse(Request $request): SymfonyResponse
    {
        if ($this->wantsJson($request)) {
            return $this->jsonBlock('LICENSE_VERIFICATION_FAILED', 'License verification failed.');
        }

        return response(
            view('mrh-license::pages.verification-failed'),
            Response::HTTP_FORBIDDEN,
        );
    }

    private function jsonBlock(string $code, string $message): SymfonyResponse
    {
        return response()->json([
            'success'     => false,
            'data'        => null,
            'error'       => ['code' => $code, 'message' => $message, 'details' => null],
            'server_time' => now()->toIso8601String(),
        ], Response::HTTP_FORBIDDEN);
    }

    private function wantsJson(Request $request): bool
    {
        return $request->expectsJson() || $request->is('api/*');
    }
}
