<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail as MailDemoMail;
use App\Models\SendMailMessages;

class SendMailMessagJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user,$type,$description)
    {
        //
        $this->user = $user;
        $this->type = $type;
        $this->description = $description;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->user;
        $type = $this->type;
        $description = $this->description;


        foreach ($user as $value){
            Mail::to('hbdeveloper.two@gmail.com')->send(new MailDemoMail('Developer'));
            $data = new SendMailMessages();
            $data->user_id = $value['id'];
            $data->date = date('Y-m-d');
            $data->type = $type;
            $data->message = $description;
            $data->status = '0';
            $data->save();
        }
        //     Mail::to('hbdeveloper.two@gmail.com')->send(new MailDemoMail('Developer'));
        // }

        Mail::to('hbdeveloper.two@gmail.com')->send(new MailDemoMail('Developer'));

    }
}
