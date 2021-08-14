<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    /**
     * @return View
     */
    public function mainView(): View
    {
        return view('admin.login');
    }

    /**
     * @return View
     */
    public function dashboardView(): View
    {
        return view('admin.dashboard');
    }
}
