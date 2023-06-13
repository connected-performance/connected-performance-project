<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset(mix('vendors/js/ui/jquery.sticky.js'))}}"></script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>
<script src="{{ asset(mix('js/core/app.js')) }}"></script>

<!-- custome scripts file for user -->
<script src="{{ asset(mix('js/core/scripts.js')) }}"></script>

@if($configData['blankPage'] === false)
<script src="{{ asset(mix('js/scripts/customizer.js')) }}"></script>
@endif
<script type="text/javascript">
    function show_note_modal() {
        $("#create_note_customer").modal("show")
    }

    $("#submit_note").submit(function(event) {
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let formData = new FormData(this);
        $.ajax({
            url: "{{ route('panel.user.note.save') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                var isRtl = $('html').attr('data-textdirection') === 'rtl';
                if (response.status == "success") {
                    $("#create_note_customer").modal('hide');
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
<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->
