<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'location',
    ];

    protected $appends = ['encoded_id'];

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
