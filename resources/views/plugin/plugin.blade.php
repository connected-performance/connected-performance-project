@extends('layouts/contentLayoutMaster')

@section('title', 'Plugin')

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
.arrange-text{
    margin-top: -34px;
    margin-left: 8px;
}
.img-position {

    margin-left: -80px;
}

</style>
@section('content')

   
    <div class="container-fluid user-card">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card d-flex flex-row py-4 px-1" style="">
                    <h5 class="fw-bold arrange-text">Expensify</h5>
                    <div><img class="img-position  float-start"   src="{{ asset('custom/img/expensify_100x100.png') }}"
                            alt="Card image cap">
                    </div>
                    <div class="card-body position-absolute bottom-0 end-0">
                        <button id="custom-btn" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#google"
                            onclick="show_model(1)">
                            Update</button>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card d-flex flex-row py-5 px-1" style="">
                        <h5 class="fw-bold arrange-text">EbizCharge</h5>
                    <div><img class="img-position  float-start" style="width:88px;"  src="{{ asset('custom/img/ebizcharges2_1_100x100.jpg') }}"
                            alt="Card image cap">
                    </div>
                    <div class="card-body  position-absolute bottom-0 end-0">
                        <button id="custom-btn " class="btn btn-success end" data-bs-toggle="modal" data-bs-target="#google"
                            onclick="show_model(2)">
                            Update</button>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="model-title">@lang('Expensify Credentials')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="submit_form" class="form_field" method="post">
                        <input type="hidden" id="slug-type" value="expensify" name="plugin">
                        <div class="row">
                            <div class="col-12">
                                <label for="recipient-name" class="col-form-label" >@lang('User ID')</label>
                                <input type="text" class="form-control" name="private_key" id="private-key"
                                    placeholder="User ID" required>
                            </div>
                            <div class="col-12">
                                <label for="recipient-name" class="col-form-label">@lang('User Secret Key')</label>
                                <input type="text" class="form-control" name="screte_key" id="screte-key"
                                    placeholder="User Secret Key" required>
                            </div>
                      
                            <div class="col-12 d-none custome-filed">
                                <label for="recipient-name" class="col-form-label">@lang('Security ID')</label>
                                <input type="text" class="form-control" name="security_id" id="security_id"
                                    placeholder="Security ID" >
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
    </div> <!-- end preview-->

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
        function show_model(slug) {
            if (slug == 1) {
                var slug = 'expensify';
                $("#model-title").text("Expensify Credentials");
            }
            if(slug == 2){
                var slug = 'ebizcharge';
                $("#model-title").text("EbizCharge Credentials");

            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('model') }}",
                type: "POST",
                data: {
                    slug: slug,
                },
                success: function(response) {
                    var html = '';
                    $("#slug-type").val(slug);
                    $("#private-key").val(response.private_key);
                    $("#screte-key").val(response.secret_key);
                    if(slug == 'ebizcharge'){
                        $(".custome-filed").removeClass("d-none");
                    $("#security_id").val(response.security_id);
                    }else{
                         $(".custome-filed").addClass("d-none");
                    }
                    $("#exampleModal").modal('show');
                },
                error: function(response) {
                    alert("Failed")
                }
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
                url: "{{ route('add.plugin') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        $("#exampleModal").modal('hide');
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
    </script>

@endsection
