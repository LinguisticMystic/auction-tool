@extends('layout')

@section('title')
    {{__('controls.change_password')}}
@endsection

@section('content')
    <h1>{{__('controls.change_password')}}</h1>

    <form action="/admin/change-password/store" method="post" enctype="multipart/form-data">
        @csrf

        <label>{{__('forms.password')}}: </label>
        <input type="password" name="password" value="{{ old('password') }}">
        <div class="form-error">
            <strong>{{ $errors->first('password') }}</strong>
        </div>

        <label>{{__('forms.confirm')}}: </label>
        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}">
        <div class="form-error">
            <strong>{{ $errors->first('password_confirmation') }}</strong>
        </div>

        <br>

        <input type="submit" value="{{__('controls.change')}}">

    </form>
@endsection
