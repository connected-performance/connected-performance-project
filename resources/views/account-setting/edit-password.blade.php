<!-- Edit User Modal -->
<div class="modal fade" id="editPass" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Edit Password Information</h1>
                </div>
                <form id="submit_form_pass" action="{{ route('update.user.profile') }}" enctype='multipart/form-data'
                    method="POST">
                    @csrf
                    <input type="hidden" value="0" name="u_id" id="u_id">
                    <div class="row mb-2">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label" for="modalCurrentPassword">Current Password</label>
                                <input type="text" id="current_password" name="current_password" class="form-control" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="modalNewPassword">New Password</label>
                                <input type="text" name="password" class="form-control" id="password" required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="modalConfirmPassword">Confirm Password</label>
                                <input type="text" name="password_confirmation" class="form-control" id="password_confirmation" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center mt-2 pt-50">
                                <button type="submit" class="btn btn-success me-1">Change Password</button>
                                <button type="password" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    Discard
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Edit User Modal -->
