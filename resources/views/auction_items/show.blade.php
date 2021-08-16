@extends('layout')

@section('title')
    {{ __('page_titles.auction_item') . ' #'. $auctionItem->id }}
@endsection

@section('content')
    <div class="user-controls">
        <h1>
            {{ __('page_titles.auction_item') . ' #'. $auctionItem->id }} </h1>

        @if(\Auth::check())

            <a href="/auction-items/{{ $auctionItem->id }}/edit">
                <button>📝</button>
            </a>

            <form action="/auction-items/{{ $auctionItem->id }}/destroy" method="post">
                @csrf
                <input type="submit" value="❌" onclick="return confirm('Tiešām dzēst?');">
            </form>

        @endif
    </div>

    <img class="auction-item" src="{{ asset('storage/' . $auctionItem->path_to_item_image) }}">

    @if(\Auth::check())
        <p><strong>{{ __('forms.starting_bid') }}: </strong>€{{ $auctionItem->starting_bid / 100 }}</p>
        <p><a href="/auction-items/{{ $auctionItem->id }}/qr" target="_blank">{{ __('controls.print_qr_code') }}</a></p>
    @endif

    <p>view bidding history</p>
    <p>place bid</p>

@endsection
