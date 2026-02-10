<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnquiryMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'e_name',
        'e_email',
        'e_phone', 
        'e_in_date',
        'e_out_date',
        'e_r_type',
        'e_no_adults',
        'e_no_children',
        'e_desc',
        'created_at',
        'updated_at',
    ];

     
    /**
     * Get the base64 encoded ID.
     *
     * @return string
     */
    public function getEncodedIdAttribute(): string
    {
        return base64_encode($this->id);
    }
}
