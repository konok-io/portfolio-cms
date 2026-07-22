<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
}
