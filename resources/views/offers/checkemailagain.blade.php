@extends('layouts.app')

@section('content')

<div class="container">


    <div class="row">

        <h2>Re-enter email address</h2>

        <p>We couldn't find this email: <strong>{{ $entemail }}</strong> in our co-op member database. Please enter the email address to which we send weekly newsletters. You may try again below:</p>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <form method="POST" action="/offers/checkmember">
            <div class="form-group">
                <input id="offer_id" name="offer_id" type="hidden" value="{{ $offerId }}">
                {{ csrf_field() }}
                <label for="orderEmail">Email address</label>
                <input type="email" class="form-control" id="orderEmail" name="orderEmail" placeholder="Email" required>
            </div>
            <button type="submit" class="btn btn-primary">Order Online</button>
        </form>


        <p class="email-us">If you continue having problems, please email us: <span class="emmyadd"></span>. <em>(We still accept orders through email.)</em></p>
    </div>
</div>

@endsection
