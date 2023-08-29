<?php

namespace App\Console\Commands;

use App\Mail\ExtraCharges;
use App\Mail\InvoiceMail;
use App\Models\ExtraCharge;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class InvoiceCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendinvoice:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return 0;
        $c_date = date('Y-m-d');
        
        $invoices = Invoice::where('issue_date', '<=', $c_date)->where('status', '0')->where('lavel', '1')->with('customer')->get();
        Log::info($invoices);
        // $invoices = Invoice::where('issue_date', '<=', $c_date)->get();
        if(@$invoices){
            foreach ($invoices as $invoice) {
                if($invoice->customer->status == '1'){
                    Invoice::where('id', $invoice->id)->first();
                    $user =  User::find($invoice->user_id);
                    $invoice = Invoice::find($invoice->id);
                    //Mail::to($user->email)->send(new InvoiceMail($user, $invoice));
                    $invoice->status = '1';
                    $invoice->save();
                }
                
            }
        }

        $charges = ExtraCharge::where('issue_date', '<=', $c_date)->where('status', '3')->with('users')->get();

        foreach ($charges as $value) {
            if ($value->users->is_customer == true) {
                $user =  User::find($value->user_id);
                $charge = ExtraCharge::find($value->id);
                //Mail::to($user->email)->send(new ExtraCharges($user, $charge));
                $charge->status = '1';
                $charge->save();
            }
        }

       
    }
}
