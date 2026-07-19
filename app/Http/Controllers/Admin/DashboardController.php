<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\ContactMessage;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects'        => Project::count(),
            'services'        => Service::count(),
            'skills'          => Skill::count(),
            'testimonials'    => Testimonial::count(),
            'blogs'           => Blog::count(),
            'messages'        => ContactMessage::count(),
            'unread_messages' => ContactMessage::unread()->count(),
            'visitors'        => Visitor::count(),
            'visitors_today'  => Visitor::whereDate('visited_date', today())->count(),
        ];

        $recentMessages = ContactMessage::latest()->take(5)->get();
        $recentProjects = Project::latest()->take(5)->get();

        $visitorChart = Visitor::select(
                DB::raw('DATE(visited_date) as date'),
                DB::raw('COUNT(*) as total')
            )
            ->where('visited_date', '>=', now()->subDays(13)->toDateString())
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $browserStats = Visitor::select('browser', DB::raw('COUNT(*) as total'))
            ->groupBy('browser')
            ->orderByDesc('total')
            ->take(6)
            ->get();

        $license = $this->licenseInfo();

        return view('admin.dashboard.index', compact(
            'stats',
            'recentMessages',
            'recentProjects',
            'visitorChart',
            'browserStats',
            'license'
        ));
    }

    /**
     * Collect MRH license details for the dashboard. Returns null when the
     * license package isn't installed, so the dashboard degrades gracefully
     * instead of erroring on a fresh install.
     *
     * @return array<string, mixed>|null
     */
    private function licenseInfo(): ?array
    {
        // Package not installed → nothing to show.
        if (! class_exists(\Mrh\License\Facades\License::class)) {
            return null;
        }

        try {
            /** @var array<string, mixed> $status */
            $status = \Mrh\License\Facades\License::status();
        } catch (\Throwable $e) {
            // Tables not migrated yet, or any other setup issue — fail soft.
            return ['installed' => true, 'ready' => false];
        }

        $expiresAt = ! empty($status['expires_at'])
            ? \Illuminate\Support\Carbon::parse($status['expires_at'])
            : null;

        $daysLeft = $expiresAt ? now()->startOfDay()->diffInDays($expiresAt->startOfDay(), false) : null;

        return [
            'installed'         => true,
            'ready'             => true,
            'status'            => $status['status'] ?? 'unknown',
            'activated'         => (bool) ($status['activated'] ?? false),
            'installation_id'   => $status['installation_id'] ?? null,
            'server_type'       => $status['server_type'] ?? null,
            'normalized_domain' => $status['normalized_domain'] ?? null,
            'expires_at'        => $expiresAt,
            'days_left'         => $daysLeft,
            'last_verified_at'  => ! empty($status['last_verified_at']) ? \Illuminate\Support\Carbon::parse($status['last_verified_at']) : null,
            'grace_ends_at'     => ! empty($status['grace_ends_at']) ? \Illuminate\Support\Carbon::parse($status['grace_ends_at']) : null,
        ];
    }
}
