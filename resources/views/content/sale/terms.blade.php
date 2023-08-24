@extends('layouts/fullLayoutMaster')
@section('title', 'Terms and Conditions')
@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
    <style type="text/css">
        .auth-wrapper.auth-basic .auth-inner {
            max-width: 80%;
        }
    </style>
@endsection
@section('content')
    <div class="auth-wrapper auth-basic px-2">
        <div class="auth-inner my-2">
            <!-- Login basic -->
            <div class="card mb-0">
                <div class="card-body">
                    <div class="h-100 d-flex align-items-center justify-content-center">
                        <a class="" href="#">
                            <img src="{{ URL::asset('custom/img/connect_logo.png') }}" class="auth-logo" height="64">
                        </a>
                    </div>
                    <div class="row" style="margin-top: 40px;">
                        <h2 class="text-center">Terms and Conditions</h2>
                        <p>
                            If This is a Credit Card Payment, I also authorize this payment to be charged to my/our credit card account given. I agree to pay the total amount shown above in compliance with the cardholder agreement and that this is a special customer order, non-refundable or rendered cancelled. As part of this agreement, we, the customer stipulate we will not generate chargebacks/stop payments through our bank institution and a facsimile signature is to be considered as an original.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
