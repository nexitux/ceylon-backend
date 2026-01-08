<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSiteSettingController extends Controller
{
    /**
     * Get the site settings (Singleton).
     */
    public function index()
    {
        // Return the first record or empty object
        $settings = SiteSetting::first();
        return response()->json($settings ?: []);
    }

    /**
     * Update or Create site settings.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ss_site_title' => 'required|string|max:200',
            'ss_company_name' => 'nullable|string|max:200',
            'ss_logo' => 'nullable|image|max:2048',
            'ss_logo_alt' => 'nullable|string|max:200',
            'ss_favicon' => 'nullable|image|max:1024',
            'ss_favicon_alt' => 'nullable|string|max:200',
            'ss_phone' => 'nullable|string|max:20',
            'ss_booking_phone' => 'nullable|string|max:20',
            'ss_email' => 'nullable|email',
            'ss_address' => 'nullable|string',
            'ss_facebook' => 'nullable|url',
            'ss_instagram' => 'nullable|url',
            'ss_linkedin' => 'nullable|url',
            'ss_twitter_x' => 'nullable|url',
            'ss_youtube' => 'nullable|url',
            'ss_pinterest' => 'nullable|url',
            'ss_threads' => 'nullable|url',
            'ss_tumblr' => 'nullable|url',
            'ss_footer_copy' => 'nullable|string|max:300',
            'ss_footer_content_privacy_link' => 'nullable|string|max:200',
            'ss_footer_privacy_policy_link' => 'nullable|string|max:200',
            'ss_footer_terms_link' => 'nullable|string|max:200',
            'ss_is_active' => 'boolean',
        ]);

        $settings = SiteSetting::first();

        // Handle File Uploads
        if ($request->hasFile('ss_logo')) {
            if ($settings && $settings->ss_logo && Storage::disk('public')->exists($settings->ss_logo)) {
                Storage::disk('public')->delete($settings->ss_logo);
            }
            $file = $request->file('ss_logo');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('site_settings', $filename, 'public');
            $validated['ss_logo'] = $path;
        }

        if ($request->hasFile('ss_favicon')) {
            if ($settings && $settings->ss_favicon && Storage::disk('public')->exists($settings->ss_favicon)) {
                Storage::disk('public')->delete($settings->ss_favicon);
            }
            $file = $request->file('ss_favicon');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('site_settings', $filename, 'public');
            $validated['ss_favicon'] = $path;
        }

        if ($settings) {
            $settings->update($validated);
        } else {
            $settings = SiteSetting::create($validated);
        }

        return response()->json([
            'message' => 'Site settings updated successfully',
            'data' => $settings
        ]);
    }

    /**
     * Delete a specific image from site settings.
     */
    public function deleteImage(Request $request)
    {
        $validated = $request->validate([
            'field_name' => 'required|string|in:ss_logo,ss_favicon',
        ]);

        $settings = SiteSetting::first();

        if (!$settings) {
            return response()->json(['message' => 'Settings not found'], 404);
        }

        $field = $validated['field_name'];

        if ($settings->$field) {
            if (Storage::disk('public')->exists($settings->$field)) {
                Storage::disk('public')->delete($settings->$field);
            }
            
            $settings->$field = null;
            $settings->save();
        }

        return response()->json([
            'message' => 'Image deleted successfully',
            'data' => $settings
        ]);
    }
}
