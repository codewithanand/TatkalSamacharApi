<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Article;
use App\Models\Category;


class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
