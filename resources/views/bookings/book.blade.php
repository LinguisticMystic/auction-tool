@extends('layout')

@section('title')
    {{ __('controls.book_print')}}
@endsection

@section('content')
    <p>{!! __('content.book_print_description') !!} {{ __('content.shipping') }}.</p>

    <img class="auction-item" src="{{ asset('storage/' . $auctionItem->path_to_item_image) }}">

    <p><strong>{{ __('page_titles.auction_item') }}: </strong>#{{ $auctionItem->id }}</p>

    <form action="/auction-items/{{ $auctionItem->id }}/book/store" method="post">
        @csrf

        <div class="form">
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

            <label>{{__('forms.amount')}}: </label>
            <br>
            <input class="currency-input" type="number" name="amount" value="{{ old('amount') }}">
            <div class="form-error">
                <strong>{{ $errors->first('amount') }}</strong>
            </div>

            <input type="hidden" value="{{ $auctionItem->id }}" name="auction_item_id">

            <p></p>

            <input type="submit" value="{{__('controls.book')}}">
        </div>
    </form>
@endsection
