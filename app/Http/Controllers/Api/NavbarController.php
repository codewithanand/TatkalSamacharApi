<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NavbarResource;
use App\Models\Navbar;
use Illuminate\Http\Request;

class NavbarController extends Controller
{
    public function index()
    {
        $navbar = Navbar::with('category.subCategories')->get();
        return NavbarResource::collection($navbar);
    }
}
