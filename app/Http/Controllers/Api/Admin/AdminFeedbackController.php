<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class AdminFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getFeedback()
    {
        return response()->json(Feedback::get());
    }


    public function filterFeedback(Request $request)
    {
        $query = Feedback::query();

        // Filter by star rating
        if ($request->has('r_star') && $request->r_star != '') {
            $query->where('r_star', $request->r_star);
        }

        if ($request->has('from_date') && $request->has('to_date')) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        $fd_res = $query->get();

        return response()->json($fd_res);
    }
    
}
