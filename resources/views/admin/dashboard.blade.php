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
            <th>Item</th>
            <th>Current bid</th>
            <th>Bidder</th>
            <th>Phone</th>
            <th></th>
        </tr>
        @foreach($auctionItems as $auctionItem)
            <tr>
                <td>{{ $auctionItem->id }}</td>
                <td>Current bid</td>
                <td>Name</td>
                <td>Number</td>
                <td><a href="/auction-items/{{ $auctionItem->id }}">👁</a></td>
            </tr>
        @endforeach
    </table>

@endsection
