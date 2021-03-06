@extends('layout')

@section('title')
    {{__('page_titles.thanks')}}
@endsection

@section('content')

    <h1>{{ __('page_titles.thanks') }}</h1>

    <p>{{ __('content.thanks_for_bidding') }}</p>

    <p>{!! __('content.return') !!}</p>

@endsection

<?php \Session::flush(); ?>
