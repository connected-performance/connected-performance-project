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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        .scroll {
            max-height: 516px;
            overflow-y: auto;
        }

        .card {
            margin-bottom: 6rem;
            box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%);
            transition: all 0.3s ease-in-out, background 0s, color 0s, border-color 0s;
        }
    </style>
    @if(count($notes) > 0)
        <div class="alert alert-warning alert-note" role="alert" style="padding:20px">
            This user has a series of notifications or reminders that you would like to see. <a href="#un-anclaje">Watch Now</a>
        </div>
    @endif
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
                                <img class="img-fluid rounded mt-3 mb-2" src="{{ @$users->avatar }}" height="110"
                                    width="110" alt="User avatar" />
                                <div class="user-info text-center">
                                    <h4>{{ @$users->username }}</h4>
                                    <span class="badge bg-light-secondary">Author</span>
                                </div>
                            </div>
                        </div>

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
                                {{-- <li class="mb-75">
                                    <span class="fw-bolder me-25">Role:</span>
                                    <span>{{ auth()->user()->roles[0]->name }}</span>
                                </li> --}}
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Address:</span>
                                    <span>{{ @$users->address }}</span>
                                </li>
                                <li class="mb-75">
                                    <span class="fw-bolder me-25">Contact:</span>
                                    <span>{{ @$users->phone_number }}</span>
                                </li>
                                <li class="mb-75">
                                    <a href="{{ route('user.token.request', @$users->id) }}" class="btn btn-success">Token Request</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ User Sidebar -->

            <!-- User Content -->
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1 ">
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert" style="padding: 10px;">
                        <div class="alert-text">{{ Session::get('success') }}</div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12" style="margin-bottom: -60px;">
                        <div class="card scroll">
                            <h4 class="card-header">Manage Tokens</h4>
                            <div class="card-body pt-1">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Credicard</th>
                                            <th scope="col">Exp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($tdc) > 0)
                                            @foreach($tdc as $key => $value)
                                                <tr>
                                                    <td>
                                                        {{ substr($value->ccnumber, 0, 2) }}** **** **** **{{ substr($value->ccnumber, -2) }}
                                                    </td>
                                                    <td>
                                                        {{ substr($value->ccexp, 0, 1) }}**{{ substr($value->ccexp, -1) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3" class="text-center">It has no associated tokens</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" style="margin-bottom: -60px;">
                        <div class="card scroll">
                            <h4 class="card-header">Last Recurring Payment</h4>
                            <div class="card-body pt-1 text-center">
                                @if($last_invoice)
                                    <span style="font-size: 24px;"><b>{{ number_format($last_invoice->balance, 2) }} USD</b></span>
                                @else
                                    Has no transactions
                                @endif
                                <br>
                                {{-- <span class="badge bg-light-success">Detail</span> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="margin-bottom: -60px;">
                        <div class="card scroll">
                            <h4 class="card-header">Contract Link</h4>
                            <div class="card-body pt-1 text-center">
                                @if($url_contract != null) 
                                    See signed <a target="_blank" href="{{ $url_contract }}">contract</a>
                                @else
                                    This user does not have a signed contract, <a href="javascript:void(0);" onclick="show_modal_contract()">load now</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card scroll">
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
                <!-- /Activity Timeline -->

                <!-- Invoice table -->

                <!-- /Invoice table -->
            </div>
            <!--/ User Content -->
        </div>

        <div class="row element-blur">

            <div class="card">
                <div class="card-header border-bottom">
                    <button type="button" class="btn btn-success" onclick="modal_show_invoice()">Create</button>
                </div>
                <div class="card-body">
                    <div class="card-datatable">
                        <table id="invoice_table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>@lang('Invoice')</th>
                                    <th>@lang('Issue Date')</th>
                                    <th>@lang('Due Date')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Balance')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row element-blur">

            <div class="card">
                @if (auth()->user()->is_admin == true)
                    <div class="card-header border-bottom">
                        <button type="button" class="btn btn-success" onclick="show_note_modal()">Create Note</button>
                    </div>
                @endif
                <div class="card-body" id="un-anclaje">
                    <div class="card-datatable">
                        <table id="note_table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>@lang('Content')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade text-start" id="delete_form" tabindex="-1" aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel160">Refund Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to make a refund?.
                    <input type="hidden" id="del_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="delete_form()">Refund</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-start" id="cancel_form" tabindex="-1" aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel160">Cancel Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to cancel this transaction?.
                    <input type="hidden" id="cancel_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="cancel_form()">Cancel transaction</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-start" id="note_form" tabindex="-1" aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel160">Delete Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this record?.
                    <input type="hidden" id="note_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="note_delete()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-start" id="note_detail" tabindex="-1" aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel160">Note Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="text-note"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('Create Invoice')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="submit_form_invoice" class="form_field" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="user_id" value="{{ $users->id }}">
                        <div class="row">
                            <div class="col-12">
                                <label for="recipient-name" class="col-form-label">@lang('Cost')</label>
                                <input type="number" class="form-control" name="price" id="price" placeholder="Cost" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="recipient-name" class="col-form-label">@lang('Description')</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Description" required></textarea>
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
    <div class="modal fade" id="modal_contract" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('Add Contract ID')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="submit_form_invoice" action="{{ route('user.waiver') }}" class="form_field" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" name="user_waiver" id="user_waiver" value="{{ $users->id }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label for="recipient-name" class="col-form-label">@lang('Contract')</label>
                                <input type="text" class="form-control" name="waiver" id="waiver" placeholder="Contract ID" autocomplete="off" required>
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
    @include('account-setting/edit-profile')
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
                                            src="` + response.data.avatar + `" class="rounded-circle z-depth-2" height="120"
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

        load_data();

        function load_data() {
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
                columns: [
                    {
                        data: 'invoice_number'
                    },
                    {
                        data: 'issue_date'
                    }, 
                    {
                        data: 'due_date'
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
                    {
                        data: 'action'
                    }
                ]
            });
        }

        load_notes();

        function load_notes() {
            var id = @json($id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#note_table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                ordering: true,
                ajax: {
                    url: "{{ url('panel/notes/ajax') }}",
                    type: "POST",
                    data: {
                        id: id
                    },

                },
                columns: [
                    {
                        data: 'content'
                    },
                    {
                        data: 'action'
                    }
                ]
            });
        }

        function delete_note(id) {
            $("#note_id").val(id);
            $("#note_form").modal('show');
        }

        function note_delete() {
            var id = $("#note_id").val();
            $.ajax({
                url: "{{ route('panel.user.note.delete') }}",
                method: "POST",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        $("#note_form").modal('hide');
                        $('#note_table').DataTable().ajax.reload();
                        toastr[response.status](
                            response.message, 'Success', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            });


                    } else {
                        $("#note_form").modal('hide');
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
                    $("#sahir_exampleModal").modal('hide');

                }
            })
        }

        function show_note(id) {
            $.ajax({
                url: "{{ route('panel.user.notes.detail') }}",
                method: "POST",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    $('.text-note').html(response.note);
                    $("#note_detail").modal('show');
                }
            })
        }

        function show_note_modal() {
            $("#create_note_customer").modal("show")
        }

        $("#submit_note").submit(function(event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('panel.user.note.save') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        $('#customer').val('');
                        $('#content').val('');
                        $("#create_note_customer").modal('hide');
                        $('#note_table').DataTable().ajax.reload();
                        toastr[response.status](
                            response.message, 'Success', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            });
                    } else {
                        $('#customer').val('');
                        $('#content').val('');
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
                    alert("Failed")
                }
            });
        });

        function delete_data(id) {
            $("#del_id").val(id);
            $("#delete_form").modal('show');
        }

        function delete_form() {
            var id = $("#del_id").val();
            $.ajax({
                url: "{{ route('customer.invoice.refund') }}",
                method: "POST",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        $("#delete_form").modal('hide');
                        $('#invoice_table').DataTable().ajax.reload();
                        toastr[response.status](
                            response.message, 'Success', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            });


                    } else {
                        $("#delete_form").modal('hide');
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
                    $("#sahir_exampleModal").modal('hide');

                }
            })
        }

        function cancel_data(id) {
            $("#cancel_id").val(id);
            $("#cancel_form").modal('show');
        }

        function cancel_form() {
            var id = $("#cancel_id").val();
            $.ajax({
                url: "{{ route('customer.invoice.cancel') }}",
                method: "POST",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        $("#cancel_form").modal('hide');
                        $('#invoice_table').DataTable().ajax.reload();
                        toastr[response.status](
                            response.message, 'Success', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            }
                        );


                    } else {
                        $("#delete_form").modal('hide');
                        toastr[response.status](
                            response.message, '!Oops', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            }
                        );
                    }
                },
                error: function(response) {
                    $("#sahir_exampleModal").modal('hide');

                }
            })
        }

        function modal_show_invoice() {
            $("#price").val(null);
            $("#description").val(null);
            $("#exampleModal").modal('show');
        }

        $('#submit_form_invoice').on('submit', function(event) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "{{ route('invoice.user.create') }}",
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

        function show_modal_contract() {
            $("#modal_contract").modal('show');
        }
    </script>
@endsection
