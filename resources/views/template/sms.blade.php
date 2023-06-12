@extends('layouts/contentLayoutMaster')
@section('title', 'Sms Templates')
@section('content')

    <style>
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #28c76f;
            padding: 30px 0;
            text-align: center;
        }


        .nav-pills .nav-link {
            padding: 30px 0;
            text-align: center;
            border-bottom: 1px solid #cbc7c7;
            border-radius: 0;
            background-color: #fff;
        }

        .tabScrol {
            height: 550px;
            overflow: auto;
        }

        .nav-pills .nav-link.active {
            border-color: #28c76f;
            box-shadow: 0 4px 18px -4px rgb(40 199 111 / 43%);
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-xs-12 tabScrol">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link {{ $template == 'account-created' ? 'active' : '' }}" id="v-pills-home-tab"
                        href="{{ route('sms', 'account-created') }}" role="tab" aria-controls="v-pills-home"
                        aria-selected="true">Account Created</a>
                    <a class="nav-link {{ $template == 'login-alert' ? 'active' : '' }}" id="v-pills-profile-tab"
                        href="{{ route('sms', 'login-alert') }}" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">LogIn Alert</a>
                    <a class="nav-link {{ $template == 'password-reset' ? 'active' : '' }}" id="v-pills-messages-tab"
                        href="{{ route('sms', 'password-reset') }}" role="tab" aria-controls="v-pills-messages"
                        aria-selected="false">Password Reset</a>
                    <a class="nav-link border-0 {{ $template == 'email-verified' ? 'active' : '' }}"
                        id="v-pills-settings-tab" href="{{ route('sms', 'email-verified') }}" role="tab"
                        aria-controls="v-pills-settings" aria-selected="false">Email Verified</a>
                </div>
            </div>


            <div class="col-sm-9 col-xs-12 card py-4 px-3">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade {{ $template == 'account-created' ? 'show active' : '' }}" id="v-pills-home"
                        role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <x-greetings />
                        <form action="{{ route('save-sms-template', 'account-created') }}" method="post">
                            @csrf
                            <textarea id="{{ $template == 'account-created' ? 'editor1' : '' }}" name="template">{{ $templates->where('sms_type', 'account-created')->first()->content ?? '' }}</textarea>
                            <div class="text-end mt-4">
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade {{ $template == 'login-alert' ? 'show active' : '' }}" id="v-pills-home"
                        role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <x-greetings />
                        <form action="{{ route('save-sms-template', 'login-alert') }}" method="post">
                            @csrf
                            <textarea id="{{ $template == 'login-alert' ? 'editor1' : '' }}" name="template">{{ $templates->where('sms_type', 'login-alert')->first()->content ?? '' }}</textarea>
                            <div class="text-end mt-4">
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                    </div>


                    <div class="tab-pane fade {{ $template == 'password-reset' ? 'show active' : '' }}" id="v-pills-home"
                        role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <x-greetings />
                        <form action="{{ route('save-sms-template', 'password-reset') }}" method="post">
                            @csrf
                            <textarea id="{{ $template == 'password-reset' ? 'editor1' : '' }}" name="template">{{ $templates->where('sms_type', 'password-reset')->first()->content ?? '' }}</textarea>
                            <div class="text-end mt-4">
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                    </div>


                    <div class="tab-pane fade {{ $template == 'email-verified' ? 'show active' : '' }}" id="v-pills-home"
                        role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <x-greetings />
                        <form action="{{ route('save-sms-template', 'email-verified') }}" method="post">
                            @csrf
                            <textarea id="{{ $template == 'email-verified' ? 'editor1' : '' }}" name="template">{{ $templates->where('sms_type', 'email-verified')->first()->content ?? '' }}</textarea>
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
        CKEDITOR.replace('editor1');
    </script>
    <script src="https://cdn.ckeditor.com/[version.number]/[distribution]/ckeditor.js"></script>


@endsection


@endsection
