<!-- pricing modal  -->

<div class="modal fade" id="pricingModal" tabindex="-1" aria-labelledby="pricingModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-12 col-lg-12 border bg-light">
                <div class="d-flex">
                    <img src="{{ asset('https://um8.salesforce.com/img/icon/t4v35/standard/lead_120.png') }}"
                        class="float-right" alt="svg img" width="50" height="50"
                        style="margin-left: 15px;margin-top: 30px; background-color: #28c76f" />


                    <div class="">
                        <p class="mb-0" style="margin-left: 7px;margin-top: 27px;">LEAD</p>
                        <h1 class="mb-0" style="margin-left: 7px;" id="top-mail">
                            email@gmail.com</h1>
                    </div>
                </div>
                <div class="container">
                    <div class="row mt-2">
                        <div class="col-3 px-sm-5 pb-5">
                            <p class="mb-0">NAME</p>
                            <p class="mb-0" id="lower-name">Lead Name</p>
                        </div>
                        <div class="col-3 px-sm-5 pb-5">
                            <p class="mb-0">EMAIL</p>
                            <p class="mb-0" id="lower-mail">User Mail</p>
                        </div>
                        <div class="col-3 px-sm-5 pb-5">
                            <p class="mb-0">PHONE</p>
                            <p class="mb-0" id="lower-phone">+123254656</p>
                        </div>
                        <div class="col-3 px-sm-5 pb-5">
                            <p class="mb-0">SERVICES</p>
                            <p class="mb-0" id="lower-service">Service</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pricing-card">
                <!-- basic plan -->
                <div class="col-12 col-lg-12">
                    <div class="card basic-pricing border shadow-none">
                        <div class="card-body">

                            <div class="bs-stepper wizard-modern modern-wizard-example">
                                <div class="bs-stepper-header">
                                    <div class="step" data-target="#account-details-modern" role="tab"
                                        id="account-details-modern-trigger">
                                        <button type="button" class="step-trigger">
                                            <span class="bs-stepper-box" style="width:100px;">
                                                <i data-feather='check'></i>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="line">
                                        <i data-feather="chevron-right" class="font-medium-2"></i>
                                    </div>
                                    <div class="step active" data-target="#personal-info-modern" role="tab"
                                        id="personal-info-modern-trigger">
                                        <button type="button" class="step-trigger">
                                            <span class="bs-stepper-box" style="width:100px;">
                                                <p class="mb-0">Contract</p>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="line">
                                        <i data-feather="chevron-right" class="font-medium-2"></i>
                                    </div>
                                    {{-- <div class="step" data-target="#address-step-modern" role="tab"
                                        id="address-step-modern-trigger">
                                        <button type="button" class="step-trigger">
                                            <span class="bs-stepper-box" style="width:100px;">
                                                <p class="mb-0">Completed</p>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="line">
                                        <i data-feather="chevron-right" class="font-medium-2"></i>
                                    </div> --}}
                                </div>
                                <div class="bs-stepper-content">
                                    <div id="account-details-modern" class="content" role="tabpanel"
                                        aria-labelledby="account-details-modern-trigger">
                                        <div class="content-header">
                                            <div class="row">
                                                <div class="col-6 my-2">
                                                    <h5 class="mb-1">Table without card</h5>
                                                    <div class="table-responsive" id="table-without-card">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Key Fields</th>
                                                                    <th></th>
                                                                    {{-- <th>Users</th>
                                                                    <th>Status</th>
                                                                    <th>Actions</th> --}}
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Name</td>
                                                                    <td id="name">user</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Email</td>
                                                                    <td id="email">user@example.com</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Mobile</td>
                                                                    <td id="phone">+9542369842</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Service</td>
                                                                    <td id="service">Service</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-xl-4 mb-0 bg-light"
                                                    style="
    margin-top: 53px;
