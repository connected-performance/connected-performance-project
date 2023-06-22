<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use App\Models\Customer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $invoice)
    {
        $this->user = $user;
        $this->invoice = $invoice;
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = $_SERVER['SERVER_NAME'];
        $user = $this->user;
        $invoice = $this->invoice;

        $customer = Customer::where('user_id',$user->id)->first();
        if($customer == null){
            $buttton  = '<button style="background-color: #28c76f; padding: 2%; padding-left: 10%;  padding-right: 10%;border-radius: 10px;border: none; color:#fff;"><a href="http://phpstack-811730-2916767.cloudwaysapps.com/invoice/'.$invoice->id.'" style="color: #fff;text-decoration: none;">Pay</a></button>';
            $template = EmailTemplate::where('slug', 'invoice')->first()->value;
            $template_data = [
                '#1000089',
                '--username--',
                '--sub_amount--',
                '--cgst_amount--',
                '--sgst_amount--',
                '--mnth_charges--',
                '--mnth_charges--',
                '--due_date--'
            ];
            $user_data = [
                $invoice->invoice_code . $invoice->invoice_number,
                $user->first_name,
                $invoice->total_amount,
                0,
                0,
                $invoice->balance,
                0,
                $invoice->due_date
            ];
            $data = str_replace($template_data, $user_data, $template);
            $us_data = str_replace('--payment_button--', $buttton, $data);
            return $this->view('content.sale.invoice-mailtemplate',compact('us_data'));
        }else
        {
            $service = $customer->service;
            $buttton  = '<button style="background-color: #28c76f; padding: 2%; padding-left: 10%;  padding-right: 10%;border-radius: 10px;border: none; color:#fff;"><a href="http://localhost:8000/invoice/'.$invoice->id.'" style="color: #fff;text-decoration: none;">Pay</a></button>';
            $template = EmailTemplate::where('slug', 'invoice')->first()->value;
            $template_data = [
                '#1000089',
                '--username--',
                '--service--',
                '--sub_amount--',
                '--cgst_amount--',
                '--sgst_amount--',
                '--mnth_charges--',
                '--mnth_charges--',
                '--due_date--'
            ];
            $user_data = [
                $invoice->invoice_code . $invoice->invoice_number,
                $user->first_name,
                $service,
                $invoice->total_amount,
                0,
                0,
                $invoice->balance,
                0,
                $invoice->due_date
            ];
            $data = str_replace($template_data, $user_data, $template);
            $us_data = str_replace('--payment_button--', $buttton, $data);
            return $this->view('content.sale.invoice-mailtemplate',compact('us_data'));
        }
    }
}
