<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return view("");
    }

    public function create()
    {
        return view("");
    }

    public function store(Request $request)
    {
        return redirect("/");
    }

    public function edit($id)
    {
        return view("");
    }

    public function update(Request $request, $id)
    {
        return redirect("/");
    }

    public function delete($id)
    {
        return redirect("/");
    }
}
