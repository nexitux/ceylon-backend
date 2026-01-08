<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        $message = ContactMessage::create($validated);

        // Fetch Site Settings for Admin Email and Logo
        $siteSettings = \App\Models\SiteSetting::first();
        $adminEmail = $siteSettings->ss_email ?? env('MAIL_FROM_ADDRESS');
        $logoUrl = $siteSettings->ss_logo ? asset('storage/' . $siteSettings->ss_logo) : null;
        
        $validated['logo_url'] = $logoUrl;

        // Send email to Admin
        if ($adminEmail) {
            \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\ContactFormAdminMail($validated));
        }

        // Send acknowledgment to Customer
        \Illuminate\Support\Facades\Mail::to($validated['email'])->send(new \App\Mail\ContactFormCustomerMail($validated));

        return response()->json([
            'message' => 'Message sent successfully',
            'data' => $message
        ], 201);
    }
}
