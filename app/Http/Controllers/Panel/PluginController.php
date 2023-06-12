<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Plugin;
use Illuminate\Http\Request;

class PluginController extends Controller
{
    //
    public function index(){
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/plugin"), 'name' => 'plugin'],
            ['name' => __('plugin')],
        ];
        return view('plugin.plugin',compact('breadcrumbs'));
    }

    public function add_plugin(Request $request){
        try {
            $request->validate([
                'private_key' => 'required',
                'screte_key' => 'required',
               
            ]);
        $plugin = Plugin::where('name',$request->plugin)->first();
        if($plugin){
        }else{
            $plugin = new Plugin();
        }
        $plugin->name = $request->plugin;
        $plugin->private_key = $request->private_key;
        $plugin->secret_key = $request->screte_key;
        $plugin->security_id = $request->security_id;
        $plugin->save();
            $response = [
                'status' => 'success',
                'message' => 'Successfully Updated '.$request->plugin.' Plugin',
            ];
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];

            return response()->json($response);
        }
    }

    public function model(Request $request){
        $plugin = Plugin::where('name',$request->slug)->first();
        return response()->json($plugin);
    }
}
