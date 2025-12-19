<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrendTiktok extends Model
{
    protected $fillable = [
        'trend_id',
        'tiktok_url',
        'creator_name',
        'caption',
        'thumbnail'
    ];

    public function trend()
    {
        return $this->belongsTo(Trend::class);
    }
}

