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
    <style>
        .col-6 {
            flex: 0 0 auto;
            width: 36%;
        }
    </style>
    <div class="row">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <a href="https://demo.rajodiya.com/crmgo-saas/contract/1" class="mb-0">Dolor architecto
                                    vol</a>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <div class="dropdown action-item">
                                        <a href="#" class="action-item" data-bs-toggle="dropdown"><i
                                                class="fas fa-ellipsis-h"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                data-url="https://demo.rajodiya.com/crmgo-saas/contract/1/edit"
                                                data-bs-whatever="Edit Contract"
                                                data-bs-original-title="Edit Contract"><span class=""> <i
                                                        class="ti ti-edit"></i></span>Edit</a>



                                            <form method="POST" action="https://demo.rajodiya.com/crmgo-saas/contract/1"
                                                accept-charset="UTF-8"><input name="_method" type="hidden"
                                                    value="DELETE"><input name="_token" type="hidden"
                                                    value="HzlluIjVza4KToo9ypJenEQ5IZEUbGVisUAFFVFa">
                                                <a href="#!"
                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm">
                                                    <i class="ti ti-trash" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Delete"></i>Delete
                                                </a>
                                            </form>
                                            <!-- <form method="POST" action="https://demo.rajodiya.com/crmgo-saas/contract/1">
                                                                    <input type="hidden" name="_token" value="HzlluIjVza4KToo9ypJenEQ5IZEUbGVisUAFFVFa">                                                        <input name="_method" type="hidden" value="DELETE">
                                                                    <button type="submit" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm" data-toggle="tooltip"
                                                                    title='Delete'>
                                                                    <span class=""> <i
                                                                    class="ti ti-trash"></i></span>
                                                                    Delete
                                                                    </button>
                                                                </form> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-3 flex-grow-1">

                        <p class="text-sm mb-0">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                            the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                            of type and scrambled it to make a type specimen book.
                        </p>
                    </div>
                    <div class="card-footer py-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">Contract Type:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <span class="badge bg-primary p-2 px-3 rounded">Planning</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">Contract Value:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <span class="badge bg-primary p-2 px-3 rounded">34.00$</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">Client:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        Anthony Dayrep
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <small>Start Date:</small>
                                        <div class="h6 mb-0">Aug 4, 2022</div>
                                    </div>
                                    <div class="col-6">
                                        <small>End Date:</small>
                                        <div class="h6 mb-0">Jun 2, 2025</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <a href="https://demo.rajodiya.com/crmgo-saas/contract/2" class="mb-0">Quae officia ea
                                    dolo</a>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <div class="dropdown action-item">
                                        <a href="#" class="action-item" data-bs-toggle="dropdown"><i
                                                class="fas fa-ellipsis-h"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                data-url="https://demo.rajodiya.com/crmgo-saas/contract/2/edit"
                                                data-bs-whatever="Edit Contract"
                                                data-bs-original-title="Edit Contract"><span class=""> <i
                                                        class="ti ti-edit"></i></span>Edit</a>



                                            <form method="POST" action="https://demo.rajodiya.com/crmgo-saas/contract/2"
                                                accept-charset="UTF-8"><input name="_method" type="hidden"
                                                    value="DELETE"><input name="_token" type="hidden"
                                                    value="HzlluIjVza4KToo9ypJenEQ5IZEUbGVisUAFFVFa">
                                                <a href="#!"
                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm">
                                                    <i class="ti ti-trash" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Delete"></i>Delete
                                                </a>
                                            </form>
                                            <!-- <form method="POST" action="https://demo.rajodiya.com/crmgo-saas/contract/2">
                                                                    <input type="hidden" name="_token" value="HzlluIjVza4KToo9ypJenEQ5IZEUbGVisUAFFVFa">                                                        <input name="_method" type="hidden" value="DELETE">
                                                                    <button type="submit" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm" data-toggle="tooltip"
                                                                    title='Delete'>
                                                                    <span class=""> <i
                                                                    class="ti ti-trash"></i></span>
                                                                    Delete
                                                                    </button>
                                                                </form> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-3 flex-grow-1">

                        <p class="text-sm mb-0">
                            Lorem Ipsum is placeholder text that stands in for meaningful content. It allows designers to
                            focus on getting the graphical elements such as typography
                        </p>
                    </div>
                    <div class="card-footer py-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">Contract Type:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <span class="badge bg-primary p-2 px-3 rounded">Marketing</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">Contract Value:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <span class="badge bg-primary p-2 px-3 rounded">86.00$</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">Client:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        Kim J Gibson
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <small>Start Date:</small>
                                        <div class="h6 mb-0">Aug 4, 2022</div>
                                    </div>
                                    <div class="col-6">
                                        <small>End Date:</small>
                                        <div class="h6 mb-0">Nov 13, 2025</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <a href="https://demo.rajodiya.com/crmgo-saas/contract/3" class="mb-0">Game Development
                                    Time Limit</a>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <div class="dropdown action-item">
                                        <a href="#" class="action-item" data-bs-toggle="dropdown"><i
                                                class="fas fa-ellipsis-h"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                data-url="https://demo.rajodiya.com/crmgo-saas/contract/3/edit"
                                                data-bs-whatever="Edit Contract"
                                                data-bs-original-title="Edit Contract"><span class=""> <i
                                                        class="ti ti-edit"></i></span>Edit</a>



                                            <form method="POST" action="https://demo.rajodiya.com/crmgo-saas/contract/3"
                                                accept-charset="UTF-8"><input name="_method" type="hidden"
                                                    value="DELETE"><input name="_token" type="hidden"
                                                    value="HzlluIjVza4KToo9ypJenEQ5IZEUbGVisUAFFVFa">
                                                <a href="#!"
                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm">
                                                    <i class="ti ti-trash" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Delete"></i>Delete
                                                </a>
                                            </form>
                                            <!-- <form method="POST" action="https://demo.rajodiya.com/crmgo-saas/contract/3">
                                                                    <input type="hidden" name="_token" value="HzlluIjVza4KToo9ypJenEQ5IZEUbGVisUAFFVFa">                                                        <input name="_method" type="hidden" value="DELETE">
                                                                    <button type="submit" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm" data-toggle="tooltip"
                                                                    title='Delete'>
                                                                    <span class=""> <i
                                                                    class="ti ti-trash"></i></span>
                                                                    Delete
                                                                    </button>
                                                                </form> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-3 flex-grow-1">

                        <p class="text-sm mb-0">
                            n a professional context it often happens that private or corporate clients corder a publication
                            to be made and presented with the actual content still not being ready. Think of a news blog
                            that's filled with content hourly on the day of going live.
                        </p>
                    </div>
                    <div class="card-footer py-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">Contract Type:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <span class="badge bg-primary p-2 px-3 rounded">Marketing</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">Contract Value:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <span class="badge bg-primary p-2 px-3 rounded">90.00$</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">Client:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        Kim J Gibson
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <small>Start Date:</small>
                                        <div class="h6 mb-0">Aug 4, 2022</div>
                                    </div>
                                    <div class="col-6">
                                        <small>End Date:</small>
                                        <div class="h6 mb-0">Oct 30, 2025</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <a href="https://demo.rajodiya.com/crmgo-saas/contract/4" class="mb-0">Dolor architecto
                                    vol</a>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <div class="dropdown action-item">
                                        <a href="#" class="action-item" data-bs-toggle="dropdown"><i
                                                class="fas fa-ellipsis-h"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                data-url="https://demo.rajodiya.com/crmgo-saas/contract/4/edit"
                                                data-bs-whatever="Edit Contract"
                                                data-bs-original-title="Edit Contract"><span class=""> <i
                                                        class="ti ti-edit"></i></span>Edit</a>



                                            <form method="POST" action="https://demo.rajodiya.com/crmgo-saas/contract/4"
                                                accept-charset="UTF-8"><input name="_method" type="hidden"
                                                    value="DELETE"><input name="_token" type="hidden"
                                                    value="HzlluIjVza4KToo9ypJenEQ5IZEUbGVisUAFFVFa">
                                                <a href="#!"
                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm">
                                                    <i class="ti ti-trash" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Delete"></i>Delete
                                                </a>
                                            </form>
                                            <!-- <form method="POST" action="https://demo.rajodiya.com/crmgo-saas/contract/4">
                                                                    <input type="hidden" name="_token" value="HzlluIjVza4KToo9ypJenEQ5IZEUbGVisUAFFVFa">                                                        <input name="_method" type="hidden" value="DELETE">
                                                                    <button type="submit" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm" data-toggle="tooltip"
                                                                    title='Delete'>
                                                                    <span class=""> <i
                                                                    class="ti ti-trash"></i></span>
                                                                    Delete
                                                                    </button>
                                                                </form> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-3 flex-grow-1">

                        <p class="text-sm mb-0">
                            n a professional context it often happens that private or corporate clients corder a publication
                            to be made and presented with the actual content still not being ready. Think of a news blog
                            that's filled with content hourly on the day of going live.
                        </p>
                    </div>
                    <div class="card-footer py-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">Contract Type:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <span class="badge bg-primary p-2 px-3 rounded">Marketing</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">Contract Value:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <span class="badge bg-primary p-2 px-3 rounded">90.00$</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">Client:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        Anthony Dayrep
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <small>Start Date:</small>
                                        <div class="h6 mb-0">Aug 20, 2022</div>
                                    </div>
                                    <div class="col-6">
                                        <small>End Date:</small>
                                        <div class="h6 mb-0">Oct 30, 2025</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <a href="https://demo.rajodiya.com/crmgo-saas/contract/5" class="mb-0">Sunt quod
                                    dignissimo</a>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <div class="dropdown action-item">
                                        <a href="#" class="action-item" data-bs-toggle="dropdown"><i
                                                class="fas fa-ellipsis-h"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                data-url="https://demo.rajodiya.com/crmgo-saas/contract/5/edit"
                                                data-bs-whatever="Edit Contract"
                                                data-bs-original-title="Edit Contract"><span class=""> <i
                                                        class="ti ti-edit"></i></span>Edit</a>



                                            <form method="POST" action="https://demo.rajodiya.com/crmgo-saas/contract/5"
                                                accept-charset="UTF-8"><input name="_method" type="hidden"
                                                    value="DELETE"><input name="_token" type="hidden"
                                                    value="HzlluIjVza4KToo9ypJenEQ5IZEUbGVisUAFFVFa">
                                                <a href="#!"
                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm">
                                                    <i class="ti ti-trash" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Delete"></i>Delete
                                                </a>
                                            </form>
                                            <!-- <form method="POST" action="https://demo.rajodiya.com/crmgo-saas/contract/5">
                                                                    <input type="hidden" name="_token" value="HzlluIjVza4KToo9ypJenEQ5IZEUbGVisUAFFVFa">                                                        <input name="_method" type="hidden" value="DELETE">
                                                                    <button type="submit" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm" data-toggle="tooltip"
                                                                    title='Delete'>
                                                                    <span class=""> <i
                                                                    class="ti ti-trash"></i></span>
                                                                    Delete
                                                                    </button>
                                                                </form> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-3 flex-grow-1">

                        <p class="text-sm mb-0">
                            It is a long established fact that a reader will be distracted by the readable content of a page
                            when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
                            distribution of letters, as opposed to using 'Content here, content here', making it look like
                            readable English.
                        </p>
                    </div>
                    <div class="card-footer py-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">Contract Type:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <span class="badge bg-primary p-2 px-3 rounded">Planning</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">Contract Value:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <span class="badge bg-primary p-2 px-3 rounded">300.00$</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">Client:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        Walter Simpson
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <small>Start Date:</small>
                                        <div class="h6 mb-0">Sep 15, 2022</div>
                                    </div>
                                    <div class="col-6">
                                        <small>End Date:</small>
                                        <div class="h6 mb-0">Apr 15, 2023</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
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
