<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action={{ $action }} method="post">

        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        @csrf
                        <label for="enable">Enable</label>
                        <input type="checkbox" class="custom-switch" value="1" name="enable" id="enable"
                            {{ $status ? ($status->active == 1 ? 'checked' : '') : '' }}>
                    </div>
                    <div class="form-group mb-3">
                        <label for="client_id" class="form-label ">Client Id</label>
                        <div class="col-12"> <input type="text" class="form-control" id="token" name="client_id"
                                autocomplete="off" value="{{ $attributes->get('pluginID') }}"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="client_secret" class="form-label">Client Secret Key</label>
                        <div class="col-12"><input type="text" class="form-control" id="key"
                                name="client_secret" autocomplete="off"
                                value="{{ $attributes->get('pluginSecret') }}"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </div>

            </div>
        </div>
    </form>
</div>
