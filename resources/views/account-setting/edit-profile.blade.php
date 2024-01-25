<!-- Edit User Modal -->
<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Edit User Information</h1>
                    <p>Updating user details will receive a privacy audit.</p>
                </div>
                <form id="submit_form" action="{{ route('update.user.profile') }}" enctype='multipart/form-data'
                    method="POST">
                    @csrf
                    <input type="hidden" value="0" name="u_id" id="u_id">
                    <div class="row mb-2">
                        <div class="col">
                            <div class="logo-content">
                                <a href="#">
                                    <div id="img_div">
                                        <img id="favicon" alt="your image"
                                            src="{{ asset('images/avatars/male.png') }}" class="big-logo" height="100"
                                            width="100">
                                    </div>

                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="logo" class="form-label"> Choose file here </label>
                                <input type="file" name="avatar" id="logo" class="form-control file"
                                    data-filename="edit-logo" accept=".jpeg,.jpg,.png"
                                    onchange="document.getElementById('favicon').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="modalEditUserFirstName">First Name</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="modalEditUserLastName">Last Name</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="modalEditUserName">Username</label>
                                <input type="text" name="user_name" class="form-control" id="user_name" required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="modalEditUserEmail"> Email</label>
                                <input type="text" name="email" class="form-control" id="email" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="modalEditUserPhone">Contact</label>
                                <input type="number" name="phone_number" class="form-control " id="phone_number"
                                    required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="modalEditUserPhone">address</label>
                                <input type="text" name="address" class="form-control" id="address" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="modalEditUserPhone">Date Of Birth</label>
                                <input type="date" name="dob" class="form-control" id="dob" required />
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12 text-center mt-2 pt-50">
                                <button type="submit" class="btn btn-success me-1">Save Change</button>
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
