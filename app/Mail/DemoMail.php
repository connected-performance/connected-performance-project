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


     private $user;

    public function __construct($user,$type)
    {
        //
          $this->user = $user;
          $this->type = $type;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $name = $user->first_name;
        $type = $this->type;
        if($type == 'customer' ){
            $customer = Customer::where('user_id',$user->id)->first();
            $service = $customer->service;
            $button = '<a class="button-a" style="background: #26a4d3; border: 15px solid #26a4d3; font-family: "Montserrat", sans-serif; font-size: 14px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 50px; font-weight: bold; color: white;" title="Agreement" href="https://waiver.smartwaiver.com/w/vmwvywvnfbo6148ycdyadb/web/" target="_blank" rel="noopener">Agreement</a>';
            $template = EmailTemplate::where('slug', 'welcome-mail')->first()->value;
            $template_data = ['--name--', '--service--','--agreement--'];
            $user_data = [$name,$service,$button];
            $data = str_replace($template_data, $user_data, $template);
            // $data = str_replace('--name--', $user, $template);
            return $this->view('demo-mail',compact('data'));
        }
        if($type = 'login'){
            $button = '<a class="button-a" style="background: #26a4d3; border: 15px solid #26a4d3; font-family: "Montserrat", sans-serif; font-size: 14px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 50px; font-weight: bold; color: white;" title="Agreement" href="https://waiver.smartwaiver.com/w/vmwvywvnfbo6148ycdyadb/web/" target="_blank" rel="noopener">Agreement</a>';
            $template = EmailTemplate::where('slug', 'Login')->first()->value;
            $template_data = ['--name--','--service--'];
            $user_data = [$name];
            $data = str_replace($template_data, $user_data, $template);
            // $data = str_replace('--name--', $user, $template);
            return $this->view('demo-mail',compact('data'));
        }
        // $service = $customer->service;

    }
}
