<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    /**
     * @return View
     */
    public function loginView(): View
    {
        $bids = Bid::all();

        return view('admin.login', [
            'bids' => $bids
        ]);
    }

    /**
     * @return View
     */
    public function dashboardView(): View
    {
        return view('admin.dashboard');
    }
}
