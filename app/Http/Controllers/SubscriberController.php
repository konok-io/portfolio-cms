<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\NewSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        // Honeypot spam protection - reject if field is filled
        if ($request->filled('website_url')) {
            // Bot detected - silently "succeed" but don't save
            return back()->with('newsletter_success', 'Thanks for subscribing! You will hear from us soon.');
        }
        
        // Validate reCAPTCHA if enabled
        $siteSetting = Setting::instance();
        if ($siteSetting->isRecaptchaEnabled()) {
            $recaptchaValidation = $this->validateRecaptcha($request->input('g-recaptcha-response'), $siteSetting->recaptcha_secret_key);
            
            if (!$recaptchaValidation['success']) {
                return back()->withErrors(['recaptcha' => 'reCAPTCHA verification failed. Please try again.'])->withInput();
            }
        }

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

        // Return JSON for AJAX requests
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thanks for subscribing! You will hear from us soon.',
                'newsletter_success' => 'Thanks for subscribing! You will hear from us soon.'
            ]);
        }

        return back()->with('newsletter_success', 'Thanks for subscribing! You will hear from us soon.');
    }
    
    protected function validateRecaptcha(string $recaptchaResponse, string $secretKey): array
    {
        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $secretKey,
                'response' => $recaptchaResponse,
            ]);
            
            $result = $response->json();
            
            return [
                'success' => $result['success'] ?? false,
                'score' => $result['score'] ?? null,
                'error-codes' => $result['error-codes'] ?? [],
            ];
        } catch (\Exception $e) {
            \Log::error('reCAPTCHA validation failed: ' . $e->getMessage());
            return ['success' => false, 'error-codes' => ['network-error']];
        }
    }
}
