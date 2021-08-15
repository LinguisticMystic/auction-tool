@extends('layout')

@section('title')
    {{ 'QR #'. $id }}
@endsection

@section('content')
    <h1>{{ 'QR #'. $id }}</h1>

    <img class="auction-item" src="{{ asset('storage/' . $auctionItem->path_to_QR_image) }}">

@endsection
