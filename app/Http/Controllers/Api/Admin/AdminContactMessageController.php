<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\EnquiryMessage;

use Illuminate\Http\Request;

class AdminContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = ContactMessage::latest()->get();

        if ($messages->isEmpty()) {
            return response()->json([
                'message' => 'No contact messages found',
                'data' => []
            ]);
        }

        return response()->json($messages);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $decodedId = $this->decodeId($id);
        $message = ContactMessage::find($decodedId);

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
        $decodedId = $this->decodeId($id);
        $message = ContactMessage::find($decodedId);

        if (!$message) {
            return response()->json(['message' => 'Message not found'], 404);
        }

        $message->delete();

        return response()->json(['message' => 'Message deleted']);
    }


    public function getEnquiries()
    {
        $messages = EnquiryMessage::latest()->get();

        if ($messages->isEmpty()) {
            return response()->json([
                'message' => 'No enquiry messages found',
                'data' => []
            ]);
        }

        return response()->json($messages);
    }


    public function destroyEnquiry(string $id)
    {
        $decodedId = $this->decodeId($id);
        $message = EnquiryMessage::find($decodedId);

        if (!$message) {
            return response()->json(['message' => 'Message not found'], 404);
        }

        $message->delete();

        return response()->json(['message' => 'Enquiry message deleted']);
    }

    /**
     * Encode ID to base64.
     *
     * @param int $id
     * @return string
     */
    private function encodeId(int $id): string
    {
        return base64_encode($id);
    }

    /**
     * Decode base64 ID to integer.
     *
     * @param string $encodedId
     * @return int
     */
    private function decodeId(string $encodedId): int
    {
        return (int) base64_decode($encodedId);
    }
}
