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
use Illuminate\Support\Facades\DB;

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

    public function analytics(){ 

        $mon=date("m");
        $year=date("Y");
        $months=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $months_l=['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'Octuber', 'November', 'December'];
        $cate_mon=array();
        $dataPay=array();
        for($i=0;$i<=11;$i++){ 
            $dataPay[]=Invoice::where('balance_status', '1')->whereMonth('pay_date', $i+1)->whereYear('pay_date', $year)->sum('balance');
            $cate_mon[]=$months[$i].' '.$year;
        }
        $tit_g_1='Monthly Sales ('.$year.')';
        // fin graph 1

        $dataPayY=array();
        $year_act=[date("Y")];
        $dataPayY[]=Invoice::where('balance_status', '1')->whereYear('pay_date', date("Y"))->sum('balance');

        $tit_g_2='Annual Sales ('.date("Y").')';
        // fin graph 2

        $dataPay1=array();
        $dataPro1=array();
        $year=date("Y");
        for($i=0;$i<=11;$i++){ 
            $dataPay1[]=Invoice::where('balance_status', '1')->whereMonth('pay_date', $i+1)->whereYear('pay_date', $year)->sum('balance');
            $dataPro1[]=Invoice::whereMonth('pay_date', $i+1)->whereYear('pay_date', $year)->sum('balance');
            $mon=$mon-1;
        }

        $tit_g_3='Monthly Customers Projected ('.$year.')';
        // fin graph 3

        $dataPayRec=array();
        $year=date("Y");
        for($i=0;$i<=11;$i++){ 
            $dataPayRec[]=Invoice::where('balance_status', '1')->where('type', 'NORMAL PAYMENT')->whereMonth('pay_date', $i+1)->whereYear('pay_date', $year)->sum('balance');
        }
        $tit_g_4='Monthly Recurring Revenue ('.$year.')';
        // fin graph 4

        $dataleadtot=array();
        $dataleadtot[]=Lead::where('status', 2)->whereYear('lead_date', date("Y"))->count();

        $tit_g_5='Leads by Year ('.date("Y").')';
        // fin graph 5

        $dataleadbyuserpor=array();
        $leadbyuser=DB::table('leads')->select(DB::raw('form_name as name, count(*) as y'))->groupBy('form_name')->get();
        $tot_le=$leadbyuser->sum('y');
        $i=0;
        foreach($leadbyuser as $key => $value){
            $dataleadbyuserpor[$i]["name"]=$value->name;
            $dataleadbyuserpor[$i]["y"]=round(($value->y*100)/$tot_le,2);
            $i++;
        }

        $tit_g_6='Total Porcentage Leads by User (Total)';
        // fin graph 6

        $mon=date("m");
        $year=date("Y");
        $dat=Invoice::join('customers', 'customers.id', '=', 'invoices.customer_id')
        ->join('employees', 'employees.id', '=', 'customers.employee_id')
        ->join('users', 'users.id', '=', 'employees.user_id')
        ->where('invoices.balance_status', '1')->where('invoices.type', 'NORMAL PAYMENT')
        ->whereMonth('invoices.pay_date', $mon)->whereYear('invoices.pay_date', $year)
        ->select(DB::raw('users.first_name as name, users.last_name as last_name, sum(invoices.balance) as total'))
        ->groupBy('customers.employee_id','users.first_name','users.last_name')->get();

        $cate_emp=array();
        $data_empren=array();
        foreach($dat as $key => $value){
            $cate_emp[]=$value->name.' '.$value->last_name;
            $data_empren[]=$value->total;
        }

        $tit_g_7='Monthly Recurring Revenue by Employee ('.$months_l[$mon-1].' '.$year.')';
        // fin graph 7

        $cate_user=array();
        $data_user=array();
        foreach($leadbyuser as $key => $value){
            $cate_user[]=$value->name;
            $data_user[]=$value->y;
        }
        $tit_g_8='Total Leads by User (Total)';
        // fin graph 8

        $yearlast5=array();
        $yearlast5[]=date("Y");
        $yearlast5[]=date("Y")-1;
        $yearlast5[]=date("Y")-2;
        $yearlast5[]=date("Y")-3;
        $yearlast5[]=date("Y")-4;

        return view('content.dashboard.dash-analytics', ['dataPay' => $dataPay, 'cate_mon' => $cate_mon, 'dataPayY' => $dataPayY, 'dataPay1' => $dataPay1, 'dataPro1' => $dataPro1, 'dataPayRec' => $dataPayRec, 'dataleadbyuserpor' => $dataleadbyuserpor, 'cate_user' => $cate_user, 'data_user' => $data_user, 'cate_emp' => $cate_emp, 'data_empren' => $data_empren, 'tit_g_7' => $tit_g_7, 'yearlast5' => $yearlast5, 'tit_g_1' => $tit_g_1, 'tit_g_3' => $tit_g_3, 'tit_g_4' => $tit_g_4, 'tit_g_6' => $tit_g_6, 'tit_g_8' => $tit_g_8, 'dataleadtot' => $dataleadtot, 'year_act' => $year_act, 'tit_g_5' => $tit_g_5, 'tit_g_2' => $tit_g_2]);
    }

    public function analyticsUpdate(Request $request){ 
        try {
            if($request->graph==1){
                $request->validate([
                    'show_1' => 'required',
                    'year_1' => 'required',
                ]);

                $year=$request->year_1;
                $months=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                $cate_mon=array();
                $dataPay=array();

                if($request->show_1=='T'){
                    for($i=0;$i<=11;$i++){ 
                        $dataPay[]=Invoice::where('balance_status', '1')->whereMonth('pay_date', $i+1)->whereYear('pay_date', $year)->sum('balance');
                        $cate_mon[]=$months[$i].' '.$year;
                    }
                }else{
                    for($i=0;$i<=11;$i++){ 
                        $dataPay[]=Invoice::where('balance_status', '1')->whereMonth('pay_date', $i+1)->whereYear('pay_date', $year)->count();
                        $cate_mon[]=$months[$i].' '.$year;
                    }
                }
                $tit_g_1='Monthly Sales ('.$year.')';
                $response = [
                    'status' => 'success',
                    'cate_mon' => $cate_mon,
                    'dataPay' => $dataPay,
                    'tit_g_1' => $tit_g_1
                ];
                return response()->json($response);

            }elseif($request->graph==2){

                $request->validate([
                    'show_2' => 'required',
                    'year_2' => 'required',
                ]);

                $dataPayY=array();
                $year_act=[$request->year_2];

                if($request->show_2=='T'){            
                    $dataPayY[]=Invoice::where('balance_status', '1')->whereYear('pay_date', $request->year_2)->sum('balance');
                }else{
                    $dataPayY[]=Invoice::where('balance_status', '1')->whereYear('pay_date', $request->year_2)->count();
                }
                $tit_g_2='Annual Sales ('.$request->year_2.')';
                $response = [
                    'status' => 'success',
                    'year_act' => $year_act,
                    'dataPayY' => $dataPayY,
                    'tit_g_2' => $tit_g_2,
                ];
                return response()->json($response);

            }elseif($request->graph==3){

                $request->validate([
                    'show_3' => 'required',
                    'year_3' => 'required',
                ]);

                $dataPay1=array();
                $dataPro1=array();
                $year=$request->year_3;
                $months=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                $cate_mon=array();

                if($request->show_3=='T'){
                    for($i=0;$i<=11;$i++){ 
                        $dataPay1[]=Invoice::where('balance_status', '1')->whereMonth('pay_date', $i+1)->whereYear('pay_date', $year)->sum('balance');
                        $dataPro1[]=Invoice::whereMonth('pay_date', $i+1)->whereYear('pay_date', $year)->sum('balance');
                        $cate_mon[]=$months[$i].' '.$year;
                    }
                }else{
                    for($i=0;$i<=11;$i++){ 
                        $dataPay1[]=Invoice::where('balance_status', '1')->whereMonth('pay_date', $i+1)->whereYear('pay_date', $year)->count();
                        $dataPro1[]=Invoice::whereMonth('pay_date', $i+1)->whereYear('pay_date', $year)->count();
                        $cate_mon[]=$months[$i].' '.$year;
                    }
                }

                $tit_g_3='Monthly Customers Projected ('.$year.')';

                $response = [
                    'status' => 'success',
                    'cate_mon' => $cate_mon,
                    'dataPay1' => $dataPay1,
                    'dataPro1' => $dataPro1,
                    'tit_g_3' => $tit_g_3,
                ];
                return response()->json($response);

            }elseif($request->graph==4){

                $request->validate([
                    'year_4' => 'required',
                ]);

                $dataPayRec=array();
                $year=$request->year_4;
                $months=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                $cate_mon=array();

                for($i=0;$i<=11;$i++){ 
                    $dataPayRec[]=Invoice::where('balance_status', '1')->where('type', 'NORMAL PAYMENT')->whereMonth('pay_date', $i+1)->whereYear('pay_date', $year)->sum('balance');
                    $cate_mon[]=$months[$i].' '.$year;
                }
                $tit_g_4='Monthly Recurring Revenue ('.$year.')';

                $response = [
                    'status' => 'success',
                    'cate_mon' => $cate_mon,
                    'dataPayRec' => $dataPayRec,
                    'tit_g_4' => $tit_g_4
                ];
                return response()->json($response);

            }elseif($request->graph==5){

                $request->validate([
                    'type_5' => 'required',
                    'year_5' => 'required',
                    'week_5' => 'required_if:type_5,W'
                ]);

                $dataleadtot=array();
                $cate=array();
                $months=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                $months_l=['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'Octuber', 'November', 'December'];

                if($request->type_5=="Y"){

                    $dataleadtot[]=Lead::where('status', 2)->whereYear('lead_date', $request->year_5)->count();
                    $cate[]=$request->year_5;
                    $tit_g_5='Leads by Year ('.$request->year_5.')';

                }elseif($request->type_5=="M"){
                    
                    for($i=0;$i<=11;$i++){ 
                        $dataleadtot[]=Lead::where('status', 2)->whereMonth('lead_date', $i+1)->whereYear('lead_date', $request->year_5)->count();
                        $cate[]=$months[$i].' '.$request->year_5;
                    }
                    $tit_g_5='Leads by Month ('.$request->year_5.')';

                }else{
                    $date=explode("/", $request->week_5);
                    $dateact=$date[0];
                    for($i=0;$i<=6;$i++){ 
                        $dataleadtot[]=Lead::where('status', 2)->where('lead_date', $dateact)->count();
                        $cate[]=$dateact;
                        $dateact=date('Y-m-d', strtotime($dateact. ' + 1 day'));
                    }
                    $tit_g_5='Leads by Week ('.$date[0].' to '.$date[1].')';
                }

                $response = [
                    'status' => 'success',
                    'dataleadtot' => $dataleadtot,
                    'tit_g_5' => $tit_g_5,
                    'cate' => $cate,
                ];
                return response()->json($response);

            }elseif($request->graph==6){

                $request->validate([
                    'year_6' => 'required',
                    'month_6' => 'required',
                ]);

                $dataleadbyuserpor=array();
                $i=0;
                $year=$request->year_6;
                $mon=$request->month_6;
                if($year=='T'){
                    $leadbyuser=DB::table('leads')->select(DB::raw('form_name as name, count(*) as y'))->groupBy('form_name')->get();
                    $tot_le=$leadbyuser->sum('y');
                    foreach($leadbyuser as $key => $value){
                        $dataleadbyuserpor[$i]["name"]=$value->name;
                        $dataleadbyuserpor[$i]["y"]=round(($value->y*100)/$tot_le,2);
                        $i++;
                    }

                    $tit_g_6='Total Porcentage Leads by User (Total)';
                }else{
                    if($mon=='T'){
                        $leadbyuser=DB::table('leads')->whereYear('lead_date', $year)->select(DB::raw('form_name as name, count(*) as y'))->groupBy('form_name')->get();
                        $tot_le=$leadbyuser->sum('y');
                        foreach($leadbyuser as $key => $value){
                            $dataleadbyuserpor[$i]["name"]=$value->name;
                            $dataleadbyuserpor[$i]["y"]=round(($value->y*100)/$tot_le,2);
                            $i++;
                        }

                        $tit_g_6='Total Porcentage Leads by User ('.$year.')';
                    }else{
                        $leadbyuser=DB::table('leads')->whereMonth('lead_date', $mon)->whereYear('lead_date', $year)->select(DB::raw('form_name as name, count(*) as y'))->groupBy('form_name')->get();
                        $tot_le=$leadbyuser->sum('y');
                        foreach($leadbyuser as $key => $value){
                            $dataleadbyuserpor[$i]["name"]=$value->name;
                            $dataleadbyuserpor[$i]["y"]=round(($value->y*100)/$tot_le,2);
                            $i++;
                        }

                        $months_l=['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'Octuber', 'November', 'December'];
                        $tit_g_6='Total Porcentage Leads by User ('.$months_l[$mon-1].' '.$year.')';
                    }   
                }   

                $response = [
                    'status' => 'success',
                    'dataleadbyuserpor' => $dataleadbyuserpor,
                    'tit_g_6' => $tit_g_6
                ];
                return response()->json($response);

            }elseif($request->graph==7){

                $request->validate([
                    'month_7' => 'required',
                    'year_7' => 'required',
                ]);

                $mon=$request->month_7;
                $year=$request->year_7;
                $dat=Invoice::join('customers', 'customers.id', '=', 'invoices.customer_id')
                ->join('employees', 'employees.id', '=', 'customers.employee_id')
                ->join('users', 'users.id', '=', 'employees.user_id')
                ->where('invoices.balance_status', '1')->where('invoices.type', 'NORMAL PAYMENT')
                ->whereMonth('invoices.pay_date', $mon)->whereYear('invoices.pay_date', $year)
                ->select(DB::raw('users.first_name as name, users.last_name as last_name, sum(invoices.balance) as total'))
                ->groupBy('customers.employee_id','users.first_name','users.last_name')->get();

                $cate_emp=array();
                $data_empren=array();
                foreach($dat as $key => $value){
                    $cate_emp[]=$value->name.' '.$value->last_name;
                    $data_empren[]=$value->total;
                }

                $months_l=['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'Octuber', 'November', 'December'];
                $tit_g_7='Monthly Recurring Revenue by Employee ('.$months_l[$mon-1].' '.$year.')';

                $response = [
                    'status' => 'success',
                    'cate_emp' => $cate_emp,
                    'data_empren' => $data_empren,
                    'tit_g_7' => $tit_g_7,
                ];
                return response()->json($response);

            }elseif($request->graph==8){

                $request->validate([
                    'year_8' => 'required',
                    'month_8' => 'required'
                ]);

                $cate_user=array();
                $data_user=array();
                $year=$request->year_8;
                $mon=$request->month_8;
                if($year=='T'){
                    $leadbyuser=DB::table('leads')->select(DB::raw('form_name as name, count(*) as y'))->groupBy('form_name')->get();
                    foreach($leadbyuser as $key => $value){
                        $cate_user[]=$value->name;
                        $data_user[]=$value->y;
                    }

                    $tit_g_8='Total Leads by User (Total)';
                }else{
                    if($mon=='T'){
                        $leadbyuser=DB::table('leads')->whereYear('lead_date', $year)->select(DB::raw('form_name as name, count(*) as y'))->groupBy('form_name')->get();
                        foreach($leadbyuser as $key => $value){
                            $cate_user[]=$value->name;
                            $data_user[]=$value->y;
                        }

                        $tit_g_8='Total Leads by User ('.$year.')';
                    }else{
                        $leadbyuser=DB::table('leads')->whereMonth('lead_date', $mon)->whereYear('lead_date', $year)->select(DB::raw('form_name as name, count(*) as y'))->groupBy('form_name')->get();
                        foreach($leadbyuser as $key => $value){
                            $cate_user[]=$value->name;
                            $data_user[]=$value->y;
                        }
                        $months_l=['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'Octuber', 'November', 'December'];
                        $tit_g_8='Total Leads by User ('.$months_l[$mon-1].' '.$year.')';
                    }
                } 

                $response = [
                    'status' => 'success',
                    'cate_user' => $cate_user,
                    'data_user' => $data_user,
                    'tit_g_8' => $tit_g_8,
                ];
                return response()->json($response);

            }
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'data' => $th->getMessage(),
            ];
            return response()->json($response);
        }
    }

    public function weekByYear(Request $request){ 
        try {
            $request->validate([
                'year_5' => 'required',
            ]);

            function weekDayToTime($week, $year, $dayOfWeek = 1) {
                $dayOfWeekRef = date("w", mktime (0,0,0,1,4,$year));
                if ($dayOfWeekRef == 0) $dayOfWeekRef = 7;
                $resultTime = mktime(0,0,0,1,4,$year) + ((($week - 1) * 7 + ($dayOfWeek - $dayOfWeekRef)) * 86400);
                $resultTime = cleanTime($resultTime);  //Cleaning daylight saving time hours
                return $resultTime;
            };  
    
            function cleanTime($time) {
                //This function strips all hours, minutes and seconds from time.
                //For example useful of cleaning up DST hours from time
                $cleanTime = mktime(0,0,0,date("m", $time),date("d", $time),date("Y", $time));
                return $cleanTime;
            }   
            function weeks($year) {   
                return date("W",mktime(0,0,0,12,28,$year));
            }   
    
            $year = $request->year_5;
            $option='<option value="">Select Week</option>';
            for($i=1;$i<=weeks($year);$i++) {
                $start = weekDayToTime($i, $year);
                $end   = cleanTime(518400 + $start);
                $value=strftime("%Y", $start).'-'.strftime("%m", $start).'-'.strftime("%d", $start).'/'.strftime("%Y", $end).'-'.strftime("%m", $end).'-'.strftime("%d", $end);
                $option=$option."<option value='".$value."'>Week: ".$i.": ".strftime("%d %B %Y", $start)." to ".strftime("%d %B %Y", $end)."</option>";
            }
            $response = [
                'status' => 'success',
                'option' => $option
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
}

