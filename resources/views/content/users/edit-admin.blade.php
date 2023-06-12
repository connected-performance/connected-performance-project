
<!--/ add new card modal  -->
<div class="modal" id="editUser" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" method="">
                @csrf

                <div class="row">
                  <div class="col">
                    <label for="first_name" >First Name</label>
                    <input type="text" class="form-control" id="first_name"  >
                  </div>
                  <div class="col">
                    <label for="last_name" >Last Name</label>
                    <input type="text" class="form-control"   id="last_name">
                  </div>
                </div>

                <div class="row mt-2">
                  <div class="col">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" >
                  </div>
                  <div class="col">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control"  id="phone">
                  </div>
                </div>

                <div class="row mt-2">
                    <div class="col">
                      <label for="email">Address</label>
                      <input type="text" class="form-control" id="address">
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
