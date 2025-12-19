<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trend extends Model
{
    protected $fillable = [
        'title',
        'description',
        'cover_image',
        'is_active'
    ];

    public function tiktoks()
    {
        return $this->hasMany(TrendTiktok::class);
    }
}

