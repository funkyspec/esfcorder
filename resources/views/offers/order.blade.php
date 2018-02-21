@extends('layouts.app')

@section('content')

<div class="container">


    <div class="row">
        <h2>Weekly orders for pickup day starting {{ \Carbon\Carbon::parse($offer->pickup_date)->format('l - M j, Y') }}</h2>

    </div>

    @foreach($orders as $order)
    <h4>Order #{{ $loop->iteration }}</h4>
        <div class="row">
            <div class="col-md-3">
                Email: <strong>{{ $order-> email }}</strong>
                @if (!empty($order->phone))
                <br />Phone: {{ $order-> phone }}
                @endif
            </div>

            <div class="col-md-3">
                Name:
                @if (!empty($order->name))
                <strong>{{ $order->name }}</strong>
                @else
                <em>Not given</em>
                @endif
                <br />
                Order status:
                @if (!empty($order->order_status))
                {{ $order->order_status }}
                @else
                Unconfirmed
                @endif
            </div>

            <div class="col-md-3">
                Pickup Option: {{ $order->pickup_option }}
            </div>

            <div class="col-md-3">
                Notes/comments:<br />
                @if (!empty($order->name))
                {{ $order->customernote }}
                @else
                None
                @endif
            </div>

        </div>
        <p><strong>Items in this order:</strong>

        @foreach($order->lineItems as $lineItem)

        <p><strong>{{ round($lineItem->quantity) }}</strong> {{ $lineItem->producerPrice->item->name }} @ ${{ $lineItem->producerPrice->mbr_price }} = $ {{ $lineItem->mbr_line_price }}</p>



        @endforeach

        <p>Estimated order total: <strong>${{ number_format($order->lineItems->sum('mbr_line_price'), 2) }}</strong> <em>(weighed items actual weight and delivery charge may change this)</em></p>


        <br /><br />

    @endforeach

@endsection
