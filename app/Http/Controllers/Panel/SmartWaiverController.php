<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SmartWaiverController extends Controller
{
    //
    public function index(){

        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("panel/smart-waiver/template"), 'name' => 'Template'],
            ['name' => __('template')],
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.smartwaiver.com/v4/templates');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $headers = array();
        $headers[] = 'Sw-Api-Key: 2ca0284b435662666515868b0b45874f';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        $data =   json_decode($result);
        $data =  @$data->templates;
        
        return view('smartwaiver.templates',compact('data', 'breadcrumbs'));
    }
}
