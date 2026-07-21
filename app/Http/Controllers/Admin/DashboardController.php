<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\ContactMessage;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private array $countryNames = [
        'AF' => 'Afghanistan','AL' => 'Albania','DZ' => 'Algeria','AR' => 'Argentina','AU' => 'Australia','AT' => 'Austria','BD' => 'Bangladesh','BE' => 'Belgium','BR' => 'Brazil','CA' => 'Canada','CL' => 'Chile','CN' => 'China','CO' => 'Colombia','HR' => 'Croatia','CZ' => 'Czech Republic','DK' => 'Denmark','EG' => 'Egypt','FI' => 'Finland','FR' => 'France','DE' => 'Germany','GR' => 'Greece','HK' => 'Hong Kong','HU' => 'Hungary','IS' => 'Iceland','IN' => 'India','ID' => 'Indonesia','IR' => 'Iran','IQ' => 'Iraq','IE' => 'Ireland','IL' => 'Israel','IT' => 'Italy','JP' => 'Japan','JO' => 'Jordan','KZ' => 'Kazakhstan','KE' => 'Kenya','KR' => 'South Korea','KW' => 'Kuwait','LV' => 'Latvia','LB' => 'Lebanon','LY' => 'Libya','LT' => 'Lithuania','MY' => 'Malaysia','MX' => 'Mexico','MA' => 'Morocco','NP' => 'Nepal','NL' => 'Netherlands','NZ' => 'New Zealand','NG' => 'Nigeria','NO' => 'Norway','PK' => 'Pakistan','PH' => 'Philippines','PL' => 'Poland','PT' => 'Portugal','QA' => 'Qatar','RO' => 'Romania','RU' => 'Russia','SA' => 'Saudi Arabia','RS' => 'Serbia','SG' => 'Singapore','SK' => 'Slovakia','SI' => 'Slovenia','ZA' => 'South Africa','ES' => 'Spain','LK' => 'Sri Lanka','SE' => 'Sweden','CH' => 'Switzerland','TW' => 'Taiwan','TH' => 'Thailand','TN' => 'Tunisia','TR' => 'Turkey','UA' => 'Ukraine','AE' => 'United Arab Emirates','GB' => 'United Kingdom','US' => 'United States','VN' => 'Vietnam',
    ];

    private function getCountryName(?string $code): string
    {
        if (!$code) return 'Unknown';
        return $this->countryNames[strtoupper($code)] ?? $code;
    }
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
            'experiences'     => Experience::count(),
            'educations'      => Education::count(),
        ];

        $recentMessages = ContactMessage::latest()->take(5)->get();
        $recentProjects = Project::latest()->take(5)->get();
        $recentBlogs = Blog::latest()->take(5)->get();

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

        $projectStats = Project::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get();

        $skillStats = Skill::select('is_active', DB::raw('COUNT(*) as total'))
            ->groupBy('is_active')
            ->get();

        $topCountries = Visitor::select('country', DB::raw('COUNT(*) as total'))
            ->whereNotNull('country')
            ->where('country', '!=', '')
            ->groupBy('country')
            ->orderByDesc('total')
            ->take(5)
            ->get()
            ->map(function ($item) {
                $item->country = $this->getCountryName($item->country);
                return $item;
            });

        $topPages = Visitor::select('page_url', DB::raw('COUNT(*) as total'))
            ->whereNotNull('page_url')
            ->where('page_url', '!=', '')
            ->groupBy('page_url')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $license = $this->licenseInfo();

        return view('admin.dashboard.index', compact(
            'stats',
            'recentMessages',
            'recentProjects',
            'recentBlogs',
            'visitorChart',
            'browserStats',
            'projectStats',
            'skillStats',
            'topCountries',
            'topPages',
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
