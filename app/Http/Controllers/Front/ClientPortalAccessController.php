<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ClientPortal;
use Illuminate\Http\Request;

class ClientPortalAccessController extends Controller
{
    public function access(Request $request)
    {
        return view('front.client-portal.access');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $portal = ClientPortal::byToken($request->token)->first();

        if (!$portal) {
            return back()->withErrors(['token' => 'Invalid access token. Please check and try again.']);
        }

        // Store in session for access
        session(['client_portal_token' => $request->token]);

        return redirect()->route('client-portal.dashboard');
    }

    public function dashboard(Request $request)
    {
        $token = session('client_portal_token');

        if (!$token) {
            return redirect()->route('client-portal.access');
        }

        $portal = ClientPortal::byToken($token)->first();

        if (!$portal) {
            session()->forget('client_portal_token');
            return redirect()->route('client-portal.access')->withErrors(['token' => 'Session expired. Please enter your access token again.']);
        }

        return view('front.client-portal.dashboard', compact('portal'));
    }

    public function logout(Request $request)
    {
        session()->forget('client_portal_token');
        return redirect()->route('client-portal.access')->with('success', 'You have been logged out of the client portal.');
    }
}
