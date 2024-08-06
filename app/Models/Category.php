<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Article;
use App\Models\SubCategory;
use App\Models\Navbar;


class Category extends Model
{
    use HasFactory;

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }

    public function navbars()
    {
        return $this->hasMany(Navbar::class, 'category_id', 'id');
    }
}
