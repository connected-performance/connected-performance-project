<?php

namespace App\Http\Controllers\Panel;

use App\Events\ActivityLog;
use App\Events\Notificaion;
use App\Http\Controllers\Controller;
use App\Mail\DemoMail as MailDemoMail;
use App\Mail\InvoiceMail;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\ExtraCharge;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Lead;
use App\Models\Payment;
use App\Models\Plugin;
use App\Models\Service;
use App\Models\Transction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PhpParser\Lexer\TokenEmulator\ExplicitOctalEmulator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Mail\DemoMail;
use SoapClient;
use App\Gateway\Gwapi;


class SaleController extends Controller
{
    //
    public function invoice_index(){
    //    return  $records =  Invoice::with('users')->get();
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/services"), 'name' => 'Invoices'],
            ['name' => __('invoices')],
        ];
       $customers = User::Orwhere('is_lead',1)->with('invoices')->get(['id','first_name']);
        $services = Service::where('status','1')->get(['id','name']);
        return view('content.sale.invoice-index',compact('customers', 'breadcrumbs', 'services'));
    }
    public function invoice_ajax(Request $request){
        $user_id = auth()->user()->id;
        $records =  Invoice::with('users')->get();
        return DataTables::of($records)->addIndexColumn()
        ->addColumn('action', function ($row) {
                $btn = '<a href="#" style="padding-left:10px;" class="link-success"  data-bs-toggle="tooltip"
                       data-bs-placement="top" title="Edit" onclick="edit_model(' . $row->id . ')"><i class="fas fa-edit"></i></a>' .
                    '<a href="#" style="padding-left:10px;" class="link-danger"  data-bs-toggle="tooltip"
                       data-bs-placement="top" title="Delet" onclick="delete_data(' . $row->id . ')"><i class="fa-solid fa-trash"></i></a>';
                return $btn;
            })
            ->addColumn('invoice_number', function ($row) {
                $number = $row->invoice_code.$row->invoice_number;
                return $number;
            })
            ->addColumn('status', function ($row) {
               if($row->status == '0'){
               $status =  '<span class="badge rounded-pill  badge-light-info">Draft</span>';
               }else{;
                $status  = '<span class="badge rounded-pill  badge-light-success">Send</span>';
               }
               return $status;
            })
            ->addColumn('service', function ($row) {
                $customer = Customer::where('user_id',$row->user_id)->first();
                // dd($row->customer->service);
                $service = $row->customer->service;
                return $service;
            })
            ->addColumn('balance', function ($row) {
                
                return '$'.$row->balance;
            })
            ->addColumn('total_amount', function ($row) {

                return '$' . $row->total_amount;
            })
            ->addColumn('balance_status', function ($row) {
                if ($row->balance_status == '0') {
                $balance_status =  '<span class="badge rounded-pill  badge-light-warning">UnPaid</span>';
                } else {;
                $balance_status  = '<span class="badge rounded-pill  badge-light-success">Paid</span>';
                }
                return $balance_status;
            })
            ->rawColumns(['action', 'invoice_number','service', 'status', 'balance_status', 'balance', 'total_amount'])
            ->make(true);
    }

    public function invoice_create(Request $request){
         try {
            // return $request->all();
        
            $request->validate([
                // 'name' => 'required',
                'user_id' => 'required',
                'issue_date' => 'required',
                'due_date' => 'required',
                'description' => 'required',
                'price' => 'required',
                'duration' => 'required'
            ]);
            if ($request->due_date <= $request->issue_date) {
                $response = [
                    'status' => 'error',
                    'message' => 'Due Date Must Be Greater Then Issue Date',
                  
                ];
                return response()->json($response);
            }
       
            if ($request->due_date <= $request->issue_date) {
                $response = [
                    'status' => 'error',
                    'message' => 'Due Date Must Be Greater Then Issue Date',

                ];
                return response()->json($response);
            }
             $data = explode(',',$request->duration);
            if($data[1] == 'month'){
                $duration = $data[0];
            }else{
                $duration = $data[0] *12;
            }
            $customer_id = Customer::where('user_id',$request->user_id)->first();
            $customer_id->status = '1';
            $customer_id->save();
            $issue_date = $request->issue_date;
            $due_date = $request->due_date;

            $ino_number = Invoice::latest()->first();
            if($ino_number){
                $number = $ino_number->invoice_number +1;
            }else{
                  $number = 1000 +1;
            }

            //Loop
            for($i = 1; $i<= $duration; $i++ ){
                $invoice = new Invoice();
           
                if($number){
                    $number = $number+1;
                }
                 else {
                    $number = 1000 + 1;
                }
                $invoice->user_id = $request->user_id;
                $invoice->invoice_number = $number;
                $invoice->invoice_code = "#N";
                if($i>1){
                    $issue_date = date('Y-m-d', strtotime($issue_date . ' + 1 months'));
                    $due_date = date('Y-m-d', strtotime($due_date . ' + 1 months'));
                    $invoice->level = 0;
                }else{
                    $issue_date = $request->issue_date;
                    $due_date = $request->due_date;
                    $invoice->level = 1;
                }
               
                $invoice->created_by = auth()->id();
                $invoice->customer_id = $customer_id->id;
                $invoice->issue_date = $issue_date;//$request->issue_date;
                $invoice->due_date = $due_date;//$request->due_date;
                $invoice->description = $request->description;
                $invoice->total_amount =  $request->price;
                $subtotal_amount = $request->price/$duration;
                $invoice->balance = round($subtotal_amount, 2);
                $invoice->time_period = $duration. ' , Month';
                $invoice->duration = $duration;
                $invoice->save();
            }


            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Create Invoice",
                'event_name' => "Create Invoice",
                'email' => auth()->user()->email,
                'description' => "Create Invoice Successfully",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));
            $notification = [
                'user_id' => auth()->id(),
                'title' =>  'Invoice Create',
                'description' => 'Create new invoice for '. @$customer_id->user->first_name.' customer'
            ];
            if (auth()->user()->is_admin == false) {
                event(new Notificaion($notification));
            }
            
            $response = [
                'status' => 'success',
                'message' => 'Invoice Successfully Created!',
                'id' => $invoice->id,
            ];
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
            return response()->json($response);
        }
    }

    public function invoice_delete(Request $request){
        try {
            $invoice = Invoice::where('id',$request->id)->delete();
            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Delete Invoice",
                'event_name' => "Delete Invoice",
                'email' => auth()->user()->email,
                'description' => "Create Delete Successfully",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));

            $notification = [
                'user_id' => auth()->id(),
                'title' =>  'Invoice Delete',
                'description' => 'Delete invoice of ' . @$invoice->customer->user->first_name . ' customer'
            ];
            if (auth()->user()->is_admin == false) {
                event(new Notificaion($notification));
            }
            $response = [
                'status' => 'success',
                'message' => 'Invoice Successfully Deleted',
            ];
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
            return response()->json($response);
        }
    }

    public function invoice_edit(Request $request){
        try {
            $data = Invoice::where('id', $request->id)->first();
            $response = [
                'status' => 'success',
                'data' => $data
            ];
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'data' => $th->getMessage(),
            ];
            return response()->json($response);
        }
    }

    public function invoice_update(Request $request){
        try {
            $invoice = Invoice::where('id', $request->invoice_id)->first();
            $invoice->issue_date  = $request->issue_date;
            $invoice->due_date = $request->due_date;
            $invoice->save();

            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Update Invoice",
                'event_name' => "Update Invoice",
                'email' => auth()->user()->email,
                'description' => "Update Invoice Successfully",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));

            $notification = [
                'user_id' => auth()->id(),
                'title' =>  'Invoice Update',
                'description' => 'Update invoice of ' . @$invoice->customer->user->first_name . ' customer'
            ];
            if (auth()->user()->is_admin == false) {
                event(new Notificaion($notification));
            }

            $response = [
                'status' => 'success',
                'message' => 'Invoice Successfull Updated'
            ];
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
            return response()->json($response);
        }
    }

    public function invoice_detail($id){
        $data =  Invoice::find($id);
        return view('content.sale.invoice-detail',compact('data'));
    }

    public function invoice_send(Request $request)
    {
        $data =  User::find($request->id);
        $invoice = Invoice::find($request->in_id);
        $mail = "cihanjake1@gmail.com";
        Mail::to($mail)->send(new InvoiceMail($data, $invoice));
        return redirect()->route('invoice');
        // return view('content.sale.invoice-detail', compact('data'));
    }

    public function invoice_get($id)
    {
        $invoice = Invoice::find($id);
        $user = User::find($invoice->user_id);
        
        return view('content.sale.dumy-page',compact('user','invoice'));
    }

    public function token_request($id)
    {
        $user = User::findOrFail($id);
        
        return view('content.sale.dumy-page-rt',compact('user'));
    }

    public function invoice_transaction(Request $request){
        /***************************EbizCharger****************************** */
          //$ebizcharge = $this->ebizcharge_customer_create($request->except('_token')); 
          //dd($ebizcharge);
      
         /*if($ebizcharge['status'] == 'error'){
            return redirect()->back()->with('error', $ebizcharge['message']);
         }*/
        $invoice = Invoice::find($request->invoice_id);
        $customer_name = $invoice->users->first_name;
        $customer_last_name = $invoice->users->last_name;
        if($invoice->users->address){
            $customer_address = $invoice->users->address;
        }else{
            $customer_address = 'Unknown';
        }
        
        if($invoice->users->citie_id){
            $customer_city = $invoice->users->city->name;
        }else{
            $customer_city = 'Unknown';
        }

        if($invoice->users->state_id){
            $customer_state = $invoice->users->state->name;
        }else{
            $customer_state = 'Unknown';
        }

        if($invoice->users->countrie_id){
            $customer_country = $invoice->users->country->name;
        }else{
            $customer_country = 'Unknown';
        }

        if($invoice->users->phone_number){
            $customer_phone_number = $invoice->users->phone_number;
        }else{
            $customer_phone_number = 'Unknown';
        }

        $customer_city = $customer_city;
        $customer_state = $customer_state;
        $customer_country = $customer_country;
        $customer_address = $customer_address;
        $customer_phone = $customer_phone_number;
        $customer_email = $invoice->users->email;

        $customer_invoice_id = $invoice->invoice_number;
        $customer_invoice_description = $invoice->invoice_description;

        $customer_do_sale_amount = $request->balance;
        $customer_do_sale_card_number = $request->card_number;
        $customer_do_sale_exp_date = $request->exp_date;
        $customer_do_sale_cvc_number = $request->cvc_number;
        $customer_do_sale_card_honer = $request->card_honer;


        $plan_payments = $invoice->duration - 1;
        $plan_amount = $customer_do_sale_amount;
        $plan_name = 'Plan '.$invoice->id;
        $plan_id = $invoice->id;
        $month_frequency = 1;
        $day = strtotime($invoice->due_date);
        $day = date( "j", $day);
        $day_of_month = $day;

        $gw = new gwapi;
        $gw->setLogin("BU5b8jk85Ghxun5mXab4rQ7v8f88cJBR");
        $gw->setBilling($customer_name, $customer_last_name ,"", $customer_address, "", $customer_city, $customer_state, "", $customer_country, $customer_phone, "", $customer_email, "");
        $gw->setShipping("Unknown", "Unknown", "Unknown", "Unknown", "Unknown", "Unknown", "Unknown", "Unknown", "Unknown", "Unknown");
        $gw->setOrder($customer_invoice_id, $customer_invoice_description, 0, 0, "", "");
        $gw->getPlan($plan_payments, $plan_amount, $plan_name, $plan_id, $month_frequency, $day_of_month);
        $gw->getSubscription($customer_name, $customer_last_name);

        $gw->doSale($customer_do_sale_amount, $customer_do_sale_card_number, $customer_do_sale_exp_date, $customer_do_sale_cvc_number);
        $response_g = $gw->responses['response'];
        print $gw->responses['responsetext'];
        if($response_g == 1){
            $gw->doPlan();
            $response_g = $gw->responses['response'];
            print $gw->responses['responsetext'];
            if($response_g == 1){
                $gw->doSubscription($customer_do_sale_card_number, $customer_do_sale_exp_date);
                $response_g = $gw->responses['response'];
                print $gw->responses['responsetext'];
            }
        }

        if($response_g != 1){
            return redirect()->back()->with('error', $gw->responses['responsetext']);
            die();
        }
         
    
        /************************END Add Customer With Full  Profile***************************************/
        if(@$request->extra_charges == 1){

            $customer_id = Customer::where('user_id',$request->user_id)->first()->id;
            $transaction = new Transction();
            $transaction->user_id = $request->user_id;
            $transaction->customer_id = $customer_id;
            $transaction->transaction_type = '2';
            $transaction->extra_charge = $request->charge_id;
            $transaction->ammount = $request->balance;
            $transaction->status = '1';
            $transaction->save();

            $extra = ExtraCharge::find($request->invoice_id);
            $extra->balance_status = '1';
            $extra->save();

          
        }else{
            $invoice = Invoice::find($request->invoice_id);

            $invoice->balance_status = '1';
            $invoice->save();
            $total_amount =  $invoice->total_amount - $request->balance;
            Invoice::where('user_id', $request->user_id)->where('status', '0')->update(['total_amount' => $total_amount]);
            $transaction = new Transction();
            $transaction->user_id = $invoice->user_id;
            $transaction->customer_id = $invoice->customer_id;
            $transaction->transaction_type = '1';
            $transaction->invoice_id = $invoice->id;
            $transaction->ammount = $request->balance;
            $transaction->status = '1';
            $transaction->save();
            $data = User::find($invoice->user_id);
            $data->status = '1';
            $data->is_lead = 0;
            $data->is_customer = 1;
            $data->save();
            $name = $data->first_name;
            $customer = Customer::where('user_id', $request->user_id)->update(['status' => '1']);
            $lead = Lead::where('email', $data->email)->update(['status' => '2']);
            Mail::to($data->email)->send(new MailDemoMail($data->first_name));
        }

        $data = User::find($request->user_id);
        $name = $data->first_name; 
        $notification = [
            'user_id' => User::where('id',1)->first()->id,//auth()->id(),
            'title' =>  'Transaction',
            'description' => $data->first_name . " Pay " . $request->balance . " Amount",
        ];
        if ($data->is_admin == false) {
            event(new Notificaion($notification));
        }

        $actor = 0;
        if ($data->is_customer == true) {
            $actor = 3;
        } 
        $data = [
                'user_id' => $data->id,
                'name' => $data->first_name . " Pay ". $request->balance. " Amount",
                'event_name' => "Transaction",
                'email' => $data->email,
                'description' => "Transaction Successfully Done",
                'actor' => $actor,
                'url' => url()->current(),
            ];
        event(new ActivityLog($data));
      
         return view('content.form.message', compact('name'));
         
    }

    public function token_request_save(Request $request)
    {
        $users = User::findOrFail($request->user_id);
        $customer_id = $users->id;
        $customer_name = $users->first_name;
        $customer_last_name = $users->last_name;
        if($users->address){
            $customer_address = $users->address;
        }else{
            $customer_address = 'Unknown';
        }
        
        if($users->citie_id){
            $customer_city = $users->city->name;
        }else{
            $customer_city = 'Unknown';
        }

        if($users->state_id){
            $customer_state = $users->state->name;
        }else{
            $customer_state = 'Unknown';
        }

        if($users->countrie_id){
            $customer_country = $users->country->name;
        }else{
            $customer_country = 'Unknown';
        }

        if($users->phone_number){
            $customer_phone_number = $users->phone_number;
        }else{
            $customer_phone_number = 'Unknown';
        }

        $customer_city = $customer_city;
        $customer_state = $customer_state;
        $customer_country = $customer_country;
        $customer_address = $customer_address;
        $customer_phone = $customer_phone_number;
        $customer_email = $users->email;

        $customer_card_number = $request->card_number;
        $customer_exp_date = $request->exp_date;

        $gw = new gwapi;
        $gw->setLogin("BU5b8jk85Ghxun5mXab4rQ7v8f88cJBR");
        $gw->doDeleteCustomer($customer_id);
        $gw->doCustomer($customer_id, $customer_card_number, $customer_exp_date, $customer_name, $customer_last_name, $customer_address, $customer_city, $customer_state, $customer_country, $customer_phone, $customer_email);
        $response_g = $gw->responses['response'];
        
        if($response_g != 1){
            return redirect()->back()->with('error', $gw->responses['responsetext']);
            die();
        }

        return view('content.form.message', compact('customer_name'));
    }

    public function ebizcharge_customer_create($request){
    try{
        $invoice = Invoice::find($request['invoice_id']);
        $user = User::find($request['user_id']);
        $card_type = substr($request['card_number'], 0, 5);
        $amount = $request['balance'] + 100;
        $city = 'unkow';
        $state = 'unkow';
        $country = 'unkow';
        $address = 'unkow';

        if (isset($user->city)) {
            $city = $user->city;
        }
        if (isset($user->state)) {
            $state = $user->state;
        }
        if (isset($user->country)) {
            $country = $user->country;
        }
        if (isset($user->address)) {
            $address = $user->address;
        }
        $plugin = Plugin::where('name', 'ebizcharge')->first();
           
        if(!$plugin) {
            $data['status']='error'; 
            $data['message']='Payment Gateway Not Install'; 
            return $data;
        }
        // $client = new SoapClient('https://soap.ebizcharge.net/eBizService.svc?singleWsdl');
        $client = new SoapClient('https://soap.ebizcharge.net/eBizService.svc?singleWsdl');

        $securityToken = array(
            'SecurityId' => $plugin->security_id,
            'UserId' => $plugin->private_key,
            'Password' => $plugin->secret_key
        );
        /************************If EBIZ Customer Exist *********************************/
        if (isset($user->ebiz_customer_id)) {
            /************************Get Customer********************* */
            $getCustomer = array(
                'securityToken' => $securityToken,
                'customerInternalId' => $user->ebiz_customer_internal_id
            );
            $getCustomer = $client->GetCustomer($getCustomer);
             $getCustomer = $getCustomer->GetCustomerResult;
          
            /************************Get Custome******************************* */


            /************************If EBIZ Customer Payment Profile Exist *********************************/
            if (isset($getCustomer->PaymentMethodProfiles->PaymentMethodProfile)) {

                /************************If EBIZ Customer Payment Profile Exist *********************************/
                if (isset($getCustomer->PaymentMethodProfiles->PaymentMethodProfile)) {
                    $user->ebiz_customer_number = $getCustomer->CustomerToken;
                    $user->save();
                    /************************If EBIZ Customer Payment Profile Exist *********************************/
             
                    $customerTransactionRequest = array(
                        'isRecurring' => false,
                        'IgnoreDuplicate' => true,
                        'Details' => array(
                            'OrderID' => $user->ebiz_customer_id,
                            'Invoice' => $invoice->invoice_code . $invoice->invoice_number,
                            'PONum' => $invoice->invoice_code . $invoice->invoice_number,
                            'Description' => 'Testing',
                            'Amount' => $request['balance'],
                            'Tax' => 1.2,
                            'Currency' => 'USD',
                            'Shipping' => '',
                            'ShipFromZip' => '54000',
                            'Discount' => 0,
                            'Subtotal' => $request['balance'],
                            'AllowPartialAuth' => false,
                            'Tip' => 0,
                            'NonTax' => false,
                            'Duty' => 0,
                        ),
                        'Software' => 'CRM',
                        'MerchReceipt' => true,
                        'CustReceiptName' => @$user->first_name,
                        'CustReceiptEmail' => @$user->email,
                        'CustReceipt' => '2',
                        'ClientIP' => request()->ip(),
                        'CardCode' => @$request['cvc_number'],
                        'Command' => 'Sale',
                        'LineItems' => array(
                            'SKU' => 'Test',
                            'ProductName' => 'AC',
                            'Description' => 'cool ac',
                            'UnitPrice' => $request['balance'],
                            'Taxable' => 'N',
                            'TaxAmount' => 0,
                            'Qty' => 1
                        )
                    );
                    // echo '<pre>';
                    // print_r();
                    // dd('k');
                    $transactionResult = $client->runCustomerTransaction(
                        array(
                            'securityToken' => $securityToken,
                            'custNum' => $getCustomer->CustomerToken,//$getCustomer->CustomerToken,
                            'paymentMethodID' => $getCustomer->PaymentMethodProfiles->PaymentMethodProfile->MethodID,//$user->ebiz_customer_payment_methd,
                            'tran' => $customerTransactionRequest
                        )
                    );
                    // echo '<pre>';
                    // print_r($getCustomer->CustomerToken);
                    //     dd('end here');
                    $transaction = $transactionResult->runCustomerTransactionResult;

                    if ($transaction->Result == "Error") {
                        //  redirect()->back()->with('error', $transaction->Error);
                        $data['status'] = 'error';
                        $data['message'] = $transaction->Error;
                        return $data;
                    }
//
                    /************************If EBIZ Customer Payment Profile Exist *********************************/
                } else {

                    /************************Add Customer Payment Profile***************************************/
                    $customerPayment = array(
                        'MethodName' => 'My Master Card',
                        'SecondarySort' => 1,
                        'Created' => date('Y-m-d\TH:i:s'),
                        'Modified' => date('Y-m-d\TH:i:s'),
                        'AvsStreet' => 'St 5',
                        'AvsZip' => '54000',
                        'CardCode' => @$request['cvc_number'],
                        'CardExpiration' => @$request['exp_date'],
                        'CardNumber' => @$request['card_number'],
                        'CardType' => @$card_type,
                        'Balance' => $request['balance'],
                        'MaxBalance' => $amount,
                    );
                    $paymentMethod = $client->addCustomerPaymentMethodProfile(
                        array(
                            'securityToken' => $securityToken,
                            'customerInternalId' => $user->ebiz_customer_internal_id,
                            'paymentMethodProfile' => $customerPayment
                        )
                    );
                    $paymentMethodId = $paymentMethod->AddCustomerPaymentMethodProfileResult;

                    if ($paymentMethodId) {
                        $user->ebiz_customer_payment_methd = $paymentMethodId;
                        $user->save();
                        $customerTransactionRequest = array(
                            'isRecurring' => false,
                            'IgnoreDuplicate' => true,
                            'Details' => array(
                                'OrderID' => $user->ebiz_customer_id,
                                'Invoice' => $invoice->invoice_code . $invoice->invoice_number,
                                'PONum' => $invoice->invoice_code . $invoice->invoice_number,
                                'Description' => 'Testing',
                                'Amount' => $request['balance'],
                                'Tax' => 1.0,
                                'Currency' => 'USD',
                                'Shipping' => '',
                                'ShipFromZip' => '54000',
                                'Discount' => 0,
                                'Subtotal' => $request['balance'],
                                'AllowPartialAuth' => false,
                                'Tip' => 0,
                                'NonTax' => false,
                                'Duty' => 0,
                            ),
                            'Software' => 'CRM',
                            'MerchReceipt' => true,
                            'CustReceiptName' => @$user->first_name,
                            'CustReceiptEmail' => @$user->email,
                            'CustReceipt' => '2',
                            'ClientIP' => request()->ip(),
                            'CardCode' => @$request['cvc_number'],
                            'Command' => 'Sale',
                            'LineItems' => array(
                                'SKU' => 'Test',
                                'ProductName' => 'AC',
                                'Description' => 'cool ac',
                                'UnitPrice' => $request['balance'],
                                'Taxable' => 'N',
                                'TaxAmount' => 0,
                                'Qty' => 1
                            )
                        );
                        $transactionResult = $client->runCustomerTransaction(
                            array(
                                // 'securityToken' => $securityToken,
                                // 'custNum' => $user->ebiz_customer_number,
                                // 'paymentMethodID' => $paymentMethodId,
                                // 'tran' => $customerTransactionRequest
                                'securityToken' => $securityToken,
                                'custNum' => $getCustomer->CustomerToken,//$getCustomer->CustomerToken,
                                'paymentMethodID' => $getCustomer->PaymentMethodProfiles->PaymentMethodProfile->MethodID,//$user->ebiz_customer_payment_methd,
                                'tran' => $customerTransactionRequest
                            )
                        );
                        $transaction = $transactionResult->runCustomerTransactionResult;

                        if ($transaction->Result == "Error") {
                            // return redirect()->back()->with('error', $transaction->Error);
                            $data['status'] = 'error';
                            $data['message'] = $transaction->Error;

                            return $data;
                        }
                    } else {
                        // return redirect()->back()->with('error', 'Payment Profile Not Successfully Add');
                        $data['status'] = 'error';
                        $data['message'] = 'Payment Profile Not Successfully Add';

                        return $data;
                    }
                    /************************Add Customer Payment Profile***************************************/
                }
            } else {
                /************************Add Customer Payment Profile***************************************/
                $customerPayment = array(
                    'MethodName' => 'My Visa',
                    'SecondarySort' => 1,
                    'Created' => date('Y-m-d\TH:i:s'),
                    'Modified' => date('Y-m-d\TH:i:s'),
                    'AvsStreet' => 'St 5',
                    'AvsZip' => '54000',
                    'CardCode' => @$request['cvc_number'],
                    'CardExpiration' => @$request['exp_date'],
                    'CardNumber' => @$request['card_number'],
                    'CardType' => @$card_type,
                    'Balance' => $request['balance'],
                    'MaxBalance' => $amount,
                );
                $paymentMethod = $client->addCustomerPaymentMethodProfile(
                    array(
                        'securityToken' => $securityToken,
                        'customerInternalId' => $user->ebiz_customer_internal_id,
                        'paymentMethodProfile' => $customerPayment
                        
                    )
                );
                $paymentMethodId = $paymentMethod->AddCustomerPaymentMethodProfileResult;

                if ($paymentMethodId) {
                    $user->ebiz_customer_payment_methd = $paymentMethodId;
                    $user->save();
                    $customerTransactionRequest = array(
                        'isRecurring' => false,
                        'IgnoreDuplicate' => true,
                        'Details' => array(
                            'OrderID' => $user->ebiz_customer_id,
                            'Invoice' => $invoice->invoice_code . $invoice->invoice_number,
                            'PONum' => $invoice->invoice_code . $invoice->invoice_number,
                            'Description' => 'Testing',
                            'Amount' => $request['balance'],
                            'Tax' => 1.0,
                            'Currency' => 'USD',
                            'Shipping' => '',
                            'ShipFromZip' => '54000',
                            'Discount' => 0,
                            'Subtotal' => $request['balance'],
                            'AllowPartialAuth' => false,
                            'Tip' => 0,
                            'NonTax' => false,
                            'Duty' => 0,
                        ),
                        'Software' => 'CRM',
                        'MerchReceipt' => true,
                        'CustReceiptName' => @$user->first_name,
                        'CustReceiptEmail' => @$user->email,
                        'CustReceipt' => '2',
                        'ClientIP' => request()->ip(),
                        'CardCode' => @$request['cvc_number'],
                        'Command' => 'Sale',
                        'LineItems' => array(
                            'SKU' => 'Test',
                            'ProductName' => 'AC',
                            'Description' => 'cool ac',
                            'UnitPrice' => $request['balance'],
                            'Taxable' => 'N',
                            'TaxAmount' => 0,
                            'Qty' => 1
                        )
                    );
                    $transactionResult = $client->runCustomerTransaction(
                        array(
                            'securityToken' => $securityToken,
                            // 'custNum' => $user->ebiz_customer_number,
                            // 'paymentMethodID' => $paymentMethodId,
                            'custNum' => $getCustomer->CustomerToken,//$getCustomer->CustomerToken,
                            'paymentMethodID' => $getCustomer->PaymentMethodProfiles->PaymentMethodProfile->MethodID,//
                            'tran' => $customerTransactionRequest
                        )
                    );
                    $transaction = $transactionResult->runCustomerTransactionResult;

                    if ($transaction->Result == "Error") {
                        // return redirect()->back()->with('error', $transaction->Error);
                        $data['status'] = 'error';
                        $data['message'] = $transaction->Error;

                        return $data;
                    }else{
                        $data['status'] = 'success';
                        $data['message'] = 'Transaction Successfully Done';

                        return $data;
                    }
                } else {
                    // return redirect()->back()->with('error', 'Payment Profile Not Successfully Add');
                    $data['status'] = 'error';
                    $data['message'] = 'Payment Profile Not Successfully Add';

                    return $data;
                }
            }
            /************************Add Customer Payment Profile***************************************/
        } else {

            /************************Add Customer With Full  Profile***************************************/

            $customerData = array(
                'CustomerId' => $user->id . @$user->uid,
                'FirstName' =>  @$user->first_name,
                'LastName' => @$user->last_name,
                'CompanyName' => 'CRM',
                'Phone' => @$user->phone_number,
                'CellPhone' => @$user->phone_number,
                'Fax' => '234-343434',
                'Email' => @$user->email,
                'WebSite' => '',
                'ShippingAddress' => array(
                    'FirstName' => $user->first_name,
                    'LastName' => $user->last_name,
                    'Company' => 'CRM',
                    'Address1' => @$address,
                    'Address2' => @$address,
                    'City' => @$city,
                    'State' => @$state,
                    'ZipCode' => 'E1 6AN',
                    'Country' => @$country,
                    'Phone' => @$user->phone_number,
                    'Fax' => '233-234432',
                    'Email' => @$user->email
                ),
                'BillingAddress' => array(
                    'FirstName' => @$user->first_name,
                    'LastName' => @$user->last_name,
                    'Company' => 'CRM',
                    'Address1' => @$address,
                    'Address2' => @$address,
                    'City' => @$city,
                    'State' => @$state,
                    'ZipCode' => 'E1 6AN',
                    'Country' => @$country,
                    'Phone' => @$user->phone_number,
                    'Fax' => '456-234432',
                    'Email' => $user->email,
                )
            );
            $customerResult = $client->AddCustomer(array(
                'securityToken' => $securityToken,
                'customer' => $customerData
            ));
             $addCustomerResult = $customerResult->AddCustomerResult;
            if($addCustomerResult->Status == 'Failed'){
                $data['status'] = 'error';
                $data['message'] = $addCustomerResult->Error;
                return $data;
            }
            if ($addCustomerResult->Status == 'Success') {
                $getCustomer = array(
                    'securityToken' => $securityToken,
                    'customerInternalId' => $addCustomerResult->CustomerInternalId
                );
                $getCustomer = $client->GetCustomer($getCustomer);
                $getCustomer = $getCustomer->GetCustomerResult;

                $cust_id = $user->ebiz_customer_id = $addCustomerResult->CustomerId;
                $user->ebiz_customer_internal_id = $addCustomerResult->CustomerInternalId;
                $user->ebiz_customer_number = $getCustomer->CustomerToken;
                $user->save();
                $customerPayment = array(
                    'MethodName' => 'My Visa',
                    'SecondarySort' => 1,
                    'Created' => date('Y-m-d\TH:i:s'),
                    'Modified' => date('Y-m-d\TH:i:s'),
                    'AvsStreet' => 'St 5',
                    'AvsZip' => '54000',
                    'CardCode' => @$request['cvc_number'],
                    'CardExpiration' => @$request['exp_date'],
                    'CardNumber' => @$request['card_number'],
                    'CardType' => @$card_type,
                    'Balance' => @$request['balance'],
                    'MaxBalance' => $amount,
                );
                $paymentMethod = $client->addCustomerPaymentMethodProfile(
                    array(
                        'securityToken' => $securityToken,
                        'customerInternalId' => $addCustomerResult->CustomerInternalId,
                        'paymentMethodProfile' => $customerPayment
                    )
                );

                $paymentMethodId = $paymentMethod->AddCustomerPaymentMethodProfileResult;
                if ($paymentMethodId) {
                    $user->ebiz_customer_payment_methd = $paymentMethodId;
                    $user->save();
                    $customerTransactionRequest = array(
                        'isRecurring' => false,
                        'IgnoreDuplicate' => true,
                        'Details' => array(
                            'OrderID' => $cust_id,
                            'Invoice' => $invoice->invoice_code . $invoice->invoice_number,
                            'PONum' => $invoice->invoice_code . $invoice->invoice_number,
                            'Description' => 'Testing',
                            'Amount' => @$request['balance'],
                            'Tax' => 1.0,
                            'Currency' => 'USD',
                            'Shipping' => '',
                            'ShipFromZip' => '54000',
                            'Discount' => 0,
                            'Subtotal' => @$request['balance'],
                            'AllowPartialAuth' => false,
                            'Tip' => 0,
                            'NonTax' => false,
                            'Duty' => 0,
                        ),
                        'Software' => 'CRM',
                        'MerchReceipt' => true,
                        'CustReceiptName' => @$user->first_name,
                        'CustReceiptEmail' => @$user->email,
                        'CustReceipt' => '2',
                        'ClientIP' => request()->ip(),
                        'CardCode' => @$request['cvc_number'],
                        'Command' => 'Sale',
                        'LineItems' => array(
                            'SKU' => 'Test',
                            'ProductName' => 'AC',
                            'Description' => 'cool ac',
                            'UnitPrice' => $request['balance'],
                            'Taxable' => 'N',
                            'TaxAmount' => 0,
                            'Qty' => 1
                        )
                    );
                    $transactionResult = $client->runCustomerTransaction(
                        array(
                            'securityToken' => $securityToken,
                            'custNum' => $getCustomer->CustomerToken,//$getCustomer->CustomerToken,
                            'paymentMethodID' => $getCustomer->PaymentMethodProfiles->PaymentMethodProfile->MethodID,//
                            // 'custNum' => $getCustomer->CustomerToken,
                            // 'paymentMethodID' => $paymentMethodId,
                            'tran' => $customerTransactionRequest
                        )
                    );
                    $transaction = $transactionResult->runCustomerTransactionResult;

                    if ($transaction->Result == "Error") {
                        // return redirect()->back()->with('error', $transaction->Error);

                        $data['status'] = 'error';
                        $data['message'] = $transaction->Error;

                        return $data;
                    }else{
                        $data['status'] = 'success';
                        $data['message'] = 'Transaction Successfully Done';

                        return $data;
                    }
                } else {
                    // return redirect()->back()->with('error', 'Payment Profile Not Successfully Add');
                    $data['status'] = 'error';
                    $data['message'] = 'Payment Profile Not Successfully Add';

                    return $data;
                }
            } else {

                // return redirect()->back()->with('error', 'Sorry Cutomer Note Found');
                $data['status'] = 'error';
                $data['message'] = 'Sorry Customer Not Found';

                return $data;
            }
        }
        } catch (\Throwable $th) {
           
            $data['status']='error';
            $data['message']= $th->getMessage();

            return $data;
        }


    }
 

    public function payment(){
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/payment/employee"), 'name' => 'payment'],
            ['name' => __('payment')],
        ];
        $user = User::where('is_employe',true)->where('status','1')->with(['employee'])->get(['id','first_name']);
        $modal = 'Create Payment';
    //    return  $records = Payment::with(['employee' => function ($query) {
    //         return $query->with('user');
    //     }])->get();
      
        return view('employee.payments',compact('user', 'modal', 'breadcrumbs'));
    }

    public function payment_ajax(Request $request){
         $records = Payment::with(['employee' => function ($query) {
            return $query->with('user');
        }])->get();

        return DataTables::of($records)->addIndexColumn()
            ->addColumn('action', function ($row) {
                if($row->status == '0'){
                $btn = '<a href="#" style="padding-left:10px;" class="link-info"  data-bs-toggle="tooltip"
                       data-bs-placement="top" title="Send" onclick="send_data(' . $row->id . ')"><i class="fa-regular fa-paper-plane"></i></a>' . '
                <a href="#" style="padding-left:10px;" class="link-success"  data-bs-toggle="tooltip"
                       data-bs-placement="top" title="Edit" onclick="edit_data(' . $row->id . ')"><i class="fas fa-edit"></i></a>' .
                    '<a href="#" style="padding-left:10px;" class="link-danger"  data-bs-toggle="tooltip"
                       data-bs-placement="top" title="Delet" onclick="delete_data(' . $row->id . ')"><i class="fa-solid fa-trash"></i></a>';
                }else{
                    $btn = '';
                }
              
                return $btn;
            })
            ->addColumn('status', function ($row) {
                if ($row->status == '0') {
                    $status =  '<span class="badge rounded-pill  badge-light-info">Draft</span>';
                } else {;
                    $status  = '<span class="badge rounded-pill  badge-light-success">Send</span>';
                }
                return $status;
            })
            ->addColumn('name', function ($row) {
                if ($row->employee->user) {
                $name =  $row->employee->user->first_name;
                } else {
                $name  = '';
                }
                return $name;
            })
            ->addColumn('amount', function ($row) {
                
                return "$".$row->amount;
            })
            ->rawColumns(['action', 'status','name' ,'amount'])
            ->make(true);
    }

    public function payment_create(Request $request){
        try {
            $request->validate([
                'description' => 'required',
                'drop_down' => 'required',
                'amount' =>'required',
            ]);
            if($request->payment_id != 0 ){
                $payment = Payment::find($request->payment_id);
                $message = "Payment Successfully Updated";
            }else{
                $payment = new Payment();
                $message = "Payment Successfully Created";
            }
            $payment->employee_id = $request->drop_down;
            $payment->amount = $request->amount;
            $payment->status = '0';
            $payment->create_date = date('Y-m-d');
            $payment->description = $request->description;
            $payment->save();

            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Create Payment",
                'event_name' => "Create Payment",
                'email' => auth()->user()->email,
                'description' => "Create Payment Successfully",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));

            $response = [
                'status' => 'success',
                'message' => $message,
            ];
            
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
            return response()->json($response);
        }
    }

    public function payment_edit(Request $request){
        try {
            $data = Payment::where('id',$request->id)->with('employee')->first();

            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Update Payment",
                'event_name' => "Update Payment",
                'email' => auth()->user()->email,
                'description' => "Update Payment Successfully",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));
            $response = [
                'status' => 'success',
                'data' => $data,
                'model' => 'Update Payment',

            ];
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'data' => $th->getMessage(),
            ];
            return response()->json($response);
        }
    }

    public function payment_delete(Request $request){
        try {
            $data = Payment::where('id', $request->id)->delete();

            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Delete Payment",
                'event_name' => "Delete Payment",
                'email' => auth()->user()->email,
                'description' => "Delete Payment Successfully",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));
            $response = [
                'status' => 'success',
                'message' => 'Payment Successfully deleted',
                'model' => 'Update Payment',

            ];
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
            return response()->json($response);
        }
    }

    public function payment_send(Request $request){
        try {
            $data = Payment::where('id', $request->id)->first();
            $data->status = '1';
            $data->send_date = date('Y-m-d');
            $data->save();
            $amount = $data->amount."00";

             $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://integrations.expensify.com/Integration-Server/ExpensifyIntegrations');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "requestJobDescription={\n        
            \"type\":\"create\",\n        
            \"credentials\":{\n            
            \"partnerUserID\":\"aa_hbdeveloper_two_gmail_com\",\n
            \"partnerUserSecret\":\"bab1c0e1bd30365227b7c7390c31454ef3c13905\"\n},\n
            \"inputSettings\":{\n
                                \"type\":\"expenses\",\n
                                \"employeeEmail\":\"cihanjake1@gmail.com\",\n
                                \"transactionList\": [\n
                                {\n
                                    \"created\":\"".date("Y-m-d")."\",\n
                                    \"currency\": \"USD\",\n
                                    \"merchant\": \"".$data->employee->user->first_name."\",\n
                                    \"amount\": ".$amount."\n 
                                },\n
                                \n
                                ]\n
                                 }\n 
                            }");

        $headers = array();
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
      
            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Send Payment",
                'event_name' => "Send Payment",
                'email' => auth()->user()->email,
                'description' => "Send Payment Successfully",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));
            $response = [
                'status' => 'success',
                'message' => 'Payment Successfully Send',
            ];
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
            return response()->json($response);
        }
    }
}
