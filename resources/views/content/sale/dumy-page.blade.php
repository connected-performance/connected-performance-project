<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
</head>

<style>
    .padding {

        padding: 5rem !important;
    }



    .form-control:focus {
        box-shadow: 10px 0px 0px 0px #ffffff !important;
        border-color: #4ca746;
    }

    .btn-success {
        color: #fff;
        background-color: #28c76f;
        border-color: #28c76f;
    }

    body {

        background-color: #020202;

    }

    .padding {
        padding: 5rem !important;
        margin-top: 10%;
    }

    .form-group label {
        padding-bottom: 10px;
    }

    .form-control:focus {
        color: #293240;
        background-color: #ffffff;
        border-color: #28c76f;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgb(40 199 111 / 25%);
    }

    .btn-success {
        color: #ffffff;
        background-color: #28c76f;
        border-color: #28c76f;
    }

    .btn-success:hover {
        background-color: #28c76f;
        border-color: #28c76f;
        box-shadow: 0 0 10px 1px rgb(40 199 111) !important;
    }
</style>

<body>
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/3.0.0/jquery.payment.min.js"></script> --}}
    <div class="padding" style="margin-top: 0% !important;">
        <div class="row">
            <div class="container-fluid d-flex justify-content-center">
                <div class="col-sm-8 col-md-6" style="margin-bottom: 20px;">
                    <center>
                        <img src="{{ asset('custom/img/connect_logo.png') }}" class="auth-logo" height="64">
                    </center>
                </div>
            </div>
            <div class="container-fluid d-flex justify-content-center">
                <div class="col-sm-8 col-md-6">
                    <div class="alert alert-info" role="alert">
                      You are using a secure payment link.
                    </div>
                    <div class="card">
                        <div class="card-header">

                            <div class="row">
                                <div class="col-md-6">
                                    <span>CREDIT/DEBIT CARD PAYMENT</span>

                                </div>

                                <div class="col-md-6 text-right" style="margin-top: -5px;">

                                    {{-- <img src="https://img.icons8.com/color/36/000000/visa.png">
                                    <img src="https://img.icons8.com/color/36/000000/mastercard.png">
                                    <img src="https://img.icons8.com/color/36/000000/amex.png"> --}}

                                </div>

                            </div>

                        </div>
                        @if (Session::has('error'))
                            <div class="alert alert-danger" role="alert" style="margin: 10px;">
                                <div class="alert-text">{{ Session::get('error') }}</div>
                            </div>
                        @endif
                        <form action="{{ route('invoice.transaction') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ @$invoice->balance }}" name="balance">
                            <input type="hidden" value="{{ @$invoice->id }}" name="invoice_id">
                            <input type="hidden" value="{{ @$user->id }}" name="user_id">
                            <div class="card-body" style="height: 330px">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cc-number" class="control-label">AMOUNT</label>
                                            <input id="cc-number" type="" name="balance"
                                                value="{{ '$' . @$invoice->balance }}"
                                                class="input-lg form-control cc-number" autocomplete="cc-number"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cc-number" class="control-label">CARD NUMBER</label>
                                            <input id="cc-number" type="tel" class="input-lg form-control cc-number"
                                                name="card_number" autocomplete="cc-number"
                                                placeholder="&bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull;"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cc-exp" class="control-label">Expiration Date</label>
                                            <input id="cc-exp" type="tel" class="input-lg form-control cc-exp"
                                                name="exp_date" autocomplete="cc-exp"
                                                placeholder="10/25" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cc-cvc" class="control-label">CARD CVV</label>
                                            <input id="cc-cvc" type="tel" class="input-lg form-control cc-cvc"
                                                autocomplete="off" placeholder="&bull;&bull;&bull;&bull;"
                                                name="cvc_number" required>
                                        </div>
                                    </div>

                                </div>


                                <div class="form-group">
                                    <label for="numeric" class="control-label">CARD HOLDER NAME</label>
                                    <input type="text" class="input-lg form-control" name="card_honer" required>
                                </div>
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" style="margin-top: 10px;" required>
                                <label class="form-check-label" for="flexCheckDefault" style="margin-top: 5px;">
                                    I agree to have read the <a href="{{ route('invoice.terms') }}" target="_blank">terms and conditions</a> to make my payments
                                </label>
                                <br>
                                <div class="form-group" style="margin-top: 10px;">
                                    <input value="MAKE PAYMENT" type="submit"
                                        class="btn btn-success btn-lg form-control" style="font-size: .8rem;" required>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/extensions/ext-component-toastr.js')) }}"></script>
<script>
    let status = "{{ session('success') ? 'success' : (session('error') ? 'error' : '') }}"
    let message = "{{ session('success') ? session('success') : (session('error') ? session('error') : '') }}"
    if (status) {
        toastr[status](  message, status, {
                closeButton: true,
                tapToDismiss: false,
                progressBar: true,
        });
    }

    function successMessage(message) {
        toastr['success'](message, capitalizeFirstLetter('Success'), {
            closeButton: true,
            tapToDismiss: false,
            progressBar: true,
            rtl: isRtl
        });
    }

    function errorMessage(message) {
        toastr['error'](
            message,
            capitalizeFirstLetter('Success'), {
                closeButton: true,
                tapToDismiss: true,
                progressBar: true,
                rtl: false
            }
        );
    }
</script>
