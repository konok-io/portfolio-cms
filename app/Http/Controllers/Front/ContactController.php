<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\NewContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function index()
    {
        $siteSetting = Setting::instance();

        return view('front.contact', [
            'siteSetting' => $siteSetting,
        ]);
    }

    public function store(Request $request)
    {
        $siteSetting = Setting::instance();
        
        // Honeypot spam protection - reject if field is filled
        if ($request->filled('website_url')) {
            // Bot detected - silently "succeed" but don't save
            if ($request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Message sent successfully!']);
            }
            return back()->with('success', 'Message sent successfully!');
        }
        
        // Validate reCAPTCHA if enabled
        if ($siteSetting->isRecaptchaEnabled()) {
            $recaptchaValidation = $this->validateRecaptcha($request->input('g-recaptcha-response'), $siteSetting->recaptcha_secret_key);
            
            if (!$recaptchaValidation['success']) {
                if ($request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => 'reCAPTCHA verification failed. Please try again.'], 422);
                }
                return back()->withErrors(['recaptcha' => 'reCAPTCHA verification failed. Please try again.'])->withInput();
            }
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $validated['ip_address'] = $request->ip();

        $contactMessage = ContactMessage::create($validated);

        // Send email notification to admin users
        $adminUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'Admin');
        })->get();

        foreach ($adminUsers as $admin) {
            $admin->notify(new NewContactMessage($contactMessage));
        }

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Your message has been sent successfully!']);
        }

        return redirect()->route('thank-you')->with('success', 'Your message has been sent successfully!');
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
            // Log the error but block form submission for security
            \Log::error('reCAPTCHA validation failed: ' . $e->getMessage());
            return ['success' => false, 'error-codes' => ['network-error']];
        }
    }
}
