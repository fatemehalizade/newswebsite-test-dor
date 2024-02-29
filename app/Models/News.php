<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class News extends Model
{
    use HasFactory,HasSlug,LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('News')->logOnly(["image", "title", "category_id", "summary", "description", "published_at"]);
        // Chain fluent methods for configuration options
    }

//    public $timestamps = false;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(40)
            ->usingSeparator('-');
    }
    protected $table="news";
    protected $fillable = [
        "code",
        "image",
        "title",
        "slug",
        "category_id",
        "user_id",
        "summary",
        "views",
        "description",
        "published_at"
    ];

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function Favorites(){
        return $this->hasMany(Favorite::class);
    }
}
