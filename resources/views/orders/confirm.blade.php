@extends('layouts.app')

@section('content')

<div class="container">


    <div class="row">
        <h3>Confirm your order</h3>
        <p>Thanks for submitting an order. Your order details are below.</p>

        <p><strong>Ordered by:</strong> {{ $order->email }} @isset($order->name) ({{ $order->name }}) @endisset</p>

        @isset($order->phone)<p><strong>Contact phone:</strong> {{ $order->phone }}</p> @endisset

        <h5>Your order items and quantities:</h5>
        <table id="order-items" class="table table-bordered table-condensed">
        @foreach($lineItems as $lineItem)

            <!-- need to access distant relationship to show item name -->

            <tr><td>@if( $lineItem->producerPrice->item->name)
                    {{ $lineItem->producerPrice->item->name }}
                            @if(session('mbr') == 1)
                                @isset($lineItem->producerPrice->mbr_price)
                                (${{ $lineItem->producerPrice->mbr_price }}
                                @endisset
                                @empty($lineItem->producerPrice->mbr_price)
                                (price TBA)
                                @endempty
                            @else
                                @isset($lineItem->producerPrice->non_mbr_price)
                                (${{ $lineItem->producerPrice->non_mbr_price }}
                                @endisset
                                @empty($lineItem->producerPrice->non_mbr_price)
                                (price TBA)
                                @endempty
                            @endif
                    @isset($lineItem->producerPrice->sellUnit)/{{ $lineItem->producerPrice->sellUnit->name }})
                    @endisset
                    :
                @else
                    Unspecified name:
                @endif</td>
                <td><strong>{{ number_format($lineItem->quantity, 0) }}</strong></td></tr>

        @endforeach
            </table>
        <h5>Estimated price:  ${{ number_format($orderTotal, 2) }} <em>(does not include delivery fee if applicable)</em></h5>

        <!-- note on any items for which there is no price -->

        <!-- note that price subject to change based on availability of produce - we will let you know of the final price in a follow-up email -->

        <p><strong>Pickup/delivery option:</strong> {{ $order->pickup_option }}</p>

        @isset($order->customernote)
        <br>
        <h5>Your notes:</h5>
        <p>{{ $order->customernote }}<p>
        @endisset

    </div>

    <div class="row">
        <!-- confirm button - sends to final thanks page and enters confirmed flag into order page -->
        <p>If it all looks good, please <strong>click Confirm</strong>. If you need to make changes, please click Change Order.</p>
        <div class="col-sm-2">
            <form method="POST" action="/orders/confirm">
                <input id="offer_id" name="order_id" type="hidden" value="{{ $order->id }}">
                    {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Confirm Order</button>
            </form>
        </div>

        <!-- change button - loads order form pre-filled with choices check session variable -->



        <div class="col-sm-2">
                <a class="btn btn-warning" href="/orders/{{ $order->id }}/edit" role="button">Change Order</a>
        </div>
    </div>

    <div class="row" id="confirm-cancel">
        <p>Or you can cancel your order entirely:</p>
        <div class="col-sm-2">
                <a class="btn btn-danger" href="/orders/cancel/{{ $order->id }}" role="button">Cancel Order</a>
        </div>

    </div>

</div>


@endsection
