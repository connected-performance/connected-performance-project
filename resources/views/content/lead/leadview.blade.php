@extends('layouts/contentLayoutMaster')

@section('title', 'Lead')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">

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
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
@endsection


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (auth()->user()->is_admin == true)
                        <div class="card-header border-bottom">
                            <button type="button" class="btn btn-success" onclick="show_lead_modal()">Create Lead</button>
                        </div>
                    @endif
                    <div class="card-datatable">
                        <table id="lead_table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Resource</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Services</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Closed Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade text-start" id="delete_form" tabindex="-1" aria-labelledby="myModalLabel160"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel160">Delete Lead</h5><button type="button"
                            class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Are you shure you want to delete this lead. <input type="hidden"
                            id="del_id"></div>
                    <div class="modal-footer"><button type="button" class="btn btn-light"
                            data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info" onclick="change_status()">Loss</button>
                        <button type="button" class="btn btn-danger" onclick="delete_form()">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('content.lead.create-lead-model')
    @include('content.lead.schedule-modal')
    @include('content.lead.lead-status-model')

@endsection
@section('vendor-script') {{-- vendor files --}}
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
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>{{-- <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script> --}}
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@section('page-script')
    <script src="{{ asset(mix('js/scripts/components/components-tooltips.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/extensions/ext-component-toastr.js')) }}"></script>
    {{-- <script src="{{ asset(mix('js/scripts/forms/form-wizard.js')) }}"></script> --}}
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        function delete_data(id) {
            $("#del_id").val(id);
            $("#delete_form").modal('show');
        }

        function show_lead_modal() {
            $("#lead_id").val(0);
            $("#name").val(null);
            $("#email").val(null);
            $("#phone_number").val(null);
            $("#drop_down").val(null);
            $("#description").val(null);
            $("#create_lead").modal("show")
        }

        function delete_form() {
            var id = $("#del_id").val();
            $.ajax({
                url: "{{ route('lead.delete') }}",
                method: "POST",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        $("#delete_form").modal('hide');
                        $('#lead_table').DataTable().ajax.reload();
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
            var id = id;
            $.ajax({
                url: "{{ route('lead.data') }}",
                method: "POST",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    $("#lead_id").val(response.data.id);
                    $("#customer-name").val(response.data.name);
                    $("#email").val(response.data.email);

                    $("#inlineForm").modal("show");

                },
                error: function(response) {
                    $("#inlineForm").modal('hide');

                }
            })
        }


        load_data();

        function load_data() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#lead_table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                ordering: true,
                ajax: {
                    url: "{{ url('panel/lead/ajax') }}",
                    type: "POST",

                },
                columns: [{
                        data: 'form_name'
                    },
                    {
                        data: 'name'
                    },

                    {
                        data: 'email'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'services'
                    },
                    {
                        data: 'lead_status'
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'closed_date'
                    },
                    {
                        data: 'action'
                    },
                ]
            });
        }

        function leadt_status(id) {

            var id = id;
            $.ajax({
                url: "{{ route('lead.data') }}",
                method: "POST",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {

                    $("input[name=status][value=" + response.data.status + "]").prop('checked', true);
                    $("#note_lead_id").val(response.data.id);
                    $("#mech_name").text(response.data.name);
                    $("#top-mail").text(response.data.email);
                    $("#lower-mail").text(response.data.email);
                    $("#lower-name").text(response.data.name);
                    $("#lower-phone").text(response.data.phone);
                    $("#lower-service").text(response.data.services);
                    $(".show_description").text(response.data.description);
                    $("#mail").html(response.data.email);
                    $("#name").html(response.data.name);
                    $(".phone").html(response.data.phone);
                    $(".service").html(response.data.services);
                    $(".notes").val(response.data.note);
                    $(".email-for-table").text(response.data.email);
                    $(".name-for-table").text(response.data.name);

                    var modernWizard = document.querySelector('.modern-wizard-example');
                    if (typeof modernWizard !== undefined && modernWizard !== null) {
                        var modernStepper = new Stepper(modernWizard, {
                            linear: false

                        });
                        if (response.data.working_status == 1) {
                            modernStepper.next();
                        }
                        if (response.data.working_status == 2) {
                            modernStepper.next();
                            modernStepper.next();
                        }


                    }

                    $("#pricingModal").modal('show');
                },
                error: function(response) {
                    $("#inlineForm").modal('hide');

                }
            })
        }

        function change_status() {

            var id = $("#del_id").val();
            $.ajax({
                url: "{{ route('lead.loss') }}",
                method: "POST",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        $("#delete_form").modal('hide');
                        toastr[response.status](
                            response.message, 'Success', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            });
                        window.location.reload();
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
                    $("#inlineForm").modal('hide');

                }
            })
        }

        function save_note() {
            var note = $(".notes1").val();
            $(".notes2").val(note);
            $(".notes3").val(note);
            var id = $("#note_lead_id").val();
            $.ajax({
                url: "{{ route('lead.notes') }}",
                method: "POST",
                data: {
                    id: id,
                    note: note
                },
                dataType: "json",
                success: function(response) {
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
                    $("#inlineForm").modal('hide');

                }
            })
        }

        var modernWizard = document.querySelector('.modern-wizard-example');
        if (typeof modernWizard !== undefined && modernWizard !== null) {
            var modernStepper = new Stepper(modernWizard, {
                linear: false

            });
            modernStepper.next();
            modernStepper.next();
            {{-- $(modernWizard)
                .find('.btn-next')
                .on('click', function() {
                    modernStepper.next();
                });
            $(modernWizard)
                .find('.btn-prev')
                .on('click', function() {
                    modernStepper.previous();
                });

            $(modernWizard)
                .find('.btn-submit')
                .on('click', function() {
                    alert('Submitted..!!');
                }); --}}
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
                url: "{{ route('lead.create') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        $("#create_lead").modal('hide');
                        $('#lead_table').DataTable().ajax.reload();
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

        function working_step(step) {

            var note = $(".notes").val();
            var id = $("#note_lead_id").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('lead.step') }}",
                type: "POST",
                data: {
                    step: step,
                    id: id
                },
                dataType: "json",
                success: function(response) {
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
                    alert("Failed")
                }
            });
        }
    </script>
@endsection
@endsection
