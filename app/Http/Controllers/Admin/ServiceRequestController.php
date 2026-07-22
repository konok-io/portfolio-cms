<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = ServiceRequest::with('service')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('service_id')) {
            $query->where('service_id', $request->service_id);
        }

        $requests = $query->paginate(15);

        return view('admin.service-requests.index', compact('requests'));
    }

    public function show(ServiceRequest $request)
    {
        return view('admin.service-requests.show', compact('request'));
    }

    public function updateStatus(Request $request, ServiceRequest $serviceRequest)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed,cancelled',
        ]);

        $serviceRequest->update(['status' => $validated['status']]);

        return back()->with('success', 'Status updated successfully.');
    }

    public function destroy(ServiceRequest $serviceRequest)
    {
        $serviceRequest->delete();

        return redirect()->route('admin.service-requests.index')->with('success', 'Request deleted successfully.');
    }
}
