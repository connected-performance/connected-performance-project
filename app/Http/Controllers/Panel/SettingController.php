<?php

namespace App\Http\Controllers\Panel;

use App\Events\ActivityLog;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\ActivityLog as ModelsActivityLog;
use App\Models\Country;
use PDO;
use Yajra\DataTables\Facades\DataTables;

class SettingController extends Controller
{
    //
    /** @var UserRepository */
    private $userRepository;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function system_index(){
        return view('setting.system-setting');
    }

    public function time_zone_index(){
        return view('setting.system-setting');

    }

    public function site_index()
    {
        return view('setting.system-setting');
    }

    public function user_profile(){
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/setting/account"), 'name' => 'account'],
            ['name' => __('account')],
        ];
    
        $activities = ModelsActivityLog::where('user_id', auth()->id())->get();
        $users = User::where('id', auth()->id())->first();
        $avatar_dir = $_SERVER['DOCUMENT_ROOT'].'/users/'.$users->avatar;
        $avatar = 'http://'.$_SERVER['HTTP_HOST'].'/users/'.$users->avatar;

        $id = auth()->id();
        return view('account-setting.user-view-account', compact('users', 'activities', 'breadcrumbs','id','avatar_dir','avatar'));
    }

    public function edit_profile(Request $request){
        try {
            $data =  User::where('id',$request->id)->first();
            $avatar_dir = $_SERVER['DOCUMENT_ROOT'].'/users/'.$data->avatar;
            $avatar = 'http://'.$_SERVER['HTTP_HOST'].'/users/'.$data->avatar;
            if($data->avatar && $data->avatar!=null && file_exists($avatar_dir)){
                $logo_avatar=$avatar;
            }else{
                $logo_avatar="https://crm.connected-performance.com/images/avatars/male.png";
            }
            $response = [
                'status' => 'success',
                'message' => '',
                'data' => $data,
                'avatar' => $logo_avatar,
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

    public function update_profile(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'dob' => 'required',
            'address' => 'required',
        ]);
        // if ($request->password) {
        //     $request->validate(['password' => 'required|confirmed|min:6',]);
        // }
        $users = User::find($request->u_id);
        if ($users->email != $request->email) {
            $request->validate([
                'email' => 'required|email|unique:users',
            ]);
        }
        $users->first_name = $request->first_name;
        $users->last_name = $request->last_name;
        $users->email = $request->email;
        $users->username = $request->user_name;
        $users->phone_number = $request->phone_number;
        $users->address = $request->address;
        $users->dob  = $request->dob;
        if($request->hasFile('avatar')){
            $oldimage = $users->avatar;
            $image = $request->avatar;
            $filename = $image->getclientoriginalextension();
            $filename = time().'.'.$filename;
            $request->avatar->move(public_path('/users'), $filename);
            $users->avatar = $filename;
        }
        $users->save();
        $actor = "";
        if (auth()->user()->is_admin == true) {
            $actor = 1;
        } else {
            $actor = 2;
        }
        $data = [
            'user_id' => auth()->id(),
            'name' => auth()->user()->first_name . " Edit Profile",
            'event_name' => "Edit Profile",
            'email' => auth()->user()->email,
            'description' => "Edit Profile Successfully",
            'actor' => $actor,
            'url' => url()->current(),
        ];
        event(new ActivityLog($data));
        return  redirect()->back()->with('success','Update Profile Successfully');

    }

    public function update_password(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        $users = User::find($request->u_id);


        dd();
        $users->first_name = $request->first_name;
        $users->last_name = $request->last_name;
        $users->email = $request->email;
        $users->username = $request->user_name;
        $users->phone_number = $request->phone_number;
        $users->address = $request->address;
        $users->dob  = $request->dob;
        if($request->hasFile('avatar')){
            $oldimage = $users->avatar;
            $image = $request->avatar;
            $filename = $image->getclientoriginalextension();
            $filename = time().'.'.$filename;
            $request->avatar->move(public_path('/users'), $filename);
            $users->avatar = $filename;
        }
        $users->save();
        $actor = "";
        if (auth()->user()->is_admin == true) {
            $actor = 1;
        } else {
            $actor = 2;
        }
        $data = [
            'user_id' => auth()->id(),
            'name' => auth()->user()->first_name . " Edit Profile",
            'event_name' => "Edit Profile",
            'email' => auth()->user()->email,
            'description' => "Edit Profile Successfully",
            'actor' => $actor,
            'url' => url()->current(),
        ];
        event(new ActivityLog($data));
        return  redirect()->back()->with('success','Update Profile Successfully');

    }

    public function account_secuirty(){
        $users = User::where('id', auth()->id())->first();
        return view('account-setting.user-view-security',compact('users'));
    }

    public function account_billing_plans()
    {
        $users = User::where('id', auth()->id())->first();
        return view('account-setting.user-view-billing', compact('users'));
    }

    public function account_notification()
    {
        $users = User::where('id', auth()->id())->first();
        return view('account-setting.user-view-notifications', compact('users'));
    }

    public function account_connection()
    {
        $users = User::where('id', auth()->id())->first();
        return view('account-setting.user-view-connections', compact('users'));
    }

    public function country_setting(){
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/setting/country"), 'name' => 'country'],
            ['name' => __('country')],
        ];
        return view('setting.country-setting',compact('breadcrumbs'));
    }

    public function country_setting_ajax(Request $request){
        $records =  Country::get();
        return DataTables::of($records)->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =

                    '<a href="#" style="padding-left:10px;" class="link-success"  data-bs-toggle="tooltip"
                       data-bs-placement="top" title="Edit" onclick="edit_data(' . $row->id . ')"><i class="fas fa-edit"></i></a>' .
                    '<a href="#" style="padding-left:10px;" class="link-danger"  data-bs-toggle="tooltip"
                       data-bs-placement="top" title="Delet" onclick="delete_data(' . $row->id . ')"><i class="fa-solid fa-trash"></i></a>';
                return $btn;
            })
            ->addColumn('status', function ($row) {
                if ($row->is_active == '1') {
                    $btn  = '<span class="badge bg-success">On</span>';
                } else {
                    $btn  = '<span class="badge bg-danger">Of</span>';
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function country_create(Request $request){
        try {
            $request->validate([
                'code' => 'required',
                'country_name' => 'required',
                'phone_code' => 'required',
            ]);

            $country = new Country();
            $country->sortname = $request->code;
            $country->name = $request->country_name;
            $country->phonecode = $request->phone_code;
            $country->save();
            $response = [
                'status' => 'success',
                'message' => 'Country Successfully Created',
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

    public function country_setting_delete(Request $request){
        try {

            $data = Country::where('id',$request->id)->delete();
            $response = [
                'status' => 'success',
                'message' => 'Country Successfully Deleted',
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
