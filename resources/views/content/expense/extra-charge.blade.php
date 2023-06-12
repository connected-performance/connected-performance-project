@extends('layouts/contentLayoutMaster')

@section('title', 'Extra Amount')

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

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
@endsection
@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
    <style>
        .spinner-image {
            position: absolute;
            z-index: 1000;
            /* margin-top: 25%;
                */
            margin-top: 10%;
            margin-left: 33%
        }

        .blur-body {
            filter: blur(5px);
            background-color: #fbfbfb;
            color: #fbfbfb;
        }
    
    </style>
@endsection

@section('content')


    <div class="spinner-preloader d-none" id="preloader-img">
        <div class="preloader-img">
            <img src="{{ asset('custom/img/512x512.gif') }}" class="spinner-image" height="200">
        </div>
    </div>
    <!-- Complex Headers -->
    <div class="row element-blur">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header border-bottom">
                        <button type="button" class="btn btn-success" onclick="modal_show()">Create</button>
                    </div>
                    <div class="card-datatable" class="dt-complex-header table table-bordered table-responsive">
                        <table id="invoice_table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Issue Date')</th>
                                    <th>@lang('Due Date')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Balance Status')</th>
                                    <th>@lang('Status')</th>
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
                    <h5 class="modal-title" id="myModalLabel160">Delete Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you shure you want to delete this Invoice.
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
    <div class="modal fade text-start" id="edit_invoice" tabindex="-1" aria-labelledby="myModalLabel160"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel160">Edit Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="submit_form_edit" class="form_field" method="post">

                        <input type="hidden" name="invoice_id" id="invoice_id">

                        <div class="row">
                            <div class="col-6">
                                <label for="recipient-name" class="col-form-label">@lang('Issue Date')</label>
                                <input type="date" class="form-control" name="issue_date" id="id_issue_date"
                                    placeholder="Issue Date" required>
                            </div>
                            <div class="col-6">
                                <label for="recipient-name" class="col-form-label">@lang('Due Date')</label>
                                <input type="date" class="form-control" name="due_date" id="id_due_date"
                                    placeholder="Issue Date" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Change</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    @include('content.expense.extra-charge-model');



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
 function modal_show() {
            $("#user_id").val(null);
            $("#service_id").val(null);
            $("#issue_date").val(null);
            $("#due_date").val(null);
            $("#duration").val(null);
            $("#price").val(null);
            $("#description").val(null);
            $("#exampleModal").modal('show');
        }

         load_data();

        function load_data() {
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
                    url: "{{ url('panel/extra/charges/ajaxt') }}",
                    type: "POST",

                },
                columns: [
                    {
                        data: 'users.first_name'
                    },
                    {
                        data: 'issue_date'
                    }, {
                        data: 'due_date'
                    },
                    {
                        data: 'amount'
                    },
                     {
                        data: 'balance_status'
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

        $('#submit_form').on('submit', function(event) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "{{ route('extra.charge.create') }}",
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
