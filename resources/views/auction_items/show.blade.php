@extends('layout')

@section('title')
    {{ __('page_titles.auction_item') . ' #'. $auctionItem->id }}
@endsection

@section('content')
    <h1>
        {{ __('page_titles.auction_item') . ' #'. $auctionItem->id }}

        @if(\Auth::check())
            <a href="/auction-items/{{ $auctionItem->id }}/edit">📝</a>
        @endif

    </h1>

    <img class="auction-item" src="{{ asset('storage/' . $auctionItem->path_to_item_image) }}">

    @if(\Auth::check())
        <p><strong>{{ __('forms.starting_bid') }}: </strong>€{{ $auctionItem->starting_bid / 100 }}</p>
        <p><a href="/auction-items/{{ $auctionItem->id }}/qr" target="_blank">{{ __('controls.print_qr_code') }}</a></p>
    @endif

    <p>edit image</p>
    <p>edit starting bid</p>
    <p>view bidding history</p>
    <p>place bid</p>

@endsection
