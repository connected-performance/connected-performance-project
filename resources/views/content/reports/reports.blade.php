@extends('layouts/contentLayoutMaster')

@section('title', 'Reports')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">

        </div>
    </div>

    @php
        $start_date = date('01-m-Y');
        $end_date = date('t-m-Y');
        $timestamp_start = strtotime($start_date);
        $timestamp_end = strtotime($end_date);
        $start_date = date('d M,Y', $timestamp_start);
        $end_date = date('d M,Y', $timestamp_end);
    @endphp
    <div class="col-sm-4">
        <label>Date Range</label>
        <div class="input-daterange input-group " id="datepicker6" data-date-format="M, yyyy" data-date-autoclose="true"
            data-provide="datepicker" data-date-container='#datepicker6'>
            <input type="hidden" class="form-control onchange_chart" name="start" id="start" placeholder="Start Date"
                autocomplete="off" value="{{ $start_date }}" />
            <input type="hidden" class="form-control onchange_chart" name="end" id="end" placeholder="End Date"
                autocomplete="off" value="{{ $end_date }}" />
        </div>
        {{-- <input id="bday-month" type="month" name="bday-month" value="2001-06" /> --}}
    </div>
    <!-- apex charts section start -->
    <section id="apexchart">
        <div class="row">


            <!-- Column Chart Starts -->
            <div class="col-12">
                <div class="card">
                    <div
                        class="
            card-header
            d-flex
            flex-md-row flex-column
            justify-content-md-between justify-content-start
            align-items-md-center align-items-start
          ">
                        <h4 class="card-title">Customer</h4>
                        <div class="d-flex align-items-center mt-md-0 mt-1">

                            {{-- <input type="text" class="form-control flat-picker bg-transparent border-0 shadow-none"
                                placeholder="YYYY-MM-DD" /> <input type="mounth" class="form-control" /> --}}
                            <input id="customer-data" type="month" class="form-control" name="bday-month" />
                        </div>
                        <div class="d-flex align-items-center flex-wrap mt-sm-0 mt-1">
                            <h5 class="fw-bolder mb-0 me-1 t_customer"></h5>

                        </div>
                    </div>
                    <div class="card-body">
                        <div id="column-chart"></div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div
                        class="
            card-header
            d-flex
            flex-sm-row flex-column
            justify-content-md-between
            align-items-start
            justify-content-start
          ">
                        <div>
                            <h4 class="card-title mb-25">Monthly Recurring Revenue</h4>
                            <span class="card-subtitle text-muted">Monthly recurring revenue</span>
                        </div>
                        <div class="d-flex align-items-center mt-md-0 mt-1">
                            {{-- <i class="font-medium-2" data-feather="calendar"></i>
                            <input type="text" class="form-control flat-picker bg-transparent border-0 shadow-none"
                                placeholder="YYYY-MM-DD" /> --}}
                            <input id="mounth-recuring-data" type="month" class="form-control" name="bday-month" />

                        </div>
                        <div class="d-flex align-items-center flex-wrap mt-sm-0 mt-1">
                            <h5 class="fw-bolder mb-0 me-1 t_evenue_value">$</h5>
                            {{-- <span class="badge badge-light-secondary">
                                <i class="text-danger font-small-3" data-feather="arrow-down"></i>
                                <span class="align-middle">20%</span>
                            </span> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="line-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div
                        class="
            card-header
            d-flex
            flex-sm-row flex-column
            justify-content-md-between
            align-items-start
            justify-content-start
          ">
                        <div>
                            <h4 class="card-title mb-25">Project Revenue</h4>
                            <span class="card-subtitle text-muted">Project Revenue</span>
                        </div>
                        <div class="d-flex align-items-center mt-md-0 mt-1">

                            <input id="project-revenue" type="month" class="form-control" name="bday-month" />
                        </div>
                        <div class="d-flex align-items-center flex-wrap mt-sm-0 mt-1">
                            <h5 class="fw-bolder mb-0 me-1 t_pro_evenue"></h5>
                            {{-- <span class="badge badge-light-secondary">
                                <i class="text-danger font-small-3" data-feather="arrow-down"></i>
                                <span class="align-middle">20%</span>
                            </span> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="project-revenue-chart"></div>
                    </div>
                </div>
            </div>

            <!-- Line Chart Ends -->

            <!-- Bar Chart Starts -->
            <div class="col-xl-12 col-12">
                <div class="card">
                    <div
                        class="
            card-header
            d-flex
            flex-sm-row flex-column
            justify-content-md-between
            align-items-start
            justify-content-start
          ">
                        <div>
                            {{-- <p class="card-subtitle text-muted mb-25"></p> --}}
                            <h4 class="card-title fw-bolder">Amount Of Deals In Pipeline</h4>
                        </div>
                        <div class="d-flex align-items-center mt-md-0 mt-1">

                            <input id="pipeline-deal" type="month" class="form-control" name="bday-month" />
                        </div>
                        <div class="d-flex align-items-center flex-wrap mt-sm-0 mt-1">
                            <h5 class="fw-bolder mb-0 me-1 t_deals"></h5>

                        </div>
                    </div>
                    <div class="card-body">
                        <div id="bar-chart"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-12">
                <div class="card">
                    <div class="card-header flex-column align-items-start">
                        <h4 class="card-title mb-75">Trends</h4>
                        {{-- <span class="card-subtitle text-muted"> </span> --}}
                    </div>
                    <div class="card-body">
                        <div id="donut-chart"></div>
                    </div>
                </div>
            </div>
            <!-- Donut Chart Ends-->
            <!-- Apex charts section end -->
        </div>
    </section>
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection

@section('page-script')
    <!-- Page js files -->

    <script src="{{ asset(mix('js/scripts/extensions/ext-component-toastr.js')) }}"></script>
    <script>
        ajax();

        function ajax() {
            var start = $("#start").val();
            var end = $("#end").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('reports.index.ajax') }}",
                method: "POST",
                data: {
                    start: start,
                    end: end,
                },
                success: function(response) {

                    $(".t_evenue_value").text("$" + response.t_evenue_value);
                    $(".t_customer").text("Total:" + response.t_customer);
                    $(".t_pro_evenue").text("Total:" + response.t_deals);
                    $(".t_deals").text("Total:" + response.t_deals);
                    $(".t_pro_evenue").text("Total:" + response.t_pro_revenue);
                    recurring_revenue(response.revenue_value, response.mounth_name);
                    customer(response.customer, response.mounth_name);
                    deals(response.deals, response.mounth_name);
                    trend(response.trends, response.total_customer);
                    project_revenue(response.pro_revenue, response.pro_dates);
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        toastr[response.status](
                            response.message, 'Success', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            });
                    } else {
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
                    // swal("Error", "Something is wrong", "error");
                }
            })
        }

        $("#customer-data").change(function() {
            $.ajax({
                url: "{{ route('reports.customer.ajax') }}",
                method: "POST",
                data: {
                    date: $("#customer-data").val(),
                },
                success: function(response) {
                    $(".t_customer").text("Total:" + response.t_customer);
                    customer(response.customer, response.mounth_name);
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        toastr[response.status](
                            response.message, 'Success', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            });
                    } else {
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
                    alert('Faild');
                }
            })
        });

        $("#mounth-recuring-data").change(function() {
            $.ajax({
                url: "{{ route('reports.mounth-recuring.ajax') }}",
                method: "POST",
                data: {
                    date: $("#mounth-recuring-data").val(),
                },
                success: function(response) {
                    $(".t_evenue_value").text("$" + response.t_evenue_value);
                    recurring_revenue(response.revenue_value, response.mounth_name);
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        toastr[response.status](
                            response.message, 'Success', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            });
                    } else {
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
                    alert('Faild');
                }
            })
        });

        $("#project-revenue").change(function() {
            $.ajax({
                url: "{{ route('reports.project-revenue.ajax') }}",
                method: "POST",
                data: {
                    date: $("#project-revenue").val(),
                },
                success: function(response) {
                    $(".t_pro_evenue").text("Total:" + response.t_pro_revenue);
                    project_revenue(response.pro_revenue, response.pro_dates);
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        toastr[response.status](
                            response.message, 'Success', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            });
                    } else {
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
                    alert('Faild');
                }
            })
        });

        $("#pipeline-deal").change(function() {
            $.ajax({
                url: "{{ route('reports.pipeline-deal.ajax') }}",
                method: "POST",
                data: {
                    date: $("#pipeline-deal").val(),
                },
                success: function(response) {
                    $(".t_deals").text("Total:" + response.t_deals);

                    deals(response.deals, response.mounth_name);
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        toastr[response.status](
                            response.message, 'Success', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            });
                    } else {
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
                    alert('Faild');
                }
            })
        });
    </script>
    <script src="{{ asset(mix('js/scripts/charts/chart-apex.js')) }}"></script>
    <script src="{{ asset('js/scripts/charts/custom-chart.js') }}"></script>
@endsection
