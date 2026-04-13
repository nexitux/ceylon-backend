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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id('fe_id');  
            $table->string('fe_email');     
            $table->enum('fe_check_in_process', ['1','2','3','4'])->comment('1-poor,2-average,3-good,4-excellent')->nullable();
            $table->enum('fe_staff_friendliness', ['1','2','3','4'])->comment('1-poor,2-average,3-good,4-excellent')->nullable();
            $table->enum('fe_cleanliness', ['1','2','3','4'])->comment('1-poor,2-average,3-good,4-excellent')->nullable();
            $table->enum('fe_bed_comfort', ['1','2','3','4'])->comment('1-poor,2-average,3-good,4-excellent')->nullable();
            $table->enum('fe_bathroom', ['1','2','3','4'])->comment('1-poor,2-average,3-good,4-excellent')->nullable();
            $table->enum('fe_room_maintenance', ['1','2','3','4'])->comment('1-poor,2-average,3-good,4-excellent')->nullable();
            $table->enum('fe_wiFi_quality', ['1','2','3','4'])->comment('1-poor,2-average,3-good,4-excellent')->nullable();
            $table->enum('fe_room_service', ['1','2','3','4'])->comment('1-poor,2-average,3-good,4-excellent')->nullable();
            $table->enum('fe_food_quality', ['1','2','3','4'])->comment('1-poor,2-average,3-good,4-excellent')->nullable();
            $table->enum('fe_stay_experience', ['1','2','3','4'])->comment('1-poor,2-average,3-good,4-excellent')->nullable();
            $table->enum('fe_value_for_money', ['1','2','3','4'])->comment('1-poor,2-average,3-good,4-excellent')->nullable();
            $table->enum('fe_stay_with_us_again', ['yes','no'])->comment('yes or no')->nullable();
            $table->enum('fe_recommend', ['yes','no'])->comment('yes or no')->nullable();
            $table->string('fe_name')->nullable();     
            $table->string('fe_room_no')->nullable();     
            $table->string('fe_date')->nullable();     
            $table->string('fe_phone')->nullable();      
            $table->string('fe_like')->nullable();      
            $table->string('fe_improve')->nullable();      
            $table->string('fe_appreciate')->nullable();
            $table->enum('fe_feedback', ['1','2','3','4','5'])->comment('star rating from 1 to 5');
    
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
