@extends('layouts/contentLayoutMaster')

@section('title', 'Invoice Preview')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
@endsection
@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base/pages/app-invoice.css') }}">
@endsection

@section('content')
    <section class="invoice-preview-wrapper">
        <div class="row invoice-preview">
            <!-- Invoice -->
            <div class="col-xl-12 col-md-12 col-12">
                <div class="card invoice-preview-card">
                    <div class="card-body invoice-padding pb-0">
                        <!-- Header starts -->
                        <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                            <div>
                                <div class="logo-wrapper">
                                    <a class="" href="#">
                                        <img src="{{ URL::asset('custom/img/connect_logo.png') }}" class="auth-logo"
                                            height="64">
                                    </a>
                                </div>
                                <p class="card-text mb-25">Office 149, 450 South Brand Brooklyn</p>
                                <p class="card-text mb-25">San Diego County, CA 91905, USA</p>
                                <p class="card-text mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
                            </div>
                            <div class="mt-md-0 mt-2">
                                @include('content/sale/barcode')
                                <h4 class="invoice-title">
                                    Invoice
                                    <span class="invoice-number">{{ @$data->invoice_code . @$data->invoice_number }}</span>
                                </h4>
                                <div class="invoice-date-wrapper">
                                    <p class="invoice-date-title">Date Issued:</p>
                                    <p class="invoice-date">{{ $data->issue_date }}</p>
                                </div>
                                <div class="invoice-date-wrapper">
                                    <p class="invoice-date-title">Due Date:</p>
                                    <p class="invoice-date">{{ $data->due_date }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Header ends -->
                    </div>
                    <hr class="invoice-spacing" />
                    <!-- Address and Contact starts -->
                    <div class="card-body invoice-padding pt-0">
                        <div class="row invoice-spacing">
                            <div class="col-xl-4 p-0">
                                <h3 class="mb-2">INVOICE TO :</h3>
                                <p class="mb-25"></p>
                                <p class="card-text mb-25">Shelby Company Limited</p>
                                <p class="card-text mb-25">Small Heath, B10 0HF, UK</p>
                                <p class="card-text mb-25">718-986-6062</p>
                                <p class="card-text mb-0">peakyFBlinders@gmail.com</p>
                            </div>
                            <div class="col-xl-4 p-0">
                                <h3 class="mb-2">INVOICE DETAILS :</h3>
                                <p class="mb-25">Issue Date: <span>{{ @$data->issue_date }}</span></p>
                                <p class="card-text mb-25">Expair Date:<span>{{ @$data->due_date }}</span></p>
                                <p class="card-text mb-25">Status:
                                    @if (@$data->status == '0')
                                        <span class="badge rounded-pill  badge-light-info">Drift</span>
                                    @elseif(@$data->status)
                                        <span class="badge rounded-pill  badge-light-success">Drift</span>
                                    @endif
                                </p>
                                <p class="card-text mb-25">
                                    Id:<span>{{ @$data->invoice_code . @$data->invoice_number }}</span></p>
                            </div>
                            <div class="col-xl-4 p-0">
                                <h3 class="mb-2">INVOICE NUMBER :</h3>
                                <h6 class="mb-25"><span
                                        class="badge rounded-pill  badge-light-success">{{ @$data->invoice_code . @$data->invoice_number }}</span>
                                </h6>
                            </div>
                            {{-- <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                <h6 class="mb-2">Payment Details:</h6>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="pe-1">Total Due:</td>
                                            <td><span class="fw-bold">$12,110.55</span></td>
                                        </tr>
                                        <tr>
                                            <td class="pe-1">Bank name:</td>
                                            <td>American Bank</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-1">Country:</td>
                                            <td>United States</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-1">IBAN:</td>
                                            <td>ETD95476213874685</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-1">SWIFT code:</td>
                                            <td>BR91905</td>
                                        </tr>
                                    </tbody>
                                </table> --}}
                        </div>
                    </div>
                </div>
                <!-- Address and Contact ends -->

                <!-- Invoice Description starts -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="py-1">Service</th>
                                <th class="py-1">Duration</th>
                                <th class="py-1">Rate</th>
                                <th class="py-1">Dicount</th>
                                <th class="py-1">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>
                                <td class="py-1">
                                    <p class="card-text fw-bold mb-25">Native App Development</p>
                                    <p class="card-text text-nowrap">
                                        Developed a full stack native app using React Native, Bootstrap & Python
                                    </p>
                                </td>
                                <td class="py-1">
                                    <span class="fw-bold">$60.00</span>
                                </td>
                                <td class="py-1">
                                    <span class="fw-bold">30</span>
                                </td>
                                <td class="py-1">
                                    <span class="fw-bold">$1,800.00</span>
                                </td>
                            </tr>
                            <tr class="border-bottom">
                                <td class="py-1">
                                    <p class="card-text fw-bold mb-25">Ui Kit Design</p>
                                    <p class="card-text text-nowrap">Designed a UI kit for native app using Sketch,
                                        Figma & Adobe XD</p>
                                </td>
                                <td class="py-1">
                                    <span class="fw-bold">$60.00</span>
                                </td>
                                <td class="py-1">
                                    <span class="fw-bold">20</span>
                                </td>
                                <td class="py-1">
                                    <span class="fw-bold">$1200.00</span>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>

                <div class="card-body invoice-padding pb-0">
                    <div class="row invoice-sales-total-wrapper">
                        <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                            <p class="card-text mb-0">
                                <span class="fw-bold">Salesperson:</span> <span class="ms-75">Connected</span>
                            </p>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                            <div class="invoice-total-wrapper">
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Subtotal:</p>
                                    <p class="invoice-total-amount">${{ @$data->sub_total_amount }}</p>
                                </div>
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Discount:</p>
                                    <p class="invoice-total-amount"></p>
                                </div>
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Tax:</p>
                                    <p class="invoice-total-amount"></p>
                                </div>
                                <hr class="my-50" />
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Total:</p>
                                    <p class="invoice-total-amount">${{ @$data->sub_total_amount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Invoice Description ends -->

                <hr class="invoice-spacing" />

                <!-- Invoice Note starts -->
                <div class="card-body invoice-padding pt-0">
                    <div class="row">
                        <div class="col-12">
                            {{-- <span class="fw-bold">Note:</span> --}}
                            {{-- <span>It was a pleasure working with you and your team. We hope you will keep us in mind for
                                future freelance
                                projects. Thank You!</span> --}}
                        </div>
                    </div>
                </div>
                <!-- Invoice Note ends -->
            </div>
        </div>
        <!-- /Invoice -->

        <!-- Invoice Actions -->
        {{-- <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-primary w-100 mb-75" data-bs-toggle="modal"
                            data-bs-target="#send-invoice-sidebar">
                            Send Invoice
                        </button>
                        <button class="btn btn-outline-secondary w-100 btn-download-invoice mb-75">Download</button>
                        <a class="btn btn-outline-secondary w-100 mb-75" href="{{ url('app/invoice/print') }}"
                            target="_blank"> Print </a>
                        <a class="btn btn-outline-secondary w-100 mb-75" href="{{ url('app/invoice/edit') }}"> Edit </a>
                        <button class="btn btn-success w-100" data-bs-toggle="modal"
                            data-bs-target="#add-payment-sidebar">
                            Add Payment
                        </button>
                    </div>
                </div>
            </div>
            <!-- /Invoice Actions -->
        </div> --}}
    </section>

    <!-- Send Invoice Sidebar -->
    {{-- <div class="modal modal-slide-in fade" id="send-invoice-sidebar" aria-hidden="true">
        <div class="modal-dialog sidebar-lg">
            <div class="modal-content p-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title">
                        <span class="align-middle">Send Invoice</span>
                    </h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <form>
                        <div class="mb-1">
                            <label for="invoice-from" class="form-label">From</label>
                            <input type="text" class="form-control" id="invoice-from" value="shelbyComapny@email.com"
                                placeholder="company@email.com" />
                        </div>
                        <div class="mb-1">
                            <label for="invoice-to" class="form-label">To</label>
                            <input type="text" class="form-control" id="invoice-to" value="qConsolidated@email.com"
                                placeholder="company@email.com" />
                        </div>
                        <div class="mb-1">
                            <label for="invoice-subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="invoice-subject"
                                value="Invoice of purchased Admin Templates" placeholder="Invoice regarding goods" />
                        </div>
                        <div class="mb-1">
                            <label for="invoice-message" class="form-label">Message</label>
                            <textarea class="form-control" name="invoice-message" id="invoice-message" cols="3" rows="11"
                                placeholder="Message..."> --}}
    {{-- Dear Queen Consolidated,

Thank you for your business, always a pleasure to work with you!

We have generated a new invoice in the amount of $95.59

We would appreciate payment of this invoice by 05/11/2019</textarea
            >
          </div> --}}
    {{-- <div class="mb-1">
            <span class="badge badge-light-primary">
              <i data-feather="link" class="me-25"></i>
              <span class="align-middle">Invoice Attached</span>
            </span>
          </div>
          <div class="mb-1 d-flex flex-wrap mt-2">
            <button type="button" class="btn btn-primary me-1" data-bs-dismiss="modal">Send</button>
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> --}}
    <!-- /Send Invoice Sidebar -->

    <!-- Add Payment Sidebar -->
    {{-- <div class="modal modal-slide-in fade" id="add-payment-sidebar" aria-hidden="true">
  <div class="modal-dialog sidebar-lg">
    <div class="modal-content p-0">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
      <div class="modal-header mb-1">
        <h5 class="modal-title">
          <span class="align-middle">Add Payment</span>
        </h5>
      </div>
      <div class="modal-body flex-grow-1">
        <form>
          <div class="mb-1">
            <input id="balance" class="form-control" type="text" value="Invoice Balance: 5000.00" disabled />
          </div>
          <div class="mb-1">
            <label class="form-label" for="amount">Payment Amount</label>
            <input id="amount" class="form-control" type="number" placeholder="$1000" />
          </div>
          <div class="mb-1">
            <label class="form-label" for="payment-date">Payment Date</label>
            <input id="payment-date" class="form-control date-picker" type="text" />
          </div>
          <div class="mb-1">
            <label class="form-label" for="payment-method">Payment Method</label>
            <select class="form-select" id="payment-method">
              <option value="" selected disabled>Select payment method</option>
              <option value="Cash">Cash</option>
              <option value="Bank Transfer">Bank Transfer</option>
              <option value="Debit">Debit</option>
              <option value="Credit">Credit</option>
              <option value="Paypal">Paypal</option>
            </select>
          </div> --}}
    <form action="{{ route('invoice.send') }}" method="post">
        @csrf
        <input type="hidden" value="{{ $data->user_id }}" name="id">
        <input type="hidden" value="{{ $data->id }}" name="in_id">
        <div class="mb-1">
            <label class="form-label" for="payment-note">Internal Payment Note</label>
            <textarea class="form-control" id="payment-note" rows="5" placeholder="Internal Payment Note"></textarea>
        </div>
        <div class="d-flex flex-wrap mb-0">
            <button type="submit" class="btn btn-primary me-1" data-bs-dismiss="modal">Send</button>
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
    </form>
    </div>
    </div>
    </div>
    </div>
    <!-- /Add Payment Sidebar -->
@endsection

@section('vendor-script')
    <script src="{{ asset('vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('js/scripts/pages/app-invoice.js') }}"></script>
@endsection
