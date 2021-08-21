<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function mainView(): View
    {
        return view('index');
    }

    public function thanksPage(): View
    {
        return view('thanks');
    }
}
