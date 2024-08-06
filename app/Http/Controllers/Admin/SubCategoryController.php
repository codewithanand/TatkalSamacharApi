<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function index()
    {
        $sub_categories = SubCategory::all();
        return view("admin.subCategory.index", compact('sub_categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view("admin.subCategory.create", compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:sub_categories,slug'
        ]);

        try {
            $subCategory = new SubCategory;
            $subCategory->category_id = $request->category_id;
            $subCategory->name = $validated['name'];
            $subCategory->slug = Str::slug($validated['slug']);
            $subCategory->save();
            return redirect('/admin/sub-categories')->with("success", "SubCategory created successfully.");
        } catch (Exception $ex) {
            return redirect()->back()->with("error", "Something went wrong while creating new subCategory.");
        }
    }

    public function edit($id)
    {
        $categories = Category::all();
        $subCategory = SubCategory::find($id);
        if ($subCategory) {

            return view("admin.subCategory.edit", compact('categories', 'subCategory'));
        } else {
            return redirect()->back()->with("error", "SubCategory not found.");
        }
    }

    public function update(Request $request, $id)
    {
        $subCategory = SubCategory::find($id);

        if (!$subCategory) {
            return redirect()->back()->with('error', 'SubCategory not found.');
        }

        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:subSubCategories,slug,' . $id
        ]);

        try {
            $subCategory->name = $validated['name'];
            $subCategory->slug = Str::slug($validated['slug']);
            $subCategory->category_id = $request->category_id;
            $subCategory->update();

            return redirect('/admin/sub-categories')->with('success', 'SubCategory updated successfully.');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something went wrong while updating the subCategory.');
        }
    }

    public function delete($id)
    {
        $subCategory = SubCategory::find($id);

        if (!$subCategory) {
            return redirect()->back()->with('error', 'SubCategory not found.');
        }

        try {
            $subCategory->delete();

            return redirect('/admin/sub-categories')->with('success', 'SubCategory deleted successfully.');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something went wrong while deleting the subCategory.');
        }
    }
}
