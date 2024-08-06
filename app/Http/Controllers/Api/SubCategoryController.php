<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function get($id)
    {
        $subCategory = SubCategory::find($id);
        if (!$subCategory) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json($subCategory);
    }

    public function get_by_name($name)
    {
        $slug = Str::slug($name);
        $subCategory = SubCategory::where('slug', $slug)->latest()->first();
        if (!$subCategory) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json($subCategory);
    }

    public function get_all()
    {
        $subCategories = SubCategory::all(['id', 'name', 'slug']);
        return response()->json($subCategories);
    }

    public function get_by_article_count()
    {
        $subCategories = SubCategory::withCount('articles')
            ->orderBy('articles_count', 'desc')
            ->get(['id', 'name', 'slug', 'articles_count']);
        return response()->json($subCategories);
    }

    public function get_by_no_of_articles($count)
    {
        $subCategories = SubCategory::with([
            'articles' => function ($query) use ($count) {
                $query->take($count);
            }
        ])->get(['id', 'name', 'slug']);
        return response()->json($subCategories);
    }
}
