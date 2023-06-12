<div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Schedual</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('lead.schedual.metting') }}" method="POSt" id="show-lead"
                    class="row gy-1 gx-2 mt-75">
                    @csrf
                    <input type="hidden" id="lead_id" name="lead_id" />
                    <div class="col-12">
                        <label class="form-label" for="name">Name</label>
                        <div class="input-group input-group-merge">
                            <input id="customer-name" name="customer-name" class="form-control" disabled />
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="email">Email</label>
                        <div class="input-group input-group-merge">
                            <input type="text" id="email" name="customer-email" class="form-control" disabled />
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="meeting-date">Meeting Date</label>
                        <div class="input-group input-group-merge">
                            <input type="date" id="meeting-date" name="meeting-date" class="form-control"
                                placeholder="SelectDate" />
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="Meeting-time">Meeting Time</label>
                        <div class="input-group input-group-merge">
                            <input type="time" id="meeting-time" name="meeting-time" class="form-control"
                                placeholder="Set Time for Meeting" />
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Login</button>
                <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Send</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
