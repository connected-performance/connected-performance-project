@extends('layouts/contentLayoutMaster')

@section('title', 'EmailTemplate')

@section('vendor-style')

@endsection

@section('content')
    <style>
        .py-4 {
            padding-top: 1.5rem !important;
            padding-bottom: 2.5rem !important;
        }

        a {
            color: #717373;
            text-decoration: none;
        }
    </style>
    <div class="flex">
        <div class="row">

            <div class="container col-3 list-group d-none d-md-block  " style="max-height: 700px; overflow:auto;">
                <ul>
                    <h5>@lang('Email Templates')</h5>
                    @foreach ($rows as $row)
                        <li class="list-group-item py-4 d-block {{ Request::segment(3) == $row->slug ? 'bg-success' : '' }}">
                            <a class="{{ Request::segment(3) == $row->slug ? 'text-light' : '' }}"
                                href="{{ route('email') . '/' . $row->slug }}">@lang($row->name)</a>
                        </li>
                    @endforeach
                </ul>

            </div>

            <div class="col-9 col-xs-12 ">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ Request::url() }}">
                            {{-- @php(dd(Request::url())) --}}
                            @csrf
                            <textarea id="elm1" name="area" rows="50" style="width: 100%;display:none; height: 100%">{{ $value->value }}</textarea>
                            <div class="text-end">
                                <button class="btn btn-success mt-4" type="submit">@lang('Save')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
@endsection


@section('vendor-script')
    {{-- vendor files --}}
    {{-- <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor1');
    </script> --}}
    {{-- <script src="https://cdn.ckeditor.com/[version.number]/[distribution]/ckeditor.js"></script> --}}
    <script src="{{ asset('custom/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('custom/pages/form-editor.init.js') }}"></script>


    <script>
        function add_tempalte() {
            var name = prompt("Enter Template Name");
            var slug = prompt("Enter Template Slug");
            if (name && slug) {
                $.ajax({
                    url: "{{ route('email_templates.store') }}",
                    type: "POST",
                    data: {
                        name: name,
                        slug: slug,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        window.location.href = "{{ route('email') }}";
                    }
                });
            } else {
                alert('Please Enter Name and Slug');
            }
        }
        $(function() {
            $('#elm1').fadeIn();
            window.addEventListener('click', function(evt) {
                if (evt.detail === 3) {
                    add_tempalte();
                }
            });
        });
    </script>
@endsection
