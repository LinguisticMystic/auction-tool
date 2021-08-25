@extends('layout')

@section('title')
    {{__('content.full_auction_list')}}
@endsection

@section('content')
    <h1>{{__('content.full_auction_list')}}</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>{{ __('content.view') }}</th>
        </tr>
        @foreach($auctionItems as $auctionItem)
            <tr>
                <td>#{{ $auctionItem->id }}</td>
                <td><a href="/auction-items/{{ $auctionItem->id }}">👁</a></td>
            </tr>
        @endforeach
    </table>
@endsection
