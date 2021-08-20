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
                <button class="noto-font">📝</button>
            </a>

            <form action="/auction-items/{{ $auctionItem->id }}/destroy" method="post">
                @csrf
                <input class="noto-font" type="submit" value="❌" onclick="return confirm('Tiešām dzēst?');">
            </form>

        @endif
    </div>

    <img class="auction-item" src="{{ asset('storage/' . $auctionItem->path_to_item_image) }}">

    @if(\Auth::check())
        <p><strong>{{ __('forms.starting_bid') }}: </strong>€{{ $auctionItem->starting_bid / 100 }}</p>
        <p><a href="/auction-items/{{ $auctionItem->id }}/qr" target="_blank">{{ __('controls.print_qr_code') }}</a></p>
    @endif

    <p><strong>{{ __('content.bidding_history') }}</strong></p>
    <table>
        <tr>
            <th>ID</th>
            <th>{{ __('forms.bid_amount') }}</th>
            <th>{{ __('content.bidder') }}</th>
            <th>{{ __('forms.phone') }}</th>
            <th>{{ __('content.date') }}</th>
        </tr>
        @foreach($bidHistory as $bid)
            <tr>
                <td>{{ $bid->id }}</td>
                <td>€{{ $bid->bid_amount / 100 }}</td>
                <td>{{ $bid->bidder_name }}</td>
                <td>{{ $bid->bidder_phone }}</td>
                <td>{{ $bid->created_at }}</td>
            </tr>
        @endforeach
    </table>

    <p><strong>{{ __('content.current_bid') }}:</strong> €{{ $highestBid / 100 }}</p>

    <form action="/bids/store" method="post">
        @csrf

        <label>{{__('forms.name')}}: </label>
        <input type="text" name="name" value="{{ old('name') }}">
        <div class="form-error">
            <strong>{{ $errors->first('name') }}</strong>
        </div>

        <label>{{__('forms.phone')}}: </label>
        <input type="text" name="phone" value="{{ old('phone') }}">
        <div class="form-error">
            <strong>{{ $errors->first('phone') }}</strong>
        </div>

        <label>{{__('forms.bid_amount')}}: </label>
        <input type="text" name="bid_amount" size="4">
        <div class="form-error">
            <strong>{{ $errors->first('bid_amount') }}</strong>
            <strong>{{ $errors->first('invalid_bid') }}</strong>
        </div>

        <input type="hidden" value="{{ $auctionItem->id }}" name="auction_item_id">

        <input type="submit" value="{{__('controls.bid')}}">

    </form>

@endsection
