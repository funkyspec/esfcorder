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

        <h4>Order for {{ session('orderemail') }} @if( session('mbr') == 1)(Co-op member) @endif</h4>

    </div>


    <form method="POST" action="/orders/{{ $order->id }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}

    <div class="row">

        </div>
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






    <div class="form-group form-row">
            <label for="orderEmail">Email address</label>
            <input type="email" class="form-control" id="orderEmail" name="orderEmail" placeholder="Email" value="{{ $order->email }}" required>
        </div>

        <div class="form-group form-row">
                <label for="phone">Phone (optional):</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $order->phone }}">
            </div>

        <div class="form-group form-row">
            <label for="customer_note">Delivery address, special instructions, or other comments:</label>
            <textarea id="customer_note" class="form-control" name="customer_note" value="{{ $order->customer_note }}"></textarea>
        </div>
