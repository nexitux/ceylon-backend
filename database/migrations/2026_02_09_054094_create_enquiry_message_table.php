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
        Schema::create('enquiry_message', function (Blueprint $table) {
            $table->id();
            $table->string('e_name');
            $table->string('e_email');
            $table->string('e_phone');
            $table->string('e_in_date');
            $table->string('e_out_date');
            $table->string('e_r_type');
            $table->string('e_no_adults');
            $table->string('e_no_children')->nullable();
            $table->string('e_desc')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiry_message');
    }
};
