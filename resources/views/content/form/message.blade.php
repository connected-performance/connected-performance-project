@extends('layouts/fullLayoutMaster')

@section('title', 'Verify Email Basic')

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
    <style>
        .card-body {
            /* flex: 1 1 auto; */
            padding: 6.5rem 20.5rem;
        }
        html body {
            height: 100%;
            background-color: #0e0e0e;
            direction: ltr;
        }
    </style>
    <div class="auth-wrapper auth-basic px-2">
        <div class="">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="#" class="brand-logo">
                                <img src="{{ URL::asset('custom/img/connect_logo.png') }}" class="auth-logo" height="64">
                            </a>

                            <p class="h1  text-center text-dark">Thank You!</p>

                            <a href="#" class="brand-logo">
                                <img src="{{ URL::asset('custom/img/like.png') }}" class="auth-logo">
                            </a>
                            <!-- <p class="card-text mb-2">
                                We look forward to offering you new and exciting content.
                            </p> -->

                            {{-- <a href="{{ asset('/') }}" class="btn btn-primary w-100">Skip for now</a> --}}

                            <p class="text-center mt-2">

                            </p>
                        </div>
                    </div>
                    <!-- / verify email basic -->
                </div>
            </div>
        </div>
    </div>
@endsection
