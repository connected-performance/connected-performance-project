<!--/ add new card modal  -->
<div class="modal" id="create_payment" tabindex="-1" role="dialog">
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
                    <input type="hidden" value="0" name="payment_id" id="payment_id">


                    <div class="row mb-2">
                        <div class="col">
                            <label for="email">Select Emaployee</label>
                            <select class="form-control type" id="drop_down" name="drop_down" required="">
                                <option value="">Select Employee </option>
                                @forelse (@$user as $value)
                                    <option value="{{ @$value->employee->id }}">{{ @$value['first_name'] }} </option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="col">
                            <label for="phone">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount"
                                placeholder="Amount">
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
