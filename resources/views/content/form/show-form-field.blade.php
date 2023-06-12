@extends('layouts/contentLayoutMaster')

@section('title', 'Form Builder')

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
@endsection

@section('content')

    <!-- Complex Headers -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header border-bottom">
                        <button type="button" class="btn btn-success" onclick="modal_show()">Add</button>
                    </div>
                    <div class="card-datatable" class="table table-bordered table-responsive">
                        <table id="form_table">
                            <thead>
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Response')</th>
                                    <th class="col-1">@lang('Action')</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-start" id="delete_field" tabindex="-1" aria-labelledby="myModalLabel160"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel160">Delete Form Field</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you shure you want to delete this form field.
                    <input type="hidden" id="del_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="delete_field()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <input type="hidden" value="{{ $id }}" id="form_id">
    @include('content/form/form-field-model')
    @include('content/form/edit-form-field')
    </div>
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
    </script>
    <script>
        load_data();
        var i = 0;

        function load_data() {
            var id = $("#form_id").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#form_table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                ordering: true,
                ajax: {
                    url: "{{ route('form.fields.ajax') }}",
                    type: "POST",
                    data: {
                        form_id: id
                    }

                },
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'type'
                    },
                    {
                        data: 'action'
                    },
                ]
            });
        }

        function modal_show() {
            i = 0;
            $("#f_id").val(null);
            $("#field_name").val(null);
            $('#newRow').html('');
            $("#add_fields_placeholderValue").hide();

            $("#exampleModal").modal('show');
        }

        $('.form_field').on('submit', function(event) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "{{ route('form.field.save') }}",
                method: "POST",
                data: form_data,
                dataType: "json",
                success: function(response) {
                    $('#form_table').DataTable().ajax.reload();
                    if (response.status == "success") {
                        $("#exampleModal").modal('hide');
                        $("#edit_exampleModal").modal('hide');

                    }
                    toastr[response.status](
                        response.message, {
                            closeButton: true,
                            tapToDismiss: false,
                            progressBar: true,
                        });
                },
                error: function(response) {
                    $("#exampleModal").modal('hide');
                    swal("Not Saved", "Status SuccessFully Change", "error");
                }
            })
        });

        function edit_model(id) {
            $.ajax({
                url: "{{ route('form.field.edit') }}",
                method: "POST",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    $("#f_id").val(response.data.id);
                    $("#field_name").val(response.data.name);

                    $('#type option[value=' + response.data.type + ']').attr('selected', 'selected');
                    $("#exampleModal").modal('show');
                },
                error: function(response) {
                    $("#exampleModal").modal('hide');
                    swal("Not Saved", "Status SuccessFully Change", "error");
                }
            })
        }

        function delete_data(id) {
            $("#delete_field").modal('show');
            $("#del_id").val(id);
        }

        function delete_field() {
            var id = $("#del_id").val()
            $.ajax({
                url: "{{ route('form.field.delete') }}",
                method: "POST",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    $('#form_table').DataTable().ajax.reload();

                    $("#delete_field").modal('hide');
                    toastr[response.status](
                        response.message, {
                            closeButton: true,
                            tapToDismiss: false,
                            progressBar: true,
                        });
                },
                error: function(response) {
                    $("#delete_field").modal('hide');
                    swal("Not Saved", "Status SuccessFully Change", "error");
                }
            })
        }
        $(document).ready(function() {
            $(".type").change(function() {
                if ($(this).val() == "drop_down") {
                    $("#add_fields_placeholderValue").show();
                } else {
                    $("#add_fields_placeholderValue").hide();
                }
            });
            $("#add_fields_placeholderValue").hide();
        });
        $("#add_fields_placeholderValue").hide();

        $("#addRow").click(function() {
            i++;
            var html = '';
            html += `<div id="inputFormRow">
              <div id="add_fields_placeholderValue">
                        <div class="row">
                            <div class="col-8">
                                <label for="recipient-name" class="col-form-label">@lang('Option Name')</label>
                                <input class="form-control" type="text" name="dropdonwn[]"
                                    id="add_fields_placeholderValue" placeholder="Option Name">
                            </div>
                            <div class="col-3">
                                <button id="removeRow" type="button"
                                    class="btn btn-danger"style="margin-top: 35px;">-</button>
                            </div>
                        </div>
                    </div>
                    </div>`;
            if (i <= 3) {
                $('#newRow').append(html);
            } else {
                i = 3;
                toastr["error"](
                    "Sorry You Cannot Add More Options", {
                        closeButton: true,
                        tapToDismiss: false,
                        progressBar: true,
                    });
            }
        });
        $(document).on('click', '#removeRow', function() {
            i--;
            $(this).closest('#inputFormRow').remove();
        });
    </script>
@endsection
