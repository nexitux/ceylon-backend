<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubCategory extends Model
{
    protected $fillable = ['category_id', 'name', 'slug', 'status'];

    protected $appends = ['encoded_id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

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
