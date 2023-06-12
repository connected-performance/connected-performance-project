<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExtraChargeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $user;
    private $invoice;
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
        $user = $this->user;
        $invoice = $this->invoice;
        $buttton  = '<button style="background-color: #28c76f; padding: 2%; padding-left: 10%;  padding-right: 10%;border-radius: 10px;border: none; color:#fff;"><a href="http://phpstack-811730-2916767.cloudwaysapps.com/charges/'.$invoice->id.'" style="color: #fff;text-decoration: none;">Pay</a></button>';
        $template = EmailTemplate::where('slug', 'extra-charge')->first()->value;
        $template_data = [
            '--username--',
            '--amount--',
            '--description--',
            '--due_date--'
        ];
        $user_data = [
            $user->first_name,
            $invoice->amount,
            $invoice->description,
            $invoice->due_date
        ];
        $data = str_replace($template_data, $user_data, $template);
        $us_data = str_replace('--payment_button--', $buttton, $data);
        return $this->view('content.sale.invoice-mailtemplate',compact('us_data'));
    }
}
