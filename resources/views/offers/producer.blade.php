@extends('layouts.app')

@section('content')

<div class="container">


    <div class="row">
        <h2>Producer totals for pickup day starting {{ \Carbon\Carbon::parse($offer->pickup_date)->format('l - M j, Y') }}</h2>

        <p><a href="/offers/{{ $offer->id }}">View customer orders &raquo;</a></p>

    </div>



    @foreach(App\Producer::all() as $producer)
    <div class="row">
    <h4 style="text-decoration: underline;">{{ $producer->name }}</h4>

        @foreach($producerPrices->where('producer_id', $producer->id) as $producerPrice)

            @if($producerPrice->lineItems->sum('quantity') > 0)

            <p>{{ $producerPrice->item->name }}, {{ $producerPrice->sellUnit->name }}: <strong>{{ $producerPrice->lineItems->sum('quantity') }}</strong></p>

            @endif

        @endforeach




    </div>

    <br />

    @endforeach

@endsection
