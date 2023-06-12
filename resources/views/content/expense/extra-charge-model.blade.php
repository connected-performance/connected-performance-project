<style>
    select.form-control:not([size]):not([multiple]) {
        height: calc(2.25rem + 8px);
    }
</style>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('Create Invoice')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="submit_form" class="form_field" method="post">

                    <input type="hidden" name="f_id">
                    <input type="hidden" name="f_id" id="f_id">
                    {{-- <input type="hidden" value="{{ $id }}" name="form_id"> --}}
                    <input type="hidden" class="form-control" name="user_id" id="dus_user_id" placeholder="" required>
                    <input type="hidden" class="form-control" name="issue_dates" id="issue_dates" placeholder=""
                        required>
                    <div class="row">
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">@lang('Customer')</label>
                            <select class="form-control type slector" id="user_id" name="user_id" required>
                                <option value="">Select Customer</option>
                                @foreach (@$users as $value)
                                    <option value="{{ @$value->id }}">{{ @$value->first_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">@lang('Cost')</label>
                            <input type="number" class="form-control" name="price" id="du_price" placeholder="Cost"
                                required>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">@lang('Issue Date')</label>
                            <input type="date" class="form-control" name="issue_date" id="issue_date"
                                placeholder="Issue Date" required>
                        </div>
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">@lang('Due Date')</label>
                            <input type="date" class="form-control" name="due_date" id="due_date"
                                placeholder="Issue Date" required>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">@lang('Description')</label>
                            <textarea class="form-control" name="description" id="description" placeholder="Description" required></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div> <!-- end preview-->
