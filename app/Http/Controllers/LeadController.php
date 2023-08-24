<?php
namespace App\Http\Controllers;

use App\Events\ActivityLog;
use App\Events\Notificaion;
use App\Mail\MeetingScheduleMail;
use App\Models\Customer;
use App\Models\FormBuilder;
use App\Models\FormField;
use App\Models\FormResponse;
use App\Models\Invoice;
use App\Models\Lead;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class LeadController extends Controller
{
    //
    public function Leads()
    {
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/lead"), 'name' => 'lead'],
            ['name' => __('lead')],
        ];
         $records =  Lead::where('status', '0')->with('form')->get();
        $modal = 'Create New Lead';
        return view('content.lead.leadview',compact('breadcrumbs','modal'));
    }
    public function lead_ajax(Request $request){
        $records =  Lead::with('form')->where('status', '!=', '2')->get();
        return DataTables::of($records)->addIndexColumn()
            ->addColumn('action', function ($row) {
                    $btn = '<a href="#" style="padding-left:10px;" class="link-danger"  data-bs-toggle="tooltip"
                data-bs-placement="top" title="Delet" onclick="delete_data(' . $row->id . ')"><i class="fa-solid fa-trash"></i></a>';
                    return $btn;
            })
            ->addColumn('name', function ($row) {
                $name = '<a href="#" style="padding-left:10px;" class="link-dark"  data-bs-toggle="tooltip"
                data-bs-placement="top" title="status" onclick="leadt_status(' . $row->id . ')">'.$row->name.'</a>';  
                return $name;
            })
            ->addColumn('last_name', function ($row) {
                $last_name = '<a href="#" style="padding-left:10px;" class="link-dark"  data-bs-toggle="tooltip"
                data-bs-placement="top" title="status" onclick="leadt_status(' . $row->id . ')">'.$row->last_name.'</a>';  
                return $last_name;
            })
            ->editColumn('closed_date', function ($row) { 
                $date = new Carbon($row->closed_date);
                $date = $date->format('Y-m-d');
                $date = date('l M, d, Y',strtotime($date));

                if($row->closed_date) {
                    return $date;
                } else {
                    return '---';
                }
                
            })
            ->addColumn('lead_status', function ($row) {
               if($row->status == '0'){
                $status = '<span class="badge rounded-pill  badge-light-info">Lead</span>';
               } elseif ($row->status == '2') {
                $status = '<span class="badge rounded-pill  badge-light-success">Customer</span>';
               }elseif($row->status == '3'){
                $status = '<span class="badge rounded-pill  badge-light-danger">Loss</span>';
               }else{
                $status = '<span class="badge rounded-pill  badge-light-warning">Pending</span>';
               }
               return $status ;
            })
            ->addColumn('form_name', function ($row) {
                if ($row->form != null) {
                $form_name = $row->form->name;
                }  else {
                $form_name = $row->form_name;
                }

                return $form_name;
            })
            ->addColumn('date', function ($row) {

                return $date = date('l M, d, Y',strtotime($row->lead_date));
            })
            ->rawColumns(['action', 'lead_status','date' ,'name', 'last_name', 'form_name'])
            ->make(true);
    }

    public function LeadGenerate(Request $request)
    {
        $value =''; // showing error of undefinaed variable so i defined it -ammar-26-12-22
        $date =  date('Y-m-d');
        $form = FormBuilder::where('code', 'LIKE', $request->code)->first();
        if (!empty($form)) {
            $arrFieldResp = [];
            $data =   FormResponse::create(
                   [
                    'form_builder_id' => $form->id,
                    'response' => json_encode($arrFieldResp),
                    ]
                );
                if ($form->is_active == 1) {
                $lead = new Lead();
                    if($request->email){
                        $email = Lead::where('email', 'LIKE', $request->email)->first();
                        if(!empty($email)){
                            return back()->with('error','This Email Allready exist');
                        }
                        $lead->email = $request->email;
                    }else{
                    // $request->validate([
                    //     'email' => 'required',
                    // ]);
                    }
                    if($request->name){
                        $lead->name = trim($request->name," ");
                    }else{
                    // $request->validate([
                    //     'name' => 'required',
                    // ]);
                    }
                    if($request->last_name){
                        $lead->last_name = trim($request->last_name," ");
                    }else{
                    // $request->validate([
                    //     'name' => 'required',
                    // ]);
                    }
                if (isset($request->text[0])) {
                    $arr = [];
                    foreach ($request->text as$value) {
                        $arr[] = $value;
                    }
                    $lead->text = json_encode($arr);
                }
                if(isset($request->text_area[0])){
                    $arr = [];
                    foreach ($request->text_area as $value) {
                        $arr[] = $value;
                    }
                    if(isset($arr[0])){ 
                        $lead->description = $arr[0];
                    }
                }
                if($request->drop_down){
                    $value =   DB::table('form_dropdowns')->where('key', $request->drop_down)->first()->value;
                    if($value){
                        $value = $value;
                    }else{
                        $value = $request->drop_down;
                    }
                    $lead->services = $value;
                }
                $lead->form_builder_id = $request->form_id;
                $lead->phone = $request->phone_plugin;
                $lead->status = '0';
                $lead->lead_date = $date;
                $name = $lead->name;
                $last_name = $lead->last_name;
                $lead->save();
                if($lead->email){

         
                    $user = new User();
                    $user->first_name = $request->name;
                    $user->last_name = $request->last_name;
                    $user->username = $request->email;
                    $user->email = $request->email;
                    $user->password = Hash::make('123456');
                    $user->phone_number = $request->phone_plugin;
                    $user->status = '0';
                    $user->is_lead = 1;
                    $user->active_portal = 'customer';
                    $user->save();
                    if($user){
                        $user_referral = User::where('is_admin',true)->first();
                        $customer = new Customer();
                        $customer->user_id = $user->id;
                        $customer->status = '0';
                        $customer->referral_id = @$user_referral->id;
                        $customer->service = $value;
                        $customer->save();
                    }
                }

                $actor = "";
                if (auth()->user()->is_admin == true) {
                    $actor = 1;
                } else {
                    $actor = 2;
                }


                $notification = [
                        'user_id' => User::where('is_admin', true)->first()->id,
                        'title' =>  'New Lead Created',
                        'description' => 'New Lead Created Successfully'
                    ];
          
                    event(new Notificaion($notification));
                return view('content.form.message',compact('name'));
            }
            
            return back()->with("error", "Sorry form is not active");

        }
        return back()->with("error","Sorry code not match");
    }

    public function Lead_cretae(Request $request){
        try {
            $request->validate([
                'name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'phone_number' => 'required',
                'description' => 'required',
                'drop_down' => 'required',
            ]);

            if ($request->lead_id != 0) {
                $lead = Lead::find($request->lead_id);
                $message = "Referral Successfullu Updated";
            } else {
                $lead = new Lead();
                $message = "Referral Successfullu Created";
            }
           
            $form_nmae = 'Created By '.@auth()->user()->first_name; 
            
            
            $lead->form_name = @$form_nmae;
            $lead->name = trim($request->name," ");
            $lead->last_name = trim($request->last_name," ");
            $lead->email = $request->email;
            $lead->phone = $request->phone_number;
            $lead->lead_date = date('Y-m-d');
            $lead->description = $request->description;
            $lead->services = $request->drop_down;
            $lead->status = '0';
            $lead->closed_date = $request->estimated_closed_date;
            $lead->save();

            $user = new User();
            $user->first_name = $request->name;
            $user->last_name = $request->last_name;
            $user->username = $request->email;
            $user->email = $request->email;
            $user->password = Hash::make('123456');
            $user->phone_number = $request->phone_number;
            $user->status = '0';
            $user->is_lead = 1;
            $user->active_portal = 'customer';
            $user->save();
            if ($user) {
                $customer = new Customer();
                $customer->user_id = $user->id;
                $customer->status = '0';
                 $customer->referral_id = auth()->id();
                $customer->service = $request->drop_down;
                $customer->referral_id = auth()->id();
                $customer->save();
            }
            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Create Referral",
                'event_name' => "Create Referral",
                'email' => auth()->user()->email,
                'description' => "Create Referral Successfully",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));

            $notification = [
                'user_id' => auth()->id(),
                'title' =>  'Create Referral',
                'description' => 'New lead created by his referral'
            ];
            event(new Notificaion($notification));
            /*if (auth()->user()->is_admin == true) {
                event(new Notificaion($notification));
            }*/
            $response = [
                'status' => 'success',
                'message' => $message,
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
    public  function lead_data(Request $request){
        try{ 
            $data= Lead::find($request->id);
            $response = [
                'status' => 'success',
                'data' => $data,
            ];
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'data' => $th->getMessage(),
            ];
            return response()->json($response);
        }

    }
    public  function lead_delete(Request $request)
    {
        try {
            $lead = Lead::find($request->id);
            $data = Lead::where('id',$request->id)->delete();
            $user = User::where('email',$lead->email)->where('is_lead',true)->delete();
            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Delete Lead",
                'event_name' => "Delete Lead",
                'email' => auth()->user()->email,
                'description' => "Delete Lead Successfull",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));
            $response = [
                'status' => 'success',
                'message' => 'Lead Successfullu Deleted',
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
    public function lead_schedual_metting(Request $request){

        try {
          $mail = Lead::find($request->lead_id);
         Mail::to($mail)->send(new MeetingScheduleMail());
        return redirect()->route('lead.view')->with('success','Mail Successfull Send');
        } catch (\Throwable $th) { 

           return redirect()->route('lead.view')->with('error',$th->getMessage());
        }
    }

    public function lead_note(Request $request){
        try {
            
            $lead = Lead::find($request->id);
            $lead->note = $request->note;
            $lead->save();
            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Updated Lead Note",
                'event_name' => "Lead Note",
                'email' => auth()->user()->email,
                'description' => "Lead Note Successfull Updated",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));
            $response = [
                'status' => 'success',
                'message' => 'Lead Note Successfullu Updated',
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

    public function lead_loss(Request $request){
        try {
            $date = Carbon::now();
            $lead = Lead::find($request->id);
            if($lead->status == '2'){
                $response = [
                    'status' => 'error',
                    'message' => 'Sorry Its Not A Lead',
                ];
                return response()->json($response); 
            }
            $lead->status = '3';
            $lead->closed_date = $date->format('Y-m-d h:i:s');
            $lead->save();
            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . "Lead Loss",
                'event_name' => "Lead Loss",
                'email' => auth()->user()->email,
                'description' => "Lead Successfully Loss ",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));
            $response = [
                'status' => 'success',
                'message' => 'Lead  Successfullu Loss',
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

    public function lead_step(Request $request){
        try{
            $message = '';
            if ($request->step == '0') {
                $message="Lead In Pending Stage";
            }
            if ($request->step == '1') {
                $message = "Lead In Working Stage";
            }
            if ($request->step == '2') {
                $message = "Lead In Complete Stage";
            }
            $lead = Lead::find($request->id);
            $lead->working_status = $request->step;
            $lead->save();
            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . "Lead Stage",
                'event_name' => "Lead Stage",
                'email' => auth()->user()->email,
                'description' => $message,
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));
            $response = [
                'status' => 'success',
                'message' => $message,
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

  
}
