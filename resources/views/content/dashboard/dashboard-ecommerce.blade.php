@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard Ecommerce')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('page-style')
    {{-- Page css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
@endsection

@section('content')
    <!-- Dashboard Ecommerce Starts -->
    <section id="dashboard-ecommerce">
        <div class="row match-height">
            <!-- Medal Card -->
            {{-- <div class="col-xl-4 col-md-6 col-12">
                <div class="card card-congratulation-medal">
                    <div class="card-body">
                        <h5>Congratulations 🎉 John!</h5>
                        <p class="card-text font-small-3">You have won gold medal</p>
                        <h3 class="mb-75 mt-2 pt-50">
                            <a href="#">$48.9k</a>
                        </h3>
                        <button type="button" class="btn btn-success">View Sales</button>
                        <img src="{{ asset('images/illustration/badge.svg') }}" class="congratulation-medal"
                            alt="Medal Pic" />
                    </div>
                </div>
            </div> --}}
            <!--/ Medal Card -->

            <!-- Statistics Card -->
            <div class="col-xl-12 col-md-12 col-12">
                <div class="card card-statistics">
                    <div class="card-header">
                        {{-- <h4 class="card-title">Statistics</h4> --}}
                        <div class="d-flex align-items-center">
                            <p class="card-text font-small-2 me-25 mb-0">Updated 1 month ago</p>
                        </div>
                    </div>
                    <div class="card-body statistics-body">
                        <div class="row">
                            <div class="col-xl-2 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-success me-2">
                                        <div class="avatar-content">
                                            <i data-feather="trending-up" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{ @$lead }}</h4>
                                        <p class="card-text font-small-3 mb-0">lead</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-info me-2">
                                        <div class="avatar-content">
                                            <i data-feather="user" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{ @$customer }}</h4>
                                        <p class="card-text font-small-3 mb-0">Customers</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-sm-6 col-12 mb-2 mb-sm-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-danger me-2">
                                        <div class="avatar-content">
                                            <i data-feather="user" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{ @$employee }}</h4>
                                        <p class="card-text font-small-3 mb-0">Employee</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-sm-6 col-12 mb-2 mb-sm-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-danger me-2">
                                        <div class="avatar-content">
                                            <i data-feather="user" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{ @$referral }}</h4>
                                        <p class="card-text font-small-3 mb-0">Referrals</p>
                                    </div>
                                </div>
                            </div>
                            @if (auth()->user()->is_admin == true)
                                <div class="col-xl-2 col-sm-6 col-12">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-success me-2">
                                            <div class="avatar-content">
                                                <i data-feather="dollar-sign" class="avatar-icon"></i>
                                            </div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">${{ @$revenue_value }}</h4>
                                            <p class="card-text font-small-3 mb-0">Revenue</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Statistics Card -->
        </div>

        <div class="row match-height">
            <div class="col-lg-12 col-12">
                <div class="row match-height">
                    <!-- Bar Chart - Orders -->
                    {{-- <div class="col-lg-6 col-md-3 col-6">
                        <div class="card">
                            <div class="card-body pb-50">
                                <h6>Orders</h6>
                                <h2 class="fw-bolder mb-1">2,76k</h2>
                                <div id="statistics-order-chart"></div>
                            </div>
                        </div>
                    </div> --}}
                    <!--/ Bar Chart - Orders -->

                    <!-- Line Chart - Profit -->
                    {{-- <div class="col-lg-6 col-md-3 col-6">
                        <div class="card card-tiny-line-stats">
                            <div class="card-body pb-50">
                                <h6>Profit</h6>
                                <h2 class="fw-bolder mb-1">6,24k</h2>
                                <div id="statistics-profit-chart"></div>
                            </div>
                        </div>
                    </div> --}}
                    <!--/ Line Chart - Profit -->

                    <!-- Earnings Card -->
                    @if (auth()->user()->is_admin == true)
                        <!-- <div class="col-lg-12 col-md-6 col-12">
                            <div class="card earnings-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h4 class="card-title mb-1">Earnings</h4>
                                            <div class="font-small-2">This Month Revenue</div>
                                            <h5 class="mb-1 t_revenue">${{$mounthly_revenue_value}}</h5>
                                            <p class="card-text text-muted font-small-2">

                                            </p>
                                        </div>
                                        <div class="col-6">
                                        <input id="customer-data" type="month" class="form-control" name="bday-month" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    @endif
                    <!--/ Earnings Card -->
                </div>
            </div>
            <!-- Revenue Report Card -->
            <!-- @if (auth()->user()->is_admin == true)
                <div class="col-lg-8 col-12">
                    <div class="card card-revenue-budget">
                        <div class="row mx-0">
                            <div class="col-md-8 col-12 revenue-report-wrapper">
                                <div class="d-sm-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title mb-50 mb-sm-0">Revenue Report</h4>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center me-2">
                                            <span class="bullet bullet-success font-small-3 me-50 cursor-pointer"></span>
                                            <span>Earning</span>
                                        </div>
                                        <div class="d-flex align-items-center ms-75">
                                            <span class="bullet bullet-warning font-small-3 me-50 cursor-pointer"></span>
                                            <span>Expense</span>
                                        </div>
                                    </div>
                                </div>
                                <div id="revenue-report-chart"></div>
                            </div>
                            <div class="col-md-4 col-12 budget-wrapper">
                                <div class="btn-group">
                                    <button type="button"
                                        class="btn btn-outline-success btn-sm dropdown-toggle budget-dropdown"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        2023
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" data-value="2020">2023</a>
                                        <a class="dropdown-item" href="#" data-value="2019">2022</a>
                                        <a class="dropdown-item" href="#" data-value="2018">2021</a>
                                        <a class="dropdown-item" href="#" data-value="2018">2020</a>
                                    </div>
                                </div>
                                <h2 class="mb-25" id="year_data">$</h2>
                                {{-- <div class="d-flex justify-content-center">
                                    <span class="fw-bolder me-25">Budget:</span>
                                    <span>56,800</span>
                                </div>
                                <div id="budget-chart"></div>
                                <button type="button" class="btn btn-success">Increase Budget</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endif -->
            <!--/ Revenue Report Card -->
        </div>
        <div class="row match-height">
            <!-- Company Table Card -->
            <div class="col-lg-12 col-12">
                <div class="card card-company-table">
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table id="unpaid_invoice_table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>@lang('Invoice')</th>
                                        <th>@lang('customer')</th>
                                        <th>@lang('Issue Date')</th>
                                        <th>@lang('Due Date')</th>
                                        <th>@lang('Total')</th>
                                        <th>@lang('Due Date')</th>
                                        <th>@lang('Balance')</th>
                                        <th>@lang('Status')</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row match-height">
            <!-- Company Table Card -->
            <div class="col-lg-12 col-12">
                <div class="card card-company-table">
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table id="paid_invoice_table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>@lang('Invoice')</th>
                                        <th>@lang('customer')</th>
                                        <th>@lang('Issue Date')</th>
                                        <th>@lang('Due Date')</th>
                                        <th>@lang('Total')</th>
                                        <th>@lang('Due Date')</th>
                                        <th>@lang('Balance')</th>
                                        <th>@lang('Status')</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row match-height">

            <!-- Goal Overview Card -->
            <div class="col-lg-8 col-md-8 col-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Goal Overview</h4>
                        <i data-feather="help-circle" class="font-medium-3 text-muted cursor-pointer"
                            onclick="goals(1)"></i>
                    </div>
                    <div class="card-body p-0">
                        <div id="goal-overview-radial-bar-chart" class="my-2"></div>
                        <div class="row border-top text-center mx-0">
                            <div class="col-4 border-end py-1">
                                <p class="card-text text-muted mb-0 ">Completed</p>
                                <h3 class="fw-bolder mb-0 complete_goal" >$</h3>
                            </div>
                            <div class="col-4 border-end py-1">
                                <a class="card-text text-muted mb-0" onclick="goals(1)">Set Goal</a>
                                <h3 class="fw-bolder mb-0 set_goal">$</h3>
                            </div>
                              <div class="col-4 py-1">
                                <p class="card-text text-muted mb-0">Status</p>
                                <h4 class="fw-bolder mb-0 status_goal"></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Goal Overview Card -->

            <!-- Transaction Card -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card card-transaction">
                    <div class="card-header">
                        <h4 class="card-title">Transactions</h4>
                        <div class="dropdown chart-dropdown">
                            <i data-feather="more-vertical" class="font-medium-3 cursor-pointer"
                                data-bs-toggle="dropdown"></i>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Last 28 Days</a>
                                <a class="dropdown-item" href="#">Last Month</a>
                                <a class="dropdown-item" href="#">Last Year</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="transaction-item">
                            <div class="d-flex">
                                <div class="avatar bg-light-success rounded float-start">
                                    <div class="avatar-content">
                                        <i data-feather="pocket" class="avatar-icon font-medium-3"></i>
                                    </div>
                                </div>
                                <div class="transaction-percentage">
                                    <h6 class="transaction-title">Wallet</h6>
                                    <small>Starbucks</small>
                                </div>
                            </div>
                            <div class="fw-bolder text-danger">- $74</div>
                        </div>
                        <div class="transaction-item">
                            <div class="d-flex">
                                <div class="avatar bg-light-success rounded float-start">
                                    <div class="avatar-content">
                                        <i data-feather="check" class="avatar-icon font-medium-3"></i>
                                    </div>
                                </div>
                                <div class="transaction-percentage">
                                    <h6 class="transaction-title">Bank Transfer</h6>
                                    <small>Add Money</small>
                                </div>
                            </div>
                            <div class="fw-bolder text-success">+ $480</div>
                        </div>
                        <div class="transaction-item">
                            <div class="d-flex">
                                <div class="avatar bg-light-danger rounded float-start">
                                    <div class="avatar-content">
                                        <i data-feather="dollar-sign" class="avatar-icon font-medium-3"></i>
                                    </div>
                                </div>
                                <div class="transaction-percentage">
                                    <h6 class="transaction-title">Paypal</h6>
                                    <small>Add Money</small>
                                </div>
                            </div>
                            <div class="fw-bolder text-success">+ $590</div>
                        </div>
                        <div class="transaction-item">
                            <div class="d-flex">
                                <div class="avatar bg-light-warning rounded float-start">
                                    <div class="avatar-content">
                                        <i data-feather="credit-card" class="avatar-icon font-medium-3"></i>
                                    </div>
                                </div>
                                <div class="transaction-percentage">
                                    <h6 class="transaction-title">Mastercard</h6>
                                    <small>Ordered Food</small>
                                </div>
                            </div>
                            <div class="fw-bolder text-danger">- $23</div>
                        </div>
                        <div class="transaction-item">
                            <div class="d-flex">
                                <div class="avatar bg-light-info rounded float-start">
                                    <div class="avatar-content">
                                        <i data-feather="trending-up" class="avatar-icon font-medium-3"></i>
                                    </div>
                                </div>
                                <div class="transaction-percentage">
                                    <h6 class="transaction-title">Transfer</h6>
                                    <small>Refund</small>
                                </div>
                            </div>
                            <div class="fw-bolder text-success">+ $98</div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Transaction Card -->
        </div>
    </section>
    <!-- create app modal -->
    <div class="modal fade" id="createAppModal" tabindex="-1" aria-labelledby="createAppTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-3 px-sm-3">
                    <h1 class="text-center mb-1" id="createAppTitle">Pending Invoice</h1>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-datatable">
                                        <table id="user_table" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Status</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($data['pending'][0]))
                                                    @foreach (@$data['pending'] as $value)
                                                        <tr>
                                                            <td>{{ @$value->users->first_name }}</td>
                                                            <td>{{ @$value->users->email }}</td>
                                                            <td><span class="badge rounded-pill  badge-light-danger">Not
                                                                    Pay</span>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                @endif
                                                @if (isset($data['send'][0]))
                                                    @foreach (@$data['send'] as $value)
                                                        <tr>
                                                            <td>{{ @$value->users->first_name }}</td>
                                                            <td>{{ @$value->users->email }}</td>
                                                            <td><span
                                                                    class="badge rounded-pill  badge-light-warning">Pending</span>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- / create app modal -->

    <!-- Dashboard Ecommerce ends -->

    @php
        $date = date('d-m-Y');
    @endphp
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('Update Goal')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="submit_goal_form" class="form_field" method="post">

                        <input type="hidden" name="f_id">
                        <input type="hidden" name="f_id" id="f_id">
                        {{-- <input type="hidden" value="{{ $id }}" name="form_id"> --}}

                        <div class="row">

                            <div class="row">
                                <div class="col-6">
                                    <label for="recipient-name" class="col-form-label">@lang('Starte Date')</label>
                                    <input type="date" class="form-control" name="starte_date" id="starte_date">
                                </div>
                                <div class="col-6">
                                    <label for="recipient-name" class="col-form-label">@lang('End Date')</label>
                                    <input type="date" class="form-control" name="end_date" id="end_date"
                                        placeholder="Issue Date">
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-6">
                                    <label for="recipient-name" class="col-form-label">@lang('Goal Amount')</label>
                                    <input type="number" class="form-control" name="goal_amount" id="goal_amount"
                                        placeholder="Cost" required>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- end preview-->


@endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
@endsection
@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/pages/dashboard-ecommerce.js')) }}"></script>
    <script>
        load_data();

        function load_data() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#unpaid_invoice_table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                ordering: true,
                ajax: {
                    url: "{{ url('panel/unpaid/invoice') }}",
                    type: "POST",

                },
                columns: [{
                        data: 'invoice_number'
                    },
                    {
                        data: 'users.first_name'
                    },
                    {
                        data: 'issue_date'
                    }, {
                        data: 'due_date'
                    },
                    {
                        data: 'total_amount'
                    },
                    {
                        data: 'balance'
                    },
                    {
                        data: 'balance_status'
                    },
                    {
                        data: 'status'
                    },

                ]
            });


            $('#paid_invoice_table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                ordering: true,
                ajax: {
                    url: "{{ url('panel/paid/invoice') }}",
                    type: "POST",

                },
                columns: [{
                        data: 'invoice_number'
                    },
                    {
                        data: 'users.first_name'
                    },
                    {
                        data: 'issue_date'
                    }, {
                        data: 'due_date'
                    },
                    {
                        data: 'total_amount'
                    },
                    {
                        data: 'balance'
                    },
                    {
                        data: 'balance_status'
                    },
                    {
                        data: 'status'
                    },

                ]
            });

            $.ajax({
                url: "{{ route('alert.data') }}",
                method: "POST",
                success: function(response) {
                    if (response == 1) {
                        $('#createAppModal').modal('show');
                    }
                },
                error: function(response) {
                    $("#sahir_exampleModal").modal('hide');

                }
            })
        }

        {{-- $('#user_table').DataTable({
            responsive: false,
            processing: true,
            serverSide: true,
            searching: true,
            ordering: true,
        }); --}}

        goals(0)

        function goals(val) {

           var val = val;

            $.ajax({
                url: "{{ route('index.goal') }}",
                method: "GET",
                success: function(response) {
                if(response.goal){
                    $("#starte_date").val(response.goal.start_date);
                    $("#end_date").val(response.goal.end_date);
                    $("#goal_amount").val(response.goal.set_goals);

                     var html = '';
                     $(".complete_goal").text(response.complete);
                     $(".set_goal").text(response.goal_amount);
                      custome_chart(response.complete);
                     if(response.complete <= response.goal_amount ){
                     html = `<span class="badge rounded-pill  badge-light-warning">Inprogress</span>`;
                     }else{
                     html = `<span class="badge rounded-pill  badge-light-success">Done</span>`;
                     }
                     $(".status_goal").html(html);
                   }
                   if(val == 1){
                    $('#exampleModal').modal('show');
                   }
                },
                error: function(response) {
                }
            });
        }


   $('#submit_goal_form').on('submit', function(event) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "{{ route('update.goal') }}",
                method: "POST",
                data: form_data,
                dataType: "json",
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                       $("#exampleModal").modal('hide');
                        $('#invoice_table').DataTable().ajax.reload();
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
                    $("#exampleModal").modal('hide');

                }
            })
        });
  var $barColor = '#f3f3f3';
  var $trackBgColor = '#EBEBEB';
  var $textMutedColor = '#b9b9c3';
  var $budgetStrokeColor2 = '#dcdae3';
  var $goalStrokeColor2 = '#51e5a8';
  var $strokeColor = '#ebe9f1';
  var $textHeadingColor = '#5e5873';
  var $earningsStrokeColor2 = '#28c76f66';
  var $earningsStrokeColor3 = '#28c76f33';
  var $goalOverviewChart = document.querySelector('#goal-overview-radial-bar-chart');
  var goalOverviewChartOptions;
  custome_chart();
