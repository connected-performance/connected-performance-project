@extends('layouts/contentLayoutMaster')

@section('title', 'Analytics Dashboard')

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
    <div class="row match-height">
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0">
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="users" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder mt-1" id="churned_customer_count"></h2>
                    <p class="card-text">Churned Customers this year</p>
                </div>
                <div id="gained-chart"></div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0">
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="dollar-sign" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder mt-1" id="projected_revenue"></h2>
                    <p class="card-text">Projected Revenue this year</p>
                </div>
                <div id="gained-chart"></div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0">
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="bar-chart-2" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder mt-1" id="new_subs"></h2>
                    <p class="card-text">New Subscribers this year</p>
                </div>
                <div id="gained-chart"></div>
            </div>
        </div>
    </div>

    <!-- apex charts section start -->
    <section id="apexchart">
        <div class="row">

            <div class="col-12 col-lg-12 col-md-12">
                <div class="card">
                    <div
                        class=" card-header d-flex flex-md-row flex-column justify-content-md-between justify-content-start align-items-md-center align-items-start">
                        <h4 class="card-title">Sales</h4>
                        <div class="d-flex align-items-center mt-md-0 mt-1">

                            {{-- <input type="text" class="form-control flat-picker bg-transparent border-0 shadow-none"
                                placeholder="YYYY-MM-DD" /> <input type="mounth" class="form-control" /> --}}
                        </div>
                        <div class="d-flex align-items-center flex-wrap mt-sm-0 mt-1">
                            <h5 class="fw-bolder mb-0 me-1 t_customer"></h5>

                        </div>
                    </div>
                    <div class="card-body">
                        <div id="analytics-sales-chart"></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 col-md-4">
                <div class="card">
                    <div
                        class=" card-header d-flex flex-md-row flex-column justify-content-md-between justify-content-start align-items-md-center align-items-start">
                        <h4 class="card-title">Customers</h4>
                        <div class="d-flex align-items-center mt-md-0 mt-1">

                            {{-- <input type="text" class="form-control flat-picker bg-transparent border-0 shadow-none"
                                placeholder="YYYY-MM-DD" /> <input type="mounth" class="form-control" /> --}}
                        </div>
                        <div class="d-flex align-items-center flex-wrap mt-sm-0 mt-1">
                            <h5 class="fw-bolder mb-0 me-1 t_customer"></h5>

                        </div>
                    </div>
                    <div class="card-body">
                        <div id="analytics-customers-chart"></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8 col-md-8">
                <div class="card">
                    <div
                        class=" card-header d-flex flex-md-row flex-column justify-content-md-between justify-content-start align-items-md-center align-items-start">
                        <h4 class="card-title">Overall Leads</h4>
                        {{-- <div class="d-flex align-items-center mt-md-0 mt-1"></div> --}}
                        <div class="d-flex align-items-center flex-wrap mt-sm-0 mt-1">
                            <form action="{{ route('panel.analytics.leads-data') }}" method="POST"
                                id="leads-chart-filter-form">
                                {{-- <input type="mounth" class="form-control" /> --}}

                                <select name="by_factor" id="leads_by_factor" onchange="$(this).parent().submit()">
                                    <option value="yearly">Yearly</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="weekly">Weekly</option>
                                </select>
                            </form>

                        </div>
                    </div>
                    <div class="card-body">
                        <div id="chart-container">
                            <div id="analytics-leads-chart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-12 col-md-12">
                <div class="card">
                    <div
                        class=" card-header d-flex flex-md-row flex-column justify-content-md-between justify-content-start align-items-md-center align-items-start">
                        <h4 class="card-title">Employees Close Rate</h4>
                        <div class="d-flex align-items-center flex-wrap mt-sm-0 mt-1"></div>
                    </div>
                    <div class="card-body">
                        <div id="chart-container">
                            <div id="analytics-employee-close-rate-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-12 col-md-12">
                <div class="card">
                    <div
                        class=" card-header d-flex flex-md-row flex-column justify-content-md-between justify-content-start align-items-md-center align-items-start">
                        <h4 class="card-title">Employees Recurring Revenue</h4>
                        <div class="d-flex align-items-center flex-wrap mt-sm-0 mt-1"></div>
                    </div>
                    <div class="card-body">
                        <div id="chart-container">
                            <div id="analytics-empMonRecRev-chart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-12 col-md-12">
                <div class="card">
                    <div
                        class=" card-header d-flex flex-md-row flex-column justify-content-md-between justify-content-start align-items-md-center align-items-start">
                        <h4 class="card-title">Leads per employee</h4>
                        <div class="d-flex align-items-center flex-wrap mt-sm-0 mt-1"></div>
                    </div>
                    <div class="card-body">
                        <div id="chart-container">
                            <div id="analytics-leadsperemployee-chart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-12 col-md-12">
                <div class="card">
                    <div
                        class=" card-header d-flex flex-md-row flex-column justify-content-md-between justify-content-start align-items-md-center align-items-start">
                        <h4 class="card-title">Projected recurring revenue</h4>
                        <div class="d-flex align-items-center flex-wrap mt-sm-0 mt-1"></div>
                    </div>
                    <div class="card-body">
                        <div id="chart-container">
                            <div id="analytics-prr-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
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

    <script src="{{ asset(mix('js/scripts/charts/chart-apex.js')) }}"></script>
    <script src="{{ asset('js/scripts/charts/custom-chart.js') }}"></script>
    <script src="{{ asset('js/scripts/charts/analytics-charts.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            getChurnedCustomersCount();


            const salesData = {!! $salesData !!};
            const customersData = {!! $customersData !!};
            const leadsData = {!! $leadsData !!}
            displaySalesAndCustomerChart(salesData, customersData);
            displayLeadsChart(leadsData);

            $('#leads-chart-filter-form').on('submit', function(event) {
                event.preventDefault();
                var formData = {
                    by_factor: $('#leads_by_factor').val()
                }

                $.ajax({
                    url: "{{ route('panel.analytics.leads-data') }}",
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        displayLeadsChart(response.leadsData);
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
                        swal("Error", "Something is wrong", "error");
                    }
                });
            })

            getEmployeesCloseRate('{{ route('panel.analytics.get-employee-close-rate') }}');

            getEmployeeMonthlyRecurringRevenue(
                "{{ route('panel.analytics.employee-monthly-recurring-revenue') }}");

            function getChurnedCustomersCount() {
                var formData = null;
                $.ajax({
                    url: "{{ route('panel.analytics.churned-customers-count') }}",
                    method: "POST",
                    data: formData,
                    success: function(response) {

                        if (response.status == "success") {
                            if (response.churnedCutomers.length) {
                                $('#churned_customer_count').text(response.churnedCutomers[0]
                                    ?.churned_customers);
                            } else {
                                $('#churned_customer_count').text(0);
                            }
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
                        swal("Error", "Something is wrong", "error");
                    }
                });

            }

            function getProjectedRevenue() {
                var formData = null;
                $.ajax({
                    url: "{{ route('panel.analytics.projected-monthly-revenue') }}",
                    method: "POST",
                    data: formData,
                    success: function(response) {

                        if (response.status == "success") {
                            $('#projected_revenue').text("$" + response.total_revenue);
                            $('#new_subs').text(response.new_subs);
                            displayProjectedRecurringRevenueChart(response.monthly_projected_revenue,"#analytics-prr-chart");
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
                        swal("Error", "Something is wrong", "error");
                    }
                });

            }

            getProjectedRevenue();
        });
    </script>

@endsection
