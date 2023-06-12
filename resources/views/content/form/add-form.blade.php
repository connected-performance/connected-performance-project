<!-- add new card modal  -->
<div class="modal fade" id="addNewCard" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 mx-50 pb-5">
                <h1 class="text-center mb-1" id="addNewCardTitle1">Add New Form</h1>
                <!-- form -->
                <form id="add-new-form" class="row gy-1 gx-2 mt-75" onsubmit="return false">
                    <input type="hidden" id="form_id" name="form_id">
                    <div class="col-12">
                        <label class="form-label" for="modalAddCardNumber">Form Name</label>
                        <div class="">
                            <input id="form_name" name="form_name" class="form-control" placeholder="Form Name" />
                            </span>
                        </div>
                    </div>
                    <div class="demo-inline-spacing form-check-success">
                        <label class="form-check-label" for="inlineRadio1">Active</label>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="active" id="inlineRadio1"
                                value="1" checked />
                            <label class="form-check-label" for="inlineRadio1">On</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="active" id="inlineRadio2"
                                value="0" />
                            <label class="form-check-label" for="inlineRadio2">Off</label>
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success me-1 mt-1">Save</button>
                            <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal"
                                aria-label="Close">
                                Cancel
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ add new card modal  -->