">
                                                    <div class="card shadow-none bg-transparent">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Primary card title</h4>
                                                            <p class="card-text">Some quick example text to build on
                                                                the card title and make up.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div id="personal-info-modern" class="content" role="tabpanel"
                                        aria-labelledby="personal-info-modern-trigger">
                                        <div class="row">
                                            <div class="col-6 my-2">
                                                <div class="content-header">
                                                    <table id="datatable" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>User</th>
                                                                <th class="col-3">Pending</th>
                                                                <th class="col-3">Completed</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td id="mech_name">Test</td>
                                                                <td>
                                                                    <div
                                                                        class="form-check-success form-check-inline mr-3">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="status" id="inlineRadio1"
                                                                            value="1" checked />

                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div
                                                                        class="form-check-success form-check-inline mr-3">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="status" id="inlineRadio1"
                                                                            value="1" checked />
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-4 mb-0 bg-light" style="  margin-top: 21px;">
                                                <div class="card shadow-none bg-transparent">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Primary card title</h4>
                                                        <p class="card-text">Some quick example text to build on
                                                            the card title and make up.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="address-step-modern" class="content" role="tabpanel"
                                        aria-labelledby="address-step-modern-trigger">
                                        <div class="content-header">
                                            {{-- <div class="row">
                                                <div class="col-6 my-2">
                                                    <h5 class="mb-1">Table without card</h5>
                                                    <div class="table-responsive" id="table-without-card">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Key Fields</th>
                                                                    <th></th>
                                                                    {{-- <th>Users</th>
                                                                    <th>Status</th>
                                                                    <th>Actions</th> -
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Name</td>
                                                    <td id="name">user</td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td id="email">user@example.com</td>
                                                </tr>
                                                <tr>
                                                    <td>Mobile</td>
                                                    <td id="phone">+9542369842</td>
                                                </tr>
                                                <tr>
                                                    <td>Service</td>
                                                    <td id="service">Service</td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xl-4 mb-0 bg-light" style="margin-top: 53px;">
                                        <div class="card shadow-none bg-transparent">
                                            <div class="card-body">
                                                <h4 class="card-title">Primary card title</h4>
                                                <p class="card-text">Some quick example text to build on
                                                    the card title and make up.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                        </div>

                                    </div>
                                    <div id="social-links-modern" class="content" role="tabpanel"
                                        aria-labelledby="social-links-modern-trigger">
                                        <div class="content-header">
                                            <h5 class="mb-0">Social Links</h5>
                                            <small>Enter Your Social Links.</small>
                                        </div>
                                        <div class="row">
                                            <div class="mb-1 col-md-6">
                                                <label class="form-label" for="modern-twitter">Twitter</label>
                                                <input type="text" id="modern-twitter" class="form-control"
                                                    placeholder="https://twitter.com/abc" />
                                            </div>
                                            <div class="mb-1 col-md-6">
                                                <label class="form-label" for="modern-facebook">Facebook</label>
                                                <input type="text" id="modern-facebook" class="form-control"
                                                    placeholder="https://facebook.com/abc" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-1 col-md-6">
                                                <label class="form-label" for="modern-google">Google+</label>
                                                <input type="text" id="modern-google" class="form-control"
                                                    placeholder="https://plus.google.com/abc" />
                                            </div>
                                            <div class="mb-1 col-md-6">
                                                <label class="form-label" for="modern-linkedin">Linkedin</label>
                                                <input type="text" id="modern-linkedin" class="form-control"
                                                    placeholder="https://linkedin.com/abc" />
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <button class="btn btn-primary btn-prev">
                                                <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                            </button>
                                            <button class="btn btn-success btn-submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--/ pricing plan cards -->

                <!-- pricing free trial -->
                {{-- <div class="text-center">
                    <p>Still not convinced? Start with a 14-day FREE trial!</p>
                    <button class="btn btn-primary">Start your trial</button>
                </div> --}}
                <!--/ pricing free trial -->
            </div>
        </div>
    </div>
