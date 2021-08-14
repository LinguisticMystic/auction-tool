@extends('layout')

@section('title')
    {{__('controls.add_new_item')}}
@endsection

@section('content')
    <h1>{{__('controls.add_new_item')}}</h1>

    <form action="/auction-items/store" method="post">
        @csrf

        <label>{{__('forms.image')}}: </label>
        <input type="file" name="image" accept="image/jpeg">
        <div class="form-error">
            <strong>{{ $errors->first('image') }}</strong>
        </div>

        <br>

        <label>{{__('forms.starting_bid')}}: </label>
        <input type="text" name="starting_bid">
        <div class="form-error">
            <strong>{{ $errors->first('starting_bid') }}</strong>
        </div>

        <br>

        <input type="submit" value="{{__('controls.submit')}}">

    </form>
@endsection
