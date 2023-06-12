@extends('layouts/contentLayoutMaster')

@section('title', 'Statement')

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
<style>
    .set_pading {

        padding-bottom: 30px;
        /* padding-left: 80px;*/
    }

    .revenue {

        padding-right: 20px;
        padding-bottom: 10px;
        /* padding-left: 80px;*/
    }
</style>

@section('content')
    @php
        $income = @$revenue_value - @$t_expense;
        if ($income < 0) {
            $statement = 'Loss';
        } else {
            $statement = 'Expense';
        }
    @endphp

    {{-- <div class="row element-blur">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-sm-6 col-md-6 col-lg-12">
                        <div class="card-datatable" class="dt-complex-header table table-bordered table-responsive">
                            <table id="" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Total Expense</th>
                                        <th scope="col">Revenue</th>
                                        <th scope="col">Statement</th>

                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    @php
        $income = @$revenue_value - @$t_expense;
        if ($income < 0) {
            $value = explode('-', $income);
            $income = '-$' . $value[1];
            $statement = 'Loss';
        } else {
            $income = '$' . $income;
            $statement = 'Profit';
        }
    @endphp

    <!-- Complex Headers -->
    <div class="row element-blur">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-sm-12 col-md-12">
                        <form class="dt_adv_search" method="POST">
                            <div class="row g-1 mb-md-1">
                                <div class="col-md-4">
                                    <label class="form-label">Total Expense:</label>
                                    <input type="text" class="form-control dt-input dt-full-name" id="t_expense"
                                        value="${{ @$t_expense }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Revenue:</label>
                                    <input type="text" class="form-control dt-input" value="${{ @$revenue_value }}"
                                        id="revenue_value" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" id="statement">{{ @$statement }}</label>
                                    <input type="text" class="form-control dt-input" value="{{ @$income }}"
                                        disabled id="t_income">
                                </div>
                            </div>

                        </form>
                        <div class="row ">
                            <div class="col-md-4">
                                <a href="{{ route('statement.export') }}"><button type="button"
                                        class="btn btn-success">Export</button></a>
                            </div>


                            <div class="col-md-2" style="position: absolute; right:10px;">
                                <input id="custome-date" type="month" class="form-control" name="bday-month">
                            </div>
                        </div>
                    </div>
                    <div class="card-datatable" class="dt-complex-header table table-bordered table-responsive">
                        <table id="data-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Marchent Name</th>
                                    <th scope="col">Transaction ID</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
        load_data();

        function load_data(date = '') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#data-table').DataTable({
                responsive: false,
                processing: true,
                serverSide: true,
                searching: true,
                ordering: true,
                ajax: {
                    url: "{{ url('panel/statement/ajax') }}",
                    type: "POST",
                    data: {
                        date: date
                    }
                },
                columns: [{
                        data: 'date'
                    },
                    {
                        data: 'marchent_name'
                    },
                    {
                        data: 'transactionID'
                    },

                    {
                        data: 'category'
                    },
                    {
                        data: 'description'
                    },
                    {
                        data: 'amount'
                    },

                ],
                "drawCallback": function() {
                    $.ajax({
                        url: "{{ route('statement.ravenue.ajax') }}",
                        method: "POST",
                        success: function(response) {
                            var isRtl = $('html').attr('data-textdirection') === 'rtl';
                            if (response.status == "success") {
                                $("#t_expense").val(response.t_expense);
                                $("#revenue_value").val(response.revenue_value);
                                $("#t_income").val(response.income);
                                $("#statement").html(response.statement);

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
                },
            });
        }
        $("#custome-date").change(function() {
            var date = $("#custome-date").val();
            $('#data-table').DataTable().destroy();
            load_data(date);
           
        });
    </script>
@endsection
