@extends('layout')

@section('title')
    {{ __('page_titles.auction_item') . ' #'. $auctionItem->id }}
@endsection

@section('content')
    <h1>{{ __('page_titles.auction_item') . ' #'. $auctionItem->id }}</h1>

    <img class="auction-item" src="{{ asset('storage/images/KhOt2s3TWDi62EvPKqjpzQNrIhvrJumiEqJX29gF.jpg') }}">

    @if(\Auth::check())
        <p><strong>Starting bid:</strong> €{{ $auctionItem->starting_bid }}</p>
    @endif

@endsection
