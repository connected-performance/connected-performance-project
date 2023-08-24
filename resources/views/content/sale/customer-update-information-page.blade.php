<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
    <script src="https://secure.networkmerchants.com/token/CollectCheckout.js"
        data-checkout-key="checkout_public_u96zqU9F2EeZKPwD3k53GH84cqXdgVhk"></script>
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
                      You are using a secure link.
                    </div>
                    <div class="card">
                        <div class="card-header">

                            <div class="row">
                                <div class="col-md-12">
                                    <span>UPDATE CUSTOMER INFORMATION</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="height: 330px">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h3>
                                            Hi {{ $user->first_name.' '.$user->last_name }}.
                                        </h3><br>
                                        <p>{{ $user->email }}</p>
                                        <p>The purpose of this email is to update your information for the payment of your subscription to Connected Performance, for any questions do not hesitate to contact support and you will be attended.</p>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group" style="margin-top: 10px;">
                                <button id="checkout_button" class="btn btn-success btn-lg form-control" style="font-size: .8rem;">UPDATE INFORMATION</button>
                            </div>
                        </div>
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
document.getElementById('checkout_button').addEventListener('click', function (e) {
    CollectCheckout.redirectToCheckout({
        lineItems: [],
        type: "customerVaultOnly",
        collectShippingInfo: false,
        customerVault: {
            addCustomer: true
        },
        successUrl: "https://crm.connected-performance.com/api/nmi-customer-update/(CUSTOMER_VAULT_ID)/{{ $customer->id }}",
        cancelUrl: "https://crm.connected-performance.com/api/nmi-cancel",
        receipt: {
            showReceipt: true,
            redirectToSuccessUrl: true
        }
    }).then((error) => {
        console.log(error);
    });
});
</script>
