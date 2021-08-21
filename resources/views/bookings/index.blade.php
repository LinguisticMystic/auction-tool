@extends('layout')

@section('title')
    {{ __('page_titles.bookings')}}
@endsection

@section('content')
    <h1>{{ __('page_titles.bookings')}}</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>{{ __('content.item_id')}}</th>
            <th>{{ __('content.table_amount')}}</th>
            <th>{{ __('forms.name')}}</th>
            <th>{{ __('forms.phone')}}</th>
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
@endsection
