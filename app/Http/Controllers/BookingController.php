<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\AuctionItem;
use App\Models\Booking;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;

class BookingController extends Controller
{
    public function book(int $id): View
    {
        $auctionItem = AuctionItem::where('id', $id)->first();

        return view('bookings.book',
            [
                'auctionItem' => $auctionItem
            ]);
    }

    public function index()
    {
        $bookings = Booking::sortable()->paginate(50);

        return view('bookings.index',
            [
                'bookings' => $bookings
            ]);
    }

    public function store(BookingRequest $request)
    {
        Booking::create([
            'auction_item_id' => $request->auction_item_id,
            'amount' => $request->amount,
            'buyer_name' => $request->name,
            'buyer_phone' => $request->phone
        ]);

        \Session::put('booked', true);

        return Redirect::to('/thanks-for-booking');
    }
}
