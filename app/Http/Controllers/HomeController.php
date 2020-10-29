<?php

namespace App\Http\Controllers;

use App\Incident;
use App\InventoryTransaction;
use App\Rent;
use App\SalesDetail;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $title = 'Dashboard';
        $rents = Rent::all();
        $total_rents = Count($rents->where('status', 1));
        $today_rents = Count($rents->where('rent_date', '=', today()->format('Y-m-d')));
        $sevenDays = $this->sevenDaysTripCount($rents);
        $sixMonths = $this->sixMonthsTripCount();

        $debit = Transaction::where('type', 'Debit')->get();
        $totalDebit = $debit->sum('amount');
        $credit  = Transaction::where('type', 'Credit')->get();
        $totalCredit = $credit->sum('amount');

        $total_amount = $totalDebit - $totalCredit;
        $total_earnings = $this->totalEarnings($debit);
        $total_expense = $this->totalExpense($credit);
        $year_expense = $this->lastYearExpense();
        $year_earnings = $this->lastYearEarnings();

        $active_cases = Incident::OrderBy('id', 'desc')->take(5)->get();

        $total_purchase = InventoryTransaction::where('type', 1)->sum('payment');
        $total_sales = InventoryTransaction::where('type', 2)->sum('payment');
        $purchase_dues = InventoryTransaction::where('type', 1)->orderBy('id', 'desc')->get();
        $sales_dues = InventoryTransaction::where('type', 2)->orderBy('id', 'desc')->get();
        $total_purchase_dues = $this->dueCalculation($purchase_dues, 'supplier_id');
        $total_sales_dues = $this->dueCalculation($sales_dues, 'customer_id');

        $total_maintenance = SalesDetail::where('vehicle_id','!=', null)->get();
        $total_maintenance_cost = $total_maintenance->sum('sales_total');
        $maintenance_by_month = $this->maintenanceByMonth();

        $total_income = $rents->where('status', 1)->sum('collection');
        $income_by_month = $this->incomeByMonth();

        $total_profit = $total_income - $total_maintenance_cost;
        $profit_by_month = $this->profitByMonth($income_by_month, $maintenance_by_month);

        $totalStockValue = $users = DB::table('stock_details')->select( 'id', 'purchase_cost', 'stock_quantity')
            ->selectRaw( "purchase_cost*stock_quantity as 'value'")
            ->get();


        return view('dashboard')->with(compact('title', 'total_rents','today_rents',
            'sevenDays','sixMonths', 'total_amount',
            'total_earnings', 'total_expense','year_expense','year_earnings',
            'active_cases', 'total_purchase_dues', 'total_sales_dues', 'total_purchase', 'total_sales',
            'total_maintenance_cost', 'maintenance_by_month' , 'total_income',
            'income_by_month', 'total_profit', 'profit_by_month', 'totalStockValue'));
    }
    private function sevenDaysTripCount($rents)
    {
        $sevenDays = [];
        for($i=0;$i<=6;$i++)
        {
            $sevenDays[$i] = Count($rents->where('rent_date', '=', Carbon::now()->subDays($i)->format('Y-m-d')));
        }

        return $sevenDays;
    }

    private function sixMonthsTripCount()
    {
        $sixMonths = [];
        $currentMonth = Carbon::now()->format('m');

        for($i=0;$i<=6;$i++)
        {
            $month =  Carbon::now()->subMonth($i)->format('m');
            if($currentMonth >= $i)
            {
                $year = Carbon::now()->format('y');
                $sixMonths[$month.'-'.$year] = Count(Rent::whereMonth('rent_date', '=', Carbon::now()->subMonth($i)->format('m'))->whereYear('rent_date', '=', Carbon::now()->subYear(0)->format('Y'))->get());
            }
            else{
                $year = Carbon::now()->subYear(1)->format('y');
                $sixMonths[$month.'-'.$year] = Count(Rent::where('status', 1)->whereMonth('rent_date', '=', Carbon::now()->subMonth($i)->format('m'))->whereYear('rent_date', '=', Carbon::now()->subYear(1)->format('Y'))->get());
            }
        }
        return $sixMonths;
    }

    private function totalEarnings($debit)
    {
        $rent = $debit->where('payment_for', 'rent')->sum('amount');
        $sales = $debit->where('payment_for', 'sales')->sum('amount');
        $customerCollection = $debit->where('payment_for', 'customerCollection')->sum('amount');
        return $rent + $sales + $customerCollection;
    }

    private function totalExpense($credit)
    {
        $purchase = $credit->where('payment_for', 'purchase')->sum('amount');
        $case = $credit->where('payment_for', 'casePayment')->sum('amount');
        $damage = $credit->where('payment_for', 'addDamage')->sum('amount');
        $supplierPayment = $credit->where('payment_for', 'supplierPayment')->sum('amount');
        $regular = $credit->where('payment_for', 'reMoney')->sum('amount');
        return $purchase+$case+$damage+$supplierPayment+$regular;
    }

    private function lastYearExpense()
    {
        $byMonths = [];
        $currentMonth = Carbon::now()->format('m');
        for($i=0;$i<=11;$i++)
        {
            if($currentMonth >= $i)
            {
                $credit = Transaction::where('type', 'credit')->whereMonth('created_at', '=', Carbon::now()->subMonth($i)->format('m'))->whereYear('created_at', '=', Carbon::now()->subYear(0)->format('Y'))->get();
                $year = Carbon::now()->format('y');
            }
            else{
                $credit = Transaction::where('type', 'credit')->whereMonth('created_at', '=', Carbon::now()->subMonth($i)->format('m'))->whereYear('created_at', '=', Carbon::now()->subYear(1)->format('Y'))->get();
                $year = Carbon::now()->subYear(1)->format('y');
            }
            $month =  Carbon::now()->subMonth($i)->format('M');

            $purchase = $credit->where('payment_for', 'purchase')->sum('amount');
            $case = $credit->where('payment_for', 'casePayment')->sum('amount');
            $damage = $credit->where('payment_for', 'addDamage')->sum('amount');
            $supplierPayment = $credit->where('payment_for', 'supplierPayment')->sum('amount');
            $regular = $credit->where('payment_for', 'reMoney')->sum('amount');
            $byMonths[$month.'-'.$year] = $purchase+$case+$damage+$supplierPayment+$regular;
        }
        return $byMonths;
    }

    private function lastYearEarnings()
    {
        $byMonths = [];
        $currentMonth = Carbon::now()->format('m');
        for($i=0;$i<=11;$i++)
        {
            if($currentMonth >= $i)
            {
            $debit = Transaction::where('type', 'debit')->whereMonth('created_at', '=', Carbon::now()->subMonth($i)->format('m'))->whereYear('created_at', '=', Carbon::now()->subYear(0)->format('Y'))->get();
                $year = Carbon::now()->format('Y');
            }
            else{
                $debit = Transaction::where('type', 'debit')->whereMonth('created_at', '=', Carbon::now()->subMonth($i)->format('m'))->whereYear('created_at', '=', Carbon::now()->subYear(1)->format('Y'))->get();
                $year = Carbon::now()->subYear(1)->format('Y');
            }
            $month =  Carbon::now()->subMonth($i)->format('M');

            $rent = $debit->where('payment_for', 'rent')->sum('amount');
            $sales = $debit->where('payment_for', 'sales')->sum('amount');
            $customerCollection = $debit->where('payment_for', 'customerCollection')->sum('amount');
            $byMonths[$month.'-'.$year] = $rent + $sales + $customerCollection;
        }
        return $byMonths;
    }

    private function dueCalculation($dues, $index)
    {

        $total_dues = [];
        foreach ($dues as $key => $due)
        {
            if(!array_key_exists($due->$index, $total_dues))
            {
                $total_dues[$due->$index] = 'pass';
            }
            else
            {
                $dues->forget($key);
            }

        }

        return $dues->sum('due');
    }

    private function maintenanceByMonth()
    {
        $byMonths = [];
        $currentMonth = Carbon::now()->format('m');
        for($i=0;$i<=5;$i++)
        {
            if($currentMonth >= $i)
            {
                $maintenance = SalesDetail::where('vehicle_id','!=', null)->whereMonth('created_at', '=', Carbon::now()->subMonth($i)->format('m'))->whereYear('created_at', '=', Carbon::now()->subYear(0)->format('Y'))->get();
                $year = Carbon::now()->format('y');
            }
            else{
                $maintenance = SalesDetail::where('vehicle_id','!=', null)->whereMonth('created_at', '=', Carbon::now()->subMonth($i)->format('m'))->whereYear('created_at', '=', Carbon::now()->subYear(1)->format('Y'))->get();
                $year = Carbon::now()->subYear(1)->format('y');
            }

            $month =  Carbon::now()->subMonth($i)->format('m');

            $byMonths[$month.'-'.$year] = $maintenance->sum('sales_total');
        }
        return $byMonths;
    }

    private function incomeByMonth()
    {
        $byMonths = [];
        $currentMonth = Carbon::now()->format('m');
        for($i=0;$i<=5;$i++)
        {
            if($currentMonth >= $i)
            {
                $income = Rent::where('status', 1)->whereMonth('rent_date', '=', Carbon::now()->subMonth($i)->format('m'))->whereYear('rent_date', '=', Carbon::now()->subYear(0)->format('Y'))->get();
                $year = Carbon::now()->format('y');
            }
            else{
                $income = Rent::where('status', 1)->whereMonth('rent_date', '=', Carbon::now()->subMonth($i)->format('m'))->whereYear('rent_date', '=', Carbon::now()->subYear(1)->format('Y'))->get();
                $year = Carbon::now()->subYear(1)->format('y');
            }

            $month =  Carbon::now()->subMonth($i)->format('m');

            $byMonths[$month.'-'.$year] = $income->sum('collection');
        }
        return $byMonths;
    }

    private function profitByMonth(array $income_by_month, array $maintenance_by_month)
    {
        $byMonths = [];
        foreach ($income_by_month as $key => $income)
        {
            foreach ($maintenance_by_month as $key2 => $maintenance)
            {
                if($key == $key2)
                {
                    $byMonths[$key] = $income - $maintenance;
                }
            }
        }
        return $byMonths;
    }
}
