@extends('layout')

@section('title')
    {{__('page_titles.index')}}
@endsection

@section('content')

    <h1>{!! __('content.welcome') !!}</h1>

    <hr>

    <form action="/auction-items/search" method="post">
        @csrf

        <div class="form">
            <label><strong>ID: </strong></label>
            <input type="text" name="search" value="{{ old('search') }}">
            <div class="form-error">
                <strong>{{ $errors->first('invalid_id') }}</strong>
            </div>

            <br>

            <input type="submit" value="{{__('controls.search')}}">
        </div>
    </form>

    <br>

    <a href="/auction-items">{{ __('content.full_auction_list') }}</a>

@endsection
