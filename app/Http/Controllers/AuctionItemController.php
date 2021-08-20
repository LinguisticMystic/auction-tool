<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuctionItemStoreRequest;
use App\Http\Requests\AuctionItemUpdateRequest;
use App\Models\AuctionItem;
use App\Models\Bid;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class AuctionItemController extends Controller
{
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
            'original_file_name' => $originalFileName
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
        $bidHistory = Bid::where('auction_item_id', $id)->get();

        $highestBid = 0;

        foreach ($bidHistory as $bid) {
            if ($bid->bid_amount > $highestBid) {
                $highestBid = $bid->bid_amount;
            }
        }

        return view('auction_items.show',
            [
                'auctionItem' => $auctionItem,
                'highestBid' => $highestBid,
                'bidHistory' => $bidHistory
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
                'starting_bid' => $startingBid
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
}
