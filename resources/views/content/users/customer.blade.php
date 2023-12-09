@extends('layouts/contentLayoutMaster')
@section('title', $page)
@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
    <style>
        #user_table {
            overflow-y: auto !important;
            overflow-x: auto !important;
            display: block !important;
            white-space: nowrap !important;
        }

        textarea.notes {
            min-height: 6.714rem;
        }
    </style>
@endsection

@section('content')
    <!-- Complex Headers -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- @php(dd($role != 'customer')) --}}
                    <div class="card-header border-bottom">
                        <button type="button" class="btn btn-success" onclick="show_modal()">Add Customer</button>
                    </div>
                    <div class="card-datatable">
                        <table id="user_table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Subs. NMI</th>
                                    <th>Trainer</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Duration Of Time</th>
                                    <th>Payment</th>
                                    <th>Billing Status</th>
                                    <th>Services</th>
                                    <th>Status</th>
                                    <th>Agreement</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="modal fade text-start" id="delete_form" tabindex="-1" aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel160">Delete {{ ucfirst($role) }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you shure you want to delete this {{ $role }}.
                    <input type="hidden" id="del_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="delete_form()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade text-start" id="send_message" tabindex="-1" aria-labelledby="myModalLabel160"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-model">Send Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="send_form">
                    <div class="modal-body">
                        <input type="hidden" name="recever_id" id="recever_id">
                        <input type="hidden" name="type" id="type">
                        <div class="row">
                            <div class="col-12">
                                <label for="admin" class="form-label">Reciver Information</label>
                                <input type="text" id="reciver_info" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="admin" class="form-label">Description</label>
                                <textarea class="form-control notes" id="notes" name="description" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submite" class="btn btn-success" data-bs-dismiss="modal">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('content.users.user-modal')
    @include('content.users.edit-admin')
    </div>

    <div class="modal fade text-start" id="lead_converted_form" tabindex="-1" aria-labelledby="myModalLabel160"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel160">Convert Customer To Lead</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you shure you want to change this customer into lead.
                    <input type="hidden" id="customer_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="convert_to_lead_form()">Save Change</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-start" id="change_subscription" tabindex="-1" aria-labelledby="myModalLabel160"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel160">Change Payment Subscription</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="invoic_submit_forma" class="form_field" method="post">
                    <div class="modal-body">
                        <input type="hidden" id="user_id_cs" name="user_id_cs">
                        <div class="row">
                            <div class="col-12">
                                <label for="recipient-name" class="col-form-label">@lang('Customer')</label>
                                <input type="text" class="form-control" name="" id="du_user_id_cs" placeholder="" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="cv-id" class="col-form-label">@lang('Customer Vault ID')</label>
                                <input type="text" class="form-control" name="" id="cv_id" placeholder="" disabled>
                            </div>
                            <div class="col-6">
                                <label for="subs-id" class="col-form-label">@lang('Subscription ID')</label>
                                <input type="text" class="form-control" name="" id="subs_id" placeholder="" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="recipient-name-vault" class="col-form-label">@lang('Customer Vault')</label>
                                <input type="text" class="form-control" name="" id="cv_name" placeholder="" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="pay-date" class="col-form-label">@lang('Next Payment Date')</label>
                                <input type="date" class="form-control" name="pay_date" id="pay_date" placeholder="Issue Date" required>
                            </div>
                            <div class="col-6">
                                <label for="recipient-name" class="col-form-label">@lang('Amount')</label>
                                <input type="number" class="form-control" name="price_cs" id="du_price_cs" placeholder="Amount"
                                    required>
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

    @include('content.users.increase-duration-model')
    <!--/ Complex Headers -->
@endsection
@section('vendor-script')
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>


@endsection

