@extends('layouts/contentLayoutMaster')

@section('title', 'Smart-Waiver')

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
                                    {{-- <th>@lang('TemplateId')</th> --}}
                                    <th>@lang('Title')</th>
                                    <th>@lang('PublishedVersion')</th>
                                    <th>@lang('PublishedOn')</th>
                                    <th>@lang('WebUrl')</th>
                                    <th>@lang('KioskUrl')</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data as $value)
                                    <tr>
                                        {{-- <td>{{ @$value->templateId }}</td> --}}
                                        <td>{{ @$value->title }}</td>
                                        {{-- <td><a href="{{route('agreements',['id'=> $value->templateId])}}">{{ @$value->publishedVersion }}</a></td> --}}
                                        <td>{{ @$value->publishedVersion }}</td>
                                        <td>{{ @$value->publishedOn }}</td>
                                        <td>{{ @$value->webUrl }}</td>
                                        <td>{{ @$value->kioskUrl }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
@section('page-script')
    <script src="{{ asset(mix('js/scripts/components/components-tooltips.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/extensions/ext-component-toastr.js')) }}"></script>


    <script>

          var table =   $('#invoice_table').DataTable({
                responsive: true,
                processing: true,
                searching: true,
                
            });
       
    </script>

@endsection
