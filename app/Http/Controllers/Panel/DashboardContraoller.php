<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\EmailTemplate;
use App\Models\Invoice;
use App\Models\Lead;
use App\Models\Transction;
use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class DashboardContraoller extends Controller
{
    //
    public function index(){

        $first_day_of_month = Carbon::now()->startOfMonth()->toDateString();
        $last_day_of_month = Carbon::now()->endOfMonth()->toDateString();
        $c_date = date('Y-m-d');
        $invoices['send'] = Invoice::where('issue_date', '<=', $c_date)->where('status', '0')->with('users')->get();
        $invoices['pending'] = Invoice::where('issue_date', '<=', $c_date)->Where('balance_status', '0')->with('users')->get();
        $lead = Lead::where('status' , '0')->count();
        $customer = User::where('is_customer',true)->count();
        $referral = Customer::where('referral_id',auth()->id())->count();
        $revenue_value = Invoice::sum('balance');
        $mounthly_revenue_value = Invoice::where('status', '1')->whereBetween('created_at', [$first_day_of_month, $last_day_of_month])
             ->sum('balance');
        $employee = User::where('is_employe',true)->count();
        $pageConfigs = ['pageHeader' => false];



        return view('content.dashboard.dashboard-ecommerce', [
            'pageConfigs' => $pageConfigs,
            'data' => $invoices,
            'lead' => $lead,
            'customer' => $customer,
            'referral' => $referral,
            'revenue_value' => $revenue_value,
            'employee' => $employee,
            'mounthly_revenue_value' => $mounthly_revenue_value

        ]);
    }

    public function month_earning(Request $request){
    try {
        $year =  date("Y", strtotime($request->date));
        $month = date("m", strtotime($request->date));
           $transction = Invoice::whereYear('created_at', '=', $year)
                ->whereMonth('created_at', '=', $month)
                ->sum('balance');
            $response = [
                'status' => 'success',
                'data' => $transction,
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
    public function year_earning(Request $request){
        try {
            $year =  date("Y", strtotime($request->date));
               $transction = Invoice::whereYear('created_at', '=', $year)
                    ->sum('balance');
                $response = [
                    'status' => 'success',
                    'data' => $transction,
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
        public function revenue_ajax(){
            try {
                // $arr = ['1','2','3','4','5','6','7','8','9','10','11','12'];
                // foreach($arr as $array){
                // $month = date("m", strtotime($array));
                // }
                $month['jan'] = date("m", strtotime('january'));
                $month['feb'] = date("m", strtotime('february'));
                $month['march'] = date("m", strtotime('march'));
                $month['april'] = date("m", strtotime('april'));
                $month['may'] = date("m", strtotime('may'));
                $month['june'] = date("m", strtotime('june'));
                $month['july'] = date("m", strtotime('july'));
                $month['august'] = date("m", strtotime('august'));
                $month['sep'] = date("m", strtotime('september'));
                $month['oct'] = date("m", strtotime('october'));
                $month['nov'] = date("m", strtotime('november'));
                $month['dec'] = date("m", strtotime('december'));

                $pagedata['jan'] = Invoice::whereMonth('created_at', '=', $month['jan'])->sum('balance');
                $pagedata['feb'] = Invoice::whereMonth('created_at', '=', $month['feb'])->sum('balance');
                $pagedata['march'] = Invoice::whereMonth('created_at', '=', $month['march'])->sum('balance');
                $pagedata['april'] = Invoice::whereMonth('created_at', '=', $month['april'])->sum('balance');
                $pagedata['may'] = Invoice::whereMonth('created_at', '=', $month['may'])->sum('balance');
                $pagedata['june'] = Invoice::whereMonth('created_at', '=', $month['june'])->sum('balance');
                $pagedata['july'] = Invoice::whereMonth('created_at', '=', $month['july'])->sum('balance');
                $pagedata['august'] = Invoice::whereMonth('created_at', '=', $month['august'])->sum('balance');
                $pagedata['sept'] = Invoice::whereMonth('created_at', '=', $month['sep'])->sum('balance');
                $pagedata['oct'] = Invoice::whereMonth('created_at', '=', $month['oct'])->sum('balance');
                $pagedata['nov'] = Invoice::whereMonth('created_at', '=', $month['nov'])->sum('balance');
                $pagedata['dec'] = Invoice::whereMonth('created_at', '=', $month['dec'])->sum('balance');

                $pagecount['jan'] = Invoice::whereMonth('created_at', '=', $month['jan'])->count();
                $pagecount['feb'] = Invoice::whereMonth('created_at', '=', $month['feb'])->count();
                $pagecount['march'] = Invoice::whereMonth('created_at', '=', $month['march'])->count();
                $pagecount['april'] = Invoice::whereMonth('created_at', '=', $month['april'])->count();
                $pagecount['may'] = Invoice::whereMonth('created_at', '=', $month['may'])->count();
                $pagecount['june'] = Invoice::whereMonth('created_at', '=', $month['june'])->count();
                $pagecount['july'] = Invoice::whereMonth('created_at', '=', $month['july'])->count();
                $pagecount['august'] = Invoice::whereMonth('created_at', '=', $month['august'])->count();
                $pagecount['sept'] = Invoice::whereMonth('created_at', '=', $month['sep'])->count();
                $pagecount['oct'] = Invoice::whereMonth('created_at', '=', $month['oct'])->count();
                $pagecount['nov'] = Invoice::whereMonth('created_at', '=', $month['nov'])->count();
                $pagecount['dec'] = Invoice::whereMonth('created_at', '=', $month['dec'])->count();

                $response = [
                        'status' => 'success',
                        'data' => json_encode($pagedata),
                        'count' => json_encode($pagecount),

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

    public function alert_data(Request $request){
        $c_date = date('Y-m-d');
        $invoices['send'] = Invoice::where('issue_date', '<=', $c_date)->where('status', '0')->get();
        $invoices['pending'] = Invoice::where('issue_date', '<=', $c_date)->Where('balance_status', '0')->get();
        $data = 0;
        if(isset($invoices['pending'][0])){
            $data = 1;
        }elseif(isset($invoices['send'][0])){
            $data = 1;
        }else{
            $data = 0;
        }
        return response()->json($data);
    }

    public function unpaid_invoice(Request $request){

        $first_day_of_month = Carbon::now()->startOfMonth()->toDateString();
        $last_day_of_month = Carbon::now()->endOfMonth()->toDateString();

        $records =  Invoice::where('balance_status','0')->with('users')->whereBetween('created_at', [$first_day_of_month, $last_day_of_month])
             ->get();
        return DataTables::of($records)->addIndexColumn()

            ->addColumn('invoice_number', function ($row) {
                $number = $row->invoice_code . $row->invoice_number;
                return $number;
            })
            ->addColumn('status', function ($row) {
                if ($row->status == '0') {
                    $status =  '<span class="badge rounded-pill  badge-light-info">Draft</span>';
                } else {;
                    $status  = '<span class="badge rounded-pill  badge-light-success">Send</span>';
                }
                return $status;
            })
            ->addColumn('balance', function ($row) {

                return '$' . $row->balance;
            })
            ->addColumn('total_amount', function ($row) {

                return '$' . $row->total_amount;
            })
            ->addColumn('balance_status', function ($row) {
                if ($row->balance_status == '0') {
                    $balance_status =  '<span class="badge rounded-pill  badge-light-warning">UnPaid</span>';
                } else {;
                    $balance_status  = '<span class="badge rounded-pill  badge-light-success">Paid</span>';
                }
                return $balance_status;
            })
            ->rawColumns([ 'invoice_number', 'status', 'balance_status', 'balance', 'total_amount'])
            ->make(true);
    }

    public function paid_invoice(Request $request){
        $first_day_of_month = Carbon::now()->startOfMonth()->toDateString();
        $last_day_of_month = Carbon::now()->endOfMonth()->toDateString();
        $records =  Invoice::where('balance_status', '1')->with('users')->whereBetween('created_at', [$first_day_of_month, $last_day_of_month])
             ->get();
        return DataTables::of($records)->addIndexColumn()
            ->addColumn('invoice_number', function ($row) {
                $number = $row->invoice_code . $row->invoice_number;
                return $number;
            })
            ->addColumn('status', function ($row) {
                if ($row->status == '0') {
                    $status =  '<span class="badge rounded-pill  badge-light-info">Draft</span>';
                } else {;
                    $status  = '<span class="badge rounded-pill  badge-light-success">Send</span>';
                }
                return $status;
            })
            ->addColumn('balance', function ($row) {

                return '$' . $row->balance;
            })
            ->addColumn('total_amount', function ($row) {

                return '$' . $row->total_amount;
            })
            ->addColumn('balance_status', function ($row) {
                if ($row->balance_status == '0') {
                    $balance_status =  '<span class="badge rounded-pill  badge-light-warning">UnPaid</span>';
                } else {;
                    $balance_status  = '<span class="badge rounded-pill  badge-light-success">Paid</span>';
                }
                return $balance_status;
            })
            ->rawColumns(['invoice_number', 'status', 'balance_status', 'balance', 'total_amount'])
            ->make(true);
    }
}
