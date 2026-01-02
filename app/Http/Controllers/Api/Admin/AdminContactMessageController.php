<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(ContactMessage::latest()->get());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $message = ContactMessage::find($id);

        if (!$message) {
            return response()->json(['message' => 'Message not found'], 404);
        }

        return response()->json($message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = ContactMessage::find($id);

        if (!$message) {
            return response()->json(['message' => 'Message not found'], 404);
        }

        $message->delete();

        return response()->json(['message' => 'Message deleted']);
    }
}
