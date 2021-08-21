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
            $bids = Bid::where('auction_item_id', $auctionItem->id)->get();

            if ($bids->count() > 0) {
                $maxBidAmount = 0;
                $maxBid = null;

                foreach ($bids as $bid) {
                    if ($bid->bid_amount > $maxBidAmount) {
                        $maxBid = $bid;
                    }
                    $auctionItemsWithHighestBidders[$auctionItem->id]['bid_amount'] = $maxBid->bid_amount;
                    $auctionItemsWithHighestBidders[$auctionItem->id]['bidder_name'] = $maxBid->bidder_name;
                    $auctionItemsWithHighestBidders[$auctionItem->id]['bidder_phone'] = $maxBid->bidder_phone;
                }
            } else {
                $auctionItemsWithHighestBidders[$auctionItem->id]['bid_amount'] = 0;
                $auctionItemsWithHighestBidders[$auctionItem->id]['bidder_name'] = '-';
                $auctionItemsWithHighestBidders[$auctionItem->id]['bidder_phone'] = '-';
            }

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
