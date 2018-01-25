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
        @if( $offer->active_flag == 1)
        <h2>Order Form - This week's availability (Pickup: {{ \Carbon\Carbon::parse($offer->pickup_date)->format('l - M j, Y') }})</h2>
        @else
        <h2>Availability for week of {{ \Carbon\Carbon::parse($offer->pickup_date)->format('l - M j, Y') }}</h2>
        @endif

        <h4>Order for {{ session('orderemail') }} @if( session('mbr') == 1)(Co-op member) @endif</h4>
        <p><em>Not your email address above? Click your browser's back button and re-enter your email address.</em></p>

    </div>

    <!-- need to open order form here -->

    <!-- if branch - block to show member pricing and then block for non-member pricing -->

    <form method="POST" action="/orders">
        {{ csrf_field() }}
        <input id="offer_id" name="offer_id" type="hidden" value="{{ $offer->id }}">
        <input id="order_email" name="order_email" type="hidden" value="{{ session('orderemail') }}">

    <div class="row">
    @if( session('mbr') == 1)

        @foreach ($dispcats as $dispcat)
        <div class="col-md-4">
        <h3>{{ $dispcat->name}}</h3>
        <p><em>{{ $dispcat->notes }}</em></p>
            @foreach ( $producerprices->where('display_category_id', $dispcat->id) as $producerprice)
            <label for="{{ $producerprice->id }}">{{ $producerprice->item->name }}
                @isset($producerprice->mbr_price)
                &nbsp;${{ $producerprice->mbr_price }}/{{ is_null($producerprice->sellUnit)?'':$producerprice->sellUnit->name }}
                @endisset
                @isset($producerprice->notes)
                - {{ $producerprice->notes }}
            @endisset</label>
            <input type="number" class="form-control form-control-sm" name="{{ $producerprice->id }}" id="{{ $producerprice->id }}" min="0" value="0" step="1">
            @endforeach
        </div>

        <input id="customer_name" name="customer_name" type="hidden" value="{{  session('customername') }}">
        @endforeach
    </div>

    @else

        @foreach ($dispcats as $dispcat)
        <div class="col-md-4">
        <h3>{{ $dispcat->name}}</h3>
        <p><em>{{ $dispcat->notes }}</em></p>
            @foreach ( $producerprices->where('display_category_id', $dispcat->id) as $producerprice)
            <label for="{{ $producerprice->id }}">{{ $producerprice->item->name }}
                @isset($producerprice->non_mbr_price)
                &nbsp;${{ $producerprice->non_mbr_price }}/{{ is_null($producerprice->sellUnit)?'':$producerprice->sellUnit->name }}
                @endisset
                @isset($producerprice->notes)
                - {{ $producerprice->notes }}
            @endisset</label>
            <input type="number" class="form-control form-control-sm" name="{{ $producerprice->id }}" id="{{ $producerprice->id }}" min="0" value="0" step="1">
            @endforeach
        </div>
        @endforeach

    </div>
        <div class="form-group row">
        <label for="customer_name">Your name:</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name">
        </div>
    @endif

    <div class="form-group form-row">
        <p>Please choose a pickup/delivery option (required):</p>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="pickup_option" id="p_berlin" value="Berlin">
            <label class="form-check-label" for="p_berlin">Pickup Friday in Berlin</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="pickup_option" id="p_whaleyville" value="Whaleyville">
            <label class="form-check-label" for="p_whaleyville">Pickup Sat/Sun in Whaleyville</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="pickup_option" id="d_delivery" value="delivery">
            <label class="form-check-label" for="d_delivery">Delivery ($5 charge. Please enter delivery address below.)</label>
        </div>
    </div>

    <!-- add phone number input text and special instructions, comments, address textarea -->

    <div class="form-group form-row">
        <label for="phone">Phone (optional):</label>
        <input type="text" class="form-control" id="phone" name="phone">
    </div>

    <div class="form-group form-row">
        <label for="customer_note">Delivery address, special instructions, or other comments:</label>
        <textarea id="customer_note" class="form-control" name="customer_note"></textarea>

    </div>

    <button class="btn btn-primary" type="submit">Place Order</button>

<!-- pickup options - radio buttons here -->
<!-- ask for name, pickup method, and special instructions/notes -->
    <!-- submit order, go to confirmation page -->

</form>



</div>


@endsection
