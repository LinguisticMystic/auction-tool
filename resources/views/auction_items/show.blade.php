@extends('layout')

@section('title')
    {{ __('page_titles.auction_item') . ' #'. $auctionItem->id }}
@endsection

@section('content')
    <h1>{{ __('page_titles.auction_item') . ' #'. $auctionItem->id }}</h1>

    <img class="auction-item" src="{{ asset('storage/' . $auctionItem->path_to_item_image) }}">

    @if(\Auth::check())
        <p><strong>Starting bid:</strong> €{{ $auctionItem->starting_bid }}</p>
        <p><a href="/auction-items/{{ $auctionItem->id }}/qr" target="_blank">Print QR code</a></p>
    @endif

@endsection
