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
                    <div class="card-datatable" class="dt-complex-header table table-bordered table-responsive">
                        <table id="form_table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th>@lang('status')</th>
                                    <th class="col-2">@lang('Action')</th>
                                </tr>
                            </thead>
                        </table>
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
    @include('content/form/add-form')

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

        function load_data() {
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
                    url: "{{ url('panel/form/builder/ajax') }}",
                    type: "POST",

                },
                columns: [{
                        data: 'name'
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

        function modal_show() {
            $("#form_id").val(null);
            $("#form_name").val(null);
             $("input[name=active][value="+1+"]").prop('checked', true);
            $("#addNewCard").modal('show');
        }

        $('#add-new-form').on('submit', function(event) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "{{ route('form.builder.save') }}",
                method: "POST",
                data: form_data,
                dataType: "json",
                success: function(response) {
                    if (response.status == "success") {
                        $("#addNewCard").modal('hide');
                        $('#form_table').DataTable().ajax.reload();
                    }
                    toastr[response.status](
                        response.message, {
                            closeButton: true,
                            tapToDismiss: false,
                            progressBar: true,
                        });
                },
                error: function(response) {
                    $("#sahir_exampleModal").modal('hide');

                }
            })
        });

        function edit_data(id) {
            $.ajax({
                url: "{{ route('form.builder.edit') }}",
                method: "POST",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    var text = 'Edit Form'
                    $("#addNewCardTitle1").text(text);
                    $("#form_id").val(response.data.id);
                    $("#form_name").val(response.data.name);
                    $("input[name=active][value=" + response.data.is_active + "]").prop('checked', true);
                    $("#addNewCard").modal('show');
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
                url: "{{ route('form.builder.delete') }}",
                method: "POST",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == "success") {
                        $("#delete_form").modal('hide');
                        $('#form_table').DataTable().ajax.reload();
                    }
                    toastr[response.status](
                        response.message, {
                            closeButton: true,
                            tapToDismiss: false,
                            progressBar: true,
                        });
                },
                error: function(response) {
                    $("#sahir_exampleModal").modal('hide');

                }
            })
        }

        function copy_link(code) {
            var data = document.createElement('input');
            var url = "#form" + code;
            document.body.appendChild(data)
            var text = $(url).val();
            data.value = text;

            data.select();
            document.execCommand('copy');
            toastr["success"]("Form URL Successfully Copy", {
                closeButton: true,
                tapToDismiss: false,
                progressBar: true,
            });
        }
        {{-- 'use strict';
        var userText = $('#copy-url');
        var btnCopy = $('#btn-copy'),
            isRtl = $('html').attr('data-textdirection') === 'rtl';
        btnCopy.on('click', function() {
            userText.select();
            document.execCommand('copy');
            toastr['success']('', 'form Url Successfully Coiped', {
                rtl: isRtl
            });
        }); --}}
    </script>
@endsection
