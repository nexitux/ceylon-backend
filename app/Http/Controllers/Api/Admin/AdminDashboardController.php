<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ContactMessage;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'categories_count' => Category::count(),
            'sub_categories_count' => SubCategory::count(),
            'contact_messages_count' => ContactMessage::count(),
            'recent_contact_messages' => ContactMessage::latest()->take(5)->get()
        ];

        return response()->json($stats);
    }
}
