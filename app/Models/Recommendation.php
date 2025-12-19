<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'day',
        'title',
        'source'
    ];

    public function items()
    {
        return $this->hasMany(RecommendationItem::class);
    }
}
