@extends('layouts/contentLayoutMaster')
@section('title', 'Customer')
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
    </style>
@endsection

@section('content')

    <!-- Complex Headers -->
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
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>Profile</th>
                                    <th>Referrals</th>
                                    <th>Duration Of Time</th>
                                    <th>Payment Made</th>
                                    <th>Billing Status</th>
                                    {{-- <th>Services</th> --}}
                                    <th>Status</th>
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
                    <h5 class="modal-title" id="myModalLabel160">Delete Form Field</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you shure you want to delete this form.
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


    </div>
    <!--/ Complex Headers -->

    <div class="modal fade text-start" id="delete_form" tabindex="-1" aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel160">Delete Form Field</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you shure you want to delete this form.
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
    @include('content.users.user-modal')
    @include('content.users.edit-admin')
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
                    url: "{{ url('panel/my/customer/ajax') }}",
                    type: "POST",
                    data: {
                        role_id: role_id
                    }

                },
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'user.email'
                    },

                    {
                        data: 'user.country.name'
                    },
                    {
                        data: 'user.state.name'
                    },
                    {
                        data: 'profile'
                    }, {

                        data: 'referral'
                    },
                    {

                        data: 'time_duration'
                    },
                    {

                        data: 'traning_length'
                    },
                    {

                        data: 'billing_status'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action'
                    },


                ]
            });
        }


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

                        $("#user_trainer option:eq(" + response.data.customer.employee.id + ")").prop(
                            'selected',
                            true);
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
    </script>


@endsection
