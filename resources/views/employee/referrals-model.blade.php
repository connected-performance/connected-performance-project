<!--/ add new card modal  -->
<div class="modal" id="create_referrals" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $modal }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="submit_form" enctype='multipart/form-data' method="POST">
                    @csrf
                    {{-- <input type="hidden" value="{{ $role->id }}" name="user_role" id="role_id"> --}}
                    <input type="hidden" value="0" name="lead_id" id="lead_id">

                    <div class="row mb-2">
                        <div class="col">
                            <label for="email">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                        </div>
                        <div class="col">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email">
                        </div>
                    </div>
                    <div class="row mb-2">

                        <div class="col">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                placeholder="Phone Number">
                        </div>
                        <div class="col">
                            <label for="email">Select Services</label>
                            <select class="form-control type" id="drop_down" name="drop_down" required="">
                                <option value="">Select Your Answer </option>
                                <option value="1_on_1_training">
                                    1 on 1 training</option>
                                <option value="consulting">
                                    Consulting</option>
                                <option value="connect_sofware">
                                    Connect Sofware</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12">
                            <label for="confirm-password">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light " data-bs-dismiss="modal">Close</button>
                <button type="submit" type="button" class="btn btn-success">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>
