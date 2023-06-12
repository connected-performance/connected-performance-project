<?php

namespace App\Http\Controllers\Panel;

use App\Events\ActivityLog;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


use App\Exceptions\GeneralException;
use App\Http\Requests\Administrator\StoreAdminRole;
use App\Http\Requests\Administrator\UpdateAdminRole;
use App\Library\Tool;
use App\Models\RoleUser;
use App\Repositories\Contracts\RoleRepository;
use Box\Spout\Common\Exception\InvalidArgumentException;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Exception\UnsupportedTypeException;
use Box\Spout\Writer\Exception\WriterNotOpenedException;
use Generator;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Rap2hpoutre\FastExcel\FastExcel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RoleController extends Controller
{

    /**
     * @var RoleRepository
     */
    protected $roles;

    /**
     * Create a new controller instance.
     *
     * @param  RoleRepository  $roles
     */
    public function __construct(RoleRepository $roles)
    {
        $this->roles = $roles;
    }

    /**
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
   
    public function role_index(){

        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/user/role"), 'name' => 'roles'],
            ['name' => __('roles')],
        ];
        $this->authorize('view_role');
        $categories = collect(config('permissions'))->map(function ($value, $key) {
            $value['name'] = $key;
            return $value;
        })->groupBy('category');

         $permissions = $categories->keys()->map(function ($key) use ($categories) {
            return [
                'title'       => $key,
                'permissions' => $categories[$key],
            ];
        });
        return view('content.permission.user-role-index',compact('permissions','breadcrumbs'));
    }

    public function role_ajax(Request $request){
        $records = Role::where('name', '!=', 'administrator')->where('id', '!=', auth()->user()->roles[0]->pivot->role_id)->get();
        return DataTables::of($records)->addIndexColumn()
            ->addColumn('action', function ($row) {
                $show = route('edit.role',$row->uid);
                $btn = '<a href="'.$show.'" style="padding-left:10px;" class="link-success"  data-bs-toggle="tooltip"
                data-bs-placement="top" title="Edit" ><i class="fas fa-edit"></i></a>' .
            '<a href="#" style="padding-left:10px;" class="link-danger"  data-bs-toggle="tooltip"
                data-bs-placement="top" title="Delet" onclick="delete_form(' . $row->id . ')"><i class="fa-solid fa-trash"></i></a>';
                return $btn;
            })
            ->addColumn('status', function ($row) {
                if ($row->status == false) {
                    $status = '<span class="badge fix_badges bg-danger  rounded">Closed</span>';
                } else {
                    $status = '<span class="badge fix_badges bg-success  rounded">Active</span>';
                }
                return $status;
            })
            ->addColumn('role_for', function ($row) {
                if ($row->for_user == '1') {
                    $status = '<span class="badge fix_badges bg-info  rounded">Admin</span>';
                } elseif($row->for_user == '2') {
                $status = '<span class="badge fix_badges bg-warning  rounded">Employee</span>';
                }else{
                $status = '<span class="badge fix_badges bg-dark  rounded">Customer</span>';

                }
                return $status;
            })
            ->rawColumns(['action', 'status', 'role_for'])
            ->make(true);
    }
   
    public function new_role_create($id = null){
        $this->authorize('create_role');
        $disable = 1;
        if($id ==null || $id== '1' ){
            $categories = collect(config('permissions'))->map(function ($value, $key) {
                $value['name'] = $key;
                return $value;
            })->groupBy('category');
            $for_user = '1';
        }
        elseif($id == '2'){
            $categories = collect(config('employermissions'))->map(function ($value, $key) {
           $value['name'] = $key;
           return $value;
        })->groupBy('category');
            $for_user = '2';
        }
        else{
           return  redirect('nourl');
        }

        $permissions = $categories->keys()->map(function ($key) use ($categories) {
            return [
                'title'       => $key,
                'permissions' => $categories[$key],
            ];
        });
      
        return view('content.permission.create-role', compact('permissions', 'for_user', 'disable'));

    }

    /**
     * store new plan
     *
     * @param  StoreAdminRole  $request
     *
     */
    public function create_role(StoreAdminRole $request){
       
        $this->authorize('create_role');
            $request->validate([
                'name'          => 'required|unique:roles|max:255',
                'permissions.*' => 'required',
                'for_user' => 'required',
            ]);
            $this->roles->store($request->input());
        $actor = "";
        if (auth()->user()->is_admin == true) {
            $actor = 1;
        } else {
            $actor = 2;
        }
        $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Create Role",
                'event_name' => "Create Role",
                'email' => auth()->user()->email,
                'description' => "Create Role Successfully",
                'actor' => $actor,
                'url' => url()->current(),
            ];
        event(new ActivityLog($data));
           return redirect()->route('user.role.index')->with('success','Role Successfull Created');
      
  
    }



    /**
     * View role for edit
     *
     * @param  Role  $role
     *
     * @return Application|Factory|View
     *
     * @throws AuthorizationException
     */

    public function role_edit($role)
    {
      
        $this->authorize('edit_role');
         $role =Role::where('uid',$role)->first();
        $disable = 2;
        $breadcrumbs = [
            ['link' => url(config('app.admin_path') . "/dashboard"), 'name' =>'Dashboard'],
            ['link' => url(config('app.admin_path') . "/roles"), 'name' =>'Admin Roles'],
            ['name' => __('Update Role')],
        ];
        if($role->for_user == '2'){
            $categories = collect(config('employermissions'))->map(function ($value, $key) {
                $value['name'] = $key;
                return $value;
            })->groupBy('category');
            $for_user = '2';
        }
        elseif ($role->for_user == '1') {
            $categories  = collect(config('permissions'))->map(function ($value, $key) {
                $value['name'] = $key;

                return $value;
            })->groupBy('category');
            $for_user = '1';
           
        }else{
            return redirect('nuurl');
        }
       
        $permissions = $categories->keys()->map(function ($key) use ($categories) {
            return [
                'title'       => $key,
                'permissions' => $categories[$key],
            ];
        });

        $existing_permission = $role->permissions;

        return view('content.permission.create-role', compact('disable','for_user','breadcrumbs', 'permissions', 'role', 'existing_permission'));
    }

    /**
     * @param  Role  $role
  
     *
     */
    public function update(Request $request, $role)
    {
          $this->authorize('edit_role');
         $role = Role::where('uid', $role)->first();
        $request->validate([
            'name'          => 'required|max:255|unique:roles,name,' . $role->id,
            'permissions.*' => 'required',
        ]);
        $this->roles->update($role, $request->input());
        $actor = "";
        if (auth()->user()->is_admin == true) {
            $actor = 1;
        } else {
            $actor = 2;
        }
        $data = [
            'user_id' => auth()->id(),
            'name' => auth()->user()->first_name . " Update Role",
            'event_name' => "Update Role",
            'email' => auth()->user()->email,
            'description' => "Update Role Successfully",
            'actor' => $actor,
            'url' => url()->current(),
        ];
        event(new ActivityLog($data));
        return redirect()->route('user.role.index')->with('success', 'Role Successfull Updated');
      
    }

    public function destroy_role(Request $request){
        try{
            $this->authorize('delete_role');
            $role = Role::where('id',$request->id)->first();
            $this->roles->destroy($role);
            $response = [
                'status' => 'success',
                'message' => 'Role Successfully Deleted'
            ];
            $actor = "";
            if (auth()->user()->is_admin == true) {
                $actor = 1;
            } else {
                $actor = 2;
            }
            $data = [
                'user_id' => auth()->id(),
                'name' => auth()->user()->first_name . " Create Role",
                'event_name' => "Create Role",
                'email' => auth()->user()->email,
                'description' => "Create Role Successfully",
                'actor' => $actor,
                'url' => url()->current(),
            ];
            event(new ActivityLog($data));
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
