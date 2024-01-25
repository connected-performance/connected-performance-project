@extends('layouts/contentLayoutMaster')

@section('title', 'User View - Account')

@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css')) }}">
@endsection

@section('content')
    <style>
        .nav-pills .nav-link.active {
            border-color: #28c76f;
            box-shadow: 0 4px 18px -4px rgb(40 199 111);
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #28c76f;
        }

        .progress-bar {
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow: hidden;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            background-color: #28c76f;
            transition: width 0.6s ease;
        }

        #referral-table {
            overflow-y: auto !important;
            overflow-x: auto !important;
            display: block !important;
            white-space: nowrap !important;
        }

        .scroll {
            max-height: 556px;
            overflow-y: auto;
        }
    </style>
    <section class="app-user-view-account">
        <div class="row">
            <!-- User Sidebar -->
            <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                <!-- User Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                <input type="hidden" value="{{ $users->id }}" id="user_id">
                                @if($users->avatar && $users->avatar!=null && file_exists($avatar_dir)) 
                                    <img class="img-fluid rounded mt-3 mb-2" src="{{ $avatar }}" height="110"
                                    width="110" alt="User avatar" />
                                @else
                                    <img class="img-fluid rounded mt-3 mb-2" src="https://crm.connected-performance.com/images/avatars/male.png" height="110"
                                    width="110" alt="User avatar" />
                                @endif
                                <div class="user-info text-center">
                                    <h4>{{ @$users->username }}</h4>
                                    <span class="badge bg-light-secondary">Author</span>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="d-flex justify-content-around my-2 pt-75">
                            <div class="d-flex align-items-start me-2">
                                <span class="badge bg-light-success p-75 rounded">
                                    <i data-feather="check" class="font-medium-2"></i>
                                </span>
                                <div class="ms-75">
                                    <h4 class="mb-0">1.23k</h4>
                                    <small>Tasks Done</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <span class="badge bg-light-success p-75 rounded">
                                    <i data-feather="briefcase" class="font-medium-2"></i>
                                </span>
                                <div class="ms-75">
                                    <h4 class="mb-0">568</h4>
                                    <small>Projects Done</small>
                                </div>
                            </div>
                        </div> --}}
                        <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Username:</span>
                                    <span>{{ @$users->username }}</span>
                                </li>
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Email:</span>
                                    <span>{{ $users->email }}</span>
                                </li>
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Status:</span>
                                    @if (@$users->status == 1)
                                        <span class="badge bg-light-success">Active</span>
                                    @else
                                        <span class="badge bg-light-danger">Banned</span>
                                    @endif
                                </li>
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Role:</span>
                                    <span>{{ auth()->user()->roles[0]->name }}</span>
                                </li>
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Address:</span>
                                    <span>{{ @$users->address }}</span>
                                </li>
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Contact:</span>
                                    <span>{{ @$users->phone_number }}</span>
                                </li>
                                {{-- <li class="mb-75">
                                    <span class="fw-bolder me-25">Language:</span>
                                    <span>English</span>
                                </li>
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Country:</span>
                                    <span>Wake Island</span>
                                </li> --}}
                            </ul>
                            <div class="d-flex justify-content-center pt-2">
                                <a href="#" class="btn btn-success me-1" onclick="edit_profile()">
                                    Edit
                                </a>
                                <a href="#" class="btn btn-success me-1" onclick="edit_password()">
                                    Change Password
                                </a>
                                <a href="javascript:;" class="btn btn-outline-danger suspend-user">Suspended</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /User Card -->
                <!-- Plan Card -->
                {{-- <div class="card">
                    <div class="card-body">
                        <div class="card-datatable">
                            <table id="referral-table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Country</th>
                                        <th class="text-truncate">State</th>
                                        <th class="cell-fit">City</th>
                                    </tr>
                                </thead>
                            </table>

                        </div>
                    </div>
                </div> --}}

                <!-- /Plan Card -->
            </div>
            <!--/ User Sidebar -->

            <!-- User Content -->
            <!-- User Content -->
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                <div class="card scroll" style="height: 557px;">
                    <h4 class="card-header">User Activity Timeline</h4>
                    <div class="card-body pt-1">
                        <ul class="timeline ms-50">
                            @foreach ($activities as $value)
                                <li class="timeline-item">
                                    <span class="timeline-point timeline-point-indicator"></span>
                                    <div class="timeline-event">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>{{ $value->event_name }}</h6>
                                            @php
                                                $tiem = $value->created_at->diffForHumans();
                                            @endphp
                                            <span class="timeline-event-time me-1">{{ $tiem }}</span>
                                        </div>
                                        <p>{{ $value->name }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="card-datatable">
                            <table id="invoice_table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>@lang('Invoice')</th>
                                        <th>@lang('customer')</th>
                                        <th>@lang('Issue Date')</th>
                                        <th>@lang('Due Date')</th>
                                        <th>@lang('Total')</th>
                                        <th>@lang('Due')</th>
                                        <th>@lang('Balance')</th>
                                        <th>@lang('Status')</th>

                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-datatable">
                            <table id="referral-table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Country</th>
                                        <th class="text-truncate">State</th>
                                        <th class="cell-fit">City</th>
                                    </tr>
                                </thead>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('account-setting/edit-profile')
    @include('account-setting/edit-password')
    @include('content/_partials/_modals/modal-upgrade-plan')
@endsection

@section('vendor-script')
    {{-- Vendor js files --}}
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    {{-- data table --}}
    <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection

@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/pages/modal-edit-user.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/app-user-view-account.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/app-user-view.js')) }}"></script>

    <script>
        function edit_profile() {
            var id = $("#user_id").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('edit.user.profile') }}",
                type: "POST",
                data: {
                    id: id
                },
                success: function(response) {
                    var html = `<div class="text-start">
                    <img id="favicon" alt="your image"
                                            src="` + response.avatar + `" class="rounded-circle z-depth-2" height="120"
                                            width="120"  data-holder-rendered="true">
                        <div>`;
                    $("#u_id").val(response.data.id);
                    $("#img_div").html(html);
                    $("#first_name").val(response.data.first_name);
                    $("#last_name").val(response.data.last_name);
                    $("#user_name").val(response.data.username);
                    $("#email").val(response.data.email);
                    $("#phone_number").val(response.data.phone_number);
                    $("#address").val(response.data.address);
                    $("#dob").val(response.data.dob);
                    $("#editUser").modal("show");
                },
                error: function(response) {
                    alert("Failed")
                }
            });
        }

        function edit_password() {
            var id = $("#user_id").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('edit.user.profile') }}",
                type: "POST",
                data: {
                    id: id
                },
                success: function(response) {
                    $("#editPass").modal("show");
                },
                error: function(response) {
                    alert("Failed")
                }
            });
        }

        load_data();

        function load_data() {
            var role_id = $("#user_role").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#referral-table').DataTable({
                responsive: false,
                processing: true,
                serverSide: true,
                searching: true,
                ordering: true,
                ajax: {
                    url: "{{ url('panel/referral/ajax') }}",
                    type: "POST",
                    data: {
                        role_id: role_id
                    }

                },
                columns: [{
                        data: 'user.first_name'
                    },
                    {
                        data: 'user.email'
                    },
                    {
                        data: 'user.phone_number'
                    },

                    {
                        data: 'country'
                    },

                    {
                        data: 'state'
                    },
                    {
                        data: 'city'
                    },


                ]
            });
        }

        load_invoice();

        function load_invoice() {
            var id = @json($id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#invoice_table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                ordering: true,
                ajax: {
                    url: "{{ url('panel/detail/invoice/ajax') }}",
                    type: "POST",
                    data: {
                        id: id
                    },

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
        }
    </script>
@endsection
