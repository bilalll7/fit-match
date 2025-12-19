<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecommendationItem extends Model
{
    protected $fillable = [
        'recommendation_id',
        'category',
        'name',
        'image'
    ];

    public function recommendation()
    {
        return $this->belongsTo(Recommendation::class);
    }
}
