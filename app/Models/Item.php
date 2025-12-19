<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['outfit_id', 'name', 'image'];

    public function outfit()
    {
        return $this->belongsTo(Outfit::class);
    }
}
