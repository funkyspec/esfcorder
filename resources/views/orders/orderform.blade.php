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

        <h4>{{ $orderemail }}</h4>
        <h4>Membership status: {{ $mbr }}</h4>

    </div>

    <!-- need to open order form here -->

    <!-- if branch - block to show member pricing and then block for non-member pricing -->

    <div class="row">

        <form method="POST" action="">

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
            <input type="number" class="form-control" id="{{ $producerprice->id }}" min="0" value="0" step="1">
            @endforeach
        </div>
        @endforeach

    </form>

    </div>

    <!-- ask for name, pickup method, and special instructions/notes -->
    <!-- submit order, go to confirmation page -->

</div>


@endsection
