<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    /**
     * Get the site settings.
     */
    public function index()
    {
        $settings = SiteSetting::first();
        return response()->json($settings ?: null);
    }
}
