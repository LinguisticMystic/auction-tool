@extends('layout')

@section('title')
    {{__('controls.edit_item')}} #{{ $auctionItem->id }}
@endsection

@section('content')
    <h1>{{__('controls.edit_item')}} #{{ $auctionItem->id }}</h1>

    <form action="/auction-items/{{ $auctionItem->id }}/update" method="post" enctype="multipart/form-data">
        @csrf

        <label>{{__('forms.image')}}: </label>
        <input type="file" name="image" accept="image/jpeg">
        <div class="form-error">
            <strong>{{ $errors->first('image') }}</strong>
        </div>

        <br>

        <label>{{__('forms.starting_bid')}}: </label>
        <input type="text" name="starting_bid" value="{{ $auctionItem->starting_bid / 100 }}">
        <div class="form-error">
            <strong>{{ $errors->first('starting_bid') }}</strong>
        </div>

        <br>

        <input type="submit" value="{{__('controls.update')}}">

    </form>
@endsection
