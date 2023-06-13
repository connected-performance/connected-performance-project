<?php

namespace App\Http\Controllers\Panel;

use App\Events\ActivityLog;
use App\Events\Notificaion;
use App\Http\Controllers\Controller;
use App\Jobs\SendMailMessagJob;
use App\Mail\GlobalMail;
use App\Models\ActivityLog as ModelsActivityLog;
use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Invoice;
use App\Models\Lead;
use App\Models\Role;
use App\Models\State;
use App\Models\Trainer;
use App\Models\User;
use App\Models\UserNote;
use App\Repositories\FileUploadRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use MessageBird\Client;
use MessageBird\Objects\Message;
use App\Models\EmailTemplate;
use App\Mail\DemoMail as MailDemoMail;

class UserController extends Controller
{
    /** @var UserRepository */
    private $userRepository;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $userRepository
     */
    public function __construct(UserRepository $userRepository, $data_s = null)
    {
         $name = \Request::segment(3);
        // $request = new Request();
        // $name = $request->segment(3);
        $this->userRepository = $userRepository;
        $this->data_s = $data_s;
        $this->data_s = [];
 
         

            // $ch = curl_init();

            // curl_setopt($ch, CURLOPT_URL, 'https://api.smartwaiver.com/v4/search?templateId=vmwvywvnfbo6148ycdyadb');

            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


            // $headers = array();
            // $headers[] = 'Sw-Api-Key: 2ca0284b435662666515868b0b45874f';


            // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            // $result = curl_exec($ch);
            // if (curl_errno($ch)) {
            //     return "Error";
            // }
            // $data =   json_decode($result);

            if (isset($data->search->guid)) {

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://api.smartwaiver.com/v4/search/' . $data->search->guid . '/results?page=0');

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


                $headers = array();
                $headers[] = 'Sw-Api-Key: 2ca0284b435662666515868b0b45874f';
                // $headers[] = 'templateId: picyqbwmbu4y4wrcahrgme';
                // $headers[] = 'Sw-Api-Key: 2f5ad55bdbfe30da1cef293a89dbf1f9';

                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    return "Errror";
                }
                $data =   json_decode($result);
                $data = $data->search_results;
                foreach ($data as $value) {
                    $this->data_s[] = $value->email;
                }
            }
        
     
    }

    public function user_admin()
    {
        //dd(\Request::segment(3));
        // return auth()->user()->notifications;
        // return User::with('notifications')->with(['user_notifications' =>function($query){
        //     return $query->with('notifications');
        // }])->get();
        $employe = [];
        $users = [];
        $countries = [];
        $role = '';
        $modal = '';
        $role_data = Role::get();
        $countries = Country::get();
        $name = 'customer';
        $page = $name;
        $breadcrumbs = [
            ['link' => url("/"), 'name' => 'Dashboard'],
            ['link' => url("/panel/".$name.""), 'name' => $name],
            ['name' => __($name)],
        ];
        if($name == 'admin'){
            $role = $name;//Role::where('name','admin')->first(['id','name']);
            $modal = "Add Admin";
            $page = "Admins";
            $role_data = Role::where('for_user',1)->get();
            return view('content.users.user',compact('breadcrumbs','role','modal','page', 'role_data','employe','users', 'countries'));
        }
        if ($name == 'employee') {
        
            $role = $name;//Role::where('name', 'trainer')->first(['id', 'name']);
            $modal = "Add Employe";
            $page = "Employees";
            $role_data = Role::where('for_user', 2)->get();
            return view('content.users.user',compact('breadcrumbs','role','modal','page', 'role_data','employe','users', 'countries'));
        }
        if ($name == 'customer') {
            $role = $name;
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://api.smartwaiver.com/v4/search?templateId=vmwvywvnfbo6148ycdyadb');

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


            $headers = array();
            $headers[] = 'Sw-Api-Key: 2ca0284b435662666515868b0b45874f';


            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                return "Error";
            }
            $data =   json_decode($result);

            if (isset($data->search->guid)) {

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://api.smartwaiver.com/v4/search/' . $data->search->guid . '/results?page=0');

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


                $headers = array();
                $headers[] = 'Sw-Api-Key: 2ca0284b435662666515868b0b45874f';
                // $headers[] = 'templateId: picyqbwmbu4y4wrcahrgme';
                // $headers[] = 'Sw-Api-Key: 2f5ad55bdbfe30da1cef293a89dbf1f9';

                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    return "Errror";
                }
                $data =   json_decode($result);
                $data = $data->search_results;
                foreach ($data as $value) {
                    $this->data_s[] = $value->email;
                }
            }
            /**********************End**************************** */
            $role =$name;//Role::where('name', 'customer')->first(['id', 'name']);
            $modal = "Add Employe";
            $page = "Customers";
            $employe =  User::where('is_employe',1)->with('employee')->get();
            $users =  User::where('is_customer','!=', 1)->get(['id', 'first_name'])
            ->prepend(['id' => auth()->id(), 'first_name' => 'Me'])->toArray();
            $role_data = Role::where('for_user', 3)->get();
            return view('content.users.customer', compact('breadcrumbs','role', 'modal', 'page', 'role_data', 'employe', 'users', 'countries'));
        }

        // return view('content.users.user',compact('breadcrumbs','role','modal','page', 'role_data','employe','users', 'countries'));
    }

    public function user_ajax(Request $request)
    {
        if($request->role_id == 'admin'){
            $records =  User::where('is_admin', true)->where('id', '!=', 1)->Where('id', '!=', auth()->id())->with('country')->with('state')->with('city')->get();
        }
        else{
            $records =  User::where('is_employe', true)->where('id', '!=', 1)->Where('id', '!=', auth()->id())->with('country')->with('state')->with('city')->get();
        }
         if($request->role_id == 'customer'){

            $records =  User::where('is_customer', true)->with(['customer' => function ($query) {
                return $query->where('status','1')->with('employee')->with('referral')->with('invoices');
            }])->with('country')->with('state')->get();
            return DataTables::of($records)->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="#" style="padding-left:10px;" class="link-success"  data-bs-toggle="tooltip"
                data-bs-placement="top" title="Increase Duration" onclick="increase_duration(' . $row->id . ')"><i class="fa-solid fa-calendar" aria-hidden="true"></i></a>'.'<a href="' . route('user.detail', ['id' => $row->id]) . '" style="padding-left:10px;" class="link-primary"  data-bs-toggle="tooltip"
                data-bs-placement="top" title="View"><i class="fas fa-eye"></i></a>'.'<a href="#" style="padding-left:10px;" class="link-success"  data-bs-toggle="tooltip"
                data-bs-placement="top" title="Edit" onclick="edit_data(' . $row->id . ')"><i class="fas fa-edit"></i></a>' .
                '<a href="#" style="padding-left:10px;" class="link-danger"  data-bs-toggle="tooltip"
                data-bs-placement="top" title="Delet" onclick="delete_data(' . $row->id . ')"><i class="fa-solid fa-trash"></i></a>'.
                '<a href="#" style="padding-left:10px;" class="link-warning"  data-bs-toggle="tooltip"
                data-bs-placement="top" title="Lead Converted" onclick="lead_converted(' . $row->id . ')"><i class="fa-solid fa-arrows-turn-right"></i></a>';
                return $btn;
            })
            ->addColumn('status', function ($row) {
                if ($row->status == '0') {
                    $status = '<span class="badge fix_badges bg-danger  rounded">Closed</span>';
                } else {
                    $status = '<span class="badge fix_badges bg-success  rounded">Active</span>';
                }
                return $status;
            })
                ->addColumn('country', function ($row) {
                    if ($row->country != null) {
                    $country = $row->country->name;
                    } else {
                         $country = '';
                    }
                    return $country;
                })
                ->addColumn('state', function ($row) {
                    if ($row->state != null) {
                    $state = $row->state->name;
                    } else {
                         $state = '';
                    }
                    return $state;
                })
                ->addColumn('city', function ($row) {
                    if ($row->city != null) {
                    $city = $row->city->name;
                    } else {
                    $city = '';
                    }
                    return $city;
                })
            ->addColumn('trainer', function ($row) {
                if (isset($row->customer->employee)) {
                     $trainer = '<img class="round" src="'.$row->avatar.'" alt="avatar" height="40" width="40">';
                } else {
                     $trainer = '';
                }
                return $trainer;
            })
            ->addColumn('time_duration', function ($row) {
                if (isset($row->customer->invoices[0])) {
                     $time = $row->customer->invoices[0]->time_period;
                     $data = explode(',',$time);
                     $time = $data[0]. '  ' .ucfirst($data[1]);
                } else {
                     $time = '';
                }
                return $time;
            })
            ->addColumn('billing_status', function ($row) {
                if (isset($row->customer->invoices[0])) {
                    $billing = $row->customer->invoices->where('balance_status', 0)->first();
                    if ($billing) {
                        return $billing = '<span class="badge rounded-pill  badge-light-warning">Recurring Pay</span>';
                    } else {
                         $billing = '<span class="badge rounded-pill  badge-light-success">Done</span>';
                    }
                } else {
                     $billing = '';
                }
                return $billing;
            })
            ->addColumn('traning_length', function ($row) {
                if (isset($row->customer)) {
                    $length = '';
                    $user_id = $row->customer->user_id;
                    $user = Invoice::where('user_id',$user_id)->get();
                    $balance_count =Invoice::where('balance_status',1)->count();
                    if($balance_count == null){

                    }else{
                        foreach($user as $data){
                            $total_amount = $data->total_amount;
                            $duration = $data->duration;
                            $paid = $balance_count;
                            if($data->balance_status == 1){
                                $current = $data->balance*$paid;
                            }
                        }
                        $width = $current/$total_amount*100;
                        $length = '<div class="demo-vertical-spacing">
                        <div class="progress progress-bar-success">
                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                            role="progressbar"
                            aria-valuenow="20"
                            aria-valuemin="0"
                            aria-valuemax="100"
                            style="width:'.$width.'%">
                        </div>
                        </div>';
                    }
                } else {
                     $length = '';
                }
                return $length;
            })
            ->addColumn('services', function ($row) {
                if (isset($row->customer)) {
                     $serices = '<span class="badge fix_badges bg-info  rounded">' . $row->customer->service . '</span>';
                } else {
                     $serices = '';
                }

                return $serices;
            })
            ->addColumn('email', function ($row) {
                    $mail = '<a onclick="send_message('.$row->id.',1)">'.$row->email.'</a>';
                    return $mail;
            })
            ->addColumn('phone_number', function ($row) {
                $phone_number = '<a onclick="send_message(' . $row->id . ',2)">' . $row->phone_number . '</a>';
                    return $phone_number;
                })
                    ->addColumn('agreement', function ($row) {

                    if (in_array($row->email, $this->data_s)) {
                        return  '<span class="badge fix_badges bg-success  rounded">Done</span>';
                    } else {
                        return  '<span class="badge fix_badges bg-danger  rounded">Pending</span>';

                    }
              
            })
                ->rawColumns(['agreement','action', 'status', 'services', 'traning_length', 'billing_status', 'time_duration', 'trainer', 'state', 'country', 'city','email', 'phone_number'])
                ->make(true);
                
        }else{
            return DataTables::of($records)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'.route('user.detail',['id'=>$row->id]).'" style="padding-left:10px;" class="link-primary"  data-bs-toggle="tooltip"
                data-bs-placement="top" title="View"><i class="fas fa-eye"></i></a>'.'<a href="#" style="padding-left:10px;" class="link-success"  data-bs-toggle="tooltip"
                data-bs-placement="top" title="Edit" onclick="edit_data(' . $row->id . ')"><i class="fas fa-edit"></i></a>' .
                        '<a href="#" style="padding-left:10px;" class="link-danger"  data-bs-toggle="tooltip"
                data-bs-placement="top" title="Delet" onclick="delete_data(' . $row->id . ')"><i class="fa-solid fa-trash"></i></a>';
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == '0') {
                        $status = '<span class="badge fix_badges bg-danger  rounded">Closed</span>';
                    } else {
                        $status = '<span class="badge fix_badges bg-success  rounded">Active</span>';
                    }
                    return $status;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
       
    }

    public function create_update_user(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'phone_number' => 'required',
                'dob' => 'required',
                // 'address' => 'required',
                'status' => 'required',
            ]);

            
            if ($request->user_id != 0 && $request->user_role != 'customer') {
                if ($request->password) {
                    $request->validate(['password' => 'required|confirmed|min:6',]);
                }
                 $user = User::find($request->user_id);
                if ($user->email != $request->email) {
                    $request->validate([
                        'email' => 'required|email|unique:users',
                    ]);
                }
                $messsage = 'User Successfully Updated!';
                $actor = "";
                if (auth()->user()->is_admin == true) {
                    $actor = 1;
                } else {
                    $actor = 2;
                }
                $data = [
                        'user_id' => auth()->id(),
                        'name' => auth()->user()->first_name . " Update User",
                        'event_name' => "Update User",
                        'email' => auth()->user()->email,
                        'description' => "Update User Successfully",
                        'actor' => $actor,
                        'url' => url()->current(),
                    ];
                event(new ActivityLog($data));

                $notification = [
                    'user_id' => auth()->id(),
                    'title' =>  'Create Customer Profile',
                    'description' =>  "Complete the " . $user->first_name . " customer profile",
                ];
                if (auth()->user()->is_admin == false) {
                    event(new Notificaion($notification));
                }

            } elseif($request->user_role != 'customer'){
                $request->validate([
                    'email' => 'required|email|unique:users',
                    'password' => 'required|confirmed|min:6',
                ]);
                $user = new User();
                $messsage = 'User Successfully Added!';
                $actor = "";
                if (auth()->user()->is_admin == true) {
                    $actor = 1;
                } else {
                    $actor = 2;
                }
                $data = [
                    'user_id' => auth()->id(),
                    'name' => auth()->user()->first_name . " Create User",
                    'event_name' => "Create User",
                    'email' => auth()->user()->email,
                    'description' => "Create User Successfully",
                    'actor' => $actor,
                    'url' => url()->current(),
                ];
                event(new ActivityLog($data));
            }else{
            $user = User::find($request->user_id);
                $actor = "";
                if (auth()->user()->is_admin == true) {
                    $actor = 1;
                } else {
                    $actor = 2;
                }
                $data = [
                    'user_id' => auth()->id(),
                    'name' => auth()->user()->first_name . " Update Customer Profile",
                    'event_name' => "Update Customer Profile",
                    'email' => auth()->user()->email,
                    'description' => "Update Customer Profile Successfully",
                    'actor' => $actor,
                    'url' => url()->current(),
                ];
                event(new ActivityLog($data));
            $messsage = 'User Successfully Added!';
            }

              if($request->user_role == 'admin'){
                $user->is_admin = true;
                $user->active_portal = 'admin';
            }
            if($request->user_role == 'employee'){
                $user->is_employe = true;
                $user->active_portal = 'employe';
            }
            if ($request->user_role == 'customer') {
                $user->is_customer = true;
                
            }
                $user->countrie_id = $request->country;
                $user->state_id = $request->state;
                $user->citie_id = $request->city;
                $user->first_name=$request->first_name;
                $user->last_name=$request->last_name;
                // $user->role_id=$request->user_role;
                $user->username=$request->email;
                $user->email=$request->email;
                $user->address=$request->address;
                $user->password=Hash::make($request->password);
                $user->phone_number=$request->phone_number;
                $user->dob=$request->dob;
                $user->status=$request->status;
            if ($request->hasFile('avatar')) {
                $fileName = $this->userRepository->updateProfilePhoto($user, $request->file('avatar'));
                $user->avatar = $fileName;
            }
            $user->save();
            if($request->user_role  == 'customer'){

                if($request->user_id<=0)
                {
                    $customer = new Customer();
                    $customer->user_id = $user->id;
                    $customer->status = 1;
                    $customer->service = $request->service;
                    $customer->employee_id = $request->user_trainer;
                    $customer->notes = $request->notes;
                    $customer->save();
                    $type = 'customer';
                    Mail::to($user->email)->send(new MailDemoMail($user,$type));
                }
                else {
                    $customer = Customer::find($user->customer->id);
                    // $customer->referral_id = $request->user_referral;
                    $customer->employee_id = $request->user_trainer;
                    $customer->notes = $request->notes;
                    $customer->save();
                }

            }
            if($request->user_role  == 'admin'){
                $role  = Role::where('id', $request->check_role)->first();
                $user->roles()->save($role);
            }
          
            if($request->user_role == 'employee'){
                $role  = Role::where('id', $request->check_role)->first();
                $user->roles()->save($role);
                $employe = new Employee();
                $employe->user_id = $user->id;
                $employe->date_of_joining = date('Y-m-d');
                $employe->salary_type = $request->salary_type;
                $employe->salary = $request->salary;
                $employe->save();
            }
            $response = [
                'status' => 'success',
                'message' => $messsage,
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

    public function delete(Request $request){
        try {

            $data = User::where('id',$request->id)->delete();

            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Delete User",
                'event_name' => "Delete User",
                'email' => auth()->user()->email,
                'description' => "Delete User",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));
            $response = [
                'status' => 'success',
                'message' => 'User Successfully Deleted!',
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
    public function user_trainer()
    {
         $role = Role::where('name','trainer')->first(['id','name']);
        return view('content.users.user',compact('role'));
    }

    public  function admin_data(Request $request){
        try{
            // $data = User::where('id', $request->id)->with('country')->with('state')->with('roles')->first();
            $data= User::find($request->id);
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
        }}

        public function user_edit(Request $request){
            try {
            $data = User::where('id', $request->id)->with('country')->with('state')->with('roles')->first();
                if($data->is_employe === true){
                  $data = User::where('id', $request->id)->with('employee')->first();
                }
                if($data->is_customer === true){
                $data = User::where('id', $request->id)->with(['customer' => function ($query){
                    return $query->with('employee')->with('referral');
                }])->with('country')->with('state')->first();
                // dd($data);
                }
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
    public function get_state(Request $request)
    {
        $state = State::where('country_id', $request->id)->get(['id', 'name']);
        return response()->json($state);
    }

    public function get_city(Request $request)
    {
        $state = City::where('state_id', $request->id)->get(['id', 'name']);
        return response()->json($state);
    }

    public function user_detail($id){
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/users/detailt/" . $id), 'name' => 'Detail'],
            ['name' => __('Details')],
        ];
        // return $records = Invoice::where('created_by', $id)->with('users')->get();
     
        $users = User::find($id);
        $activities = ModelsActivityLog::where('user_id',$id)->get();
        return view('content.users.user-detail',compact('users', 'activities', 'breadcrumbs','id'));
    }

    public function user_detail_invoice_ajax(Request $request){
       
        $user = User::find($request->id);
        if($user->is_customer == true){ 
            $records = Invoice::where('user_id', $request->id)->with('users')->get();
        }else{
              $records = Invoice::where('created_by', $request->id)->with('users')->get();
        }

        return DataTables::of($records)->addIndexColumn()
            ->addColumn('status', function ($row) {
                if ($row->status == '0') {
                    $status =  '<span class="badge rounded-pill  badge-light-info">Draft</span>';
                } else {;
                    $status  = '<span class="badge rounded-pill  badge-light-success">Send</span>';
                }
                return $status;
            })
            ->addColumn('balance_status', function ($row) {
                if ($row->balance_status == '0') {
                    $balance_status =  '<span class="badge rounded-pill  badge-light-warning">Pending</span>';
                } else {;
                    $balance_status  = '<span class="badge rounded-pill  badge-light-success">Paid</span>';
                }
                return $balance_status;
            })->addColumn('invoice_number', function ($row) {
                $number = $row->invoice_code . $row->invoice_number;
                return $number;
            })
            ->rawColumns(['invoice_number', 'status', 'balance_status'])
            ->make(true);

    }

    public function referral_ajax(Request $request){
          $records = Customer::where('referral_id', auth()->id())->with(['user' => function ($query) {
            return $query->with('country')->with('state')->with('city');
        }])->get();
     
        return DataTables::of($records)->addIndexColumn()
            ->addColumn('country', function ($row) {
                if (isset($row->user->countrie_id)) {
                $country =  $row->user->country->name;
                } else {;
                $country  = '';
                }
                return $country;
            })
            ->addColumn('state', function ($row) {
                if (isset($row->user->state_id)) {
                $state =  $row->user->state->name;
                } else {;
                $state  = '';
                }
                return $state;
            })
            ->addColumn('city', function ($row) {
                if (isset($row->user->citie_id)) {
                $city =  $row->user->city->name;
                } else {;
                $city  = '';
                }
                return $city;
            })
            ->rawColumns(['country', 'state', 'city'])
            ->make(true);
    }

    public function create_mail(){
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/users/send/mail/"), 'name' => 'send mail'],
            ['name' => __('send mail')],
        ];
        $users = User::where('is_admin',false)->where('id','!=',auth()->id())->get();
        return view('content.users.send-mail',compact('breadcrumbs','users'));
    }

    public function send_mail(Request $request){

        try{
            $request->validate([
                'type' => 'required',
                'user' => 'required',
                'description' => 'required',
            ]);
            $messsage = '';
            $data = [];
            $description = $request->description;
            if ($request->type == 1) {
                    foreach ($request->user as $user){
                    $data = User::where('id', $user)->first();
                    $mail = $data->email;
                    // $data = $request->description;
                    Mail::to($mail)->send(new GlobalMail($data,$mail,$description));
                }
                 $user = User::get(['id']);
                // Mail::to('hbdeveloper.two@gmail.com')->send(new MailDemoMail('Developer'));
            //  dispatch(new SendMailMessagJob($user,$request->type,$request->description))->delay(now()->addSeconds(5));
             $messsage = "Mail Successfully Send";
       
            }
            elseif($request->type == 2) {
                // $phone = [];
                // foreach ($request->user as $user){
                //     $data = User::where('id', $user)->first();
                //     $phone = $data->phone_number;
                // }
                // $accesskey = "0adCg9DdHB8uzIi4ROqCW49Js";
                // $MessageBird = new Client($accesskey);
                // $Message = new Message();
                // $Message->originator = 'Benifits';
                // $Message->recipients = array($phone);
                // $Message->body = $request->description;
                // $MessageBird->messages->create($Message);
                $messsage = "SMS Successfull Send";
               
            }else{
                $response = [
                    'status' => 'error',
                    'message' => 'Something Is Wrong'
                ];
                return response()->json($response);
            }
            $response = [
                'status' => 'success',
                'message' => $messsage
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

    function single_sender(Request $request){
        try {
            $request->validate([
                'description' => 'required',
            ]);

            if($request->type == 1){
                $user = User::where('id',$request->recever_id)->first();
                Mail::to($user->email)->send(new GlobalMail($user->email, $request->description));
                $message = "Mail Successfull Send";
            }else{
                $user = User::where('id', $request->recever_id)->first();
                $accesskey = "0adCg9DdHB8uzIi4ROqCW49Js";
                $MessageBird = new Client($accesskey);
                $Message = new Message();
                $Message->originator = 'Benifits';
                $Message->recipients = $user->phone_number;
                $Message->body = $request->description;
                $MessageBird->messages->create($Message);
                $message = "SMS Successfull Send";

            }

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

    public function single_reciver(Request $request){
        try {
            $user = User::where('id',$request->id)->first();
            $response = [
                'status' => 'success',
                'data' => $user,
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

    public function customer_to_lead(Request $request){
        try {
           
             $customer = Customer::where('user_id', $request->id)->update(['status' => 0]);
             $user = User::where('id', $request->id)->update(['is_lead' => '1','is_customer'=>0]);
             $user = User::where('id', $request->id)->first();
             $user->update(['is_lead' => '1','is_customer'=>0]);
             $lead = Lead::where('email',$user->email)->update(['status' => '0']);
            $response = [
                'status' => 'success',
                'message' => 'Customer Change Into Lead',
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

    public function increase_duration(Request $request){

        try {

            $data = Invoice::where('user_id',$request->id)->get('due_date')->max('due_date');
            $data = Invoice::where('user_id',$request->id)->where('due_date',$data)->with('users')->first();
            $issue_date = date('Y-m-d', strtotime($data->issue_date . ' + 1 months'));
            $due_date = date('Y-m-d', strtotime($data->due_date . ' + 1 months')); 
            $response = [
                'status' => 'success',
                'data' => $data,
                'issue_date' => $issue_date,
                'due_date' => $due_date
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

    public function increase_duration_save(Request $request)
    {

        try {
        //    return $request->all();

            if ($request->due_date <= $request->issue_date) {
                $response = [
                    'status' => 'error',
                    'message' => 'Due Date Must Be Greater Then Issue Date',

                ];
                return response()->json($response);
            }
            $invoice = Invoice::where('user_id',$request->user_id)->first();
            $af_duration =  $invoice->duration;
            $duration = '';
            $data = explode(',', $request->duration);
            if ($data[1] == 'month') {
                $duration = $data[0];
            } else {
                $duration = $data[0] * 12;
            }
             $total_duration = $duration + $af_duration;
             $invoice = Invoice::where('user_id',$request->user_id)->update(array('duration'=>$total_duration, 'time_period'=>$total_duration.',' . ' Month'));
             
            $customer_id = Customer::where('user_id', $request->user_id)->first();
            $customer_id->status = '1';
            $customer_id->save();
            $issue_date = $request->issue_dates;
            $due_date = $request->due_date;

            $ino_number = Invoice::latest()->first();
            if ($ino_number) {
                $number = $ino_number->invoice_number + 1;
            } else {
                $number = 1000 + 1;
            }

            //Loop
            for ($i = 1; $i <= $duration; $i++) {
                $invoice = new Invoice();

                if ($number) {
                    $number = $number + 1;
                } else {
                    $number = 1000 + 1;
                }
                $invoice->user_id = $request->user_id;
                $invoice->invoice_number = $number;
                $invoice->invoice_code = "#N";
                if ($i > 1) {

                    $issue_date = date('Y-m-d', strtotime($issue_date . ' + 1 months'));
                    $due_date = date('Y-m-d', strtotime($due_date . ' + 1 months'));
                } else {
                    $issue_date = $request->issue_dates;
                    $due_date = $request->due_date;
                }

                $invoice->created_by = auth()->id();
                $invoice->customer_id = $customer_id->id;
                $invoice->issue_date = $issue_date; //$request->issue_date;
                $invoice->due_date = $due_date; //$request->due_date;
                $invoice->description = $request->description;
                $invoice->total_amount =  $request->price;
                $subtotal_amount = $request->price / $duration;
                $invoice->balance = round($subtotal_amount, 2);
                $invoice->time_period = $request->duration;
                $invoice->duration = $duration;
                $invoice->save();
            }


            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Create Invoice",
                'event_name' => "Create Invoice",
                'email' => auth()->user()->email,
                'description' => "Create Invoice Successfully",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));
            $notification = [
                'user_id' => auth()->id(),
                'title' =>  'Invoice Create',
                'description' => 'Create new invoice for ' . @$customer_id->user->first_name . ' customer'
            ];
            if (auth()->user()->is_admin == false) {
                event(new Notificaion($notification));
            }

          

            $response = [
                'status' => 'success',
                'message' => 'Duration Successfully Increase',
                
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

    public function token_request($id)
    {
        $url = $_SERVER['SERVER_NAME'];
        $user = User::findOrFail($id);
        $buttton  = '<a href="'.$url.'/token/request/update/'.$user->id.'" style="background-color: #28c76f; padding: 20%; padding-left: 30%;  padding-right: 30%;border-radius: 5px;border: none; color:#fff;text-decoration-line:none;width:80px">Update</a>';
        $template = EmailTemplate::where('slug', 'token-request')->first()->value;
        $template_data = ['--name--'];
        $user_data = [$user->first_name,];
        $data = str_replace($template_data, $user_data, $template);
        $us_data = str_replace('--payment_button--', $buttton, $data);

        \Mail::send(
            'content.sale.invoice-mailtemplate', 
            ['us_data' => $us_data], 
            function($message) use ($user){
            $message->from($user->email, 'Connected Performance');
            $message->to($user->email, 'Connected Performance')->subject('Token Request');
        });

        return redirect()->back()->with('success', 'Request sent successfully');
    }

    public function noteSave(Request $request)
    {
        /*$this->validate($request,[
            'method' => 'content',
            'amount' => 'customer',
        ]);

        $note = new UserNote();
        $note->content = $request->content;
        $note->customer_id = $request->customer;
        if($note->save()){
            return redirect()->back()->with('success', 'Note created successfully');
        }else{
            return redirect()->back()->with('error', 'Error');
        }*/

        try {
            $request->validate([
                'method' => 'content',
                'amount' => 'customer',
            ]);

            $note = new UserNote();
            $note->content = $request->content;
            $note->customer_id = $request->customer;
            if($note->save()){
                $message = "Note created successfully";

                $response = [
                    'status' => 'success',
                    'message' => $message,
                ];
                return response()->json($response);
            }
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'message' => 'Error creating record',
            ];

            return response()->json($response);
        }
    }
}
