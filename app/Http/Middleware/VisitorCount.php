<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class VisitorCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Check if the visitor has already been counted
        if (!Cookie::get('visitor_counted')) {
            // Count the visitor
            DB::table('visitor_counts')->increment('count');

            // Set a cookie to prevent recounting the visitor
            Cookie::queue('visitor_counted', true, 60 * 24); // cookie lasts for 1 day
        }

        return $response;
    }
}
