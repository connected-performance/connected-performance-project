<?php

namespace App\Http\Controllers\Panel;

use App\Events\ActivityLog;
use App\Events\Notificaion;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Form;
use App\Models\Lead;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    //

    public function employee_customer(){
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/my/customer"), 'name' => 'customers'],
            ['name' => __('customers')],
        ];
        $employe = [];
        $users = [];
        $countries = [];
        $countries = Country::get();

        $modal = "ss";
        $role ='customer'; //Role::where('name', 'customer')->first(['id', 'name']);
        $page = "Customers";
        $employe =  User::where('is_employe', 1)->with('employee')->get();
        $users =  User::where('is_customer', '!=', 1)->get(['id', 'first_name'])
        ->prepend(['id' => auth()->id(), 'first_name' => 'Me'])->toArray();
        $role_data = Role::where('for_user', 3)->get();
        return view('content.users.customer', compact('breadcrumbs', 'role', 'modal', 'page', 'role_data', 'employe', 'users', 'countries'));
   //  return view('employee.my-customer',compact('breadcrumbs','role', 'countries', 'employe', 'users', 'role_data'));
      
    }

    public function employee_customer_ajax(Request $request){
        $employee_id =  auth()->user()->employee->id;
          $records = Customer::where('employee_id', $employee_id)->where('status', '1')->with('referral')->with('invoices')->with(['user' => function ($query) {
            return $query->with('country')->with('state');
        }])->get();

        return DataTables::of($records)->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="#" style="padding-left:10px;" class="link-success"  data-bs-toggle="tooltip"
                data-bs-placement="top" title="Edit" onclick="edit_data(' . $row->user->id . ')"><i class="fas fa-edit"></i></a>' .
                    '<a href="#" style="padding-left:10px;" class="link-danger"  data-bs-toggle="tooltip"
                data-bs-placement="top" title="Delet" onclick="delete_data(' . $row->user->id . ')"><i class="fa-solid fa-trash"></i></a>';
                return $btn;
            })
            ->addColumn('name', function ($row) {
                if ($row->user->first_name) {
                $name =  $row->user->first_name ;
                } else {
                $name ='';
                }
                return $name;
            })
            ->addColumn('profile', function ($row) {
                if ($row->user->avatar != null) {
                $profile = '<img class="round" src="'. $row->user->avatar.'" alt="avatar" height="40" width="40">';

                } else {
                $profile = '<img class="round" src="http://connected-performance-crm.pk/images/avatars/male.png" alt="avatar" height="40" width="40">';

                }
                return $profile;
            })
            ->addColumn('referral', function ($row) {
                if ($row->referral->avatar != null) {
                $referral = '<img class="round" src="' . $row->referral->avatar . '" alt="avatar" height="40" width="40">';
                } else {
                $referral = '<img class="round" src="http://connected-performance-crm.pk/images/avatars/male.png" alt="avatar" height="40" width="40">';
                }
                return $referral;
            })
            ->addColumn('time_duration', function ($row) {
                if (isset($row->invoices[0])) {
                    $time = $row->invoices[0]->time_period;
                } else {
                    $time = '';
                }
                return $time;
            })
            ->addColumn('traning_length', function ($row) {
                if (isset($row)) {
                    $length = '<div class="demo-vertical-spacing">
            <div class="progress progress-bar-success">
              <div
                class="progress-bar progress-bar-striped progress-bar-animated"
                role="progressbar"
                aria-valuenow="20"
                aria-valuemin="20"
                aria-valuemax="100"
                style="width: 20%"
              ></div>
            </div>';
                } else {
                    $length = '';
                }
                return $length;
            })
            ->addColumn('billing_status', function ($row) {
                if (isset($row->invoices[0])) {
                    $billing = $row->invoices->where('balance_status', 0)->first();
                    if ($billing) {
                        return $billing = '<span class="badge rounded-pill  badge-light-warning">OnGoing</span>';
                    } else {
                        $billing = '<span class="badge rounded-pill  badge-light-success">Done</span>';
                    }
                } else {
                    $billing = '';
                }
                return $billing;
            })
            ->addColumn('status', function ($row) {
                if ($row->user->status == '0') {
                    $status = '<span class="badge fix_badges bg-danger  rounded">Closed</span>';
                } else {
                    $status = '<span class="badge fix_badges bg-success  rounded">Active</span>';
                }
                return $status;
            })
            ->rawColumns(['action', 'status', 'profile', 'referral', 'name', 'billing_status', 'time_duration', 'traning_length'])
            ->make(true);
    }

    public function employee_referrals(){
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/my/referrals"), 'name' => 'referrals'],
            ['name' => __('referrals')],
        ];
        $modal = 'Create New Referral';
       return view('employee.my-referral',compact('breadcrumbs', 'modal'));
    }

    public function employee_referrals_ajax(Request $request){
         $records  = Lead::where('employee_id',auth()->user()->employee->id)->get();
       
        return DataTables::of($records)->addIndexColumn()
        ->addColumn('action',function($row){
            if ($row->status == '0') {
                // $action = '<a href="#" style="padding-left:10px;" class="link-success"  data-bs-toggle="tooltip"
                // data-bs-placement="top" title="Edit" onclick="edit_data(' . $row->id . ')"><i class="fas fa-edit"></i></a>' .
                $action =  '<a href="#" style="padding-left:10px;" class="link-danger"  data-bs-toggle="tooltip"
                data-bs-placement="top" title="Delet" onclick="delete_data(' . $row->id . ')"><i class="fa-solid fa-trash"></i></a>';
            } else {
                $action = '';
            }
            return $action;
        })
        ->addColumn('status',function($row){
            if ($row->status == '0') {
                $status = '<span class="badge rounded-pill  badge-light-info">Lead</span>';
            } else {
                $status = '<span class="badge fix_badges bg-success  rounded">Customer</span>';
            }
            return $status;
        })
        ->rawColumns(['status','action'])
        ->make(true);
    }

    public function employee_referrals_create(Request $request){
       
        try {

            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone_number' => 'required',
                'description' => 'required',
                'drop_down' => 'required',
            ]);

            if($request->lead_id != 0){
                $lead = Lead::find($request->lead_id);
                $message = "Referral Successfullu Updated";
            }else{
                $lead = new Lead();
                $message = "Referral Successfullu Created";
            }
           
            $form_nmae = 'Created By '. @auth()->user()->first_name;
           
            $lead->employee_id = auth()->user()->employee->id;
            $lead->form_name = @$form_nmae;
            $lead->name = $request->name;
            $lead->email =$request->email;
            $lead->phone = $request->phone_number;
            $lead->lead_date = date('Y-m-d');
            $lead->description = $request->description;
            $lead->services = $request->drop_down;
            $lead->status = '0';
            $lead->save();

            $user = new User();
            $user->first_name = $request->name;
            $user->username = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make('123456');
            $user->phone_number = $request->phone_number;
            $user->status = '0';
            $user->is_lead = 1;
            $user->active_portal = 'customer';
            $user->save();
            if ($user) {
                $lead->user_id = $user->id;
                $lead->save();
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
            if (auth()->user()->is_admin == false) {
                event(new Notificaion($notification));
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

    public function employee_referrals_edit(Request $request){
        try{
            $data = Lead::find($request->id);
            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Edit Referral",
                'event_name' => "Edit Referral",
                'email' => auth()->user()->email,
                'description' => "Edit Referral Successfully",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));
            $notification = [
                'user_id' => auth()->id(),
                'title' =>  'Update Referral',
                'description' => 'Update lead data after created by his referral'
            ];
            if (auth()->user()->is_admin == false) {
                event(new Notificaion($notification));
            }
            $response = [
                'status' => 'success',
                'data' => $data,
                'model' => 'Update Referrals',

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

    public function employee_referrals_delete(Request $request)
    {
        try {
            $data = Lead::find($request->id);
            $user = User::where('email', $data->email)->delete();
            $data = Lead::where('id',$request->id)->delete();

            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Delete Referral",
                'event_name' => "Delete Referral",
                'email' => auth()->user()->email,
                'description' => "Delete Referral Successfully",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));
            $notification = [
                    'user_id' => auth()->id(),
                    'title' =>  'Delete Referral',
                    'description' => 'Delete lead data after created by his referral'
                ];
            if (auth()->user()->is_admin == false) {
                event(new Notificaion($notification));
            }
            $response = [
                'status' => 'success',
                'message' => 'Referrals SuccessFully Deleted',
                'model' => 'Update Referrals',

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


    public function employee_deal(){
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/my/deal"), 'name' => 'deal'],
            ['name' => __('deal')],
        ];
        return view('employee.my-deal',compact('breadcrumbs'));
    }

    public function employee_deal_ajax(Request $request){
        $records = Customer::where('referral_id', auth()->user()->id)->with(['invoices' => function ($query) {
            return $query->where('status', '1')->get();
        }])->with('user')->get();

        return DataTables::of($records)->addIndexColumn()
        ->addColumn('amount', function ($row) {
            if (isset($row->invoices[0])) {
                $amount = '<span class="badge fix_badges bg-success  rounded">'. $row->invoices[0]->total_amount.'</span>';
            } else {
                $amount = '';
            }
            return $amount;
        })
        ->addColumn('avatar', function ($row) {
            if (isset($row->user->avatar)) {
                $avatar = '<img class="round" src="'.$row->user->avatar.'" alt="avatar" height="40" width="40">';
            } else {
                $avatar = '<img class="round" src="http://phpstack-811730-2916767.cloudwaysapps.com/images/avatars/male.png" alt="avatar" height="40" width="40">';
            }
            return $avatar;
        })
                  ->addColumn('is_status', function ($row) {
                if ($row->user->is_customer == false) {
                $status = '<span class="badge fix_badges bg-warning  rounded"> Pending</span>';
                } else {
                $status = '<span class="badge fix_badges bg-success  rounded">Done</span>';
                }
                return $status;
            })
            ->addColumn('from', function ($row) {
                $user = User::findorfail($row->referral_id);
                $from = '<td>'.$user->first_name.'</td>';
                return $from;
            })
        ->rawColumns(['amount', 'avatar','from', 'is_status'])
        ->make(true);
    }

    public function employee_payment(){
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/my/deal"), 'name' => 'payment'],
            ['name' => __('payment')],
        ];
        return view('employee.payments',compact('breadcrumbs'));
    }

    
}
