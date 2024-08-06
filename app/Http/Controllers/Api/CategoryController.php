<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Article;
use App\Models\Category;

class CategoryController extends Controller
{
    public function all_categories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function all_categories_with_subcategories()
    {
        $categories = Category::with('subCategories')->get();
        return response()->json($categories);
    }

    public function all_articles_by_all_categories()
    {
        $categories = Category::with('articles')->get();
        return response()->json($categories);
    }

    public function articles_by_category($category)
    {
        $slug = Str::slug($category);
        $category = Category::where('slug', $slug)->latest()->first();
        if (!$category) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        $articles = Article::where('category_id', $category->id)->get();
        return response()->json($articles);
    }

    public function categories_by_article_count()
    {

    }
}
