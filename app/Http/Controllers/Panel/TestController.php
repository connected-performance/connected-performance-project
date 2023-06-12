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

class TestController extends Controller
{
    public function test()
    {
        $c_date = date('Y-m-d');
        $invoices = Invoice::where('issue_date', '<=', $c_date)->where('status', '0')->with('customer')->get();
        if(@$invoices){
            foreach ($invoices as $invoice) {
                if($invoice->customer->status == '1'){
                    
                    Invoice::where('id', $invoice->id)->first();
                    $user =  User::find($invoice->user_id);
                    $invoice = Invoice::find($invoice->id);
                    Mail::to($user->email)->send(new InvoiceMail($user, $invoice));
                    $invoice->status = '1';
                    $invoice->save();
                }
                
            }
        }

        echo 'Email sent successfully';
    }
}
