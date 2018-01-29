@extends('layouts.app')

@section('content')

<div class="container">

<div class="row">

        <h3>Order Canceled</h3>
        <p>We have canceled the order for <strong>{{ session('orderemail') }}</strong>. You can place a new order at the <a href="/">ESFC online order system home page.</a></p>
        <p>You can also email us: <span class="emmyadd"></span></p>


    </div>

</div>
@endsection
