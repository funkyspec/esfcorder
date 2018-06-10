@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <h2>Edit Order Form - This week's availability (Pickup: {{ \Carbon\Carbon::parse($offer->pickup_date)->format('l - M j, Y') }})</h2>

        <h4>Editing order for {{ session('orderemail') }} @if( session('mbr') == 1)(Co-op member) @endif</h4>



    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form method="POST" action="/orders/{{ $order->id }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}


    @if( session('mbr') == 1)


        @foreach ($dispcats as $dispcat)


        <div class="row form-horizontal">
            <h3>{{ $dispcat->name}}</h3>
            <p><em>{{ $dispcat->notes }}</em></p>

            @foreach ( $producerprices->where('display_category_id', $dispcat->id) as $producerprice)

            @if($loop->iteration % 4 == 1)
            <div class="form-group">
            @endif

                <div class="col-md-3">

                    <label for="{{ $producerprice->id }}">{{ $producerprice->item->name }}

                    @isset($producerprice->producer->abbrev)
                    <em>({{ ($producerprice->producer->abbrev) }})</em>
                    @endisset
                    @isset($producerprice->mbr_price)
                    &nbsp;${{ $producerprice->mbr_price }}/{{ is_null($producerprice->sellUnit)?'':$producerprice->sellUnit->name }}
                    @endisset
                    @isset($producerprice->notes)
                    - {{ $producerprice->notes }}
                    @endisset</label>

                    @if($lineItems->contains('producerprice_id', $producerprice->id))
                        <input type="number" class="form-control form-control-sm" name="{{ $producerprice->id }}" id="{{ $producerprice->id }}" min="0" step="1" value="{{ number_format($lineItems->where('producerprice_id', $producerprice->id)->first()->quantity, 0) }}">
                    @else
                        <input type="number" class="form-control form-control-sm" name="{{ $producerprice->id }}" id="{{ $producerprice->id }}" min="0" step="1" value="0">
                    @endif

                </div>

            @if($loop->iteration % 4 == 0 || $loop->last)
            </div>
            @endif

            @endforeach

        </div>

        @endforeach

    @else

        @foreach ($dispcats as $dispcat)

        <div class="row form-horizontal">
            <h3>{{ $dispcat->name}}</h3>
            <p><em>{{ $dispcat->notes }}</em></p>

            @foreach ( $producerprices->where('display_category_id', $dispcat->id) as $producerprice)

            @if($loop->iteration % 4 == 1)
            <div class="form-group">
            @endif

                <div class="col-md-3">


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



                </div>

            @if($loop->iteration % 4 == 0 || $loop->last)
            </div>
            @endif

            @endforeach

        </div>

        @endforeach


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
           <!-- <div class="form-check">
                <input class="form-check-input" type="radio" name="pickup_option" required id="p_berlin" value="Berlin"
                @if($order->pickup_option == 'Berlin')checked @endif>
                <label class="form-check-label" for="p_berlin">Pickup Friday in Berlin (Bring payment in envelope - exact change or check to The Good Farm.)</label>
            </div> -->

            <div class="form-check">
                <input class="form-check-input" type="radio" name="pickup_option" required id="p_whaleyville" value="Whaleyville"
                @if($order->pickup_option == 'Whaleyville')checked @endif>
                <label class="form-check-label" for="p_whaleyville">Pickup Sat/Sun in Whaleyville (Pay when you pick up)</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="pickup_option" required id="d_delivery" value="delivery"
                @if($order->pickup_option == 'delivery')checked @endif>
                <label class="form-check-label" for="d_delivery">Delivery ($5 charge. Please enter delivery address below. Pay upon delivery.)</label>
            </div>
        </div>





        <div class="form-group form-row">
                <label for="phone">Phone (optional):</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $order->phone }}">
            </div>

        <div class="form-group form-row">
            <label for="customer_note">Delivery address, special instructions, or other comments:</label>
            <textarea id="customer_note" class="form-control" name="customer_note">{{ $order->customernote }}</textarea>
        </div>


        <button type="submit" class="btn btn-primary">Update Order</button>

    </form>



<div class="row" id="confirm-cancel">
    <p>Or you can cancel your order entirely:</p>
    <div class="col-sm-2">
            <a class="btn btn-danger" href="/orders/cancel/{{ $order->id }}" role="button">Cancel Order</a>
    </div>

</div>

</div>

@endsection
