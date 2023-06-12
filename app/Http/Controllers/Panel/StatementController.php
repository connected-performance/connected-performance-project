<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Plugin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PDF;
use Yajra\DataTables\Facades\DataTables;

class StatementController extends Controller
{
    //
    public function income_statment(){
        $plugin = Plugin::where('name', 'expensify')->first();
        if (!$plugin) {
            return redirect()->route('plugin.index')->with('error', 'Plz Add Expensify Private And Secrete Keys');
        }
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/statement"), 'name' => 'statement'],
            ['name' => __('statement')],
        ];
        
        $revenue_value = Invoice::where('status', '1')->where('balance_status', '1')->whereMonth('issue_date', date('m'))->sum('balance');
        $t_expense = Expense::where('marchent_name', '!=', null)->sum('amount') ;
        return view('content.expense.statement-index',compact('breadcrumbs', 't_expense', 'revenue_value'));
    }

    public function create_pdf()
    {

        // retreive all records from db
          $data = Expense::where('marchent_name', '!=', null)->get();
          $revenue_value = Invoice::where('status',
            '1'
        )->where('balance_status', '1')->whereMonth('issue_date', date('m'))->sum('balance');
        $t_expense = Expense::where('marchent_name', '!=', null)->sum('amount');
       //return view('content.expense.statement-pdf', compact('data', 'revenue_value', 't_expense'));
        // share data to view
        // view()->share('employee', $data);
         $pdf = PDF::loadView('content.expense.statement-pdf', compact('data', 'revenue_value', 't_expense'));
        // download PDF file with download method
       return $pdf->stream();

        return $pdf->download('pdf_file.pdf');
    }

    public function statement_ajax(Request $request){


        $plugin = Plugin::where('name', 'expensify')->first();
        if($request->date != null){
            $yr =  date("Y", strtotime($request->date));
            $mth = date("m", strtotime($request->date));
            $start_date = Carbon::create($yr, $mth)->startOfMonth()->toDateString();
             $end_date = Carbon::create($yr, $mth)->endOfMonth()->toDateString();
        }else{
            $get_dates = Carbon::now()->startOfMonth();
            $start_date = $get_dates->format('Y-m-d');
            $end_date = $get_dates->endOfMonth()->toDateString();
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://integrations.expensify.com/Integration-Server/ExpensifyIntegrations');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "requestJobDescription={\n
                    \"type\":\"file\",\n        \"credentials\":{\n 
                                   \"partnerUserID\":\"" . $plugin->private_key . "\",\n
                                               \"partnerUserSecret\":\"" . $plugin->secret_key . "\"\n
                                            },\n        \"onReceive\":{\n            \"immediateResponse\":[\"returnRandomFileName\"]\n        },\n        
                                            \"inputSettings\":{\n            \"type\":\"combinedReportData\",\n            
                                                \"reportState\":\"APPROVED,REIMBURSED\",\n            \"limit\":\"10\",\n           
                                                 \"filters\":{\n                \"startDate\":\"" . $start_date . "\",\n                
                                                    \"endDate\":\"" . $end_date . "\",\n                \n            }\n        },\n       
                                                     \"outputSettings\":{\n            \"fileExtension\":\"csv\",\n          
                                                         \n        },\n       \n    }&template=<#if addHeader == true>   
                                Merchant,Original Amount,Category,Report number,Expense number<#lt></#if><#assign reportNumber = 1>
                                <#assign expenseNumber = 1>
                                <#list reports as report>  
                                <#list report.transactionList as expense>      
                                " . ',${expense.merchant}' . ",<#t>
                                " . '${expense.amount}' . ",<#t>      
                                " . '${expense.category}' . ",<#t>
                                " . '${reportNumber}' . ",<#t>     
                                " . '${expenseNumber}' . ",<#t> 
                                " . '${expense.created}' . ",<#t>
                                " . '${expense.comment}' . ",<#t>
                                " . '${expense.currency}' . ",<#t>
                                " . '${expense.transactionID}' . ",<#t>
                                " . '${expense.type}' . ",<#t>
                                " . '${expense.hasTax}' . ",<#t>
                                " . '${expense.inserted}' . ",<#t>
                                </#list>
                                </#list>");

        $headers = array();
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $data = $result;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://integrations.expensify.com/Integration-Server/ExpensifyIntegrations');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "requestJobDescription={\n        \"type\":\"download\",\n        \"credentials\":{\n 
                      \"partnerUserID\":\"aa_hbdeveloper_two_gmail_com\",\n            \"partnerUserSecret\":\"bab1c0e1bd30365227b7c7390c31454ef3c13905\"\n
                           },\n        \"fileName\": " . $data . ",\n   }");

        $headers = array();
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        //  $result;
        $data = explode(',', $result);
        $count = count($data);
        $count = $count - 1;

        Expense::truncate();
        $j = 5;
        for ($i = 5; $i <= $count; $i++) {
            $expens = new Expense();
            if (isset($data[$j])) {
                $expens->marchent_name = $data[$j];
                $j++;
            }
            if (isset($data[$j])) {
                $expens->amount = substr($data[$j], 0, -2);
                $j++;
            }
            if (isset($data[$j])) {
                $expens->category = $data[$j];
                $j++;
            }
            if (isset($data[$j])) {
                $expens->reportNumber = $data[$j];
                $j++;
            }
            if (isset($data[$j])) {
                $expens->expenseNumber = $data[$j];
                $j++;
            }

            //new
            if (isset($data[$j])) {
                $expens->date = $data[$j];
                $j++;
            }
            if (isset($data[$j])) {
                $expens->description = $data[$j];
                $j++;
            }
            if (isset($data[$j])) {
                $expens->currency = $data[$j];
                $j++;
            }
            if (isset($data[$j])) {
                $expens->transactionID = $data[$j];
                $j++;
            }
            if (isset($data[$j])) {
                $expens->type = $data[$j];
                $j++;
            }
            if (isset($data[$j])) {
                $expens->hasTax = $data[$j];
                $j++;
            }
            if (isset($data[$j])) {
                $expens->inserted = $data[$j];
                $j++;
            }
            $j++;
            $expens->save();
        }
        $records = Expense::where('marchent_name', '!=', null)->get();
        return DataTables::of($records)->addIndexColumn()
            // ->rawColumns()
            ->make(true);
    }
    public function ravenue_ajax(Request $request){
        try {
            $revenue_value = Invoice::where('status', '1')->where('balance_status', '1')->whereMonth('issue_date', date('m'))->sum('balance');
             $t_expense = Expense::where('marchent_name', '!=', null)->sum('amount');
            $income = @$revenue_value - @$t_expense;
            if ($income < 0) {
                $value = explode('-', $income);
                $income = '-$' . $value[1];
                $statement = 'Loss';
            } else {
                $income = '$' . $income;
                $statement = 'Profit';
            }
            $response = [
                'status' => 'success',
                'message' => '',
                'revenue_value' => $revenue_value,
                't_expense' => $t_expense,
                'statement' => $statement,
                'income' => $income
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
