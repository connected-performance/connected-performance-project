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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">New Time Zone</button>
                    </div>
                    <div id="time_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="time_datatable_length"><label>Show <select
                                            name="time_datatable_length" aria-controls="time_datatable"
                                            class="custom-select custom-select-sm form-control form-control-sm form-select form-select-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> entries</label></div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="time_datatable_filter" class="dataTables_filter"><label>Search:<input
                                            type="search" class="form-control form-control-sm" placeholder=""
                                            aria-controls="time_datatable"></label></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="time_datatable"
                                    class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline"
                                    aria-describedby="time_datatable_info" style="width: 672px;">
                                    <thead>
                                        <tr>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 48px;">
                                                Sr.No</th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1"
                                                style="width: 118px;">Country Code</th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1"
                                                style="width: 144px;">Time Zone</th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 41px;">
                                                GMT</th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 36px;">
                                                DST</th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 44px;">
                                                RAW</th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 66px;">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd">
                                            <td class="dtr-control">1</td>
                                            <td>AD</td>
                                            <td>Europe/Andorra</td>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>1</td>
                                            <td><a style="padding-left:10px;" class="link-success" href="#"
                                                    onclick="update_model(1)"><i class="fas fa-edit"></i></a>
                                                <a style="padding-left:10px;" class="link-danger" onclick="show_model(1)"><i
                                                        class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        <tr class="even">
                                            <td class="dtr-control">2</td>
                                            <td>AE</td>
                                            <td>Asia/Dubai</td>
                                            <td>4</td>
                                            <td>4</td>
                                            <td>4</td>
                                            <td><a style="padding-left:10px;" class="link-success" href="#"
                                                    onclick="update_model(2)"><i class="fas fa-edit"></i></a>
                                                <a style="padding-left:10px;" class="link-danger"
                                                    onclick="show_model(2)"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <td class="dtr-control">3</td>
                                            <td>AF</td>
                                            <td>Asia/Kabul</td>
                                            <td>4.5</td>
                                            <td>4.5</td>
                                            <td>4.5</td>
                                            <td><a style="padding-left:10px;" class="link-success" href="#"
                                                    onclick="update_model(3)"><i class="fas fa-edit"></i></a>
                                                <a style="padding-left:10px;" class="link-danger"
                                                    onclick="show_model(3)"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        <tr class="even">
                                            <td class="dtr-control">4</td>
                                            <td>AI</td>
                                            <td>America/Anguilla</td>
                                            <td>-4</td>
                                            <td>-4</td>
                                            <td>-4</td>
                                            <td><a style="padding-left:10px;" class="link-success" href="#"
                                                    onclick="update_model(4)"><i class="fas fa-edit"></i></a>
                                                <a style="padding-left:10px;" class="link-danger"
                                                    onclick="show_model(4)"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <td class="dtr-control">5</td>
                                            <td>AL</td>
                                            <td>Europe/Tirane</td>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>1</td>
                                            <td><a style="padding-left:10px;" class="link-success" href="#"
                                                    onclick="update_model(5)"><i class="fas fa-edit"></i></a>
                                                <a style="padding-left:10px;" class="link-danger"
                                                    onclick="show_model(5)"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        <tr class="even">
                                            <td class="dtr-control">7</td>
                                            <td>AM</td>
                                            <td>Asia/Yerevan</td>
                                            <td>4</td>
                                            <td>4</td>
                                            <td>4</td>
                                            <td><a style="padding-left:10px;" class="link-success" href="#"
                                                    onclick="update_model(7)"><i class="fas fa-edit"></i></a>
                                                <a style="padding-left:10px;" class="link-danger"
                                                    onclick="show_model(7)"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <td class="dtr-control">8</td>
                                            <td>AO</td>
                                            <td>Africa/Luanda</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td><a style="padding-left:10px;" class="link-success" href="#"
                                                    onclick="update_model(8)"><i class="fas fa-edit"></i></a>
                                                <a style="padding-left:10px;" class="link-danger"
                                                    onclick="show_model(8)"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        <tr class="even">
                                            <td class="dtr-control">9</td>
                                            <td>AQ</td>
                                            <td>Antarctica/Casey</td>
                                            <td>8</td>
                                            <td>8</td>
                                            <td>8</td>
                                            <td><a style="padding-left:10px;" class="link-success" href="#"
                                                    onclick="update_model(9)"><i class="fas fa-edit"></i></a>
                                                <a style="padding-left:10px;" class="link-danger"
                                                    onclick="show_model(9)"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <td class="dtr-control">10</td>
                                            <td>AQ</td>
                                            <td>Antarctica/Davis</td>
                                            <td>7</td>
                                            <td>7</td>
                                            <td>7</td>
                                            <td><a style="padding-left:10px;" class="link-success" href="#"
                                                    onclick="update_model(10)"><i class="fas fa-edit"></i></a>
                                                <a style="padding-left:10px;" class="link-danger"
                                                    onclick="show_model(10)"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        <tr class="even">
                                            <td class="dtr-control">31</td>
                                            <td>AG</td>
                                            <td>America/Antigua</td>
                                            <td>-4</td>
                                            <td>-4</td>
                                            <td>-4</td>
                                            <td><a style="padding-left:10px;" class="link-success" href="#"
                                                    onclick="update_model(31)"><i class="fas fa-edit"></i></a>
                                                <a style="padding-left:10px;" class="link-danger"
                                                    onclick="show_model(31)"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div id="time_datatable_processing" class="dataTables_processing card"
                                    style="display: none;">Processing...</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="time_datatable_info" role="status" aria-live="polite">
                                    Showing 1 to 10 of 10 entries</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="time_datatable_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous disabled"
                                            id="time_datatable_previous"><a href="#" aria-controls="time_datatable"
                                                data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                                        <li class="paginate_button page-item active"><a href="#"
                                                aria-controls="time_datatable" data-dt-idx="1" tabindex="0"
                                                class="page-link">1</a></li>
                                        <li class="paginate_button page-item next disabled" id="time_datatable_next"><a
                                                href="#" aria-controls="time_datatable" data-dt-idx="2"
                                                tabindex="0" class="page-link">Next</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
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
