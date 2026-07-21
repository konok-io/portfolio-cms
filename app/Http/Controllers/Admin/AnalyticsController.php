<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    /**
     * Display analytics dashboard
     */
    public function index(Request $request)
    {
        $period = $request->get('period', '7');
        
        // Date range
        $startDate = Carbon::now()->subDays($period);
        $endDate = Carbon::now();
        
        // Basic stats
        $totalVisitors = Visitor::whereBetween('visited_date', [$startDate, $endDate])->count();
        $uniqueVisitors = Visitor::whereBetween('visited_date', [$startDate, $endDate])
            ->distinct('ip_address')
            ->count('ip_address');
        
        // Daily visitors for chart
        $dailyVisitors = Visitor::select(
                DB::raw('DATE(visited_date) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->whereBetween('visited_date', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
        
        // Browsers stats
        $browserStats = Visitor::select('browser', DB::raw('COUNT(*) as count'))
            ->whereBetween('visited_date', [$startDate, $endDate])
            ->groupBy('browser')
            ->orderBy('count', 'DESC')
            ->limit(5)
            ->get();
        
        // Platform stats
        $platformStats = Visitor::select('platform', DB::raw('COUNT(*) as count'))
            ->whereBetween('visited_date', [$startDate, $endDate])
            ->groupBy('platform')
            ->orderBy('count', 'DESC')
            ->limit(5)
            ->get();
        
        // Device stats
        $deviceStats = Visitor::select('device', DB::raw('COUNT(*) as count'))
            ->whereBetween('visited_date', [$startDate, $endDate])
            ->groupBy('device')
            ->orderBy('count', 'DESC')
            ->get();
        
        // Country stats
        $countryStats = Visitor::select('country', DB::raw('COUNT(*) as count'))
            ->whereBetween('visited_date', [$startDate, $endDate])
            ->groupBy('country')
            ->orderBy('count', 'DESC')
            ->limit(10)
            ->get();
        
        // Top pages
        $topPages = Visitor::select('page_url', DB::raw('COUNT(*) as count'))
            ->whereBetween('visited_date', [$startDate, $endDate])
            ->groupBy('page_url')
            ->orderBy('count', 'DESC')
            ->limit(10)
            ->get();
        
        // Recent visitors
        $recentVisitors = Visitor::orderBy('visited_date', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->limit(20)
            ->get();
        
        // Comparison with previous period
        $previousStartDate = Carbon::now()->subDays($period * 2);
        $previousEndDate = Carbon::now()->subDays($period);
        $previousVisitors = Visitor::whereBetween('visited_date', [$previousStartDate, $previousEndDate])->count();
        
        $visitorChange = $previousVisitors > 0 
            ? round((($totalVisitors - $previousVisitors) / $previousVisitors) * 100, 1)
            : 0;
        
        return view('admin.analytics.index', compact(
            'totalVisitors',
            'uniqueVisitors',
            'dailyVisitors',
            'browserStats',
            'platformStats',
            'deviceStats',
            'countryStats',
            'topPages',
            'recentVisitors',
            'visitorChange',
            'period'
        ));
    }
}
