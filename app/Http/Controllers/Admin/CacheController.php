<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class CacheController extends Controller
{
    public function clear()
    {
        try {
            // Clear application cache
            Artisan::call('cache:clear');
            
            // Clear config cache
            Artisan::call('config:clear');
            
            // Clear view cache
            Artisan::call('view:clear');
            
            // Clear route cache
            Artisan::call('route:clear');
            
            // Clear compiled views
            Artisan::call('view:cache');
            
            return response()->json([
                'success' => true,
                'message' => 'All caches cleared successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error clearing cache: ' . $e->getMessage(),
            ], 500);
        }
    }
    
    public function optimize()
    {
        try {
            Artisan::call('config:cache');
            Artisan::call('route:cache');
            Artisan::call('view:cache');
            
            return response()->json([
                'success' => true,
                'message' => 'Application optimized successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error optimizing: ' . $e->getMessage(),
            ], 500);
        }
    }
}
