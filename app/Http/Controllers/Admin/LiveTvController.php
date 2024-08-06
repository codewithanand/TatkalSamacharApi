<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveTv;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class LiveTvController extends Controller
{
    public function index()
    {
        $live_tvs = LiveTv::all();
        return view("admin.livetv.index", compact('live_tvs'));
    }

    public function create(Request $request)
    {
        try {
            $tv = new LiveTv;
            $tv->title = $request->title;
            $tv->slug = Str::slug($request->slug);
            $tv->live_url = $request->title;
            $tv->homepage = $request->homepage == true ? 1 : 0;
            $tv->sidebar = $request->sidebar == true ? 1 : 0;
            $tv->breaking = $request->breaking == true ? 1 : 0;
            $tv->save();
            return redirect('/admin/live-tv')->with("success", "Live TV added successfully.");
        } catch (Exception $ex) {
            return redirect()->back()->with("error", "Something went wrong while adding new Live TV.");
        }
    }

    public function remove($id)
    {
        $tv = LiveTv::find($id);
        if (!$tv) {
            return redirect()->back()->with("error", "LiveTv item not found.");
        }

        try {
            $tv->delete();
            return redirect('/admin/live-tv')->with("success", "Live TV removed successfully.");
        } catch (Exception $ex) {
            return redirect()->back()->with("error", "Something went wrong while removing Live TV.");
        }
    }
}
