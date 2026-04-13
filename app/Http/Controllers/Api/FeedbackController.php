<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Get the site settings.
     */
    public function storeFeedback()
    {
        $fe_data = Feedback::create([  
            'fe_email'      => $request->fe_email ?? '',  
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return response()->json([
            'message' => 'Feedback submitted successfully', 
            'fe_data' => $fe_data
        ]);

    }

    public function updateFeedback(Request $request, $id)
    {
        $fe_data = Feedback::where('fe_id', base64_decode($id))
            ->firstOrFail();
 
        


        $data = $request->only([ 
            'fe_check_in_process',
            'fe_staff_friendliness',
            'fe_cleanliness',
            'fe_bed_comfort',
            'fe_bathroom',
            'fe_room_maintenance',
            'fe_wiFi_quality',
            'fe_room_service',
            'fe_food_quality',
            'fe_stay_experience',
            'fe_value_for_money',
            'fe_stay_with_us_again',
            'fe_recommend',
            'fe_name',
            'fe_room_no',
            'fe_date',
            'fe_phone',
            'fe_like',
            'fe_improve',
            'fe_appreciate',
            'fe_feedback',
        ]);

        // Remove null values (important)
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });

        $data['updated_at'] = now();

        $fe_data->update($data);

        return response()->json([
            'message' => 'Feedback updated', 
        ]);
    }


}
