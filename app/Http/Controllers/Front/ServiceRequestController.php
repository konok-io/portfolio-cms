<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class ServiceRequestController extends Controller
{
    public function create(Request $request)
    {
        $serviceId = $request->get('service_id');
        $service = $serviceId ? Service::find($serviceId) : null;
        $services = Service::active()->ordered()->get();

        return view('front.service-request', compact('service', 'services'));
    }

    public function store(Request $request)
    {
        $siteSetting = Setting::instance();
        
        // Honeypot spam protection - reject if field is filled
        if ($request->filled('company_url')) {
            // Bot detected - silently redirect to thank you
            return redirect()->route('thank-you')->with('success', 'Your request has been submitted! We will get back to you soon.');
        }
        
        // Validate reCAPTCHA if enabled
        if ($siteSetting->isRecaptchaEnabled()) {
            $recaptchaValidation = $this->validateRecaptcha($request->input('g-recaptcha-response'), $siteSetting->recaptcha_secret_key);
            
            if (!$recaptchaValidation['success']) {
                return back()->withErrors(['recaptcha' => 'reCAPTCHA verification failed. Please try again.'])->withInput();
            }
        }

        $validated = $request->validate([
            'service_id' => 'nullable|exists:services,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'budget' => 'nullable|in:under_1k,1k_5k,5k_10k,10k_plus,not_sure',
            'message' => 'required|string|max:2000',
        ]);

        $serviceRequest = ServiceRequest::create($validated);

        // You can send email notification here
        // Mail::to(config('mail.from.address'))->send(new ServiceRequestMail($serviceRequest));

        return redirect()->route('thank-you')->with('success', 'Your request has been submitted! We will get back to you soon.');
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
