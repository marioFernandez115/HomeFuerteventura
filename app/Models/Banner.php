<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_id',
        'link',
        'active',
    ];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