function custome_chart(data){
      goalOverviewChartOptions = {
    chart: {
      height: 245,
      type: 'radialBar',
      sparkline: {
        enabled: true
      },
      dropShadow: {
        enabled: true,
        blur: 3,
        left: 1,
        top: 1,
        opacity: 0.1
      }
    },
    colors: [$goalStrokeColor2],
    plotOptions: {
      radialBar: {
        offsetY: -10,
        startAngle: -150,
        endAngle: 150,
        hollow: {
          size: '77%'
        },
        track: {
          background: $strokeColor,
          strokeWidth: '50%'
        },
        dataLabels: {
          name: {
            show: false
          },
          value: {
            color: $textHeadingColor,
            fontSize: '2.86rem',
            fontWeight: '600'
          }
        }
      }
    },
    fill: {
      type: 'gradient',
      gradient: {
        shade: 'dark',
        type: 'horizontal',
        shadeIntensity: 0.5,
        gradientToColors: [window.colors.solid.success],
        inverseColors: true,
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 100]
      }
    },
    series: [data],
    stroke: {
      lineCap: 'round'
    },
    grid: {
      padding: {
        bottom: 30
      }
    }
  };
  goalOverviewChart = new ApexCharts($goalOverviewChart, goalOverviewChartOptions);
  goalOverviewChart.render();
}

  $("#customer-data").change(function() {

    var data = $("#customer-data").val();
    $.ajax({
        url: "{{ route('month.earning.ajax') }}",
        method: "POST",
        data: {
            date: data ,
        },
        success: function(response) {
            console.log(response.data);
            $(".t_revenue").text("$" + response.data);
        },
        error: function(response) {
            alert('Faild');
        }
    })
});

        $('a').on('click', function(e){
        var year = $(this).data('value');
        $.ajax({
        url: "{{ route('year.earning.ajax') }}",
        type: 'POST',
        data: {
            date: year,
        },
        success: function(response){
            $("#year_data").text('$'+response.data);
        }
    });
});
    </script>

@endsection
