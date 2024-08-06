<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Exception;
use Carbon\Carbon;


use App\Models\Tag;
use App\Models\Category;
use App\Models\Article;
use App\Models\Media;
use App\Models\SubCategory;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view("admin.article.index", compact('articles'));
    }

    public function create()
    {
        $categories = SubCategory::all();
        $tags = Tag::all();
        return view("admin.article.create", compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:articles,slug',
            'content' => 'required',
            'category' => 'required',
            'tags' => 'required|array',
            'tags.*' => 'string',
        ]);

        try {
            $article = new Article;
            $article->title = $validated['title'];
            $article->slug = Str::slug($validated['slug']);
            $article->category_id = $validated['category'];
            $article->content = $validated['content'];
            $article->user_id = auth()->user()->id;
            $article->save();

            if ($request->hasfile('files')) {
                $uploadedFiles = $request->file('files');
                foreach ($uploadedFiles as $file) {
                    $filetype = $file->getClientOriginalExtension();
                    $filename = time() . uniqid() . '.' . $filetype;
                    $file->move('uploads/article/', $filename);
                    Media::create([
                        'article_id' => $article->id,
                        'file_path' => $filename,
                        'file_type' => $filetype,
                    ]);
                }
            }

            // Process the tags input
            $tags = collect($request->input('tags'))->map(function ($tag) {
                // Generate a slug from the tag name
                $slug = Str::slug($tag);

                // Find or create the tag
                return Tag::firstOrCreate(
                    ['slug' => $slug],
                    ['name' => $tag, 'slug' => $slug]
                )->id;
            })->toArray();

            // Synchronize the tags with the article
            $article->tags()->sync($tags);

            return redirect('/admin/articles')->with("success", "Article created successfully.");
        } catch (Exception $ex) {
            return redirect()->back()->with("error", "Something went wrong while creating new article.");
        }
    }


    public function edit($id)
    {
        $article = Article::find($id);
        if (!$article) {
            return redirect()->back()->with("error", "Article not found.");
        }
        $categories = Category::all();
        $tags = Tag::all();
        $medias = Media::where('article_id', $id)->get();
        return view("admin.article.edit", compact('article', 'categories', 'tags', 'medias'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return redirect()->back()->with("error", "Article not found.");
        }

        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
        ]);

        try {
            $article->title = $validated['title'];
            $article->category_id = $validated['category'];
            $article->content = $validated['content'];
            $article->user_id = auth()->user()->id;
            $article->update();

            if ($request->hasfile('files')) {
                $uploadedFiles = $request->file('files');
                foreach ($uploadedFiles as $file) {
                    $filetype = $file->getClientOriginalExtension();
                    $filename = time() . uniqid() . '.' . $filetype;
                    $file->move('uploads/article/', $filename);
                    Media::create([
                        'article_id' => $article->id,
                        'file_path' => $filename,
                        'file_type' => $filetype,
                    ]);
                }
            }

            // Process the tags input
            $tags = collect($request->input('tags'))->map(function ($tag) {
                // Generate a slug from the tag name
                $slug = Str::slug($tag);

                // Find or create the tag
                return Tag::firstOrCreate(
                    ['slug' => $slug],
                    ['name' => $tag, 'slug' => $slug]
                )->id;
            })->toArray();

            // Attach the tags to the article
            $article->tags()->sync($tags);


            return redirect('/admin/articles')->with("success", "Article updated successfully.");
        } catch (Exception $ex) {
            return redirect()->back()->with("error", "Something went wrong while updating new category.");
        }
    }

    public function delete($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return redirect()->back()->with("error", "Article not found.");
        }

        $medias = $article->medias;
        if ($medias) {
            foreach ($medias as $media) {
                $media->delete();
            }
        }

        $article->delete();
        return redirect('/admin/articles')->with("success", "Article deleted successfully.");
    }

    public function publish($id)
    {
        $article = Article::find($id);
        if (!$article) {
            return redirect()->back()->with("error", "Article not found.");
        }
        try {
            $article->status = "published";
            $article->published_at = Carbon::now();
            $article->update();
            return redirect('/admin/articles')->with("success", "Article published successfully.");
        } catch (Exception $ex) {
            return redirect()->back()->with("error", "Something went wrong while publishing new category.");
        }
    }

    public function unpublish($id)
    {
        $article = Article::find($id);
        if (!$article) {
            return redirect()->back()->with("error", "Article not found.");
        }
        try {
            $article->status = "draft";
            $article->published_at = null;
            $article->update();
            return redirect('/admin/articles')->with("success", "Article published successfully.");
        } catch (Exception $ex) {
            return redirect()->back()->with("error", "Something went wrong while publishing new category.");
        }
    }

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
}
