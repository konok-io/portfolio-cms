<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterCampaign;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class NewsletterCampaignController extends Controller
{
    /**
     * Display campaigns list
     */
    public function index()
    {
        $campaigns = NewsletterCampaign::getAll();
        $subscribersCount = Subscriber::where('is_active', true)->whereNull('unsubscribed_at')->count();
        
        return view('admin.newsletter.index', compact('campaigns', 'subscribersCount'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $subscribersCount = Subscriber::where('is_active', true)->whereNull('unsubscribed_at')->count();
        return view('admin.newsletter.create', compact('subscribersCount'));
    }

    /**
     * Store new campaign
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'schedule' => 'nullable|boolean',
            'scheduled_date' => 'nullable|required_if:schedule,1|date',
            'scheduled_time' => 'nullable|required_if:schedule,1',
            'send_now' => 'nullable|boolean',
        ]);

        $scheduledAt = null;
        $status = 'draft';

        if ($request->boolean('schedule') && $request->filled('scheduled_date')) {
            $scheduledAt = \Carbon\Carbon::parse($request->scheduled_date . ' ' . ($request->scheduled_time ?? '09:00'));
            $status = 'scheduled';
        }

        $campaign = NewsletterCampaign::create([
            'subject' => $request->subject,
            'content' => $request->content,
            'status' => $status,
            'scheduled_at' => $scheduledAt,
        ]);

        // Send immediately if requested
        if ($request->boolean('send_now')) {
            $campaign->send();
            return redirect()->route('admin.newsletter.index')
                ->with('success', 'Newsletter campaign sent successfully!');
        }

        return redirect()->route('admin.newsletter.index')
            ->with('success', 'Newsletter campaign created successfully!');
    }

    /**
     * Show edit form
     */
    public function edit(NewsletterCampaign $campaign)
    {
        return view('admin.newsletter.edit', compact('campaign'));
    }

    /**
     * Update campaign
     */
    public function update(Request $request, NewsletterCampaign $campaign)
    {
        if ($campaign->status !== 'draft') {
            return redirect()->back()->with('error', 'Only draft campaigns can be edited!');
        }

        $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $campaign->update([
            'subject' => $request->subject,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.newsletter.index')
            ->with('success', 'Campaign updated successfully!');
    }

    /**
     * Send campaign
     */
    public function send(NewsletterCampaign $campaign)
    {
        if ($campaign->status === 'sent' || $campaign->status === 'sending') {
            return redirect()->back()->with('error', 'This campaign has already been sent!');
        }

        $campaign->send();

        return redirect()->route('admin.newsletter.index')
            ->with('success', 'Campaign sent successfully!');
    }

    /**
     * Delete campaign
     */
    public function destroy(NewsletterCampaign $campaign)
    {
        if ($campaign->status === 'sending') {
            return redirect()->back()->with('error', 'Cannot delete a campaign that is currently sending!');
        }

        $campaign->delete();

        return redirect()->route('admin.newsletter.index')
            ->with('success', 'Campaign deleted successfully!');
    }

    /**
     * Preview campaign
     */
    public function preview(NewsletterCampaign $campaign)
    {
        return view('admin.newsletter.preview', compact('campaign'));
    }
}
