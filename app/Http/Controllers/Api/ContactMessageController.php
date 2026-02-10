<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\EnquiryMessage;

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
        // Priority: Env MAIL_ADMIN_ADDRESS -> DB ss_email -> Env MAIL_FROM_ADDRESS
        $adminEmail = env('MAIL_ADMIN_ADDRESS') ?? $siteSettings->ss_email ?? env('MAIL_FROM_ADDRESS');
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

    public function storeEnquiry(Request $request)
    {
        $validated = $request->validate([
            'e_name' => 'required|string|max:255',
            'e_email' => 'required|string|email|max:255',
            'e_phone' => 'nullable|string|max:255', 
            'e_in_date' => 'nullable|string|max:255',
            'e_out_date' => 'nullable|string|max:255',
            'e_r_type' => 'nullable|string|max:255',
            'e_no_adults' => 'nullable|string|max:255', 
        ]);

        $message = EnquiryMessage::create([  
            'e_name'      => $request->e_name,
            'e_email'       => $e_email,
            'e_phone'      => $request->e_phone ?? '',
            'e_in_date'       => $request->e_in_date ?? '',
            'e_out_date'  => $request->e_out_date,
            'e_r_type' => $request->e_r_type ?? 0,
            'e_no_adults' => $request->e_no_adults ?? 0,
            'e_no_children' => $request->e_no_children ?? 0,
            'e_desc' => $request->e_desc ?? 0, 
            'created_at'  => now(), 
            'updated_at'  => now(),
            

        ]);

         

        // Fetch Site Settings for Admin Email and Logo
        $siteSettings = \App\Models\SiteSetting::first();
        // Priority: Env MAIL_ADMIN_ADDRESS -> DB ss_email -> Env MAIL_FROM_ADDRESS
        $adminEmail = env('MAIL_ADMIN_ADDRESS') ?? $siteSettings->ss_email ?? env('MAIL_FROM_ADDRESS');
        $logoUrl = $siteSettings->ss_logo ? asset('storage/' . $siteSettings->ss_logo) : null;
        
        $validated['logo_url'] = $logoUrl;

        // Send email to Admin
        if ($adminEmail) {
            \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\EnquiryFormAdminMail($message));
        }

        // Send acknowledgment to Customer
        \Illuminate\Support\Facades\Mail::to($validated['e_email'])->send(new \App\Mail\EnquiryFormCustomerMail($message));

        return response()->json([
            'message' => 'Message sent successfully',
            'data' => $message
        ], 201);
    }
}
