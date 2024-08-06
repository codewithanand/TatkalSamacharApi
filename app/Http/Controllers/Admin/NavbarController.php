<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Navbar;

class NavbarController extends Controller
{
    public function index()
    {
        $categoriesWithoutNavbars = Category::doesntHave('navbars')->get();
        $categoriesWithNavbars = Category::has('navbars')->with('navbars')->get();

        return view('admin.navbar.index', compact('categoriesWithoutNavbars', 'categoriesWithNavbars'));
    }

    public function create(Request $request)
    {
        try {
            $nav = new Navbar;
            $nav->category_id = $request->category_id;
            $nav->save();
            return redirect('/admin/navbars')->with("success", "Navar item added successfully.");
        } catch (Exception $ex) {
            return redirect()->back()->with("error", "Something went wrong while adding new navbar item.");
        }
    }

    public function remove($id)
    {
        $nav = Navbar::find($id);
        if (!$nav) {
            return redirect()->back()->with("error", "Navbar item not found.");
        }

        try {
            $nav->delete();
            return redirect('/admin/navbars')->with("success", "Navar item removed successfully.");
        } catch (Exception $ex) {
            return redirect()->back()->with("error", "Something went wrong while removing navbar item.");
        }
    }
}
