<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

use App\Models\BreakingNews;

class BreakingNewsController extends Controller
{
    public function index()
    {
        $breaking_news = BreakingNews::orderByDesc('id')->get();
        return view('admin.breakingNews.index', compact('breaking_news'));
    }

    public function create(Request $request)
    {
        $bn = BreakingNews::find($request->article_id);
        if (!$bn || $bn->status == "draft") {
            return redirect()->back()->with("error", "Either Breaking news was not published or not found.");
        }

        try {
            $bn = new BreakingNews;
            $bn->article_id = $request->article_id;
            $bn->save();
            return redirect('/admin/breaking-news')->with("success", "Breaking News added successfully.");
        } catch (Exception $ex) {
            return redirect()->back()->with("error", "Something went wrong while adding breaking news.");
        }
    }

    public function remove($id)
    {
        $bn = BreakingNews::find($id);
        if (!$bn) {
            return redirect()->back()->with("error", "Breaking news not found.");
        }

        try {
            $bn->delete();
            return redirect('/admin/breaking-news')->with("success", "Breaking news removed successfully.");
        } catch (Exception $ex) {
            return redirect()->back()->with("error", "Something went wrong while removing Breaking news.");
        }
    }
}
