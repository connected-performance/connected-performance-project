@extends('layouts/contentLayoutMaster')

@section('title', 'EmailTemplate')

@section('vendor-style')

@endsection

@section('content')
    <style>
        .cke_wysiwyg_frame {
            height: 30rem;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #7367f0;
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
            height: 600px;
            overflow: auto;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #28c76f;
            padding: 30px 0;
            text-align: center;
        }

        .nav-pills .nav-link.active {
            border-color: #28c76f;
            box-shadow: 0 4px 18px -4px rgb(40 199 111);
        }
    </style>
    <div class="col-sm-12 xl-100 ">
        <div class="row">
            <div class="col-sm-3 col-xs-12 tabScrol">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link {{ $template == 'test-email' ? 'active' : '' }}" id="v-pills-home-tab"
                        href="{{ route('email', ['template' => 'test-email']) }}" role="tab" aria-controls="v-pills-home"
                        aria-selected="true">Test Email</a>
                    <a class="nav-link {{ $template == 'notification-email' ? 'active' : '' }}" id="v-pills-profile-tab"
                        href="{{ route('email', ['template' => 'notification-email']) }}" role="tab"
                        aria-controls="v-pills-profile" aria-selected="false">Notification Email</a>
                    <a class="nav-link {{ $template == 'team-invitation' ? 'active' : '' }}" id="v-pills-messages-tab"
                        href="{{ route('email', ['template' => 'team-invitation']) }}" role="tab"
                        aria-controls="v-pills-messages" aria-selected="false">Team Invitation</a>
                    <a class="nav-link {{ $template == 'forgot-password-email' ? 'active' : '' }} "
                        id="v-pills-settings-tab" href="{{ route('email', ['template' => 'forgot-password-email']) }}"
                        role="tab" aria-controls="v-pills-settings" aria-selected="false">Forgot Password</a>

                    <a class="nav-link {{ $template == 'account-update-email' ? 'active' : '' }}" id="v-pills-account-tab"
                        href="{{ route('email', ['template' => 'account-update-email']) }}" role="tab"
                        aria-controls="v-pills-account" aria-selected="false">Account update</a>

                    <a class="nav-link {{ $template == 'invitation-email' ? 'active' : '' }}" id="v-pills-invitation-tab"
                        href="{{ route('email', ['template' => 'invitation-email']) }}" role="tab"
                        aria-controls="v-pills-invitation" aria-selected="false">Invitation</a>

                    <a class="nav-link {{ $template == 'verify-email' ? 'active' : '' }}" id="v-pills-verify-email-tab"
                        href="{{ route('email', ['template' => 'verify-email']) }}" role="tab"
                        aria-controls="v-pills-verify-email" aria-selected="false">Verify Email</a>

                    <a class="nav-link {{ $template == 'order-place-email' ? 'active' : '' }} "
                        id="v-pills-order-placed-tab" href="{{ route('email', ['template' => 'order-place-email']) }}"
                        role="tab" aria-controls="v-pills-order-placed" aria-selected="false">Order Placed</a>

                    <a class="nav-link {{ $template == 'invoice-send-email' ? 'active' : '' }} "
                        id="v-pills-invoice-send-tab" href="{{ route('email', ['template' => 'invoice-send-email']) }}"
                        role="tab" aria-controls="v-pills-invoice-send" aria-selected="false">invoice send</a>

                    <a class="nav-link {{ $template == 'invoice-paid-email' ? 'active' : '' }} "
                        id="v-pills-invoice-paid-tab" href="{{ route('email', ['template' => 'invoice-paid-email']) }}"
                        role="tab" aria-controls="v-pills-invoice-paid" aria-selected="false">invoice paid</a>

                    <a class="nav-link {{ $template == 'restock-notification-mail' ? 'active' : '' }} "
                        id="v-pills-restock-tab" href="{{ route('email', ['template' => 'restock-notification-mail']) }}"
                        role="tab" aria-controls="v-pills-restock" aria-selected="false">Restock Notification Email</a>

                    <a class="nav-link  {{ $template == 'cron-report-email' ? 'active' : '' }} border-0"
                        id="v-pills-report-mail-tab" href="{{ route('email', ['template' => 'cron-report-email']) }}"
                        role="tab" aria-controls="v-pills-report-mail" aria-selected="false">Cron Report Mail</a>

                </div>
            </div>


            <div class="col-sm-9 col-xs-12 card py-4 px-3">


                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade {{ $template == 'test-email' ? 'show active' : '' }}" id="v-pills-home"
                        role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <x-greetings />
                        <form action="{{ route('save-template', 'test-email') }}" method="POST">
                            @csrf
                            <textarea id="{{ $template == 'test-email' ? 'editor1' : '' }}" name="template">{{ $templates->where('email_type', 'test-email')->first()->content ?? '' }}</textarea>
                            <div class="text-end mt-4">
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade {{ $template == 'notification-email' ? 'show active' : '' }}"
                        id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <x-greetings />
                        <form action="{{ route('save-template', 'notification-email') }}" method="POST">
                            @csrf
                            <textarea id="{{ $template == 'notification-email' ? 'editor1' : '' }}" name="template">{{ $templates->where('email_type', 'notification-email')->first()->content ?? '' }}</textarea>
                            <div class="text-end mt-4">
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade {{ $template == 'team-invitation' ? 'show active' : '' }}"
                        id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <x-greetings />
                        <form action="{{ route('save-template', 'team-invitation') }}" method="post">
                            @csrf
                            <textarea id="{{ $template == 'team-invitation' ? 'editor1' : '' }}" name="template">{{ $templates->where('email_type', 'team-invitation')->first()->content ?? '' }}</textarea>
                            <div class="text-end mt-4">
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade {{ $template == 'forgot-password-email' ? 'show active' : '' }}"
                        id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <x-greetings />
                        <form action="{{ route('save-template', 'forgot-password-email') }}" method="post">
                            @csrf
                            <textarea id="{{ $template == 'forgot-password-email' ? 'editor1' : '' }}" name="template">{{ $templates->where('email_type', 'forgot-password-email')->first()->content ?? '' }}</textarea>
                            <div class="text-end mt-4">
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade {{ $template == 'account-update-email' ? 'show active' : '' }}"
                        id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <x-greetings />
                        <form action="{{ route('save-template', 'account-update-email') }}" method="post">
                            @csrf
                            <textarea id="{{ $template == 'account-update-email' ? 'editor1' : '' }}" name="template">{{ $templates->where('email_type', 'account-update-email')->first()->content ?? '' }}</textarea>
                            <div class="text-end mt-4">
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade {{ $template == 'invitation-email' ? 'show active' : '' }}"
                        id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <x-greetings />
                        <form action="{{ route('save-template', 'invitation-email') }}" method="post">
                            @csrf
                            <textarea id="{{ $template == 'invitation-email' ? 'editor1' : '' }}" name="template">{{ $templates->where('email_type', 'invitation-email')->first()->content ?? '' }}</textarea>
                            <div class="text-end mt-4">
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade {{ $template == 'verify-email' ? 'show active' : '' }}"
                        id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <x-greetings />
                        <form action="{{ route('save-template', 'verify-email') }}" method="post">
                            @csrf
                            <textarea id="{{ $template == 'verify-email' ? 'editor1' : '' }}" name="template">{{ $templates->where('email_type', 'verify-email')->first()->content ?? '' }}</textarea>
                            <div class="text-end mt-4">
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade {{ $template == 'order-place-email' ? 'show active' : '' }}"
                        id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <x-greetings />
                        <form action="{{ route('save-template', 'order-place-email') }}" method="post">
                            @csrf
                            <textarea id="{{ $template == 'order-place-email' ? 'editor1' : '' }}" name="template">{{ $templates->where('email_type', 'order-place-email')->first()->content ?? '' }}</textarea>
                            <div class="text-end mt-4">
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade {{ $template == 'invoice-send-email' ? 'show active' : '' }}"
                        id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <x-greetings />
                        <form action="{{ route('save-template', 'invoice-send-email') }}" method="post">
                            @csrf
                            <textarea id="{{ $template == 'invoice-send-email' ? 'editor1' : '' }}" name="template">{{ $templates->where('email_type', 'invoice-send-email')->first()->content ?? '' }}</textarea>
                            <div class="text-end mt-4">
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade {{ $template == 'invoice-paid-email' ? 'show active' : '' }}"
                        id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <x-greetings />
                        <form action="{{ route('save-template', 'invoice-paid-email') }}" method="post">
                            @csrf
                            <textarea id="{{ $template == 'invoice-paid-email' ? 'editor1' : '' }}" name="template">{{ $templates->where('email_type', 'invoice-paid-email')->first()->content ?? '' }}</textarea>
                            <div class="text-end mt-4">
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade {{ $template == 'restock-notification-mail' ? 'show active' : '' }}"
                        id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <x-greetings />
                        <form action="{{ route('save-template', 'restock-notification-mail') }}" method="post">
                            @csrf
                            <textarea id="{{ $template == 'restock-notification-mail' ? 'editor1' : '' }}" name="template">{{ $templates->where('email_type', 'restock-notification-email')->first()->content ?? '' }}</textarea>
                            <div class="text-end mt-4">
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade {{ $template == 'cron-report-email' ? 'show active' : '' }}"
                        id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <x-greetings />
                        <form action="{{ route('save-template', 'cron-report-email') }}" method="post">
                            @csrf
                            <textarea id="{{ $template == 'cron-report-email' ? 'editor1' : '' }}" name="template">{{ $templates->where('email_type', 'cron-report-email')->first()->content ?? '' }}</textarea>
                            <div class="text-end mt-4">
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                    </div>

                </div>


            </div>
        </div>

    </div>
    </div>



@endsection


@section('vendor-script')
    {{-- vendor files --}}
    {{-- <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor1');
    </script>
    <script src="https://cdn.ckeditor.com/[version.number]/[distribution]/ckeditor.js"></script> --}}
    <script src="{{ asset('/custom/tinymce.min.js') }}"></script>
    <script src="{{ asset('/custom/pages/form-editor.init.js') }}"></script>


    <script>
        {{-- $(document).ready(function() {
            $('#editor1').summernote();
        }); --}}
    </script>
@endsection
