<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuctionItemStoreRequest;
use App\Http\Requests\AuctionItemUpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\AuctionItem;
use App\Models\Bid;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AuctionItemController extends Controller
{
    public function index(): View
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

        return view('auction_items.index',
            [
                'auctionItems' => $auctionItemsWithHighestBidders
            ]);
    }

    public function create(): View
    {
        return view('auction_items.create');
    }

    public function store(AuctionItemStoreRequest $request): RedirectResponse
    {
        $startingBid = str_replace([','], '.', $request['starting_bid']);
        $startingBid *= 100;

        $image = $request->file('image');
        $originalFileName = $request->file('image')->getClientOriginalName();

        $image = Storage::disk('public')->put('images', $image);

        $auctionItem = AuctionItem::create([
            'starting_bid' => $startingBid,
            'path_to_item_image' => $image,
            'original_file_name' => $originalFileName,
            'size' => $request->size
        ]);

        // Generate QR
        $image = explode('.', $image);
        $image = $image[0] . '_QR.' . $image[1];

        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new ImagickImageBackEnd()
        );

        $writer = new Writer($renderer);
        $writer->writeFile(\URL::to('/auction-items/' . $auctionItem->id), 'storage/' . $image);

        \DB::table('auction_items')
            ->where('id', $auctionItem->id)
            ->update(['path_to_QR_image' => $image]);

        return redirect('/admin/dashboard')
            ->with('alert-success', __('page_titles.auction_item') . ' ' . __('controls.added') . '!');
    }

    public function show(int $id): View
    {
        $auctionItem = AuctionItem::where('id', $id)->first();

        $paginationRange = 50;

        $bidHistory = Bid::where('auction_item_id', $id)->orderBy('bid_amount', 'DESC')->paginate($paginationRange);

        $highestBid = 0;

        foreach ($bidHistory as $bid) {
            if ($bid->bid_amount > $highestBid) {
                $highestBid = $bid->bid_amount;
            }
        }

        $prev = AuctionItem::where('id', '<', $auctionItem->id)->max('id');
        $next = AuctionItem::where('id', '>', $auctionItem->id)->min('id');

        $endDate = new \DateTime();
        $endDate->setTimezone(new \DateTimeZone('GMT'));
        $endDate->setDate(2021, 9, 11);
        $endDate->setTime(00, 00);

        $now = new \DateTime();
        $now->setTimezone(new \DateTimeZone('GMT'));

        return view('auction_items.show',
            [
                'auctionItem' => $auctionItem,
                'highestBid' => $highestBid,
                'bidHistory' => $bidHistory,
                'paginationRange' => $paginationRange,
                'prev' => $prev,
                'next' => $next,
                'endDate' => $endDate,
                'now' => $now
            ]);
    }

    public function edit(int $id): View
    {
        $auctionItem = \DB::table('auction_items')->where('id', $id)->first();

        return view('auction_items.edit',
            [
                'auctionItem' => $auctionItem
            ]);
    }

    public function update(int $id, AuctionItemUpdateRequest $request): RedirectResponse
    {
        $startingBid = str_replace(',', '.', $request['starting_bid']);
        $startingBid *= 100;

        if ($request['file'] !== null) {
            $image = $request->file('image');
            $originalFileName = $request->file('image')->getClientOriginalName();

            $image = Storage::disk('public')->put('images', $image);

            \DB::table('auction_items')
                ->where('id', $id)
                ->update([
                    'path_to_item_image' => $image,
                    'original_file_name' => $originalFileName
                ]);
        }

        \DB::table('auction_items')
            ->where('id', $id)
            ->update([
                'starting_bid' => $startingBid,
                'size' => $request->size
            ]);

        return redirect('/admin/dashboard')
            ->with('alert-success', __('page_titles.auction_item') . ' #' . $id . ' ' . __('controls.updated') . '!');
    }

    public function destroy(int $id): RedirectResponse
    {
        \DB::table('auction_items')
            ->where('id', $id)
            ->delete();

        return redirect('/admin/dashboard')
            ->with('alert-success', __('page_titles.auction_item') . ' #' . $id . ' ' . __('controls.deleted') . '!');
    }

    public function search(SearchRequest $request)
    {
        $auctionItemId = $request->search;

        $auctionItem = AuctionItem::find($auctionItemId);

        if ($auctionItem === null) {
            return Redirect::back()
                ->withErrors(['invalid_id' => __('messages.invalid_id')])
                ->withInput();
        } else {
            return redirect('/auction-items/' . $auctionItem->id);
        }

    }
}
