@extends('layouts.app')

@section('content')

<div class="container">


    <div class="row">

        <h2>This week's availability (Pickup starting: {{ \Carbon\Carbon::parse($offer->pickup_date)->format('l - M j, Y') }})</h2>

            <!--
        <p>Pricing below is for the general public. Co-op members receive a discount to these listed prices. To start an online order, enter your email address below. (We use your email address to contact you regarding your order. We will not share it with anyone.) <strong>Co-op members, please use the email address to which we send weekly newsletters to receive your member discount.</strong></p> -->

        <p>Pricing below is for co-op members. This form is for placing orders only. We cannot accept payments online at this time but hope to be able to do so in the near future.</p>

        <p>To get started with online ordering, please enter your email address below. <strong>Co-op members, please use the email address to which we send weekly newsletters.</strong></p>


        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @elseif(old('orderEmail'))
        <div class="alert alert-danger">
                <p>We couldn't find this email: <strong>{{ old('orderEmail') }}</strong> in our co-op member database. Please enter the email address to which we send weekly newsletters. Online ordering is for co-op members only.</p>
        </div>
        @endif

        @if( $offer->active_flag == 1)
        <form method="POST" action="/offers/checkmember">
            <div class="form-group">
                <input id="offer_id" name="offer_id" type="hidden" value="{{ $offer->id }}">
                {{ csrf_field() }}
                <label for="orderEmail">Email address</label>
                <input type="email" class="form-control" id="orderEmail" name="orderEmail" placeholder="Email" required>
            </div>
            <button type="submit" class="btn btn-primary">Order Online</button>
        </form>
        @endif

    </div>
    <br />


    @foreach ($dispcats as $dispcat)

    <div class="row">

        <h3>{{ $dispcat->name}}</h3>
        <p><em>{{ $dispcat->notes }}</em></p>



        @foreach ( $producerprices->where('display_category_id', $dispcat->id) as $producerprice)

            @if($loop->iteration % 4 == 1)
                <div class="row">
            @endif
                    <div class="col-md-3">

                        <p>{{ $producerprice->item->name }}
                            @isset($producerprice->mbr_price)
                            &nbsp;${{ $producerprice->mbr_price }}/{{ is_null($producerprice->sellUnit)?'':$producerprice->sellUnit->name }}
                            @endisset
                            <!--
                            @isset($producerprice->notes)
                            - {{ $producerprice->notes }}
                            @endisset
                        --></p>

                        </div>

            @if($loop->iteration % 4 == 0 || $loop->last)
                </div>
            @endif

        @endforeach


    </div>

    @endforeach




    <br /><br >
</div>


@endsection
