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

        <h2>This week's availability (Pickup: {{ \Carbon\Carbon::parse($offer->pickup_date)->format('l - M j, Y') }})</h2>

    </div>
    <div class="row">

        @foreach ($dispcats as $dispcat)
        <div class="col-md-4">
        <h3>{{ $dispcat->name}}</h3>
        <p><em>{{ $dispcat->notes }}</em></p>
            @foreach ( $producerprices->where('display_category_id', $dispcat->id) as $producerprice)
            <p>{{ $producerprice->item->name }}
                @isset($producerprice->non_mbr_price)
                &nbsp;${{ $producerprice->non_mbr_price }}/{{ is_null($producerprice->sellUnit)?'':$producerprice->sellUnit->name }}
                @endisset
                @isset($producerprice->notes)
                - {{ $producerprice->notes }}
            @endisset</p>
            @endforeach
        </div>
        @endforeach

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


@endsection
