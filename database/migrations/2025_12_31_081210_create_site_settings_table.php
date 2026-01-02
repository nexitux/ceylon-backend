<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('ss_site_title');
            $table->string('ss_company_name')->nullable();
            $table->string('ss_logo')->nullable();
            $table->string('ss_logo_alt')->nullable();
            $table->string('ss_favicon')->nullable();
            $table->string('ss_favicon_alt')->nullable();
            $table->string('ss_phone')->nullable();
            $table->string('ss_email')->nullable();
            $table->text('ss_address')->nullable();
            $table->string('ss_facebook')->nullable();
            $table->string('ss_instagram')->nullable();
            $table->string('ss_linkedin')->nullable();
            $table->string('ss_twitter_x')->nullable();
            $table->string('ss_youtube')->nullable();
            $table->string('ss_pinterest')->nullable();
            $table->string('ss_threads')->nullable();
            $table->string('ss_tumblr')->nullable();
            $table->text('ss_footer_copy')->nullable();
            $table->string('ss_footer_content_privacy_link')->nullable();
            $table->string('ss_footer_privacy_policy_link')->nullable();
            $table->string('ss_footer_terms_link')->nullable();
            $table->boolean('ss_is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
