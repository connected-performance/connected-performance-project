 <html>

 <head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

 </style>

 <body>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/3.0.0/jquery.payment.min.js"></script>
     <div class="padding">
         <div class="row">
             <div class="container-fluid d-flex justify-content-center">
                 <div class="col-sm-8 col-md-6">
                     <div class="card">
                         <div class="card-header">

                             <div class="row">
                                 <div class="col-md-6">
                                     <span>CREDIT/DEBIT CARD PAYMENT</span>

                                 </div>

                                 <div class="col-md-6 text-right" style="margin-top: -5px;">

                                     <img src="https://img.icons8.com/color/36/000000/visa.png">
                                     <img src="https://img.icons8.com/color/36/000000/mastercard.png">
                                     <img src="https://img.icons8.com/color/36/000000/amex.png">

                                 </div>

                             </div>

                         </div>
                         <div class="card-body" style="height: 350px">
                             <div class="form-group">
                                 <label for="cc-number" class="control-label">CARD NUMBER</label>
                                 <input id="cc-number" type="tel" class="input-lg form-control cc-number"
                                     autocomplete="cc-number"
                                     placeholder="&bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull;"
                                     required>
                             </div>

                             <div class="row">

                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label for="cc-exp" class="control-label">CARD EXPIRY</label>
                                         <input id="cc-exp" type="tel" class="input-lg form-control cc-exp"
                                             autocomplete="cc-exp" placeholder="&bull;&bull; / &bull;&bull;" required>
                                     </div>


                                 </div>

                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label for="cc-cvc" class="control-label">CARD CVC</label>
                                         <input id="cc-cvc" type="tel" class="input-lg form-control cc-cvc"
                                             autocomplete="off" placeholder="&bull;&bull;&bull;&bull;" required>
                                     </div>
                                 </div>

                             </div>


                             <div class="form-group">
                                 <label for="numeric" class="control-label">CARD HOLDER NAME</label>
                                 <input type="text" class="input-lg form-control">
                             </div>

                            <br>
                             <div class="form-group">
                                 <input value="MAKE PAYMENT" type="button" class="btn btn-success btn-lg form-control"
                                     style="font-size: .8rem;">
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
 <script>
     $(function($) {
         $('[data-numeric]').payment('restrictNumeric');
         $('.cc-number').payment('formatCardNumber');
         $('.cc-exp').payment('formatCardExpiry');
         $('.cc-cvc').payment('formatCardCVC');
         $.fn.toggleInputError = function(erred) {
             this.parent('.form-group').toggleClass('has-error', erred);
             return this;
         };
         $('form').submit(function(e) {
             e.preventDefault();
             var cardType = $.payment.cardType($('.cc-number').val());
             $('.cc-number').toggleInputError(!$.payment.validateCardNumber($('.cc-number').val()));
             $('.cc-exp').toggleInputError(!$.payment.validateCardExpiry($('.cc-exp').payment(
                 'cardExpiryVal')));
             $('.cc-cvc').toggleInputError(!$.payment.validateCardCVC($('.cc-cvc').val(), cardType));
             $('.cc-brand').text(cardType);
             $('.validation').removeClass('text-danger text-success');
             $('.validation').addClass($('.has-error').length ? 'text-danger' : 'text-success');
         });
     });
 </script>
