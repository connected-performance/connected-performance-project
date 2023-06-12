@extends('layouts/contentLayoutMaster')

@section('title', 'File Room')

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
                <div class="card-header border-bottom">
                    @if(1 == Auth::user()->id)
                    <button type="button" class="btn btn-success" onclick="add_file()">Add File</button>
                    @endif
                </div>
                <div class="card-datatable">
                    <table id="service_table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>From</th>
                                @if(1 == Auth::user()->id)
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($file as $key => $data)
                            @php($from = App\Models\User::findorfail($data->user_id))
                            @if($data->user_id == Auth::user()->id)
                            <tr>
                                <td>{{ $data->file }}</td>
                                <td>{{ $from->first_name }}</td>
                                <td>
                                    {{-- <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a> --}}
                                    <a href="#" class="btn btn-danger btn-sm" onclick="delete_file({{ $data->id }})"><i class="fas fa-trash"></i></a>
                                    <form id="doc-delete-{{$data->id}}" action="{{route('file.destroy',$data->id)}}" method="post" >
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td>{{ $data->file }}</td>
                                <td>{{ $from->first_name }}</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade text-start" id="add_file" tabindex="-1" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('file.create') }}" enctype="multipart/form-data" method="POST">
                @csrf
            <div class="modal-body">
                Please Select a file to upload.
                <input type="file" class="form-control" name="file" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-success">Upload</button>
            </div>
        </form>
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
        function add_file(){
            // $('#add_file').show();
            $('#add_file').modal('show');
        }
        function delete_file(id){
            if (confirm("Are you sure you want to delete?")){
                document.getElementById("doc-delete-"+id).submit();
            }
        }

    </script>
@endsection
