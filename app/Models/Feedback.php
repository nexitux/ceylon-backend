<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    protected $primaryKey = 'fe_id';
    public $incrementing = true;
    protected $keyType = 'int';


    protected $fillable = [  
            'fe_email',     
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
    
            'created_at',
            'updated_at'
    ];
}
