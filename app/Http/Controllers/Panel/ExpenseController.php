<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExtraCharge;
use App\Models\Plugin;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExpenseController extends Controller
{
    //
    public function index(){
        $plugin = Plugin::where('name','expensify')->first();
        if(!$plugin){
            return redirect()->route('plugin.index')->with('error','Plz Add Expensify Private And Secrete Keys');
        }
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/expense"), 'name' => 'expense'],
            ['name' => __('expense')],
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://integrations.expensify.com/Integration-Server/ExpensifyIntegrations');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "requestJobDescription={\n
                    \"type\":\"file\",\n        \"credentials\":{\n 
                                   \"partnerUserID\":\"".$plugin->private_key."\",\n
                                               \"partnerUserSecret\":\"".$plugin->secret_key. "\"\n
                                            },\n        \"onReceive\":{\n            \"immediateResponse\":[\"returnRandomFileName\"]\n        },\n        
                                            \"inputSettings\":{\n            \"type\":\"combinedReportData\",\n            
                                                \"reportState\":\"APPROVED,REIMBURSED\",\n            \"limit\":\"10\",\n           
                                                 \"filters\":{\n                \"startDate\":\"2022-01-01\",\n                
                                                    \"endDate\":\"2022-012-1\",\n                \n            }\n        },\n       
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
        // return $result;
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
        $data = Expense::where('marchent_name','!=',null)->get();
        return view('content.expense.expense-index', compact('breadcrumbs','data'));
    }

    public function extra_charge(){
        $breadcrumbs = [
            ['link' => url("/panel"), 'name' => 'Dashboard'],
            ['link' => url("/panel/extra/amount"), 'name' => 'exrea amount'],
            ['name' => __('extra amount')],
        ];

        $users = User::where('is_customer',true)->get(['id','first_name']);
   
        return view('content.expense.extra-charge',compact('users', 'breadcrumbs'));
    }

    public function extra_charge_ajax(Request $request){

        $records =  ExtraCharge::with('users')->get();
        return DataTables::of($records)->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="#" style="padding-left:10px;" class="link-success"  data-bs-toggle="tooltip"
                       data-bs-placement="top" title="Edit" onclick="edit_model(' . $row->id . ')"><i class="fas fa-edit"></i></a>' .
                    '<a href="#" style="padding-left:10px;" class="link-danger"  data-bs-toggle="tooltip"
                       data-bs-placement="top" title="Delet" onclick="delete_data(' . $row->id . ')"><i class="fa-solid fa-trash"></i></a>';
                return $btn;
            })
            ->addColumn('status', function ($row) {
                if ($row->status == '3') {
                    $status =  '<span class="badge rounded-pill  badge-light-info">Draft</span>';
                } else {;
                    $status  = '<span class="badge rounded-pill  badge-light-success">Send</span>';
                }
                return $status;
            })
            ->addColumn('amount', function ($row) {

                return '$' . $row->amount;
            })
          
            ->addColumn('balance_status', function ($row) {
                if ($row->balance_status == '0') {
                    $balance_status =  '<span class="badge rounded-pill  badge-light-warning">UnPaid</span>';
                } else {;
                    $balance_status  = '<span class="badge rounded-pill  badge-light-success">Paid</span>';
                }
                return $balance_status;
            })
            ->rawColumns(['action','status', 'balance_status'])
            ->make(true);
    }

    public function extra_charge_create(Request $request){

        try{

            $request->validate([
                'user_id' => 'required',
                'issue_date' => 'required',
                'due_date' => 'required',
                'description' => 'required',
                'price' => 'required',
                
            ]);

            if ($request->due_date <= $request->issue_date) {
                $response = [
                    'status' => 'error',
                    'message' => 'Due Date Must Be Greater Then Issue Date',

                ];
                return response()->json($response);
            }

            $extra_charge = new ExtraCharge();
            $extra_charge->user_id = $request->user_id;
            $extra_charge->amount = $request->price;
            $extra_charge->issue_date = $request->issue_date;
            $extra_charge->due_date = $request->due_date;
            $extra_charge->status = '3';
            $extra_charge->balance_status = '0';
            $extra_charge->save();
            $response = [
                'status' => 'success',
                'message' =>'Charges Successfully Create',
            ];
            return response()->json($response);
            
        }catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
            return response()->json($response);
        }
   
    }

    public function charges_get($id){
         $data = ExtraCharge::with('users')->find($id);
        return view('extra-charge-pay-dumy', compact( 'data'));
    }
}
