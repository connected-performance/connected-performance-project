<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemoMail extends Mailable
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
        $user = $this->user;
        $user_name = $user->first_name;
        $customer = Customer::where('user_id',$user->id)->first();
        if($customer){
            $service = $customer->service;
            $service = str_replace("_", " ", $service);
            $service = ucwords($service);
        }else{
            $service = null;
        }
        
        $button = '<a class="button-a" style="background: #26a4d3; border: 15px solid #26a4d3; font-family: "Montserrat", sans-serif; font-size: 14px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 50px; font-weight: bold; color: white;" title="Agreement" href="https://waiver.smartwaiver.com/w/vmwvywvnfbo6148ycdyadb/web/" target="_blank" rel="noopener">Agreement</a>';
        $template = EmailTemplate::where('slug', 'welcome-mail')->first()->value;
        $template_data = ['--name--', '--agreement--', '--service--'];
        $user_data = [$user_name,$button,
        'This is an automatic email for the payment of the following service: ' . $service];
        $data = str_replace($template_data, $user_data, $template);
        // $data = str_replace('--name--', $user, $template);
        return $this->view('demo-mail',compact('data'));
    }
}
