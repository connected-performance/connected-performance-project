<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //
    public function invoice_index(){

        // $user = User::where('confirmation_code', '=', 123456, 'and')->where('id', '=', 5, 'or')->where('role', '=', 'admin')->first();
        return view('test-page');
//         $c_date = date('Y-m-d');
//        return   $invoices = Invoice::where('issue_date', '<=', $c_date)->where('status', '0')->get();
// return view('test-page');
//         $template = EmailTemplate::where('slug','welcome-mail')->first()->value;

//         return $data = str_replace('--name--','Developer',$template);

    }
}
