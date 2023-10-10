<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ExtraCharges;
use App\Mail\InvoiceMail;
use App\Models\ExtraCharge;
use App\Models\Invoice;
use App\Models\User;
use App\Gateway\Gwapi;
use App\Models\Plan;
use App\Models\CreditCardCustomer;
use App\Models\Transction;
use App\Models\Customer;
use App\Models\Lead;
use App\Mail\DemoMail as MailDemoMail;
use App\Mail\InvoiceCustomerMail;

class TestController extends Controller
{
    public function test(){

        $customer=274;
        $customer_vault='4712274';
        $order='1791';
        $plan=100;
        $plan_n='Plan '.$plan.' Harrison Lough';
        $new_plan = new Plan();
        $new_plan->number = $plan;
        $new_plan->save();
        $gw = new gwapi;
        $gw->setLogin("BU5b8jk85Ghxun5mXab4rQ7v8f88cJBR");
        // (numero_pagos, monto, nombre plan, plan id, frecuencia mes, dia cobro) {
        $gw->addPlan(12, 250, $plan_n, $plan, 1, 14);
        $response_g = $gw->responses['response'];
        if($response_g == 1){
            // (plan id, vault id, order id, dia inicio) 
            $gw->addSubscriptionCVToPlan($plan, $customer_vault, $order, '20231114');
            $response_g = $gw->responses['subscription_id'];
            Customer::where('id', $customer)->update(['subscription_id' => $response_g]);
        }

        $constraints = "&report_type=customer_vault&customer_vault_id=".$customer_vault;
        $result = $gw->testXmlQuery('BU5b8jk85Ghxun5mXab4rQ7v8f88cJBR',$constraints);
        $ccnumber=str_replace("x","*",$result['customer']['cc_number']);
        $find_cc = CreditCardCustomer::where('customer_id', $customer)->where('ccnumber', $ccnumber)->first();
        if(!$find_cc){
            $tcd = new CreditCardCustomer();
            $tcd->ccnumber = $ccnumber;
            $tcd->ccexp = $result['customer']['cc_exp'];
            $tcd->customer_id = $customer;
            $tcd->save();
        }
die();
        $webhookBody='{
            "event_id": "9f847e5f-06a0-448e-a0df-286d943f8cac",
            "event_type": "transaction.sale.success",
            "event_body": {
                "merchant": {
                    "id": "938071",
                    "name": "CONNECTED PERFORMANCE"
                },
                "features": {
                    "is_test_mode": false
                },
                "transaction_id": "8674276592",
                "transaction_type": "cc",
                "condition": "pendingsettlement",
                "processor_id": "firstdataomaha",
                "ponumber": "",
                "order_description": "",
                "order_id": "1030",
                "customerid": "1014194",
                "customertaxid": "",
                "website": "",
                "shipping": "0.00",
                "currency": "USD",
                "tax": "0.00",
                "surcharge": "",
                "cash_discount": "",
                "tip": "",
                "requested_amount": "200.00",
                "shipping_carrier": "",
                "tracking_number": "",
                "shipping_date": "",
                "partial_payment_id": "",
                "partial_payment_balance": "",
                "platform_id": "",
                "authorization_code": "064728",
                "social_security_number": "",
                "drivers_license_number": "",
                "drivers_license_state": "",
                "drivers_license_dob": "",
                "billing_address": {
                    "first_name": "Tommy",
                    "last_name": "Sullivan",
                    "address_1": "6 Admiral Rickover Rd",
                    "address_2": "",
                    "company": "",
                    "city": "Plymouth",
                    "state": "MA",
                    "postal_code": "02360",
                    "country": "US",
                    "email": "thomassull915@gmail.com",
                    "phone": "7816898530",
                    "cell_phone": "",
                    "fax": ""
                },
                "shipping_address": {
                    "first_name": "",
                    "last_name": "",
                    "address_1": "",
                    "address_2": "",
                    "company": "",
                    "city": "",
                    "state": "",
                    "postal_code": "",
                    "country": "US",
                    "email": "",
                    "phone": "",
                    "fax": ""
                },
                "card": {
                    "cc_number": "442788******7892",
                    "cc_exp": "0626",
                    "cavv": "",
                    "cavv_result": "",
                    "xid": "",
                    "eci": "",
                    "avs_response": "N",
                    "csc_response": "M",
                    "cardholder_auth": "",
                    "cc_start_date": "",
                    "cc_issue_number": "",
                    "card_balance": "",
                    "card_available_balance": "",
                    "entry_mode": "4",
                    "cc_bin": "",
                    "cc_type": "Visa",
                    "feature_token": ""
                },
                "action": {
                    "amount": "200.00",
                    "action_type": "sale",
                    "date": "20230830174424",
                    "success": "1",
                    "ip_address": "166.216.159.186",
                    "source": "quickclick",
                    "api_method": "cart",
                    "username": "Bumatechnology",
                    "response_text": "APPROVED",
                    "response_code": "100",
                    "processor_response_text": "AUTH/TKT  064728",
                    "tap_to_mobile": false,
                    "processor_response_code": "0",
                    "device_license_number": "",
                    "device_nickname": ""
                }
            }
        }';
        $webhook = json_decode($webhookBody, true);

