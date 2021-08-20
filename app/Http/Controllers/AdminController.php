<?php

namespace App\Http\Controllers;

use App\Models\AuctionItem;
use App\Models\Bid;
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
        $auctionItemsWithHighestBidders = [];

        $auctionItems = AuctionItem::all();

        foreach ($auctionItems as $auctionItem) {
            //var_dump($auctionItem->id);
            $bids = Bid::where('auction_item_id', $auctionItem->id)->get();

            $maxBidAmount = 0;
            $maxBid = null;

            foreach ($bids as $bid) {

                if ($bid->bid_amount > $maxBidAmount) {
                    $maxBid = $bid;
                }

            }

            $auctionItemsWithHighestBidders[$auctionItem->id]['bid_amount'] = $maxBid->bid_amount;
            $auctionItemsWithHighestBidders[$auctionItem->id]['bidder_name'] = $maxBid->bidder_name;
            $auctionItemsWithHighestBidders[$auctionItem->id]['bidder_phone'] = $maxBid->bidder_phone;
        }

        return view('admin.dashboard',
            [
                'auctionItems' => $auctionItemsWithHighestBidders
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
