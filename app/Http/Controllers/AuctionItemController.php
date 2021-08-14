<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AuctionItemController extends Controller
{
    public function index()
    {

    }

    public function create(): View
    {
        return view('auction_items.create');
    }

    public function store(FileUploadRequest $request)
    {
        //validate input
        //resize image
        //save image
        //save to database
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
