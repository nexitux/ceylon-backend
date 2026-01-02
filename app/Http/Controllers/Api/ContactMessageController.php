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

        return response()->json([
            'message' => 'Message sent successfully',
            'data' => $message
        ], 201);
    }
}
