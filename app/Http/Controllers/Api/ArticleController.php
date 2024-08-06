<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ArticleController extends Controller
{
    public function update_read_count($id)
    {
        $article = Article::find($id);
        if ($article) {
            return redirect()->back()->with('error', 'Article not found');
        }
        $article_count = $article->read_count + 1;
        $article->read_count = $article_count;
        $article->update();
    }

    public function article_by_title(Request $request)
    {
        // $article = Article::where('title', 'like', '%' . $title . '%')
        //     ->whereNotNull('published_at')
        //     ->with(['tags', 'medias', 'comments'])
        //     ->get();

        // return response()->json($article);

        $query = $request->input('q');

        $articles = Article::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($articles);
    }
    public function article_by_slug($slug)
    {
        $slug = Str::slug($slug);
        $article = Article::where('slug', $slug)
            ->whereNotNull('published_at')
            ->with(['tags', 'medias', 'comments'])
            ->first();

        return response()->json($article);
    }

    public function articles_by_category($category_slug)
    {
        $slug = Str::slug($category_slug);
        $category = SubCategory::where('slug', $slug)->first();
        if (!$category)
            return response()->json(['message' => 'Article not found'], 404);
        $articles = Article::where('category_id', $category->id)
            ->whereNotNull('published_at')
            ->with(['tags', 'medias', 'comments'])
            ->get();

        return response()->json($articles);
    }
}
