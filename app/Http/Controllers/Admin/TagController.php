<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;

use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view("admin.tag.index", compact('tags'));
    }

    public function create()
    {
        return view("admin.tag.create");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:tags,slug'
        ]);

        try {
            $tag = new Tag;
            $tag->name = $validated['name'];
            $tag->slug = Str::slug($validated['slug']);
            $tag->save();
            return redirect('/admin/tags')->with("success", "Tag created successfully.");
        } catch (Exception $ex) {
            return redirect()->back()->with("error", "Something went wrong while creating new tag.");
        }
    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        if ($tag) {

            return view("admin.tag.edit", compact('tag'));
        } else {
            return redirect()->back()->with("error", "Tag not found.");
        }
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return redirect()->back()->with('error', 'Tag not found.');
        }

        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:tags,slug,' . $id
        ]);

        try {
            $tag->name = $validated['name'];
            $tag->slug = Str::slug($validated['slug']);
            $tag->update();

            return redirect('/admin/tags')->with('success', 'Tag updated successfully.');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something went wrong while updating the tag.');
        }
    }

    public function delete($id)
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return redirect()->back()->with('error', 'Tag not found.');
        }

        try {
            $tag->delete();

            return redirect('/admin/tags')->with('success', 'Tag deleted successfully.');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something went wrong while deleting the tag.');
        }
    }
}
