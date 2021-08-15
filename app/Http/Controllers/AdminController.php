<?php

namespace App\Http\Controllers;

use App\Models\AuctionItem;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    /**
     * @return View
     */
    public function loginView(): View
    {
        return view('admin.login');
    }

    /**
     * @return View
     */
    public function dashboardView(): View
    {
        $auctionItems = AuctionItem::all();

        return view('admin.dashboard',
            [
                'auctionItems' => $auctionItems
            ]);
    }

    /**
     * @return View
     */
    public function changePassword(): View
    {
        return view('admin.change_password');
    }
}
