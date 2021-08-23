@extends('layout')

@section('title')
    {{__('controls.add_new_item')}}
@endsection

@section('content')
    <h1>{{__('controls.add_new_item')}}</h1>

    <form action="/auction-items/store" method="post" enctype="multipart/form-data">
        @csrf

        <label>{{__('forms.image')}}: </label>
        <input type="file" name="image" accept="image/jpeg">
        <div class="form-error">
            <strong>{{ $errors->first('image') }}</strong>
        </div>

        <br>

        <div class="form">
            <label>{{__('forms.starting_bid')}}: </label>
            <input type="text" name="starting_bid" size="4" value="{{ old('starting_bid') }}">
            <div class="form-error">
                <strong>{{ $errors->first('starting_bid') }}</strong>
            </div>

            <br>

            <label>{{__('forms.size')}}: </label>
            <select name="size">
                <option value="A1">A1</option>
                <option value="A2">A2</option>
                <option value="A3">A3</option>
                <option value="A4">A4</option>
            </select>

            <br>
            <br>

            <input type="submit" value="{{__('controls.submit')}}">
        </div>

    </form>
@endsection
