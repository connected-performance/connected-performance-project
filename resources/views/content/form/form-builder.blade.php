<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CRMGo SaaS - Projects, Accounting, Leads, Deals &amp; HRM Tool">
    <meta name="author" content="Rajodiya Infotech">
    <meta name="csrf-token" content="Pt0hVjcUaDWrK4QJPn0H3pQyBmN5kyEsCbh6gghn">
    <link rel="icon" href="{{ URL::asset('custom/img/connect_logo.png') }}" type="image" sizes="16x16">
    <link rel="stylesheet" href="{{ URL::asset('custom/build/css/intlTelInput.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('custom/build/css/demo.css') }}" />
    <title>Form ‐ CRM Connected-performance
    </title>
    <link rel="stylesheet" href="{{ URL::asset('custom/style.css') }}" id="main-style-link">
</head>
<style>
    .iti--allow-dropdown input,
    .iti--allow-dropdown input[type=text],
    .iti--allow-dropdown input[type=tel],
    .iti--separate-dial-code input,
    .iti--separate-dial-code input[type=text],
    .iti--separate-dial-code input[type=tel] {
        padding-right: 311px;
        padding-left: 52px;
        margin-left: 0;
    }
</style>

<body class="application application-offset">
    <style>
        .card-body {
            /* flex: 1 1 auto; */
            padding: 6.5rem 20.5rem;
            color: #6e6b7b;
        }

        .card-body h6 {
            color: #5e5873;
        }

        /* .card-body select option{
            color: #6e6b7b !important;
        } */

        html body {
            height: 100%;
            background-color: #0e0e0e;
            direction: ltr;
        }

        .form-group label {
            padding-bottom: 10px;
        }

        .form-control:focus {
            color: #293240;
            background-color: #ffffff;
            border-color: #28c76f;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgb(40 199 111 / 25%);
        }

        .btn-success {
            color: #ffffff;
            background-color: #28c76f;
            border-color: #28c76f;
        }

        .btn-success:hover {
            background-color: #28c76f;
            border-color: #28c76f;
            box-shadow: 0 0 10px 1px rgb(40 199 111) !important;
        }

        /* ------ MEDIA QUERIES --------- */

        @media (min-width: 1025px) and (max-width: 1200px) {

            .iti--allow-dropdown input,
            .iti--allow-dropdown input[type=tel] {
                padding-right: 240px;
            }
        }

        @media (min-width: 992px) and (max-width: 1024px) {

            .iti--allow-dropdown input,
            .iti--allow-dropdown input[type=tel] {
                padding-right: 235px;
            }
        }

        @media (min-width: 576px) and (max-width: 768px) {

            .iti--allow-dropdown input,
            .iti--allow-dropdown input[type=tel] {
                padding-right: 180px;
            }
        }

        @media (min-width: 426px) and (max-width: 510px) {

            .iti--allow-dropdown input,
            .iti--allow-dropdown input[type=tel] {
                padding-right: 180px;
            }
        }

        @media (min-width: 376px) and (max-width: 425px) {

            .iti--allow-dropdown input,
            .iti--allow-dropdown input[type=tel] {
                padding-right: 180px;
            }
        }

        @media (min-width: 321px) and (max-width: 375px) {

            .iti--allow-dropdown input,
            .iti--allow-dropdown input[type=tel] {
                padding-right: 120px;
            }
        }

        @media (min-width: 200px) and (max-width: 320px) {

            .iti--allow-dropdown input,
            .iti--allow-dropdown input[type=tel] {
                padding-right: 110px;
            }
        }

        @media (min-width: 1800px) and (max-width: 2000px) {

            .iti--allow-dropdown input,
            .iti--allow-dropdown input[type=text],
            .iti--allow-dropdown input[type=tel],
            .iti--separate-dial-code input,
            .iti--separate-dial-code input[type=text],
            .iti--separate-dial-code input[type=tel] {
                padding-right: 0px;
                padding-left: 52px;
                margin-left: 0;
                width: 304%;
            }
        }

        @media (min-width: 1601px) and (max-width: 1800px) {

            .iti--allow-dropdown input,
            .iti--allow-dropdown input[type=text],
            .iti--allow-dropdown input[type=tel],
            .iti--separate-dial-code input,
            .iti--separate-dial-code input[type=text],
            .iti--separate-dial-code input[type=tel] {
                padding-right: 0px;
                padding-left: 52px;
                margin-left: 0;
                width: 103%;
            }
        }

        @media (min-width: 1440px) and (max-width: 1600px) {

            .iti--allow-dropdown input,
            .iti--allow-dropdown input[type=text],
            .iti--allow-dropdown input[type=tel],
            .iti--separate-dial-code input,
            .iti--separate-dial-code input[type=text],
            .iti--separate-dial-code input[type=tel] {
                padding-right: 0px;
                padding-left: 52px;
                margin-left: 0;
                width: 241%;
            }
        }
    </style>
    <div class="container-fluid container-application">
        <div class="main-content position-relative">
            <div class="page-content">
                <div class="min-vh-100 py-5 d-flex align-items-center">
                    <div class="w-100">
                        <div class="row justify-content-center">
                            <div class="col-sm-8 col-lg-5">

                                <div class="card shadow zindex-100 mb-0">
                                    <div class="m-auto mt-4">
                                        <a class="" href="#">
                                            <img src="{{ URL::asset('custom/img/connect_logo.png') }}" class="auth-logo"
                                                height="64">
                                        </a>
                                    </div>
                                    <x-greetings />
                                    <form action="{{ url('/leadGeneration/id') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $code }}" name="code">
                                        <input type="hidden" value="{{ $data->id }}" name="form_id">
                                        <div class="card-body px-md-5 px-sm-5 px-5 pb-5 pt-4 border-top">
                                            <div class="mb-4">
                                                <h6 class="h3 text-center fw-bold">{{ @$data->name }}</h6>
                                            </div>
                                            <input type="hidden" value="{{ @$data->code }}" name="code">
                                            @php
                                                $text = -1;
                                                $area = -1;
                                            @endphp
                                            @foreach (@$data->formfields as $field)
                                                @if (@$field->type == 'phone_plugin')
                                                    <div class="form-group">
                                                        <label for="field-1"
                                                            class="form-control-label">{{ @$field->name }}</label><br>
                                                        <input class="form-control" id="phone"
                                                            name="{{ @$field->type }}" value="{{ old($field->type) }}"
                                                            type="tel" required />
                                                        @if ($errors->has('name'))
                                                            <span
                                                                class="text-danger">{{ $errors->first('name') }}</span>
                                                        @endif
                                                    </div>
                                                @elseif(@$field->type == 'name')
                                                    <div class="form-group">
                                                        <label for="field-1"
                                                            class="form-control-label">{{ @$field->name }}</label>
                                                        <input class="form-control" required="required" id="field-1"
                                                            name="{{ @$field->type }}" type="{{ @$field->type }}"
                                                            value="{{ old($field->type) }}">
                                                    </div>
                                                @elseif(@$field->type == 'text')
                                                    @php
                                                        $text++;
                                                    @endphp
                                                    <div class="form-group">
                                                        <label for="field-1"
                                                            class="form-control-label">{{ @$field->name }}</label>
                                                        <input class="form-control" required="required" id="field-1"
                                                            name="text[{{ $text }}]"
                                                            type="{{ @$field->type }}">
                                                    </div>
                                                @elseif(@$field->type == 'textarea')
                                                    @php
                                                        $area++;
                                                    @endphp
                                                    <div class="form-group">
                                                        <label for="field-1"
                                                            class="form-control-label">{{ @$field->name }}</label>
                                                        <textarea class="form-control" required="required" id="field-1" name="text_area[{{ @$area }}]"></textarea>
                                                    </div>
                                                @elseif(@$field->type == 'email')
                                                    <div class="form-group">
                                                        <label for="field-1"
                                                            class="form-control-label">{{ @$field->name }}</label>
                                                        <input class="form-control" required="required" id="field-1"
                                                            name="{{ @$field->type }}" type="{{ @$field->type }}"
                                                            value="{{ old($field->type) }}">


                                                    </div>
                                                @elseif(@$field->type == 'date')
                                                    <div class="form-group">
                                                        <label for="field-1"
                                                            class="form-control-label">{{ @$field->name }}</label>
                                                        <input class="form-control" required="required" id="field-1"
                                                            name="{{ @$field->type }}" type="{{ @$field->type }}">
                                                    </div>
                                                @elseif(@$field->type == 'drop_down')
                                                    <div class="form-group">
                                                        <label for="field-1"
                                                            class="form-control-label">{{ @$field->name }}</label>
                                                        <select class="form-control type text-muted" id="type"
                                                            name="{{ @$field->type }}" required>
                                                            <option value="">Select Your Answer </option>
                                                            @foreach (@$field->dropdowns as $value)
                                                                <option value="{{ @$value->key }}">
                                                                    {{ @$value->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif
                                            @endforeach


                                            <div class="h-100 d-flex align-items-center justify-content-center">
                                                <button class="btn btn-sm btn-success" type="submit">Submit</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('custom/build/js/intlTelInput.js') }}"></script>
<script>
    var input = document.querySelector('#phone')
    window.intlTelInput(input, {
        allowDropdown: true,
        autoHideDialCode: true,
        autoPlaceholder: true,
        dropdownContainer: document.body,
        {{-- excludeCountries: ['us'], --}}
        formatOnDisplay: false,
        {{-- geoIpLookup: function(callback) {
            $.get('http://ipinfo.io', function() {}, 'jsonp').always(function(
                resp,
            ) {
                var countryCode = resp && resp.country ? resp.country : ''
                callback(countryCode)
            })
        }, --}}
        {{-- hiddenInput: 'full_number',
        initialCountry: 'auto',
        localizedCountries: {
            de: 'Deutschland'
        }, --}}
        nationalMode: false,
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        placeholderNumberType: 'MOBILE',
        preferredCountries: ['us'],
        separateDialCode: false,
        utilsScript: 'build/js/utils.js',
    })
</script>

</html>
