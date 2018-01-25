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
        <h2>Edit Order Form - This week's availability (Pickup: {{ \Carbon\Carbon::parse($offer->pickup_date)->format('l - M j, Y') }})</h2>

        <h4>Editing order for {{ session('orderemail') }} @if( session('mbr') == 1)(Co-op member) @endif</h4>



    </div>


    <form method="POST" action="/orders/{{ $order->id }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}



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

                    @if($lineItems->contains('producerprice_id', $producerprice->id))
                        <input type="number" class="form-control form-control-sm" name="{{ $producerprice->id }}" id="{{ $producerprice->id }}" min="0" step="1" value="{{ $lineItems->where('producerprice_id', $producerprice->id)->first()->quantity }}">
                    @else
                        <input type="number" class="form-control form-control-sm" name="{{ $producerprice->id }}" id="{{ $producerprice->id }}" min="0" step="1" value="0">
                    @endif



                @endforeach
            </div>


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

                        @if($lineItems->contains('producerprice_id', $producerprice->id))
                            <input type="number" class="form-control form-control-sm" name="{{ $producerprice->id }}" id="{{ $producerprice->id }}" min="0" step="1" value="{{ $lineItems->where('producerprice_id', $producerprice->id)->first()->quantity }}">
                        @else
                            <input type="number" class="form-control form-control-sm" name="{{ $producerprice->id }}" id="{{ $producerprice->id }}" min="0" step="1" value="0">
                        @endif



                    @endforeach
                </div>


                @endforeach
            </div>

            <!-- only allow different email and name for non-members form fields here -->

            <div class="form-group row">
                <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $order->email }}">
            </div>

            <div class="form-group row">
                <label for="customer_name">Your name:</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ $order->name }}">
            </div>

        @endif


        <div class="form-group form-row">
            <p>Please choose a pickup/delivery option (required):</p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pickup_option" id="p_berlin" value="Berlin"
                @if($order->pickup_option == 'Berlin')checked @endif>
                <label class="form-check-label" for="p_berlin">Pickup Friday in Berlin</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="pickup_option" id="p_whaleyville" value="Whaleyville"
                @if($order->pickup_option == 'Whaleyville')checked @endif>
                <label class="form-check-label" for="p_whaleyville">Pickup Sat/Sun in Whaleyville</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="pickup_option" id="d_delivery" value="delivery"
                @if($order->pickup_option == 'delivery')checked @endif>
                <label class="form-check-label" for="d_delivery">Delivery ($5 charge. Please enter delivery address below.)</label>
            </div>
        </div>





        <div class="form-group form-row">
                <label for="phone">Phone (optional):</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $order->phone }}">
            </div>

        <div class="form-group form-row">
            <label for="customer_note">Delivery address, special instructions, or other comments:</label>
            <textarea id="customer_note" class="form-control" name="customer_note" value="{{ $order->customer_note }}"></textarea>
        </div>

    </form>



</div>


@endsection
