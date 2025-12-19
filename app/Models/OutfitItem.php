<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutfitItem extends Model
{
    protected $fillable = [
        'outfit_id',
        'category_id',
        'name',
        'image',
    ];

    public function outfit()
    {
        return $this->belongsTo(Outfit::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

