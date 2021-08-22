<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class Booking
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $previousUrl = \URL::previous();

        if (\Session::get('booked') !== true) {

            if ($previousUrl === \URL::to('/thanks')) {
                return redirect('/');
            } else {
                return Redirect::back();
            }
        }

        return $next($request);
    }
}
