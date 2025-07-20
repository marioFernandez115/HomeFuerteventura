<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name',
        'description',
        'location',
        'image_id',
    ];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
