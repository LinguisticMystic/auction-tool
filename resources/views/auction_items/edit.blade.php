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

        <div class="form">
            <label>{{__('forms.starting_bid')}}: </label>
            <input type="text" name="starting_bid" value="{{ $auctionItem->starting_bid / 100 }}">
            <div class="form-error">
                <strong>{{ $errors->first('starting_bid') }}</strong>
            </div>

            <br>

            <label>{{__('forms.size')}}: </label>
            <select name="size">
                <option {{ ($auctionItem->size) == 'A1' ? 'selected' : '' }} value="A1">A1</option>
                <option {{ ($auctionItem->size) == 'A2' ? 'selected' : '' }} value="A2">A2</option>
                <option {{ ($auctionItem->size) == 'A3' ? 'selected' : '' }} value="A3">A3</option>
                <option {{ ($auctionItem->size) == 'A4' ? 'selected' : '' }} value="A4">A4</option>
            </select>

            <br>
            <br>

            <input type="submit" value="{{__('controls.update')}}">
        </div>

    </form>
@endsection
