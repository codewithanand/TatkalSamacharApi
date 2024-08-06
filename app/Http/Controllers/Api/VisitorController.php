<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VisitorCount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class VisitorController extends Controller
{
    public function index()
    {
        if (!cookie('visitor_counted')) {
            $visitor = VisitorCount::first();
            if (!$visitor) {
                $visitor = new VisitorCount();
                $visitor->count = 0;
                $visitor->save();
            }
            $visitor->count = $visitor->count + 1;
            $visitor->update();
            // Count the visitor
            // DB::table('visitor_counts')->increment('count');

            // Set a cookie to prevent recounting the visitor
            // Cookie::queue('visitor_counted', true, 60 * 24); // cookie lasts for 1 day
            cookie('visitor_counted', $visitor->count, 60 * 24);
        }
        return response()->json();
    }
    public function get_visitor_count()
    {
        $visitorCount = DB::table('visitor_counts')->value('count');
        return response()->json(['count' => $visitorCount], 200);
    }
}
