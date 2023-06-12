@extends('layouts/contentLayoutMaster')
@section('title','Whatsapp Templates')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <x-greetings />
                    <form action="{{ route('save-whatsapp-template') }}" method="post">
                        @csrf
                        <textarea id="editor1"  name="template">{{ $template->content ?? '' }}</textarea>
                        <div class="text-end mt-4">
                            <input type="submit" class="btn btn-success" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 
</div>


@section('vendor-script')
    {{-- vendor files --}}
    <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
    CKEDITOR.replace( 'editor1' );
    </script>
    <script src="https://cdn.ckeditor.com/[version.number]/[distribution]/ckeditor.js"></script>


@endsection


@endsection
