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
use Illuminate\Support\Facades\Hash;
use App\Events\ActivityLog;


class TestController extends Controller
{
    public function tes(){
        $customer=222;
        $customer_vault='1630750117';
        $order='3082';
        $plan=170;
        $plan_n='Plan '.$plan.' Chris Mazza';
        $new_plan = new Plan();
        $new_plan->number = $plan;
        $new_plan->save();
        $gw = new gwapi;
        $gw->setLogin("BU5b8jk85Ghxun5mXab4rQ7v8f88cJBR");
        // (numero_pagos, monto, nombre plan, plan id, frecuencia mes, dia cobro) {
        $gw->addPlan(12, 279, $plan_n, $plan, 1, 14);
        $response_g = $gw->responses['response'];
        if($response_g == 1){
            // (plan id, vault id, order id, dia inicio) 
            $gw->addSubscriptionCVToPlan($plan, $customer_vault, $order, '20231214');
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
    }

    public function tes1t()
    {
        $data = User::find(1);
        $data->password = Hash::make('Connectadmin123!');
        $data->save();

die();

        $type='transaction.sale.success';
        $order_id=1014;
        $transaction_id=123456789;
        $condition=null;
        $authorization_code=null;
        $cc_number='4111111111111111';
        $cc_exp='1025';
        $balance=1000;
        $date=date("Y-m-d");
        
        if(!is_null($order_id)){
            if($type=='transaction.sale.success' && $order_id!=null){
                $invoice = Invoice::where('order_nmi', $order_id)->whereNotIn('balance_status', [1,2,3,4])->first();
                if($invoice->type=='NORMAL PAYMENT'){
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
                    $coun_pay=Invoice::where('order_nmi', $order_id)->where('user_id', $invoice->user_id)->where('balance_status', 1)->count();

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
                    Invoice::where('order_nmi', $order_id)->where('user_id', $invoice->user_id)->whereNotIn('balance_status', [1,2,3,4])->update(['total_amount' => $total_amount]);
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
                    if($coun_pay==0){
                        Mail::to($data->email)->send(new MailDemoMail($invoice_user));
                    }
                }else{
                    $invoice->transaction = $transaction_id;
                    $invoice->balance_status = '1';
                    $invoice->status = '1';
                    $invoice->save();
                }
            }elseif($type=='transaction.sale.failed'){
                $invoice = Invoice::where('order_nmi', $order_id)->whereNotIn('balance_status', [1,2,3,4])->first();
                if($invoice){
                    $invoice->balance_status=2;
                    $invoice->transaction = $transaction_id;
                    $invoice->status = '1';
                    $invoice->save();
                }
            }
        }
    }
}
