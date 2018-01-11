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
        <h2>This week's availability (Pickup: {{ \Carbon\Carbon::parse($offer->pickup_date)->format('l - M j, Y') }})</h2>
        <button type="button" class="btn btn-primary">Order Online</button>
        @else
        <h2>Availability for week of {{ \Carbon\Carbon::parse($offer->pickup_date)->format('l - M j, Y') }}</h2>
        @endif

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

    <form method="POST" action="/checkmember">
        <div class="form-group">
            <label for="orderEmail">Email address</label>
            <input type="email" class="form-control" id="orderEmail" name="orderEmail" placeholder="Email">
        </div>

        <button type="submit" class="btn btn-primary">Order Online</button>
        </form>

    @if( $offer->active_flag == 1)
    <button type="button" class="btn btn-primary">Order Online</button>
    <a href="/order/create/{{ $offer->id }}" class="btn btn-primary active">Order Online</a>
    @endif

</div>


@endsection
