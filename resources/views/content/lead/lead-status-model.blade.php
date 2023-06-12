<!-- pricing modal  -->

<div class="modal fade" id="pricingModal" tabindex="-1" aria-labelledby="pricingModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <style>
                .bs-stepper-box {
                    width: 200px;
                    height: 40px;
                    position: relative;
                    background: #28c76f;
                }

                /* .bs-stepper-box:before {
                    content: "";
                    position: absolute;
                    left: 0;
                    bottom: 0;
                    width: 0;
                    height: 0;
                    border-left: 20px solid white;
                    border-top: 20px solid transparent;
                    border-bottom: 20px solid transparent;
                } */
                .bs-stepper-box:after {
                    /* content:  ""; */
                    position: absolute;
                    right: 0px;
                    /* bottom: -1px; */
                    /* width: 0; */
                    /* height: 0; */
                    /* border-left: 20px solid #28c76f; */
                    /* border-top: 20px solid transparent; */
                    /* border-bottom: 20px solid transparent; */
                }

                svg.font-medium-2 {
                    height: 5rem !important;
                    width: 5rem !important;
                }

                .bs-stepper .bs-stepper-header .step .step-trigger .bs-stepper-box {
                    /* border-bottom-left-radius: 25rem !important; */
                    /* border-top-left-radius: 25rem !important; */
                    background-color: rgba(186, 191, 199, 0.30);
                    width: 100px;
                    /* border: 1px solid #d8d7d7; */
                }

                /* .bs-stepper .bs-stepper-header .step.active .step-trigger .bs-stepper-box */
                .bs-stepper hr {
                    width: 5%;
                    height: 5px;
                    color: #71eba8;
                }

                @media (min-width: 993px) and (max-width: 1200px) {}

                @media (min-width: 769px) and (max-width: 992px) {
                    .bs-stepper .bs-stepper-header {
                        flex-direction: row;
                    }
                }

                @media (min-width: 577px) and (max-width: 768px) {
                    .bs-stepper .bs-stepper-header {
                        flex-direction: row;
                    }
                }

                @media (min-width: 426px) and (max-width: 576px) {
                    .bs-stepper .bs-stepper-header {
                        flex-direction: row;
                    }

                    .logo-heading {
                        font-size: 18px;
                    }
                }

                @media (min-width: 376px) and (max-width: 425px) {
                    .bs-stepper .bs-stepper-header {
                        flex-direction: row;
                    }

                    .logo-heading {
                        font-size: 16px;
                    }
                }

                @media (min-width: 320px) and (max-width: 375px) {
                    .bs-stepper .bs-stepper-header {
                        flex-direction: row;
                    }

                    .logo-heading {
                        font-size: 15px;
                    }

                    .fs-12 {
                        font-size: 12px;
                    }
                }

                textarea.custom-notes {
                    min-height: 13.714rem;
                }
            </style>

            <div class="bg-light px-2">
                <div class="row">
                    <div class="col-lg-12 col-12 px-1 pt-1">
                        <div class="d-flex">
                            {{-- ----- logo image ----- --}}
                            <img src="{{ asset('https://um8.salesforce.com/img/icon/t4v35/standard/lead_120.png') }}"
                                alt="svg img" width="50" height="50" class=""
                                style="background-color: #28c76f" />

                            {{-- ----- heading image ----- --}}
                            <div class="ps-1">
                                <p class="mb-0">LEAD</p>
                                <h1 class="mb-0 logo-heading" id="top-mail">
                                    email@gmail.com</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-6 py-2">
                        <p class="mb-0 fs-12">NAME</p>
                        <p class="mb-0 fs-12" id="lower-name">Lead Name</p>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-6 py-2">
                        <p class="mb-0 fs-12">EMAIL</p>
                        <p class="mb-0 fs-12 overflow-hidden" id="lower-mail">User Mail</p>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-6 py-2">
                        <p class="mb-0 fs-12">PHONE</p>
                        <p class="mb-0 fs-12" id="lower-phone">+123254656</p>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-6 py-2">
                        <p class="mb-0 fs-12">SERVICES</p>
                        <p class="mb-0 fs-12" id="lower-service">Service</p>
                    </div>
                </div>
            </div>

            <div class="row pricing-card">
                <!-- basic plan -->
                <div class="col-lg-12 col-12">
                    <div class="card basic-pricing border shadow-none">
                        <div class="card-body">
                            <div class="bs-stepper wizard-modern modern-wizard-example">

                                <div class="bs-stepper-header py-0" id="pointer">
                                    <div class="step my-0" data-target="#account-details-modern" role="tab"
                                        id="account-details-modern-trigger">
                                        <button type="button" class="step-trigger" onclick="working_step(0)">
                                            <span class="bs-stepper-box shadow-none rounded-pill py-1"
                                                style="width:px;">
                                                <i data-feather='check'></i>
                                            </span>
                                        </button>
                                    </div>

                                    <hr>

                                    <div class="step my-0" data-target="#personal-info-modern" role="tab"
                                        id="personal-info-modern-trigger">
                                        <button type="button" class="step-trigger" onclick="working_step(1)">
                                            <span class="bs-stepper-box shadow-none rounded-pill" style="width:px;">
                                                <p class="mb-0">Working</p>
                                            </span>
                                        </button>
                                    </div>

                                    <hr>

                                    <div class="step my-0" data-target="#address-step-modern" role="tab"
                                        id="address-step-modern-trigger">
                                        <button type="button" class="step-trigger" onclick="working_step(2)">
                                            <span class="bs-stepper-box shadow-none rounded-pill" style="width:px;">
                                                <p class="mb-0">Completed</p>
                                            </span>
                                        </button>
                                    </div>
                                </div>

                                <div class="bs-stepper-content mt-4">

                                    <div id="account-details-modern" class="content" role="tabpanel"
                                        aria-labelledby="account-details-modern-trigger">
                                        <div class="content-header">
                                            {{-- ----- button 1 content ----- --}}
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
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
                                                                    <td class="name-for-table">user</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Email</td>
                                                                    <td class="email-for-table">user@example.com</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Mobile</td>
                                                                    <td class="phone">+9542369842</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Service</td>
                                                                    <td class="service">Service</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <div class="card shadow-none bg-light">
                                                        <div class="card-header">
                                                            <h4>Descriptions</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <p class="show_description" id="show_description"></p>
                                                            <input type="hidden" id="note_lead_id">
                                                            <div class="row mb-2">
                                                                <div class="col-12">
                                                                    <label for="confirm-password">Notes</label>
                                                                    <textarea class="form-control notes1 custom-notes" id="notes" name="notes"></textarea>
                                                                </div>
                                                            </div>
                                                            <button type="button"
                                                                class="btn btn-success waves-effect waves-float waves-light"
                                                                onclick="save_note()">Save</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div id="personal-info-modern" class="content" role="tabpanel"
                                        aria-labelledby="personal-info-modern-trigger">
                                        {{-- ----- button 2 content ----- --}}
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
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
                                                                <td class="name-for-table">user</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email</td>
                                                                <td class="email-for-table">user@example.com</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Mobile</td>
                                                                <td class="phone">+9542369842</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Service</td>
                                                                <td class="service">Service</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                                <div class="card shadow-none bg-light">
                                                    <div class="card-header">
                                                        <h4>Descriptions</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="show_description" id="show_description"></p>
                                                        {{-- <input type="hidden" id="note_lead_id"> --}}
                                                        <div class="row mb-2">
                                                            <div class="col-12">
                                                                <label for="confirm-password">Notes</label>
                                                                <textarea class="form-control notes2 custom-notes" id="notes" name="notes"></textarea>
                                                            </div>
                                                        </div>
                                                        {{-- <button type="button"
                                                            class="btn btn-success waves-effect waves-float waves-light"
                                                            onclick="save_note()">Save</button> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="address-step-modern" class="content" role="tabpanel"
                                        aria-labelledby="address-step-modern-trigger">
                                        <div class="content-header">
                                            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                                <div class="card shadow-none bg-light">
                                                    <div class="card-header">
                                                        <h4>Descriptions</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="show_description" id="show_description"></p>

                                                        <input type="hidden" id="note_lead_id">
                                                        <div class="row mb-2">
                                                            <div class="col-12">
                                                                <label for="confirm-password">Notes</label>
                                                                <textarea class="form-control notes3 custom-notes" id="notes" name="notes"></textarea>
                                                            </div>
                                                        </div>
                                                        {{-- <button type="button"
                                                            class="btn btn-success waves-effect waves-float waves-light"
                                                            onclick="save_note()">Save</button> --}}
                                                    </div>
                                                </div>
                                            </div>
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
