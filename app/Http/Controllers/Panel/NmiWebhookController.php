<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Plan;
use App\Models\CreditCardCustomer;
use App\Models\Transction;
use App\Models\User;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;
use App\Gateway\Gwapi;
use App\Mail\DemoMail as MailDemoMail;

class NmiWebhookController extends Controller
{    
    public function sale(Request $request)
    {
        function webhookIsVerified($webhookBody, $signingKey, $nonce, $sig) {
            return $sig === hash_hmac("sha256", $nonce . "." . $webhookBody, $signingKey);
        }  

        try {
            $signingKey = "53E9C7BBF8A5A4BBBC4570FE9A57EB55";
            $webhookBody = file_get_contents("php://input");
            $headers = getallheaders();
            $sigHeader = $headers['Webhook-Signature'];

            if (!is_null($sigHeader) && strlen($sigHeader) < 1) {
            throw new \Exception("invalid webhook - signature header missing");
            }

            if (preg_match('/t=(.*),s=(.*)/', $sigHeader, $matches)) {
            $nonce = $matches[1];
            $signature = $matches[2];
            } else {
            throw new \Exception("unrecognized webhook signature format");
            }

            if (!webhookIsVerified($webhookBody, $signingKey, $nonce, $signature)) {
            throw new \Exception("invalid webhook - invalid signature, cannot verify sender");
            }
            
            // webhook is now verified to have been sent by us, continue processing

            $webhook = json_decode($request, true);
            Log::info($webhook);
            var_export($webhook);

            if($webhook['event_type']){ $type=$webhook['event_type']; }else{ $type=null; }
            if($webhook['event_body']["order_id"]){ $order_id=$webhook['event_body']["order_id"]; }else{ $order_id=null; }
            if($webhook['event_body']["transaction_id"]){ $transaction_id=$webhook['event_body']["transaction_id"]; }else{ $transaction_id=null; }
            if($webhook['event_body']["card"]["cc_number"]){ $cc_number=$webhook['event_body']["card"]["cc_number"]; }else{ $cc_number=null; }
            if($webhook['event_body']["card"]["cc_exp"]){ $cc_exp=$webhook['event_body']["card"]["cc_exp"]; }else{ $cc_exp=null; }
            if($webhook['event_body']["requested_amount"]){ $balance=$webhook['event_body']["requested_amount"]; }else{ $balance=date("Y-m-d"); }
            if($webhook['event_body']["action"]["date"]){ $date=date("Y", strtotime($webhook['event_body']["action"]["date"])).'-'.date("m", strtotime($webhook['event_body']["action"]["date"])).'-'.date("d", strtotime($webhook['event_body']["action"]["date"])); }else{ $date=null; }
            
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
        } catch (\Exception $e) {
            echo "error: $e\n";
        }
    }

    public function updateCustomerNew($customer_vault_id, $customer_id)
    {
        $customer = Customer::find($customer_id);
        if($customer->up_cus==0){
            abort('429');
        }else{
            $customer->vault_id=$customer_vault_id;
            $customer->save();
            $customer_name = $customer->user->first_name;
            $customer_last_name = $customer->user->last_name;
            $invoice =  Invoice::where('user_id', $customer->user->id)->first();
            $pay = date("Y-m-d");
            $day_i=date("d", strtotime($pay));
            $month_i=date("m", strtotime($invoice->issue_date));
            $year_i=date("Y", strtotime($invoice->issue_date));
            if($day_i<14){
                $pay_date=$year_i.'-'.$month_i.'-14';
                $day_of_month = 14;
            }else{
                if(date("m")<$month_i){
                    $pay_date=$year_i.'-'.$month_i.'-14';
                    $pay_date_n=$year_i.'-'.$month_i.'-14';
                    $day_of_month = 14;
                }else{
                    $pay_date=$year_i.'-'.$month_i.'-28';
                    $pay_date_n=$year_i.'-'.$month_i.'-28';
                    $day_of_month = 28;
                } 
            }

            $plan_payments = $invoice->duration;
            $plan_amount = $invoice->balance;
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
            $invoices=Invoice::where('order_nmi', $invoice->order_nmi)->orderBy('id', 'asc')->get();
            foreach ($invoices as $key => $value) {
                Invoice::where('id', $value->id)->update(['pay_date' => $pay_date_n, 'plan_id' => $plan_id]);
                $pay_date_n = date('Y-m-d', strtotime($pay_date_n . ' + 1 months'));
            }

            $plan_name = 'Plan '.$plan_id.' '.trim($customer_name, " ").' '.trim($customer_last_name, " ");
            $month_frequency = 1;

            $gw = new gwapi;
            $gw->setLogin("BU5b8jk85Ghxun5mXab4rQ7v8f88cJBR");
            $gw->addPlan($plan_payments, $plan_amount, $plan_name, $plan_id, $month_frequency, $day_of_month);
            $response_g = $gw->responses['response'];
            if($response_g == 1){
                $gw->addSubscriptionCVToPlan($plan_id, $customer_vault_id, $invoice->order_nmi, str_replace("-","",$pay_date));
                $response_g = $gw->responses['subscription_id'];
                Customer::where('id', $customer->id)->update(['subscription_id' => $response_g]);
            }

            $constraints = "&report_type=customer_vault&customer_vault_id=".$customer_vault_id;
            $result = $gw->testXmlQuery('BU5b8jk85Ghxun5mXab4rQ7v8f88cJBR',$constraints);
            $ccnumber=str_replace("x","*",$result['customer']['cc_number']);
            $find_cc = CreditCardCustomer::where('customer_id', $customer->id)->where('ccnumber', $ccnumber)->first();
            if(!$find_cc){
                $tcd = new CreditCardCustomer();
                $tcd->ccnumber = $ccnumber;
                $tcd->ccexp = $result['customer']['cc_exp'];
                $tcd->customer_id = $customer->id;
                $tcd->save();
            }
            Customer::where('id', $customer->id)->update(['up_cus' => 0]);
            return view('content.sale.user-update-information-page');
        }
    }

    public function updateCustomerData($customer_vault_id, $customer_id)
    {
        $customer_vault_id_new=$customer_vault_id;
        $customer = Customer::find($customer_id);
        if($customer->up_tok==0){
            abort('429');
        }else{
            $customer_vault_id_old=$customer->vault_id;
            $customer->vault_id=$customer_vault_id_new;
            $customer->save();

            $gw = new gwapi;
            $gw->setLogin("BU5b8jk85Ghxun5mXab4rQ7v8f88cJBR");
            $gw->deleteCustomerVault($customer_vault_id_old);
            $gw->editSubscriptionToPlan($customer->subscription_id, $customer_vault_id_new);
            
            $constraints = "&report_type=customer_vault&customer_vault_id=".$customer_vault_id_new;
            $result = $gw->testXmlQuery('BU5b8jk85Ghxun5mXab4rQ7v8f88cJBR',$constraints);
            $ccnumber=str_replace("x","*",$result['customer']['cc_number']);
            $find_cc = CreditCardCustomer::where('customer_id', $customer->id)->where('ccnumber', $ccnumber)->first();
            if(!$find_cc){
                $tcd = new CreditCardCustomer();
                $tcd->ccnumber = $ccnumber;
                $tcd->ccexp = $result['customer']['cc_exp'];
                $tcd->customer_id = $customer->id;
                $tcd->save();
            }
            Customer::where('id', $customer->id)->update(['up_tok' => 0]);
            return view('content.sale.user-customer-update-information-page');
        }
    }

    public function cancel(Request $request)
    {
        return view('content.test.index');
    }
}
