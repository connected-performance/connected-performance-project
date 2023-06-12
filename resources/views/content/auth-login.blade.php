@extends('layouts/fullLayoutMaster')

@section('title', 'Login Page')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
    <style>
        .form-control:focus {
            color: #6e6b7b;
            background-color: #fff;
            border-color: #28c76f;
            outline: 0;
            box-shadow: 0 3px 10px 0 rgb(34 41 47 / 10%);
        }

        .input-group:not(.bootstrap-touchspin):focus-within .form-control,
        .input-group:not(.bootstrap-touchspin):focus-within .input-group-text {
            border-color: #28c76f;
            box-shadow: none;
        }

        a {
            color: #28c76f;
            text-decoration: none;
        }

        a:hover {
            color: #28c76f;
            text-decoration: none;
        }

        .form-check-input:checked {
            background-color: #28c76f;
            border-color: #28c76f;
        }
    </style>
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
                    {{-- <h4 class="card-title mb-1">Welcome to CRM! 👋</h4>
                    <p class="card-text mb-2">Please sign-in to your account and start the adventure</p> --}}
                    <x-greetings />
                    <form class="auth-login-form mt-2" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <label for="login-email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="login-email" name="email"
                                placeholder="john@example.com" aria-describedby="login-email" tabindex="1" autofocus />
                        </div>

                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="login-password">Password</label>
                                <a href="{{ url('auth/forgot-password-basic') }}">
                                    <small>Forgot Password?</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" class="form-control" id="login-password" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me" tabindex="3" />
                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success w-100" tabindex="4">Sign in</button>
                    </form>

                    {{-- <p class="text-center mt-2">
                        <span>New on our platform?</span>
                        <a href="{{ url('auth/register-basic') }}">
                            <span>Create an account</span>
                        </a>
                    </p> --}}

                    {{-- <div class="divider my-2">
                        <div class="divider-text">or</div>
                    </div>

                    <div class="auth-footer-btn d-flex justify-content-center">
                        <a href="#" class="btn btn-facebook">
                            <i data-feather="facebook"></i>
                        </a>
                        <a href="#" class="btn btn-twitter white">
                            <i data-feather="twitter"></i>
                        </a>
                        <a href="#" class="btn btn-google">
                            <i data-feather="mail"></i>
                        </a>
                        <a href="#" class="btn btn-github">
                            <i data-feather="github"></i>
                        </a>
                    </div> --}}
                </div>
            </div>
            <!-- /Login basic -->
        </div>
    </div>
@endsection

@section('vendor-script')
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset(mix('js/scripts/pages/auth-login.js')) }}"></script>
@endsection
