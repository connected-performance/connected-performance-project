<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    //

    public function contract_index(){
        return view('content.contract.contract-index');
    }
}
