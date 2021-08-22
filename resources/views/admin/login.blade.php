@extends('layout')

@section('title')
    {{__('page_titles.admin_login')}}
@endsection

@section('content')
    <form action="/login" method="post">
        @csrf

        <div class="form">
            <br>
            <label>{{__('forms.name')}}: </label>
            <input type="text" name="name">
            <div class="form-error">
                <strong>{{ $errors->first('name') }}</strong>
            </div>

            <br>

            <label>{{__('forms.password')}}: </label>
            <input type="password" name="password">
            <div class="form-error">
                <strong>{{ $errors->first('password') }}</strong>
            </div>

            <div class="form-error">
                <strong>{{ $errors->first('failed_login') }}</strong>
            </div>

            <br>

            <input type="submit" value="{{__('controls.log_in')}}">
        </div>
    </form>
@endsection
