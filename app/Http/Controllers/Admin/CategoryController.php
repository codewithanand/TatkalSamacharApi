<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view("admin.category.index", compact('categories'));
    }

    public function create()
    {
        return view("admin.category.create");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug'
        ]);

        try {
            $category = new Category;
            $category->name = $validated['name'];
            $category->slug = Str::slug($validated['slug']);
            $category->save();
            return redirect('/admin/categories')->with("success", "Category created successfully.");
        } catch (Exception $ex) {
            return redirect()->back()->with("error", "Something went wrong while creating new category.");
        }
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if ($category) {

            return view("admin.category.edit", compact('category'));
        } else {
            return redirect()->back()->with("error", "Category not found.");
        }
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }

        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $id
        ]);

        try {
            $category->name = $validated['name'];
            $category->slug = Str::slug($validated['slug']);
            $category->update();

            return redirect('/admin/categories')->with('success', 'Category updated successfully.');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something went wrong while updating the category.');
        }
    }

    public function delete($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }

        try {
            $category->delete();

            return redirect('/admin/categories')->with('success', 'Category deleted successfully.');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something went wrong while deleting the category.');
        }
    }
}
