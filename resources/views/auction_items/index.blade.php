@extends('layout')

@section('title')
    {{__('content.full_auction_list')}}
@endsection

@section('content')
    <h1>{{__('content.full_auction_list')}}</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>{{ __('content.current_bid') }}</th>
            <th>{{ __('content.bidder') }}</th>
            <th>Info</th>
            <th>{{ __('content.view') }}</th>
        </tr>
        @foreach($auctionItems as $id => $auctionItem)
            <tr>
                <td>#{{ $id }}</td>
                <td>€{{ $auctionItem['bid_amount'] / 100}}</td>
                <td>{{ $auctionItem['bidder_name']}}</td>
                <td>
                    @if ($auctionItem['bidder_phone'] !== '-')
                        <?php echo substr($auctionItem['bidder_phone'], 0, 3) . str_repeat('*', 7);?>
                    @else
                        {{ $auctionItem['bidder_phone'] }}
                    @endif
                </td>
                <td><a href="/auction-items/{{ $id }}">👁</a></td>
            </tr>
        @endforeach
    </table>
@endsection
