<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'ss_site_title',
        'ss_company_name',
        'ss_logo',
        'ss_logo_alt',
        'ss_favicon',
        'ss_favicon_alt',
        'ss_phone',
        'ss_email',
        'ss_address',
        'ss_facebook',
        'ss_instagram',
        'ss_linkedin',
        'ss_twitter_x',
        'ss_youtube',
        'ss_pinterest',
        'ss_threads',
        'ss_tumblr',
        'ss_footer_copy',
        'ss_footer_content_privacy_link',
        'ss_footer_privacy_policy_link',
        'ss_footer_terms_link',
        'ss_is_active',
    ];

    protected $casts = [
        'ss_is_active' => 'boolean',
    ];
}
