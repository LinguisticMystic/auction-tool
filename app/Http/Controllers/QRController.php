<?php

namespace App\Http\Controllers;

use App\Models\AuctionItem;
use Illuminate\Contracts\View\View;

class QRController extends Controller
{
    public function qr(int $id): View
    {
        $auctionItem = AuctionItem::where('id', $id)->first();

        return view('qr',
            [
                'id' => $id,
                'auctionItem' => $auctionItem
            ]);
    }
}
