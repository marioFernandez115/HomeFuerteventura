<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = [
        'name',
        'description',
        'location',
        'price',
        'rooms',
        'bathrooms',
        'max_guests',
        'category_id',
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
