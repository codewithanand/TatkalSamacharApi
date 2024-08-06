<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Media;
use App\Models\BreakingNews;

class Article extends Model
{
    use HasFactory;

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'category_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }

    public function medias()
    {
        return $this->hasMany(Media::class, 'article_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id', 'id');
    }

    public function breakingNews()
    {
        return $this->hasMany(BreakingNews::class, 'article_id', 'id');
    }
}
