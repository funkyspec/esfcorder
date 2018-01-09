@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <h2>This week's availability (Pickup: {{ \Carbon\Carbon::parse($offer->pickup_date)->format('l - M j, Y') }})</h2>



        @foreach ($dispcats as $dispcat)
        <div class="col-md-4">
        <h3>{{ $dispcat->name}}</h3>
        <p><em>{{ $dispcat->notes }}</em></p>
            @foreach ( $producerprices->where('display_category_id', $dispcat->id) as $producerprice)
            <p>{{ $producerprice->item->name }} {{ $producerprice->non_mbr_price }} / {{ is_null($producerprice->sellUnit)?'':$producerprice->sellUnit->name }}  {{ $producerprice->notes }}</p>
            @endforeach
        </div>
        @endforeach






    </div>

</div>


@endsection
