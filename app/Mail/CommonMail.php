<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommonMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $user;
    private $template;
    private $data;
    public function __construct($user, $data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $data = $this->data;
        $mail = $this->user->email;
        $template = EmailTemplate::where('slug', 'global-mail')->first()->value;
        $template_data = ['--user-name--', '--description--', '--user-email--'];
        $user_data = [$user->first_name,$data,$mail];
        $data = str_replace($template_data, $user_data, $template);
        return $this->view('test-page',compact('data'));
    }
}
