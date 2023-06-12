<?php

namespace App\Console\Commands;

use App\Models\Expense;
use App\Models\Plugin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class Expensify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expensify:expense';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return 0;
        $plugin = Plugin::where('name', 'expensify')->first();

        if (!$plugin) {
            return redirect()->route('plugin.index')->with('error', 'Plz Add Expensify Private And Secrete Keys');
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
         //  $result;
         Log::info('jhjhjhjhjhjgjhg');
       
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
        }

    }
}
