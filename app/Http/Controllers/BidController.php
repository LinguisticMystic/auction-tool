<?php

namespace App\Http\Controllers;

use App\Http\Requests\BidRequest;
use App\Models\Bid;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class BidController extends Controller
{
    public function store(BidRequest $request): RedirectResponse
    {
        $highestBid = Bid::max('bid_amount');

        if ($request['bid_amount'] <= $highestBid) {
            return Redirect::back()
                ->with('alert-danger', __('messages.invalid_bid_amount'));
        }

        $bidAmount = (int)str_replace([','], '.', $request['bid_amount']);
        $bidAmount *= 100;

        Bid::create([
            'auction_item_id' => $request->auction_item_id,
            'bid_amount' => $bidAmount,
            'bidder_name' => $request->name,
            'bidder_phone' => $request->phone
        ]);

        return Redirect::to('/bids/thanks');
    }

    public function thanksPage(): View
    {
        return view('thanks');
    }
}
