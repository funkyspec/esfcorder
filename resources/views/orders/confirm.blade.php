@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

        </div>
    </div>
</div>

<div class="row">
    <h3>Confirm your order</h3>
    <p>Thanks for placing an order. Your order details are below. If it all looks good, please click Confirm below. If you need to make changes, please click Make Changes</p>

    <p><strong>Ordered by:</strong> {{ $order->email }} @isset($order->name) ({{ $order->name }}) @endisset</p>

    @isset($order->phone)<p><strong>Contact phone:</strong> {{ $order->phone }}</p> @endisset

    <h5>Your order items:</h5>
    @foreach($lineItems as $lineItem)

    <!-- need to access distant relationship to show item name -->

    <p>Producer price id {{ $lineItem->producerprice_id }}: {{ $lineItem->quantity }}

    @endforeach

    <p><strong>Pickup/delivery option:</strong> {{ $order->pickup_option }}</p>


    <!-- pickup/delivery option -->

    <!-- if comments / show here -->

    <!-- confirm button - sends to final thanks page -->

    <!-- change button - loads order form pre-filled with choices -->

</div>


@endsection
