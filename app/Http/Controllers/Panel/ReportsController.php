<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use App\Models\Invoice;
use App\Models\Lead;
use App\Models\Transction;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    //

    public function index(){
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/reports/index"), 'name' => 'reports'],
            ['name' => __('reports')],
        ];

        return view('content.reports.reports',[
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function index_ajax(Request $request){
        try {
            $revenue_value = [];
            $t_evenue_value = 0;
            $lead = [];
            $customer = [];
            $mounth_name = [];
            $mounth_number = [];
            $deals = [];
            $pro_dates = [];
            $pro_revenue = [];
            $currentDate = Carbon::now()->startOfMonth();
            while ($currentDate->year == Carbon::now()->year) {
                $mounth_number[] = $currentDate->format('m');
                $mounth_name[] = $currentDate->format('F');
                $currentDate->subMonth();
            }

            $data = array_reverse($mounth_number);
            foreach ($data as $value) {
                $revenue_value[] = Invoice::where('status', '1')->where('type', 'NORMAL PAYMENT')->where('balance_status', '1')->whereMonth('issue_date', $value)->sum('balance');
                // $lead[] = Lead::where('status', '0')->whereMonth('lead_date', $value)->count();
                $customer[] = Lead::where('status', '2')->whereMonth('lead_date', $value)->count();
                $deals[] = Lead::where('employee_id','!=',null)->where('status', '0')->whereMonth('lead_date', $value)->count();
            }

            $t_evenue_value = array_sum($revenue_value);
            $t_customer = array_sum($customer);
            $t_deals = array_sum($deals);
            $total_leads = Lead::whereYear('lead_date', date('Y'))->count();
            $total_customer = Lead::where('status', '2')->whereYear('lead_date', date('Y'))->count();
            $total_lead = Lead::where('status', '0')->whereYear('lead_date', date('Y'))->count();
            $trends[] = ($total_customer / $total_leads) * 100;
            $trends[] = ($total_lead / $total_leads) * 100;
            $total_customer = ($total_customer / $total_leads) * 100;

            $now = Carbon::now();
            $start_date = $now->startOfMonth()->format('Y-m-d');
            $end_date = $now->endOfMonth()->format('Y-m-d');
            $period = CarbonPeriod::create($start_date, $end_date);
            foreach ($period as $date) {
                $pro_dates[] = $date->format('Y-m-d');
                $pro_revenue[] = Invoice::where('status', '1')->where('type', 'NORMAL PAYMENT')->where('balance_status', '1')->where('issue_date', $date->format('Y-m-d'))->sum('balance');
            }
            $t_pro_revenue = array_sum($pro_revenue);

            $response = [
                'status' => 'success',
                'message' => 'Check Reports',
                'revenue_value' => $revenue_value,
                't_evenue_value' => $t_evenue_value,
                // 'lead' =>$lead,
                'customer' => $customer,
                't_customer' => $t_customer,
                'deals' => $deals,
                't_deals' => $t_deals,
                'trends' => $trends,
                'total_customer' => $total_customer,
                'pro_dates' => $pro_dates,
                'pro_revenue' => $pro_revenue,
                't_pro_revenue' => $t_pro_revenue,
                'mounth_name' =>array_reverse($mounth_name),
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

    public function customer_ajax(Request $request){
        try {

            $lead = [];
            $customer = [];

            $yr =  date("Y", strtotime($request->date));
            $mth = date("m", strtotime($request->date));
            $noonTodayLondonTime = Carbon::create($yr, $mth, 1);
            while ($noonTodayLondonTime->year ==  $yr) {
                $mounth_number[] = $noonTodayLondonTime->format('m');
                $mounth_name[] = $noonTodayLondonTime->format('F');
                $noonTodayLondonTime->subMonth();
            }

            $data = array_reverse($mounth_number);
            foreach ($data as $value) {

                $lead[] = Lead::where('status', '0')->whereMonth('lead_date', $value)->count();
                $customer[] = Lead::where('status', '2')->whereMonth('lead_date', $value)->count();
            }


            $t_customer = array_sum($customer);

            $total_leads = Lead::whereYear('lead_date', date('Y'))->count();
            $total_customer = Lead::where('status', '2')->whereYear('lead_date', date('Y'))->count();
            $total_lead = Lead::where('status', '0')->whereYear('lead_date', date('Y'))->count();
            $total_customer = ($total_customer / $total_leads) * 100;



            $response = [
                'status' => 'success',
                'message' => 'Check Reports',
                'customer' => $customer,
                't_customer' => $t_customer,
                'total_customer' => $total_customer,
                'mounth_name' => array_reverse($mounth_name),
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

    public function mounth_recuring_ajax(Request $request)
    {
        try {

            $revenue_value = [];


            $yr =  date("Y", strtotime($request->date));
            $mth = date("m", strtotime($request->date));
            $noonTodayLondonTime = Carbon::create($yr, $mth, 1);
            while ($noonTodayLondonTime->year ==  $yr) {
                $mounth_number[] = $noonTodayLondonTime->format('m');
                $mounth_name[] = $noonTodayLondonTime->format('F');
                $noonTodayLondonTime->subMonth();
            }

            $data = array_reverse($mounth_number);
            foreach ($data as $value) {
                $revenue_value[] = Invoice::where('status', '1')->where('type', 'NORMAL PAYMENT')->where('balance_status', '1')->whereMonth('issue_date', $value)->sum('balance');
            }

            $t_evenue_value = array_sum($revenue_value);
            $response = [
                'status' => 'success',
                'message' => 'Check Reports',
                'revenue_value' => $revenue_value,
                't_evenue_value' => $t_evenue_value,
                'mounth_name' => array_reverse($mounth_name),
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

    public function project_revenue_ajax(Request $request){
        try{
           $revenue_value = [];


            $yr =  date("Y", strtotime($request->date));
            $mth = date("m", strtotime($request->date));
            $noonTodayLondonTime = Carbon::create($yr, $mth, 1);
            while ($noonTodayLondonTime->year ==  $yr) {
                $mounth_number[] = $noonTodayLondonTime->format('m');
                $mounth_name[] = $noonTodayLondonTime->format('F');
                $noonTodayLondonTime->subMonth();
            }
            $data = array_reverse($mounth_number);
            foreach ($data as $value) {
                $revenue_value[] = Invoice::where('status', '1')->where('type', 'NORMAL PAYMENT')->where('balance_status', '1')->whereMonth('issue_date', $value)->sum('balance');
            }
            $now = Carbon::create($yr, $mth, 1);
            $start_date = $now->startOfMonth()->format('Y-m-d');
            $end_date = $now->endOfMonth()->format('Y-m-d');
            $period = CarbonPeriod::create($start_date, $end_date);
            foreach ($period as $date) {
                $pro_dates[] = $date->format('Y-m-d');
                $pro_revenue[] = Invoice::where('status', '1')->where('type', 'NORMAL PAYMENT')->where('balance_status', '1')->where('issue_date', $date->format('Y-m-d'))->sum('balance');
            }
            $t_pro_revenue = array_sum($pro_revenue);

            $t_evenue_value = array_sum($revenue_value);
            $response = [
                'status' => 'success',
                'message' => 'Check Reports',
                'pro_dates' => $pro_dates,
                'revenue_value' => $revenue_value,
                't_evenue_value' => $t_evenue_value,
                'pro_revenue' => $pro_revenue,
                't_pro_revenue' => $t_pro_revenue,

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

     public function pipeline_deal_ajax(Request $request){
        try {

            $lead = [];
            $deals = [];

            $yr =  date("Y", strtotime($request->date));
            $mth = date("m", strtotime($request->date));
            $noonTodayLondonTime = Carbon::create($yr, $mth, 1);
            while ($noonTodayLondonTime->year ==  $yr) {
                $mounth_number[] = $noonTodayLondonTime->format('m');
                $mounth_name[] = $noonTodayLondonTime->format('F');
                $noonTodayLondonTime->subMonth();
            }

            $data = array_reverse($mounth_number);
            foreach ($data as $value) {

                $deals[] = Lead::where('employee_id', '!=', null)->where('status', '0')->whereMonth('lead_date', $value)->count();
            }

            $t_deals = array_sum($deals);

            $response = [
                'status' => 'success',
                'message' => 'Check Reports',
                'deals' => $deals,
                't_deals' => $t_deals,
                'mounth_name' => array_reverse($mounth_name),
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


    public function get_goal(){

        $goal = Goal::first();
        $revenue_value = '';
        $complete = '';
        $goal_amount = '';
        if($goal){
            $revenue_value = Invoice::get()->sum('balance');
            $complete = ($revenue_value/$goal->set_goals)*100;
            $goal_amount = $goal->set_goals;
            $complete = number_format((float)$complete,2,'.','');
        }
        $response = [
            'goal' => $goal,
            'goal_amount' => $goal_amount,
            'complete' => $complete,
        ];
        return response()->json($response);
    }

    public function update_goal(Request $request)
    {

        try {
                $request->validate([
                    'starte_date' => 'required',
                    'end_date' => 'required',
                   'goal_amount' => 'required',

                ]);
                $goal = Goal::first();
            if ($goal) {
                $goal->update([
                    'start_date' => $request->starte_date,
                    'end_date' => $request->end_date,
                    'set_goals' => $request->goal_amount,
                ]);

            } else {
                $goal = Goal::create([
                    'start_date' => $request->starte_date,
                    'end_date' => $request->end_date,
                    'set_goals' => $request->goal_amount,
                ]);
            }
            $response = [
                'status' => 'success',
                'message' => 'Goal Successfully Updated',
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