        if($webhook['event_type']){ $type=$webhook['event_type']; }else{ $type=null; }
        if($webhook['event_body']["order_id"]){ $order_id=$webhook['event_body']["order_id"]; }else{ $order_id=null; }
        if($webhook['event_body']["transaction_id"]){ $transaction_id=$webhook['event_body']["transaction_id"]; }else{ $transaction_id=null; }
        if($webhook['event_body']["card"]["cc_number"]){ $cc_number=$webhook['event_body']["card"]["cc_number"]; }else{ $cc_number=null; }
        if($webhook['event_body']["card"]["cc_exp"]){ $cc_exp=$webhook['event_body']["card"]["cc_exp"]; }else{ $cc_exp=null; }
        if($webhook['event_body']["requested_amount"]){ $balance=$webhook['event_body']["requested_amount"]; }else{ $balance=date("Y-m-d"); }
        if($webhook['event_body']["action"]["date"]){ $date=date("Y", strtotime($webhook['event_body']["action"]["date"])).'-'.date("m", strtotime($webhook['event_body']["action"]["date"])).'-'.date("d", strtotime($webhook['event_body']["action"]["date"])); }else{ $date=null; }

        if(!is_null($order_id)){
            if($type=='transaction.sale.success'){
                $invoice = Invoice::where('order_nmi', $order_id)->where('balance_status', '<>', 1)->first();
                $customer = $invoice->users->customer;
                $customer_name = $invoice->users->first_name;
                $customer_last_name = $invoice->users->last_name;
        
                $customer_do_sale_amount = $balance;
                $customer_do_sale_card_number = $cc_number;
                $customer_do_sale_exp_date = $cc_exp;

                $day_i=date("d", strtotime($date));
                $month_i=date("m", strtotime($date));
                $year_i=date("Y", strtotime($date));
                if($day_i<=14){
                    $pay_date=$year_i.'-'.$month_i.'-14';
                }else{
                    $pay_date=$year_i.'-'.$month_i.'-28';
                }
                $invoice->pay_date=$pay_date;
                
                if(is_null($invoice->plan_id)){
                    $plan_payments = $invoice->duration - 1;
                    $plan_amount = $customer_do_sale_amount;
                    $plan = Plan::all()->last();
                    if($plan) {
                        $plan = $plan->number + 1;
                        $plan_id = $plan;
            
                        $new_plan = new Plan();
                        $new_plan->number = $plan_id;
                        $new_plan->save();
                    }else{
                        $plan_id = 1;
            
                        $new_plan = new Plan();
                        $new_plan->number = $plan_id;
                        $new_plan->save();
                    }
                    $invoice->plan_id = $plan_id;
                    $plan_name = 'Plan '.$plan_id.' '.trim($customer_name, " ").' '.trim($customer_last_name, " ");
                    $month_frequency = 1;
                    $day = strtotime($pay_date);
                    $day = date( "d", $day);
                    $day_of_month = $day;
                    $gw = new gwapi;
                    $gw->setLogin("BU5b8jk85Ghxun5mXab4rQ7v8f88cJBR");
                    $gw->addCustomerVault($transaction_id, $customer->vault_id);
                    $gw->addPlan($plan_payments, $plan_amount, $plan_name, $plan_id, $month_frequency, $day_of_month);
                    $response_g = $gw->responses['response'];
                    if($response_g == 1){
                        $pay_date_is = date('Y-m-d', strtotime($pay_date . ' + 1 months'));
                        $gw->addSubscriptionToPlan($plan_id, $transaction_id, str_replace("-","",$pay_date_is));
                        $response_g = $gw->responses['subscription_id'];
                        Customer::where('id', $customer->id)->update(['subscription_id' => $response_g]);
                    }
                    Invoice::where('order_nmi', $order_id)->update(['plan_id' => $plan_id]);

                    $invoices=Invoice::where('id','<>',$invoice->id)->where('order_nmi', $order_id)->get();
                    $pay_date_n=$pay_date;
                    foreach ($invoices as $key => $value) {
                        $pay_date_n = date('Y-m-d', strtotime($pay_date_n . ' + 1 months'));
                        Invoice::where('id', $value->id)->update(['pay_date' => $pay_date_n]);
                    }
                }

                $find_cc = CreditCardCustomer::where('customer_id', $customer->id)->where('ccnumber', $customer_do_sale_card_number)->first();
                if(!$find_cc){
                    $tcd = new CreditCardCustomer();
                    $tcd->ccnumber = $customer_do_sale_card_number;
                    $tcd->ccexp = $customer_do_sale_exp_date;
                    $tcd->customer_id = $customer->id;
                    $tcd->save();
                }
            
                $invoice->transaction = $transaction_id;
                $invoice->balance_status = '1';
                $invoice->status = '1';
                $invoice->save();
                $total_amount =  $invoice->total_amount - $balance;
                Invoice::where('order_nmi', $order_id)->where('user_id', $invoice->user_id)->where('balance_status', '<>', 1)->update(['total_amount' => $total_amount]);
                $transaction = new Transction();
                $transaction->user_id = $invoice->user_id;
                $transaction->customer_id = $invoice->customer_id;
                $transaction->transaction_type = '1';
                $transaction->invoice_id = $invoice->id;
                $transaction->ammount = $balance;
                $transaction->status = '1';
                $transaction->save();
                $data = User::find($invoice->user_id);
                $data->status = '1';
                $data->is_lead = 0;
                $data->is_customer = 1;
                $data->save();
                $customer = Customer::where('user_id', $invoice->user_id)->update(['status' => '1']);
                $lead = Lead::where('email', $data->email)->update(['status' => '2']);
                $invoice_user = $invoice->users;
                //Mail::to($data->email)->send(new MailDemoMail($invoice_user));

            }elseif($type=='transaction.sale.failed'){
                $invoice = Invoice::where('order_nmi', $order_id)->where('balance_status', '<>', 1)->first();
                if($invoice){
                    $invoice->balance_status=2;
                    $invoice->transaction = $transaction_id;
                    $invoice->status = '1';
                    $invoice->save();
                }
            }
        }
    }

    public function testfghfg()
    {
        $json='{
            "event_id": "9b312dfd-3174-4748-9447-d63c8744305a",
            "event_type": "transaction.sale.success",
            "event_body": {
                "merchant": {
                    "id": "1234",
                    "name": "Test Account"
                },
                "features": {
                    "is_test_mode": true
                },
                "transaction_id": "8619810383",
                "transaction_type": "cc",
                "condition": "pendingsettlement",
                "processor_id": "ccprocessora",
                "ponumber": "123456789",
                "order_description": "this is a description",
                "order_id": "1005",
                "customerid": "6747129",
                "customertaxid": "",
                "website": "https://example.com",
                "shipping": "",
                "currency": "USD",
                "tax": "0.08",
                "surcharge": "",
                "cash_discount": "",
                "tip": "",
                "requested_amount": "100.00",
                "shipping_carrier": "",
                "tracking_number": "",
                "shipping_date": "",
                "partial_payment_id": "",
                "partial_payment_balance": "",
                "platform_id": "",
                "authorization_code": "123456",
                "social_security_number": "",
                "drivers_license_number": "",
                "drivers_license_state": "",
                "drivers_license_dob": "",
                "billing_address": {
                    "first_name": "Jessica",
                    "last_name": "Jones",
                    "address_1": "123 Fake St.",
                    "address_2": "123123",
                    "company": "Alias Investigations",
                    "city": "New York City",
                    "state": "NY",
                    "postal_code": "12345",
                    "country": "US",
                    "email": "someone@example.com",
                    "phone": "555-555-5555",
                    "cell_phone": "",
                    "fax": "444-555-6666"
                },
                "shipping_address": {
                    "first_name": "Jessica",
                    "last_name": "Jones",
                    "address_1": "123 Fake St.",
                    "address_2": "123123",
                    "company": "Alias Investigations",
                    "city": "New York City",
                    "state": "NY",
                    "postal_code": "12345",
                    "country": "US",
                    "email": "someone@example.com",
                    "phone": "",
                    "fax": ""
                },
                "card": {
                    "cc_number": "543111******1111",
                    "cc_exp": "1025",
                    "cavv": "",
                    "cavv_result": "",
                    "xid": "",
                    "eci": "",
                    "avs_response": "N",
                    "csc_response": "",
                    "cardholder_auth": "",
                    "cc_start_date": "",
                    "cc_issue_number": "",
                    "card_balance": "",
                    "card_available_balance": "",
                    "entry_mode": "",
                    "cc_bin": "",
                    "cc_type": ""
                },
                "action": {
                    "amount": "54.04",
                    "action_type": "sale",
                    "date": "20200406175755",
                    "success": "1",
                    "ip_address": "1.2.3.4",
                    "source": "virtual_terminal",
                    "api_method": "virtual_terminal",
                    "username": "exampleuser",
                    "response_text": "SUCCESS",
                    "response_code": "100",
                    "processor_response_text": "",
                    "processor_response_code": "",
                    "device_license_number": "",
                    "device_nickname": ""
                }
            }
        }';

        $datos = json_decode($json, true);

        $type=$order_id=$datos['event_type'];
        $order_id=$datos['event_body']["order_id"];
        $transaction_id=$datos['event_body']["transaction_id"];
        $cc_number=$datos['event_body']["card"]["cc_number"];
        $cc_exp=$datos['event_body']["card"]["cc_exp"];
        $balance=$datos['event_body']["requested_amount"];

        $invoice = Invoice::where('invoice_number', $order_id)->first();
        $customer = $invoice->users->customer;
        $customer_name = $invoice->users->first_name;
        $customer_last_name = $invoice->users->last_name;

        $customer_do_sale_amount = $balance;
        $customer_do_sale_card_number = $cc_number;
        $customer_do_sale_exp_date = $cc_exp;

        $plan_payments = $invoice->duration - 1;
        $plan_amount = $customer_do_sale_amount;
        $plan = Plan::all()->last();
        if($plan) {
            $plan = $plan->number + 1;
            $plan_id = $plan;

            $new_plan = new Plan();
            $new_plan->number = $plan_id;
            $new_plan->save();
        }else{
            $plan_id = 1;

            $new_plan = new Plan();
            $new_plan->number = $plan_id;
            $new_plan->save();
        }
        $plan_name = 'Plan '.$plan_id.' '.trim($customer_name, " ").' '.trim($customer_last_name, " ");
        $month_frequency = 1;
        $day = strtotime($invoice->due_date);
        $day = date( "j", $day);
        $day_of_month = $day;
        
        $gw = new gwapi;
        $gw->setLogin("BU5b8jk85Ghxun5mXab4rQ7v8f88cJBR");
        $gw->addCustomerVault($transaction_id, $customer->vault_id);
        $gw->addPlan($plan_payments, $plan_amount, $plan_name, $plan_id, $month_frequency, $day_of_month);
        $gw->addSubscriptionToPlan($plan_id, $transaction_id);

        $find_cc = CreditCardCustomer::where('customer_id', $customer->id)->where('ccnumber', $customer_do_sale_card_number)->first();
        if(!$find_cc){
            $tcd = new CreditCardCustomer();
            $tcd->ccnumber = $customer_do_sale_card_number;
            $tcd->ccexp = $customer_do_sale_exp_date;
            $tcd->customer_id = $customer->id;
            $tcd->save();
        }
    
        $invoice->transaction = $transaction_id;
        $invoice->balance_status = '1';
        $invoice->save();
        $total_amount =  $invoice->total_amount - $balance;
        Invoice::where('user_id', $invoice->user_id)->where('status', '0')->update(['total_amount' => $total_amount]);
        $transaction = new Transction();
        $transaction->user_id = $invoice->user_id;
        $transaction->customer_id = $invoice->customer_id;
        $transaction->transaction_type = '1';
        $transaction->invoice_id = $invoice->id;
        $transaction->ammount = $balance;
        $transaction->status = '1';
        $transaction->save();
        $data = User::find($invoice->user_id);
        $data->status = '1';
        $data->is_lead = 0;
        $data->is_customer = 1;
        $data->save();
        $name = $data->first_name;
        $customer = Customer::where('user_id', $invoice->user_id)->update(['status' => '1']);
        $lead = Lead::where('email', $data->email)->update(['status' => '2']);
        $invoice_user = $invoice->users;
        Mail::to($data->email)->send(new MailDemoMail($invoice_user));
        

        // $c_date = date('Y-m-d');
        // $invoices = Invoice::where('issue_date', '<=', $c_date)->where('status', '0')->with('customer')->get();
        // if(@$invoices){
        //     foreach ($invoices as $invoice) {
        //         if($invoice->customer->status == '1'){
                    
        //             Invoice::where('id', $invoice->id)->first();
        //             $user =  User::find($invoice->user_id);
        //             $invoice = Invoice::find($invoice->id);
        //             Mail::to($user->email)->send(new InvoiceMail($user, $invoice));
        //             $invoice->status = '1';
        //             $invoice->save();
        //         }
                
        //     }
        // }

        // echo 'Email sent successfully';
    }
}
