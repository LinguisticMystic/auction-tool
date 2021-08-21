@extends('layout')

@section('title')
    {{ __('page_titles.bookings')}}
@endsection

@section('content')
    <h1>{{ __('page_titles.bookings')}}</h1>

    <?php $itemId = __('content.item_id'); ?>
    <?php $amount = __('content.table_amount'); ?>
    <?php $name = __('forms.name'); ?>
    <?php $phone = __('forms.phone'); ?>

    <table>
        <tr>
            <th>@sortablelink('ID')</th>
            <th>@sortablelink('auction_item_id', $itemId)</th>
            <th>@sortablelink('amount', $amount)</th>
            <th>@sortablelink('buyer_name', $name)</th>
            <th>@sortablelink('buyer_phone', $phone)</th>
        </tr>
        @foreach ($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>#{{ $booking->auction_item_id }}</td>
                <td>{{ $booking->amount }}</td>
                <td>{{ $booking->buyer_name }}</td>
                <td>{{ $booking->buyer_phone }}</td>
            </tr>
        @endforeach
    </table>
    {{ $bookings->links() }}

    {!! $bookings->appends(Request::except('page'))->render() !!}
@endsection
