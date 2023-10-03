<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use App\Models\Customer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceCustomerUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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

        $customer = Customer::where('user_id',$user->id)->first();

        $service = $customer->service;
        $buttton  = '<a href="https://crm.connected-performance.com/customer-update-information/'.$user->uid.'" style="background-color: rgb(0, 108, 152); padding: 2%; padding-left: 10%;  padding-right: 10%;border-radius: 10px;border: none; color:#fff;">Update Information</a>';
        //$buttton  = '<a href="http://127.0.0.1/connected-performance-project/public/customer-update-information/'.$user->uid.'" style="background-color: rgb(0, 108, 152); padding: 2%; padding-left: 10%;  padding-right: 10%;border-radius: 10px;border: none; color:#fff;">Update Information</a>';
        $template = EmailTemplate::where('slug', 'token-request')->first()->value;
        $template_data = ['--name--'];
        $service = str_replace("_", " ", $service);
        $service = ucwords($service);
        $user_data = [$user->first_name.' '.$user->last_name];
        $data = str_replace($template_data, $user_data, $template);
        $us_data = str_replace('--payment_button--', $buttton, $data);
        return $this->view('content.sale.invoice-mailtemplate',compact('us_data'));
    }
}
