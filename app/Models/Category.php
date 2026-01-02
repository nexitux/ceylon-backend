<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'image', 'image2', 'image3', 'image4', 'status'];

    protected $appends = ['encoded_id'];

    public function subCategories(): HasMany
    {
        return $this->hasMany(SubCategory::class);
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
