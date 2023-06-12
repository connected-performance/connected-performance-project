<?php

namespace App\Http\Controllers;

use App\Models\Email_Template;
use App\Models\EmailTemplate;
use App\Models\SmsTemplate;
use App\Models\WhatsAppTemplate;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    //
    public function emailtemplate($template=null){

         if(!$template)
         {
             $template = 'test-email';
         }
         $templates =new  EmailTemplate;
        return view('template.email-template',compact('template','templates'));

    }
    public function saveTemplate(Request $req,$name) {

        try {

            $template = EmailTemplate::where('email_type',$name)->first();

            if(!$template) {
                $template = new EmailTemplate;
            }
            $template->email_type = $name;
            $template->title = $name;
            $template->subject = $name;
            $template->content = $req->template;
            $template->save();

            return redirect()->back()->with('success','Template has been updated successfully');

        } catch (\Throwable $th) {

            return redirect()->back()->with('error','Unable to update template. Something unexpected happened!');

        }


    }

    public function smsTemplates($template=null) {

        if(!$template)
        {
            $template = 'account-created';
        }
        $templates = SmsTemplate::all();
        return view('template.sms',compact('templates','template'));

    }

    public function saveSmsTemplate(Request $req,$name) {

        try {

            $template = SmsTemplate::where('sms_type',$name)->first();

            if(!$template) {
                $template = new SmsTemplate;
            }
            $template->sms_type = $name;
            $template->title = $name;
            $template->content = $req->template;
            $template->save();

            return redirect()->back()->with('success','Template has been updated successfully');

        } catch (\Throwable $th) {

            return redirect()->back()->with('error','Unable to update template. Something unexpected happened!');

        }
    }
    public function whatsappTemplate() {

        $template = WhatsappTemplate::first();
        return view('template.whatsapp',compact('template'));

    }

    public function saveWhatsappTemplate(Request $req) {

        try {

            $template = WhatsappTemplate::first();

            if(!$template) {
                $template = new WhatsappTemplate;
            }
            $template->title = 'Whatsapp Template';
            $template->content = $req->template;
            $template->save();

            return redirect()->back()->with('success','Template has been updated successfully');

        } catch (\Throwable $th) {

            return redirect()->back()->with('error','Unable to update template. Something unexpected happened!');

        }


    }
}
