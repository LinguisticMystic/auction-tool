<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function mainView(): View
    {
        return view('index');
    }

    public function thanksForBidding(): View
    {
        return view('thanks_for_bidding');
    }

    public function thanksForBooking(): View
    {
        return view('thanks_for_booking');
    }
}
