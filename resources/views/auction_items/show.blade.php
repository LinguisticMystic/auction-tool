@extends('layout')

@section('title')
    {{ __('page_titles.auction_item') . ' #'. $auctionItem->id }}
@endsection

@section('content')
    <div class="user-controls">
        <h1>
            {{ __('page_titles.auction_item') . ' #'. $auctionItem->id }} </h1>

        @if(\Auth::check())

            <a href="/auction-items/{{ $auctionItem->id }}/edit">
                <button class="noto-font">📝</button>
            </a>

            <form action="/auction-items/{{ $auctionItem->id }}/destroy" method="post">
                @csrf
                <input class="noto-font" type="submit" value="❌" onclick="return confirm('Tiešām dzēst?');">
            </form>

        @endif
    </div>

    <img class="auction-item" src="{{ asset('storage/' . $auctionItem->path_to_item_image) }}">

    <div class="gallery-nav">
        @if ($prev === null)
            <p style="opacity:0.3;">◄</p>
        @else
            <a href="/auction-items/{{ $prev }}" class="button"><p>◄</p></a>
        @endif

        @if ($next === null)
            <p style="opacity:0.3;">►</p>
        @else
            <a href="/auction-items/{{ $next }}" class="button"><p>►</p></a>
        @endif
    </div>

    @if(\Auth::check())
        <p><a href="/auction-items/{{ $auctionItem->id }}/qr" target="_blank">{{ __('controls.print_qr_code') }}</a></p>

        <p><strong>{{ __('content.bidding_history') }}</strong></p>
        <table>
            <tr>
                <th>ID</th>
                <th>{{ __('forms.bid_amount') }}</th>
                <th>{{ __('content.bidder') }}</th>
                <th>Info</th>
                <th>{{ __('content.date') }}</th>
                <th>{{ __('controls.delete') }}</th>
            </tr>

            @if (!isset($_GET['page']) || $_GET['page'] < 2)
                <?php $i = 1 ?>
            @else
                <?php $i = ($_GET['page'] - 1) * $paginationRange + 1;?>
            @endif

            @foreach($bidHistory as $bid)
                <tr>
                    <td>{{ $i }}</td>
                    <td>€{{ $bid->bid_amount / 100 }}</td>
                    <td>{{ $bid->bidder_name }}</td>
                    <td>{{ $bid->bidder_phone }}</td>
                    <td>{{ $bid->created_at }}</td>
                    <td>
                        <form action="/bids/{{ $bid->id }}/destroy" method="post">
                            @csrf
                            <input class="noto-font" type="submit" value="❌" onclick="return confirm('Tiešām dzēst?');">
                        </form>
                    </td>
                </tr>

                <?php $i++ ?>

            @endforeach
        </table>

        {{ $bidHistory->links() }}

    @endif

    <p><strong>{{ __('forms.size') }}: </strong>{{ $auctionItem->size }}</p>

    @if($highestBid === 0)
        <p><strong>{{ __('content.starting_bid_exhibition_piece') }}: </strong>€{{ $auctionItem->starting_bid / 100 }}
        </p>
        <p><strong>{{ __('content.medium') }}: </strong>{{ __('content.aluminum_composite') }}</p>
    @else
        @if(\Auth::check())
            <p><strong>{{ __('content.starting_bid_exhibition_piece') }}
                    : </strong>€{{ $auctionItem->starting_bid / 100 }}</p>
            <p><strong>{{ __('content.medium') }}: </strong>{{ __('content.aluminum_composite') }}</p>
        @endif
        <p><strong>{{ __('content.current_bid') }}:</strong> €{{ $highestBid / 100 }}</p>
    @endif

    <a href="/auction-items/{{ $auctionItem->id }}/book">{{ __('controls.book_print') }}</a>

    <br><br>

    @if($now < $endDate)
        <form action="/bids/store" method="post">
            @csrf

            <div class="form">
                <label>{{__('forms.name')}}: </label>
                <input type="text" name="name" value="{{ old('name') }}">
                <div class="form-error">
                    <strong>{{ $errors->first('name') }}</strong>
                </div>

                <label>{{__('forms.contact')}}: </label>
                <input type="text" name="phone" value="{{ old('phone') }}">
                <div class="form-error">
                    <strong>{{ $errors->first('phone') }}</strong>
                </div>

                <label>{{__('forms.bid_amount')}}: </label>
                <br>
                <input class="currency-input" type="text" name="bid_amount" value="{{ old('bid_amount') }}">
                <div class="form-error">
                    <strong>{{ $errors->first('bid_amount') }}</strong>
                    <strong>{{ $errors->first('invalid_bid') }}</strong>
                </div>


                <input type="hidden" value="{{ $auctionItem->id }}" name="auction_item_id">

                <p>

                    <input type="submit" value="{{__('controls.bid')}}">
            </div>
        </form>

        <br>

        <p>❗ {{ __('content.sell_conditions') }}</p>
        <p>❗ {{ __('content.shipping') }}</p>

    @else
        {{ __('content.auction_end') }}
    @endif

@endsection
