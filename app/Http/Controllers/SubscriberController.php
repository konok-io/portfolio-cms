<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\User;
use App\Notifications\NewSubscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $isNew = !Subscriber::where('email', $data['email'])->exists();
        
        $subscriber = Subscriber::firstOrCreate(
            ['email' => $data['email']],
            ['subscribed_at' => now()]
        );

        // Send notification only for new subscribers
        if ($isNew) {
            $adminUsers = User::whereHas('roles', function ($query) {
                $query->where('name', 'Admin');
            })->get();

            foreach ($adminUsers as $admin) {
                $admin->notify(new NewSubscriber($subscriber));
            }
        }

        return back()->with('newsletter_success', 'Thanks for subscribing! You will hear from us soon.');
    }
}
