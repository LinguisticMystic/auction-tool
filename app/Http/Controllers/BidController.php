<?php

namespace App\Http\Controllers;

use App\Http\Requests\BidRequest;
use App\Models\AuctionItem;
use App\Models\Bid;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class BidController extends Controller
{
    public function store(BidRequest $request): RedirectResponse
    {
        $startingBid = AuctionItem::where('id', $request->auction_item_id)->first()->starting_bid;
        $highestBid = Bid::where('auction_item_id', $request->auction_item_id)->max('bid_amount');

        $bidAmount = str_replace(',', '.', $request['bid_amount']);
        $bidAmount *= 100;

        if ($highestBid !== null && $bidAmount <= (int)$highestBid) {
            return Redirect::back()
                ->withErrors(['invalid_bid' => __('messages.invalid_bid_amount_case_highest_bid')])
                ->withInput();
        }

        if ($bidAmount <= (int)$startingBid) {
            return Redirect::back()
                ->withErrors(['invalid_bid' => __('messages.invalid_bid_amount_case_starting_bid')])
                ->withInput();
        }

        Bid::create([
            'auction_item_id' => $request->auction_item_id,
            'bid_amount' => $bidAmount,
            'bidder_name' => $request->name,
            'bidder_phone' => $request->phone
        ]);

        \Session::put('booked', true);

        return Redirect::to('/thanks-for-bidding');
    }

    public function destroy(int $id): RedirectResponse
    {
        \DB::table('bids')
            ->where('id', $id)
            ->delete();

        return Redirect::back()
            ->with('alert-success', __('forms.bid_entry') . ' ' . __('controls.deleted') . '!');
    }
}
