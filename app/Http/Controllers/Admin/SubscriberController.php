<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(Request $request)
    {
        $query = Subscriber::query();
        
        if ($request->has('search') && $request->search) {
            $query->where('email', 'like', '%' . $request->search . '%');
        }
        
        if ($request->has('filter')) {
            if ($request->filter === 'active') {
                $query->where('is_active', true)->whereNull('unsubscribed_at');
            } elseif ($request->filter === 'inactive') {
                $query->where(function ($q) {
                    $q->where('is_active', false)->orWhereNotNull('unsubscribed_at');
                });
            }
        }
        
        $subscribers = $query->orderBy('subscribed_at', 'desc')->paginate(20);
        
        $stats = [
            'total' => Subscriber::count(),
            'active' => Subscriber::where('is_active', true)->whereNull('unsubscribed_at')->count(),
            'unsubscribed' => Subscriber::whereNotNull('unsubscribed_at')->count(),
        ];
        
        return view('admin.subscribers.index', compact('subscribers', 'stats'));
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();
        
        return redirect()->route('admin.subscribers.index')
            ->with('success', 'Subscriber deleted successfully.');
    }

    public function export()
    {
        $subscribers = Subscriber::where('is_active', true)
            ->whereNull('unsubscribed_at')
            ->get(['email', 'subscribed_at']);
        
        $csvContent = "Email,Subscribed At\n";
        foreach ($subscribers as $subscriber) {
            $csvContent .= "{$subscriber->email},{$subscriber->subscribed_at}\n";
        }
        
        return response()->streamDownload(
            fn () => print($csvContent),
            'subscribers.csv',
            ['Content-Type' => 'text/csv']
        );
    }
}
