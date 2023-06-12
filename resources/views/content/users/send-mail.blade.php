@extends('layouts/contentLayoutMaster')

@section('title', 'Send Mail')

@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">

@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">

@endsection

@section('content')
    <style>
        textarea.form-control {
            min-height: 15.714rem;
        }

        .select2-container--classic.select2-container--focus .select2-selection--multiple,
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #28c76f !important;
            outline: 0;
        }

        .select2-container--classic .select2-selection--multiple,
        .select2-container--default .select2-selection--multiple {
            min-height: 47px px !important;
            border: 1px solid #d8d6de;
        }

        .select2-container--classic .select2-selection--multiple .select2-selection__choice,
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #28c76f !important;
            border-color: #28c76f !important;
            color: #fff;
            padding: 2px 5px;
        }

        .select2-container--classic .select2-results__option[aria-selected=true],
        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #28c76f !important;
            color: #fff !important;
        }

        .select2-container--classic .select2-results__option--highlighted,
        .select2-container--default .select2-results__option--highlighted {
            background-color: rgb(40 199 111 / 16%) !important;
            color: #28c76f !important;
        }

        .spinner-image {
            position: absolute;
            z-index: 1000;
            /* margin-top: 25%;
                                                                                            */
            margin-top: 14%;
            margin-left: 39%
        }

        .blur-body {
            filter: blur(5px);
            background-color: #fbfbfb;
            color: #fbfbfb;
        }
    </style>

    <div class="spinner-preloader d-none" id="preloader-img">
        <div class="preloader-img">
            <img src="{{ asset('custom/img/spinner-2.gif') }}" class="spinner-image" height="100">
        </div>
    </div>

    <div class="row element-blur">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"></h4>
                </div>
                <div class="card-body">
                    <form id="submit_form">
                        {{-- <input type="hidden" value="0" name="user_id" id="user_id"> --}}
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label" for="select2-multiple">Select User</label>
                                <select class="select2 form-select" id="select2-multiple" multiple name="user[]">
                                    @foreach ($users as $value)
                                        <option value="{{ $value->id }}">{{$value->first_name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="select2-multiple">Select Type</label>
                                <select class="form-control" id="" name="type">
                                    <option value="1">Mail</option>
                                    <option value="2">Messages</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <label for="admin" class="form-label">Description</label>
                                <textarea class="form-control notes" id="notes" name="description"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="md-3">
                            <button type="submit"
                                class="btn btn-success me-1 waves-effect waves-float waves-light">Send</button>
                            {{-- <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button> --}}
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection

@section('vendor-script')
    {{-- Vendor js files --}}
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>t>
    {{-- data table --}}
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>

@endsection

@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/pages/modal-edit-user.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/app-user-view-account.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/app-user-view.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/extensions/ext-component-toastr.js')) }}"></script>


    <script>
        $("#submit_form").submit(function(event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".element-blur").addClass("blur-body");
            $(".menu-fixed menu-light").addClass("blur-body");
            $(".main-menu").addClass("blur-body");
            $("footer").addClass("blur-body");
            $("nav").addClass("blur-body");
            $(".breadcrumbs-top").addClass("blur-body");
            $(".main-menu").addClass("blur-body");
            $("#preloader-img").removeClass("d-none");
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('send.email') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {

                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        setTimeout(function() {
                            {{-- window.location.href = "/panel/invoice/detail/" + response.id; --}}
                            $(".element-blur").removeClass("blur-body");
                            $(".menu-fixed menu-light").removeClass("blur-body");
                            $(".main-menu").removeClass("blur-body");
                            $("footer").removeClass("blur-body");
                            $("nav").removeClass("blur-body");
                            $(".breadcrumbs-top").removeClass("blur-body");
                            $(".main-menu").removeClass("blur-body");
                            $("#preloader-img").addClass("d-none");

                        }, 5000)
                        toastr[response.status](
                            response.message, 'Success', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            });
                            location.reload();
                    } else {
                        $(".element-blur").removeClass("blur-body");
                        $(".menu-fixed menu-light").removeClass("blur-body");
                        $(".main-menu").removeClass("blur-body");
                        $("footer").removeClass("blur-body");
                        $("nav").removeClass("blur-body");
                        $(".breadcrumbs-top").removeClass("blur-body");
                        $(".main-menu").removeClass("blur-body");
                        $("#preloader-img").addClass("d-none");


                        toastr[response.status](
                            response.message, '!Oops', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            });
                    }
                },
                error: function(response) {
                    $(".element-blur").removeClass("blur-body");
                    $(".menu-fixed menu-light").removeClass("blur-body");
                    $(".main-menu").removeClass("blur-body");
                    $("footer").removeClass("blur-body");
                    $("nav").removeClass("blur-body");
                    $(".breadcrumbs-top").removeClass("blur-body");
                    $(".main-menu").removeClass("blur-body");
                    $("#preloader-img").addClass("d-none");
                    $('#invoice_table').DataTable().ajax.reload();
                    alert("Failed")
                }
            });
        });
    </script>

@endsection
