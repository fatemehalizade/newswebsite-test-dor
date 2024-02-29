<?php

namespace App\Models;

use App\Enums\BoolStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table="comments";
    protected $fillable = [
        'comment',
        'parent_id',
        'fullname',
        'user_id',
        'email',
        'news_id',
        'is_show',
        'show_at',
        'is_seen',
        'admin_reply'
    ];

    public function ActiveParent() {
        return $this->belongsTo(Comment::class,"parent_id")->where("is_show",BoolStatus::yes);
    }
    public function ActiveChildren() {
        return $this->hasMany(Comment::class,"parent_id")->where("is_show",BoolStatus::yes);
    }

    public function Parent() {
        return $this->belongsTo(Comment::class,"parent_id");
    }
    public function Children() {
        return $this->hasMany(Comment::class,"parent_id");
    }

    public function News() {
        return $this->belongsTo(News::class);
    }
}
