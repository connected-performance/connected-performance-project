<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GlobalMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail,$data,$description)
    {
        //

        $this->mail = $mail;
        $this->data = $data;
        $this->description = $description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        $mail = $this->mail;
        $description = $this->description;
        $user = User::where('email',$mail->email)->first();
        $template = EmailTemplate::where('slug', 'global-mail')->first()->value;
        $template_data = ['--user-name--', '--description--', '--user-email--'];
        $user_data = [$user->first_name,$description,$user->email];
        $data = str_replace($template_data, $user_data, $template);
        return $this->view('test-page',compact('data'));
    }
}
