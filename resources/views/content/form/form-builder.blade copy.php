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
        }

        html body {
            height: 100%;
            background-color: #0e0e0e;
            direction: ltr;
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
                                    <div class="m-auto">
                                        <a class="" href="#">
                                            <img src="{{ URL::asset('custom/img/connect_logo.png') }}" class="auth-logo"
                                                height="64">
                                        </a>
                                    </div>
                                    <form action="{{ url('/leadGeneration/id') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $code }}" name="code">
                                        <div class="card-body px-md-5 py-5">
                                            <div class="mb-4">
                                                <h6 class="h3">{{ @$data->name }}</h6>
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
                                                            name="{{ @$field->type }}" type="tel" required />
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
                                                            name="{{ @$field->type }}" type="{{ @$field->type }}">
                                                    </div>
                                                @elseif(@$field->type == 'text')
                                                    @php
                                                        $text++;
                                                    @endphp
                                                    <div class="form-group">
                                                        <label for="field-1"
                                                            class="form-control-label">{{ @$field->name }}</label>
                                                        <input class="form-control" required="required" id="field-1"
                                                            name="text[{{ $text }}"
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
                                                            name="{{ @$field->type }}" type="{{ @$field->type }}">
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
                                                        <select class="form-control type" id="type"
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
