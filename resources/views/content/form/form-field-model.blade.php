<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('Add Form Field')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form_field" method="post" onsubmit="return false">
                    <input type="hidden" name="f_id">
                    <input type="hidden" name="f_id" id="f_id">
                    <input type="hidden" value="{{ $id }}" name="form_id">
                    <div class="row">
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">@lang('Field Name')</label>
                            <input type="text" class="form-control" name="field_name" id="field_name"
                                placeholder="Field Name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">@lang('Field Type')</label>
                            <select class="form-control type" id="type" name="type">
                                {{-- <option value="text" selected="">Text</option> --}}
                                <option value="name">Name</option>
                                <option value="number">Number</option>
                                <option value="email">Email</option>
                                <option value="date">Date</option>
                                <option value="phone_plugin">Phone Number Plugin</option>
                                <option value="drop_down">Dropdown</option>
                                <option value="textarea">TextArea</option>
                            </select>
                        </div>
                    </div>

                    <div id="add_fields_placeholderValue">
                        <div class="row">
                            <div class="col-8">
                                <label for="recipient-name" class="col-form-label">@lang('Option Name')</label>
                                <input class="form-control" type="text" name="dropdonwn[]"
                                    id="add_fields_placeholderValue" placeholder="Option Name">
                            </div>
                            <div class="col-3">
                                <button id="addRow" type="button"
                                    class="btn btn-info"style="margin-top: 35px;">+</button>

                            </div>
                        </div>
                    </div>
                    <div id="newRow"></div>
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
