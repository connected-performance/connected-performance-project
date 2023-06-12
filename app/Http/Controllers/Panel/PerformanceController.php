<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PerformanceController extends Controller
{
    //
    public function index(){
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/performance/employee"), 'name' => 'performance'],
            ['name' => __('performance')],
        ];
       
        return view('content.performance.employee-performance-index',compact('breadcrumbs'));
    }

    public function emp_performane_ajax(Request $request){
        
        $records =  User::where('is_employe', 1)->withCount('referrals')->withCount('deals')->with(['employee' => function ($query) {
            return $query->withCount('customer')->with(['customer' => function ($query) {
                return $query->where('status', '1')->with(['invoices' => function ($query) {
                    return $query->where('status', 1)->first()->total_amount;
                }]);
            }]);
        }])->get();
        return DataTables::of($records)->addIndexColumn()
            ->addColumn('profile', function ($row) {
                    return $employee = '<img class="round" src="http://phpstack-811730-2916767.cloudwaysapps.com/images/avatars/male.png" alt="avatar" height="40" width="40">';
            })
            ->addColumn('referrals_count', function ($row) {
            $referrals_count= '<a href="'.url("panel/performance/lead/".$row->id).'"><span class="badge fix_badges bg-info  rounded">'.$row->referrals_count.'</span></a>';
                return $referrals_count;
            })
            ->addColumn('deals_count', function ($row) {
            $deals_count = '<span class="badge fix_badges bg-success  rounded">' . $row->deals_count . '</span>';
                return $deals_count;
            })
            ->addColumn('customer_count', function ($row) {
            $customer_count = '<a href="' . url("panel/performance/customer/" . $row->id) . '"><span class="badge fix_badges bg-primary  rounded">' . $row->employee->customer_count . '</span></a>';
                return $customer_count;
            })
            ->addColumn('revenue', function ($row) {
            if (isset($row->employee->customer[0]->invoices[0]->total_amount)) {
                $revenue = '<span class="badge fix_badges bg-warning  rounded">' .
                $row->employee->customer[0]->invoices[0]->total_amount . '</span>';
            }else{
                $revenue = '<span class="badge fix_badges bg-warning  rounded">0</span>';

            }
                return $revenue;
            })
            ->addColumn('analytics', function ($row) {
              
                return $analytics = '<span class="badge fix_badges bg-secondary  rounded">Coming Soon...</span>';;
            })
            ->rawColumns(['profile', 'analytics', 'referrals_count', 'deals_count', 'customer_count', 'revenue'])
            ->make(true);
    }

    public function performance_lead($id){
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/performance/lead/".$id), 'name' => 'lead'],
            ['name' => __('lead')],
        ];
        //    $data = User::find($id);
        //    return  $customer = Lead::where('employee_id',$data->employee->id)->get();
      
          return view('content.performance.lead',compact('id','breadcrumbs'));
    }

    public function performance_lead_ajax(Request $request)
    {
        $data = User::find($request->id);
        $records = Lead::where('employee_id', $data->employee->id)->get();
        return DataTables::of($records)->addIndexColumn()
       
            ->make(true);
    }

    public function performance_customer($id){
  
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/performance/customer/" . $id), 'name' => 'customer'],
            ['name' => __('customer')],
        ];
        $data = User::find($id);
       // return  $records = Customer::where('employee_id', $data->employee->id)->with(['user' => function ($query) {
        //     return $query->with('country')->with('state')->with('city');
        // }])->get();
        return view('content.performance.customer', compact('id', 'breadcrumbs'));

    }

    public function performance_customer_ajax(Request $request)
    {
        $data = User::find($request->id);
        $records = Customer::where('employee_id', $data->employee->id)->with(['user' => function ($query){
            return $query->with('country')->with('state')->with('city');
        }])->get();
        return DataTables::of($records)->addIndexColumn()
            ->addColumn('profile', function ($row) {
                return $employee = '<img class="round" src="http://phpstack-811730-2916767.cloudwaysapps.com/images/avatars/male.png" alt="avatar" height="40" width="40">';
            })
            ->addColumn('status',function ($row){
                if($row->user->status == '0'){
                $status = '<span class="badge fix_badges bg-danger  rounded">Closed</span>';
            } else {
                $status = '<span class="badge fix_badges bg-success  rounded">Active</span>';
            }
            return $status;
            })
            ->addColumn('country', function ($row) {
                $country = '';
                if($row->user->country){
                    $country = $row->user->country->name; 
                }
                return $country;
            })->addColumn('state', function ($row) {
                $state = '';
                if ($row->user->state) {
                $state = $row->user->state->name;
                }
                return $state;
            })->addColumn('city', function ($row) {
                    $city = '';
                    if ($row->user->city) {
                $city = $row->user->city->name;
                    }
                    return $city;
           })
            
            ->rawColumns(['profile','country','state','city','status'])
            ->make(true);
    }
}
