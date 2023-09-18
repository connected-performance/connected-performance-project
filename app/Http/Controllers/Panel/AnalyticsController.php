<?php

namespace App\Http\Controllers\Panel;

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
}
