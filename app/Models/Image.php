<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'url',
        'title',
        'description',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}
