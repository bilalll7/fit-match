<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'role',
        'is_active'
    ];

    public function outfits()
    {
        return $this->hasMany(Outfit::class);
    }
}