@section('page-script')
    <script src="{{ asset(mix('js/scripts/components/components-tooltips.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/extensions/ext-component-toastr.js')) }}"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        function delete_data(id) {
            $("#del_id").val(id);
            $("#delete_form").modal('show');
        }

        function delete_form() {
            var id = $("#del_id").val();
            $.ajax({
                url: "{{ route('user.delete') }}",
                method: "POST",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';

                    if (response.status == "success") {
                        $("#delete_form").modal('hide');
                        $('#user_table').DataTable().ajax.reload();
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
                    $("#sahir_exampleModal").modal('hide');

                }
            })
        }

        function show_modal(id) {
            $("#user_id").val(0);
            $("#first_name").val(null);
            $("#last_name").val(null);
            $("#email").val(null);
            $("#address").val(null);
            $("#dob").val(null);
            $("#salary").val(null);
            $("#salarytype").val(null);
            $("#phone_number").val(null);
            $("#password").val(null);
            $("#password_confirmation").val(null);
            $("#logo").val(null);
            var html = `<div class="text-start">
                    <img id="favicon" alt="your image"
                    src="{{ asset('images/avatars/male.png') }}" class="rounded-circle z-depth-2" height="120"
                    width="120" data-holder-rendered="true">
                    <div>`;
            $("#img_div").html(html);
            $("#addUser").modal("show")
        }

        load_data();

        function load_data() {
            var role_id = $("#user_role").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#user_table').DataTable({
                responsive: false,
                processing: true,
                serverSide: true,
                searching: true,
                ordering: true,
                ajax: {
                    url: "{{ url('panel/admin/ajax') }}",
                    type: "POST",
                    data: {
                        role_id: role_id
                    }

                },
                columns: [{
                        data: 'first_name'
                    },
                    {
                        data: 'last_name'
                    },
                    {
                        data: 'customer.subscription_id'
                    },
                    {
                        data: 'trainer'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'phone_number'
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
                    {
                        data: 'traning_length'
                    },
                    {
                        data: 'time_duration'
                    },
                    {
                        data: 'billing_status'
                    },
                    {
                        data: 'services'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'agreement'
                    },
                    {
                        data: 'action'
                    },
                ]
            });
        }

        $("#submit_form").submit(function(event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('add.user') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        $("#addUser").modal('hide');
                        $('#user_table').DataTable().ajax.reload();
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
                    alert("Failed")
                }
            });
        });

        function edit_data(id) {
            $.ajax({
                url: "{{ route('user.edit.data') }}",
                method: "POST",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {

                    var html = `<div class="text-start">
                    <img id="favicon" alt="your image"
                                            src="` + response.data.avatar + `" class="rounded-circle z-depth-2" height="120"
                                            width="120"  data-holder-rendered="true">
                        <div>`;
                    $("#img_div").html(html);
                    $("#first_name").val(response.data.first_name);
                    $("#last_name").val(response.data.last_name);
                    $("#email").val(response.data.email);
                    $("#phone_number").val(response.data.phone_number);
                    $("#address").val(response.data.address);
                    $("#user_id").val(response.data.id);
                    $("#dob").val(response.data.dob);
                    $("#service").val(response.data.customer.service);
                    $("#notes").val(response.data.customer.notes);
                    if (response.data.country != null) {
                        $("input[name=status][value=" + response.data.status + "]").prop('checked', true);
                        $("#country option:eq(" + response.data.country.id + ")").prop(
                            'selected',
                            true);
                        $('#state').append('<option value="' + response.data.state.id +
                            '" selected="selected">' + response.data.state.name + '</option>');
                    }


                    if (typeof(response.data.customer.employee) != "undefined" && response.data.customer
                        .employee !== null) {
                            console.log(response.data.customer.employee.id);

                            // $('#user_trainer').add('<option value="' + response.data.customer.employee.id +
                            // '" selected>' + response.data.customer.employee.id + '</option>');
                            $('#user_trainer option[value="'+response.data.customer.employee.id+'"]').attr("selected", "selected");
                        // $("#user_trainer option:eq(" + response.data.customer.employee.id + ")").prop(
                        //     'selected',
                        //     true);
                    }
                    if (typeof(response.data.customer.referral) != "undefined" && response.data.customer
                        .referral !== null) {
                        $("#user_referral option:eq(" + response.data.customer.referral.id + ")").prop(
                            'selected',
                            true);
                    }

                    $("#addUser").modal('show');

                },
                error: function(response) {
                    $("#sahir_exampleModal").modal('hide');

                }
            })
        }

        function delete_data(id) {
            $("#del_id").val(id);
            $("#delete_form").modal('show');
        }

        function delete_form() {
            var id = $("#del_id").val();
            $.ajax({
                url: "{{ route('user.delete') }}",
                method: "POST",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';

                    if (response.status == "success") {
                        $("#delete_form").modal('hide');
                        $('#user_table').DataTable().ajax.reload();
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
                    $("#sahir_exampleModal").modal('hide');

                }
            })
        }

        $("#country").change(function() {
            var id = $("#country").val();

            $.ajax({
                url: "{{ route('user.state') }}",
                type: "POST",
                data: {
                    id: id,
                },
                dataType: "json",
                success: function(response) {
                    var $select = $('#state');
                    $select.find('option').remove();
                    $.each(response, function(key, value) {
                        $select.append('<option value=' + value.id + '>' + value.name +
                            '</option>');
                    });
                },
                error: function(response) {
                    alert("Failed")
                }
            });
        });

        $("#state").change(function() {
            var id = $("#state").val();
            $.ajax({
                url: "{{ route('user.city') }}",
                type: "POST",
                data: {
                    id: id,
                },
                dataType: "json",
                success: function(response) {
                    var $select = $('#city');
                    $select.find('option').remove();
                    $.each(response, function(key, value) {
                        $select.append('<option value=' + value.id + '>' + value.name +
                            '</option>');
                    });
                },
                error: function(response) {
                    alert("Failed")
                }
            });
        });

        function send_message(id, type) {
            $("#recever_id").val(id);
            $("#type").val(type);

            $.ajax({
                url: "{{ route('user.reciver') }}",
                type: "POST",
                data: {
                    id: id,
                    type: type
                },
                dataType: "json",
                success: function(response) {
                    var type = $("#type").val();

                    if (type == 1) {

                        $("#reciver_info").val(response.data.email);
                    } else {

                        $("#reciver_info").val(response.data.phone_number);

                    }
                    $("#send_message").modal('show');

                },
                error: function(response) {
                    alert("Failed")
                }
            });

        }

        $("#send_form").submit(function(event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('send.single.user') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        $("#addUser").modal('hide');
                        $('#user_table').DataTable().ajax.reload();
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
                    alert("Failed")
                }
            });
        });

        function lead_converted(id) {
            $("#customer_id").val(id);
            $("#lead_converted_form").modal('show');
        }

        function convert_to_lead_form() {
            var id = $("#customer_id").val();
            $.ajax({
                url: "{{ route('customer.to.lead') }}",
                type: "POST",
                data: {
                    id: id,
                },
                dataType: "json",
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        $("#lead_converted_form").modal('hide');
                        $('#user_table').DataTable().ajax.reload();
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
                    $("#lead_converted_form").modal('hide');

                    alert("Failed")
                }
            });
        }

        function increase_duration(id) {
            var id = id;
            $.ajax({
                url: "{{ route('customer.increase.duration') }}",
                type: "GET",
                data: {
                    id: id,
                },
                dataType: "json",
                success: function(response) {
                    if(response.new==true){
                        $("#issue_date").prop('disabled', false);
                    }
                    $("#issue_date").val(response.issue_date);
                    $("#issue_dates").val(response.issue_date);
                    $("#due_date").val(response.due_date);
                    $("#dus_user_id").val(response.user_id);
                    $("#du_user_id").val(response.user_name);
                    $("#du_price").val(response.amount);
                    $("#exampleModal").modal('show');
                },
                error: function(response) {
                    $("#exampleModal").modal('hide');
                }
            });
        }

        $('#invoic_submit_form').on('submit', function(event) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "{{ route('customer.increase.duration.save') }}",
                method: "POST",
                data: form_data,
                dataType: "json",
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        $("#exampleModal").modal('hide');
                        $('#user_table').DataTable().ajax.reload();
                        toastr[response.status](
                            response.message, 'Success', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            });
                        $(".element-blur").addClass("blur-body");
                        $(".menu-fixed menu-light").addClass("blur-body");
                        $(".main-menu").addClass("blur-body");
                        $("footer").addClass("blur-body");
                        $("nav").addClass("blur-body");
                        $(".breadcrumbs-top").addClass("blur-body");
                        $(".main-menu").addClass("blur-body");
                        $("#preloader-img").removeClass("d-none");
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
                            $('#invoice_table').DataTable().ajax.reload();
                        }, 5000)
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

        function change_subscription(id) {
            $("#user_id_cs").val(id);
            var id = id;
            $.ajax({
                url: "{{ route('customer.change.subscription') }}",
                type: "GET",
                data: {
                    id: id,
                },
                dataType: "json",
                success: function(response) {
                    $("#du_user_id_cs").val(response.user_name);
                    $("#cv_id").val(response.vault_id);
                    $("#subs_id").val(response.subs_id);
                    $("#cv_name").val(response.vault_name);
                    $("#du_price_cs").val(response.amount);
                    $("#change_subscription").modal('show');
                },
                error: function(response) {
                    $("#change_subscription").modal('hide');
                }
            });
        }

        $('#invoic_submit_forma').on('submit', function(event) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "{{ route('customer.change.subscription.save') }}",
                method: "POST",
                data: form_data,
                dataType: "json",
                success: function(response) {
                    if (response.status == "success") {
                        var isRtl = $('html').attr('data-textdirection') === 'rtl';
                        $("#change_subscription").modal('hide');
                        $('#user_table').DataTable().ajax.reload();
                        toastr[response.status](
                            response.message, 'Success', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            });
                        $(".element-blur").addClass("blur-body");
                        $(".menu-fixed menu-light").addClass("blur-body");
                        $(".main-menu").addClass("blur-body");
                        $("footer").addClass("blur-body");
                        $("nav").addClass("blur-body");
                        $(".breadcrumbs-top").addClass("blur-body");
                        $(".main-menu").addClass("blur-body");
                        $("#preloader-img").removeClass("d-none");
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
                            $('#invoice_table').DataTable().ajax.reload();
                        }, 5000)
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
    </script>


@endsection
