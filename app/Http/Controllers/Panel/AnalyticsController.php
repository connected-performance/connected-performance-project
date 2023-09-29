<?php

namespace App\Http\Controllers\Panel;

use App\Enums\LeadLossReasonEnum;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Invoice;
use App\Models\Lead;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function dashboard($factor = 'monthly')
    {
        $currentYear = Carbon::now()->year;
        $saleChartData = [];
        $start_date = Carbon::now()->startOfMonth();
        $end_date = Carbon::now()->endOfMonth();

        /**
         * fetching yearly or monthly sales data and customers
         */
        $invoices = Invoice::where('balance_status', '1');
        $customers = Customer::where('status', '1');
        if ($factor === 'yearly') {
            $invoices = $invoices->selectRaw('YEAR(issue_date) as sales_year, SUM(balance) as total_sales')
                ->groupBy('sales_year')
                ->orderBy('sales_year');
            $customers = $customers->selectRaw('YEAR(created_at) as customers_year, COUNT(id) as total_customers ')
                ->groupBy('customers_year')
                ->orderBy('customers_year');
        } else if ($factor === 'monthly') {
            $invoices = $invoices->select(DB::raw('YEAR(issue_date) as sales_year, MONTH(issue_date) as sales_month'), DB::raw('SUM(balance) as total_sales'))
                ->groupBy('sales_year', 'sales_month')
                ->orderBy('sales_year', 'asc')
                ->orderBy('sales_month', 'asc');
            $customers = $customers->select(DB::raw('YEAR(created_at) as customers_year, MONTH(created_at) as customers_month'), DB::raw('COUNT(id) as total_customers'))
                ->groupBy('customers_year', 'customers_month')
                ->orderBy('customers_year', 'asc')
                ->orderBy('customers_month', 'asc');
        }
        $salesData = $invoices->get();
        $customersData = $customers->get();

        $leadsData = Lead::select(
            DB::raw('YEAR(created_at) as leads_year'),
            DB::raw('COUNT(id) as total_leads')
        )
            ->groupBy('leads_year')
            ->orderBy('leads_year')
            ->get();

        return view('content.analytics.index', compact('salesData', 'customersData', 'start_date', 'end_date', 'leadsData'));
    }

    public function getLeadsReports(Request $request)
    {
        try {

            $request->validate([
                'by_factor' => 'required|in:yearly,monthly,weekly'
            ]);

            $leadsData = null;

            if ($request->has('by_factor')) {

                if ($request->by_factor === 'weekly') {
                    $leadsData = Lead::select(
                        DB::raw('YEAR(created_at) as leads_year'),
                        DB::raw('WEEK(created_at, 1) as leads_week'), // Use '1' to start weeks on Monday
                        DB::raw('DATE_ADD(MIN(created_at), INTERVAL (2 - DAYOFWEEK(MIN(created_at))) DAY) as week_start_date'),
                        DB::raw('DATE_ADD(MIN(created_at), INTERVAL (8 - DAYOFWEEK(MIN(created_at))) DAY) as week_end_date'),
                        DB::raw('COUNT(id) as total_leads')
                    )
                        ->groupBy('leads_year', 'leads_week')
                        ->orderBy('leads_year', 'asc')
                        ->orderBy('leads_week', 'asc');
                } else if ($request->by_factor === 'monthly') {
                    $leadsData = Lead::select(
                        DB::raw('YEAR(created_at) as leads_year, MONTH(created_at) as leads_month'),
                        DB::raw('COUNT(id) as total_leads')
                    )
                        ->groupBy('leads_year', 'leads_month')
                        ->orderBy('leads_year', 'asc')
                        ->orderBy('leads_month', 'asc');
                } else {
                    $leadsData = Lead::select(
                        DB::raw('YEAR(created_at) as leads_year'),
                        DB::raw('COUNT(id) as total_leads')
                    )
                        ->groupBy('leads_year')
                        ->orderBy('leads_year');
                }

                $leadsData = $leadsData->get();
            }
            $response = [
                'status' => 'success',
                'leadsData' => $leadsData
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

    public function getEmployeesCloseRate(Request $request)
    {
        try {
            if ($request->has('by_factor')) {
                $by_factor = $request->by_factor;
            } else {
                $by_factor = 'monthly';
            }

            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
            $leadsByEmployee = [];


            /*** this query returns employee and leads full information */
            /** Employee::select('employees.id')
             * ->leftJoin('leads', function($join) use ($currentMonth, $currentYear) {
             *     $join->on('employees.id', '=', 'leads.employee_id')
             *          ->whereMonth('leads.created_at', '=', $currentMonth)
             *          ->whereYear('leads.created_at', '=', $currentYear);
             * })
             * ->groupBy('employees.id')
             * ->get()
             * ->map(function ($employee) {
             *     $employee['leads'] = Lead::select('leads.*', DB::raw('IF(users.is_customer = 1, 1, 0) as is_customer'))
             *         ->leftJoin('users', function($join) {
             *             $join->on('leads.email', '=', 'users.email');
             *         })
             *         ->where('employee_id', $employee->id)
             *         ->whereMonth('leads.created_at', '=', now()->month)
             *         ->whereYear('leads.created_at', '=', now()->year)
             *         ->get()
             *         ->toArray();
             *     return $employee;
             * });
             */

            if ($by_factor === 'monthly') {
                $leadsByEmployee = Employee::select(
                    DB::raw('employees.id'),
                    DB::raw('users.email as employee_email'),
                    DB::raw('YEAR(leads.created_at) as selected_year'),
                    DB::raw('MONTH(leads.created_at) as selected_month')
                )
                    ->join('users', 'users.id', 'employees.user_id')
                    ->leftJoin('leads', function ($join) use ($currentMonth, $currentYear) {
                        $join->on('employees.id', '=', 'leads.employee_id')
                            ->whereMonth('leads.created_at', '=', $currentMonth)
                            ->whereYear('leads.created_at', '=', $currentYear);
                    })
                    ->groupBy('employees.id')
                    ->groupBy('selected_year')
                    ->groupBy('selected_month')
                    ->groupBy('employee_email')
                    ->orderBy('employee_email', 'asc')
                    ->get()
                    ->map(function ($employee) {
                        $employee['total_leads'] = Lead::where('employee_id', $employee->id)
                            ->whereMonth('leads.created_at', '=', now()->month)
                            ->whereYear('leads.created_at', '=', now()->year)
                            ->count();

                        $employee['customer_leads'] = Lead::where('employee_id', $employee->id)
                            ->whereMonth('leads.created_at', '=', now()->month)
                            ->whereYear('leads.created_at', '=', now()->year)
                            ->join('users', 'leads.email', '=', 'users.email')
                            ->where('users.is_customer', '=', 1)
                            ->count();

                        return $employee;
                    });
            }

            $response = [
                'status' => 'success',
                'leadsByEmployee' => $leadsByEmployee
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

    public function getMonthlyRecurringRevenuForEmployees()
    {
        try {
            $employees = Employee::select(
                'users.email as employee_email',
                DB::raw('COALESCE(SUM(CASE WHEN invoices.balance_status = 1 THEN invoices.balance ELSE 0 END), 0) as invoices_total')
            )
                ->leftJoin('customers', 'employees.id', 'customers.employee_id')
                ->leftJoin('invoices', 'customers.id', 'invoices.customer_id')
                ->join('users', 'employees.user_id', 'users.id')
                ->groupBy('users.email')
                ->orderBy('employee_email', 'asc')
                ->get();
            $response = [
                'status' => 'success',
                'employeeMonthlyRecurringRevenue' => $employees
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

    public function totalChurnedCustomers(Request $request)
    {
        try {
            $factor = 'year';

            if ($request->has('factor')) {
                $factor = $request->factor;
            }

            if ($factor === 'year') {
                // Get data monthly for the current year
                $churnedCustomers = Customer::select(
                    DB::raw('count(id) as churned_customers'),
                    DB::raw('YEAR(convert_date) as selected_year')
                )
                    ->where('is_converted', 1)
                    ->where('convert_reason', 'contract-broken')
                    ->whereYear('convert_date', now()->year) // Filter by the current year
                    ->groupBy('selected_year')
                    ->get();
            }

            $response = [
                'status' => 'success',
                'churnedCutomers' => $churnedCustomers
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

    public function projectedRecurringRevenue()
    {
        try {
            // Get the current year
            $currentYear = Carbon::now()->year;

            // Initialize arrays to store data for each month
            $monthlyProjectedRevenue = [];
            $monthlyChurnedCustomers = [];
            $monthlySubscribedUserCount = [];
            $yearRevenue = 0;
            $newSubs = 0;

            // Loop through all 12 months
            for ($month = 1; $month <= 12; $month++) {
                // Calculate churned customers for the current month
                $churnedCustomers = Customer::where('is_converted', 1)
                    ->where('convert_reason', 'contract-broken')
                    ->whereYear('convert_date', $currentYear)
                    ->whereMonth('convert_date', $month)
                    ->count();

                // Calculate subscribed user count for the current month
                $subscribedUserCount = User::join('customers', 'users.id', '=', 'customers.user_id')
                    ->where('users.is_customer', 1)
                    ->whereNotNull('customers.subscription_id')
                    ->whereYear('customers.created_at', $currentYear)
                    ->whereMonth('customers.created_at', $month)
                    ->count();

                // Get ARPU (Average Revenue Per User) for the current month
                $totalRevenue = Invoice::where('status', '1')
                    ->where('balance_status', '1')
                    ->whereYear('issue_date', $currentYear)
                    ->whereMonth('issue_date', $month)
                    ->sum('balance');
                $currentSubscribers = $subscribedUserCount - $churnedCustomers;
                $arpu = $currentSubscribers > 0 ? $totalRevenue / $currentSubscribers : 0;

                // Calculate projected recurring revenue for the current month
                $monthlyProjectedRevenue[] = $currentSubscribers * $arpu;
                $yearRevenue +=  ($currentSubscribers * $arpu);

                // Store churned customers and subscribed user count for the current month
                $monthlyChurnedCustomers[] = $churnedCustomers;
                $monthlySubscribedUserCount[] = $subscribedUserCount;
                $newSubs += $subscribedUserCount;
            }

            $response = [
                'status' => 'success',
                'monthly_projected_revenue' => $monthlyProjectedRevenue,
                'monthly_churned_customers' => $monthlyChurnedCustomers,
                'monthly_subscribed_user_count' => $monthlySubscribedUserCount,
                'total_revenue' => $yearRevenue,
                'new_subs' => $newSubs
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

    public function lead_loss_details()
    {
        try {
            $leadCounts = Lead::select('loss_reason', DB::raw('COUNT(*) as count'))
                ->where('loss_reason', '!=', '')
                ->groupBy('loss_reason')
                ->get();
            $response = [
                'status' => 'success',
                'data' => $leadCounts
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



    // public function projectedRecurringRevenue()
    // {
    //     $currentYear = Carbon::now()->year;

    //     $churnedCustomers = Customer::where('is_converted', 1)
    //         ->where('convert_reason', 'contract-broken')
    //         ->whereYear('convert_date', now()->year)
    //         ->count();

    //     $subscribedUserCount = User::join('customers', 'users.id', '=', 'customers.user_id')
    //         ->where('users.is_customer', 1)
    //         ->whereNotNull('customers.subscription_id')
    //         ->count();

    //     $months = DB::table(DB::raw('(SELECT 1 as month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) AS months'))
    //         ->select('months.month');

    //     $invoiceTotals = $months
    //         ->leftJoin('invoices', function ($join) use ($currentYear) {
    //             $join->on(DB::raw('MONTH(invoices.created_at)'), '=', 'months.month')
    //                 ->whereYear('invoices.created_at', $currentYear)
    //                 ->where('status', '1')->where('balance_status', '1');
    //         })
    //         ->select(DB::raw('months.month as month'), DB::raw('COALESCE(SUM(invoices.total_amount), 0) as total'))
    //         ->groupBy('months.month')
    //         ->get();

    //     return [
    //         $invoiceTotals,
    //         $churnedCustomers,
    //         $subscribedUserCount
    //     ];
    //     try {
    //         $factor = 'monthly';
    //         $revenue_value = [];
    //         $mounth_number = [];
    //         $currentDate = Carbon::now()->startOfMonth();
    //         while ($currentDate->year == Carbon::now()->year) {
    //             $mounth_number[] = $currentDate->format('m');
    //             $mounth_name[] = $currentDate->format('F');
    //             $currentDate->subMonth();
    //         }
    //         $data = array_reverse($mounth_number);
    //         foreach ($data as $value) {
    //             $revenue_value[] = Invoice::where('status', '1')->where('balance_status', '1')->whereMonth('issue_date', $value)->sum('balance');
    //         }

    //         $total_revenue = array_sum($revenue_value);
    //         $response = [
    //             'status' => 'success',
    //             'total_revenue' => $total_revenue,
    //             'monthly_revenue' => $revenue_value
    //         ];
    //         return response()->json($response);
    //     } catch (\Throwable $th) {
    //         $response = [
    //             'status' => 'error',
    //             'message' => $th->getMessage(),
    //         ];
    //         return response()->json($response);
    //     }
    // }
}
