<!--/ add new card modal  -->
<div class="modal" id="addservice" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $modal }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="submit_form" enctype='multipart/form-data'
                    method="POST">
                    @csrf
                    {{-- <input type="hidden" value="{{ $role->id }}" name="user_role" id="role_id"> --}}
                    <input type="hidden" value="0" name="service_id" id="service_id">
                    <div class="row mb-2">
                        <div class="col">
                            <label for="first_name">Service Nam</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Service Name">
                        </div>
                        <div class="col">
                            <label for="last_name">Service Price</label>
                            <input type="number" class="form-control" id="price" name="price"
                                placeholder="Price">
                        </div>
                    </div>
                    <div class="col">
                        <label for="role" class="ml-3">Service Status</label>

                        <div class="form-check-success form-check-inline mr-3">
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio1"
                                value="1" checked />
                            <label class="form-check-label" for="inlineRadio1">Active</label>
                        </div>

                        <div class="form-check-success form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio2"
                                value="0" />
                            <label class="form-check-label" for="inlineRadio2">Banned</label>
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light " data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-success">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>
