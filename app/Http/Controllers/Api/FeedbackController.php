<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;
use App\Mail\ThankYouFeedbackMail;


class FeedbackController extends Controller
{
    /**
     * Get the site settings.
     */
    public function storeFeedback(Request $request)
    {
        $fe_data = Feedback::create([  
            'fe_email'      => $request->fe_email ?? '0', 
            'fe_check_in_process' => $request->fe_check_in_process ?? '',
            'fe_staff_friendliness' => $request->fe_staff_friendliness ?? '',
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
            'fe_email',
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


        
        $siteSettings = \App\Models\SiteSetting::first();
        // Priority: Env MAIL_ADMIN_ADDRESS -> DB ss_email -> Env MAIL_FROM_ADDRESS
        $adminEmail = env('MAIL_ADMIN_ADDRESS') ?? $siteSettings->ss_email ?? env('MAIL_FROM_ADDRESS');
        $logoUrl = $siteSettings->ss_logo ? asset('storage/' . $siteSettings->ss_logo) : null;
        
        $fe_data['logo_url'] = $logoUrl;


        // 🔥 SEND MAIL ONLY IF fe_feedback EXISTS



        if ($fe_data->fe_mail_sent=='0' && $request->filled('fe_feedback') && $request->fe_feedback!='0' ) {
            if($adminEmail){
                Mail::to('estherthe00@gmail.com')->send(new FeedbackMail($fe_data));

            }
            // ✅ SEND THANK YOU MAIL TO CUSTOMER
            if ($request->fe_email!='0' && $fe_data->fe_email) {
                Mail::to($fe_data->fe_email)->send(new ThankYouFeedbackMail($fe_data));
            }


            Feedback::where('fe_id', base64_decode($id))
            ->where('fe_mail_sent', '1')
            ->update();


        }


        


        return response()->json([
            'message' => 'Feedback updated', 
        ]);
    }


}
