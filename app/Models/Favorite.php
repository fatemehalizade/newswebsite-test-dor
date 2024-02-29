<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $tbale="favorites";
    protected $fillable = [
        "news_id",
        "user_id",
        "is_active"
    ];

    public function News(){
        return $this->belongsTo(News::class);
    }

    public function scopeCheckFavorite($query, $userId,$newsId)
    {
        return $query->where("user_id",$userId)->where("news_id",$newsId);
    }

}
