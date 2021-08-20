@extends('layout')

@section('title')
    {{__('page_titles.admin_dashboard')}}
@endsection

@section('content')
    <h1>{{__('page_titles.admin_dashboard')}}</h1>

    <ul>
        <li>
            <a href="/admin/change-password">{{__('controls.change_password')}}</a>
        </li>
        <li>
            <a href="/auction-items/create">{{__('controls.add_new_item')}}</a>
        </li>
    </ul>

    <table>
        <tr>
            <th>ID</th>
            <th>{{ __('content.current_bid') }}</th>
            <th>{{ __('content.bidder') }}</th>
            <th>{{ __('forms.phone') }}</th>
            <th>{{ __('content.view') }}</th>
        </tr>
        @foreach($auctionItems as $id => $auctionItem)
            <tr>
                <td>#{{ $id }}</td>
                <td>€{{ $auctionItem['bid_amount'] / 100}}</td>
                <td>{{ $auctionItem['bidder_name']}}</td>
                <td>{{ $auctionItem['bidder_phone']}}</td>
                <td><a href="/auction-items/{{ $id }}">👁</a></td>
            </tr>
        @endforeach
    </table>

@endsection
