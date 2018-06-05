@extends('layouts.app')

@section('content')

<div class="container">


    <div class="row hidden-print">
        <h2>Weekly orders for pickup day starting {{ \Carbon\Carbon::parse($offer->pickup_date)->format('l - M j, Y') }}</h2>

        <p><a href="/offers/total/{{ $offer->id }}">View vendor totals &raquo;</a></p>

    </div>

    @foreach($orders as $order)
    <div style="page-break-before: auto;">
    <h4>Order #{{ $loop->iteration }}</h4>
        <div class="row">
            <div class="col-md-3 hidden-print">
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
                <span class="hidden-print">
                    Order status:
                    @if (!empty($order->order_status))
                    {{ $order->order_status }}
                    @else
                    Unconfirmed
                    @endif
                </span>
            </div>

            <div class="col-md-3 hidden-print">
                Pickup Option: {{ $order->pickup_option }}
            </div>

            <div class="col-md-3 hidden-print">
                Notes/comments:<br />
                @if (!empty($order->name))
                {{ $order->customernote }}
                @else
                None
                @endif
            </div>

        </div>
        <p class="hidden-print"><strong>Items in this order:</strong>

        @foreach($order->lineItems as $lineItem)

        <p><strong>{{ round($lineItem->quantity) }}</strong>
            {{ $lineItem->producerPrice->sellUnit->name }}
            {{ $lineItem->producerPrice->item->name }}
            @isset($lineItem->producerPrice->producer->abbrev)
             <em>({{ $lineItem->producerPrice->producer->abbrev }})</em>
            @endisset
             @ ${{ $lineItem->producerPrice->mbr_price }} = $ {{ $lineItem->mbr_line_price }}</p>



        @endforeach

        <p>Estimated order total: <strong>${{ number_format($order->lineItems->sum('mbr_line_price'), 2) }}</strong> <em>(weighed items actual weight and delivery charge may change this)</em></p>

    </div>
    <br /><br />
    @endforeach

@endsection
