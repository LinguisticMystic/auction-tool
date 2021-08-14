<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Models\AuctionItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuctionItemController extends Controller
{
    public function index()
    {
        return AuctionItem::all();
    }

    public function create(): View
    {
        return view('auction_items.create');
    }

    public function store(FileUploadRequest $request)
    {
        $startingBid = (int)str_replace(['.', ','], '', $request['starting_bid']);

        $image = $request->file('image');
        $originalFileName = $request->file('image')->getClientOriginalName();

        $image = Storage::disk('local')->put('images', $image);

        $auctionItem = AuctionItem::create([
            'starting_bid' => $startingBid,
            'path_to_item_image' => $image,
            'original_file_name' => $originalFileName
        ]);

        //generate QR

    }

    public function show()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
