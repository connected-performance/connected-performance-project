@extends('layouts/contentLayoutMaster')

@if (isset($role))
    @section('title', 'New Role')
@else
    @section('title', 'New Role')
@endif


@section('content')
    <style>
        .btn-primary {
            border-color: #28c76f !important;
            background-color: #28c76f !important;
            color: #fff !important;
        }
    </style>
    <!-- Basic Vertical form layout section start -->
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            @if (isset($role))
                                @lang('Update Role')
                            @else
                                @lang('Create Role')
                            @endif
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical"
                                @if (isset($role)) action="{{ route('update.role', ['id' => $role->uid]) }}" @else action="{{ route('role.create') }}" @endif
                                method="post">
                                @if (isset($role))
                                    {{ method_field('PUT') }}
                                @endif
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="form-label" for="modalRoleName">Role Name</label>
                                                <input type="text" id="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name', $role->name ?? null) }}" name="name" required
                                                    placeholder="required" autofocus>
                                                @error('name')
                                                    <p><small class="text-danger">{{ $message }}</small></p>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label" for="modalRoleName">For User</label>
                                                <select class="form-control type" id="for_user" name="for_user">
                                                    <option value="1" selected="">Admin</option>
                                                    <option value="2">Employee</option>
                                                    {{-- <option value="customer">Custommer</option> --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mt-4"></div>
                                        <div class="form-check-success">
                                            <input class="form-check-input" type="checkbox" id="selectAll" />
                                            <label class="form-check-label text-uppercase"
                                                for="selectAll">select_all</label>
                                        </div>
                                        @foreach ($permissions as $category)
                                            <div class="divider divider-start divider-info mt-4">
                                                <div class="divider-text text-uppercase fw-bold text-primary">
                                                    {{ $category['title'] }}</div>
                                            </div>

                                            <div class="d-flex justify-content-start flex-wrap">
                                                @foreach ($category['permissions'] as $permission)
                                                    <div class="form-check-success me-3 me-lg-5 mt-1">
                                                        <input type="checkbox"
                                                            @if (isset($role)) @if (isset($existing_permission) &&
                                                                is_array($existing_permission) &&
                                                                in_array($permission['name'], $existing_permission))
                                                               checked @endif
                                                        @else checked @endif
                                                        value="{{ $permission['name'] }}"
                                                        name="permissions[]"
                                                        id="{{ $permission['name'] }}"
                                                        class="form-check-input"
                                                        >
                                                        <label class="form-check-label text-uppercase"
                                                            for="{{ $permission['name'] }}">
                                                            {{ $permission['display_name'] }}
                                                        </label>

                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-12 mt-2">
                                        <input type="hidden" value="access_backend" name="permissions[]">
                                        <button type="submit" class="btn btn-success mr-1 mb-1">
                                            Save Change
                                        </button>
                                    </div>


                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic Vertical form layout section end -->


@endsection

@section('page-script')
    <script>
        // Select All checkbox click
        const selectAll = document.querySelector('#selectAll'),
            checkboxList = document.querySelectorAll('[type="checkbox"]');
        selectAll.addEventListener('change', t => {
            checkboxList.forEach(e => {
                e.checked = t.target.checked;
            });
        });

        function showResponseMessage(data) {

            if (data.status === 'success') {
                toastr['success'](data.message, '{{ __('locale.labels.success') }}!!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                    rtl: isRtl
                });
                dataListView.draw();
            } else {
                toastr['warning']("{{ __('locale.exceptions.something_went_wrong') }}",
                    '{{ __('locale.labels.warning') }}!', {
                        closeButton: true,
                        positionClass: 'toast-top-right',
                        progressBar: true,
                        newestOnTop: true,
                        rtl: isRtl
                    });
            }
        }

        $("#for_user").change(function() {
            var id = $("#for_user").val();
            var v = "{{ url('panel/role/create/') }}" + "/" + id;
            window.location.replace(v);
        });

        var for_user = @json($for_user);
        $('#for_user option[value=@json($for_user)]').attr("selected", "selected");
        if (@json($disable) == 2) {
            $('#for_user').prop('disabled', 'disabled');
        }
    </script>
@endsection
