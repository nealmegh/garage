<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Exports\DebitCreditExport;
use App\Exports\DriverAllExport;
use App\Exports\DriverFinanceExport;
use App\Exports\DriverRentExport;
use App\Exports\PurchaseDateExport;
use App\Exports\SalesAllExport;
use App\Exports\SalesDateExport;
use App\Exports\StockDetailsExport;
use App\Exports\TransactionExport;
use App\Exports\VehicleAllExport;
use App\Exports\VehicleDetailExport;
use App\Exports\VehicleExport;
use App\Exports\VehicleMaintainExport;
use App\PurchaseDetail;
use App\SalesDetail;
use App\StockDetail;
use App\Transaction;
use App\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class ReportController extends Controller
{
    public function index()
    {

//

        $title = 'Dashboard - Reports';
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        return view('backend.report.index')->with(compact('title', 'vehicles', 'drivers'));
    }
    public function vehicleRent(Request $request)
    {

        $rr = $request->vehicle_rent;
        $from = substr($rr, 0,10);
        $to =  substr($rr, -10, 10);
        $vehicle = Vehicle::find($request->rent_vehicle_id);

        $rents = $vehicle->rents()->where('rent_date' , '>=', $from)->where('rent_date', '<=', $to)->get();
        $rentsOnDay = $rents->groupBy('rent_date');
//        dd($rentsOnDay);
        $date_from = strtotime($from); // Convert date to a UNIX timestamp
        $date_to = strtotime($to); // Convert date to a UNIX timestamp

        $maintenance_total = 0;
        $damage_total = 0;
        $case_total = 0;
        $collection_total =0;
// Loop from the start date to end date and output all dates inbetween
        for ($i=$date_from; $i<=$date_to; $i+=86400) {
            $date_this = gmdate("Y-m-d", $i);

            $data[$i]['date'] = $date_this;
            $data[$i]['Driver'] = '';
            $data[$i]['collection'] = '';
            $data[$i]['collection_day'] = '';
            $data[$i]['Due'] = '';
            $data[$i]['Due_day'] = '';
            $data[$i]['Damage'] = '';
            $data[$i]['Case'] = '';
            $data[$i]['Case_Amount'] = '';
            $data[$i]['Case_PaymentBy'] = '';
            $data[$i]['Maintenance'] = '';
            $dateObj = Carbon::parse($date_this);
            $dateObj2 = Carbon::parse($date_this)->addDay(1);
            $maintenance = $vehicle->sales->where('created_at', '>', $dateObj)->where('created_at', '<', $dateObj2);
            $maintenance_total += $maintenance->sum('sales_total');
            if(array_key_exists($date_this, $rentsOnDay->toArray()))
            {
                foreach ($rentsOnDay as $key => $rentOnDay)
                {

                    if($key == $date_this)
                    {
                        foreach ($rentOnDay as $rent)
                        {
                            $collection_total += $rent->amount_collected;
//                        dd($rent->driver->user->name);
                            $data[$i]['Driver'] .= $rent->driver->user->name.' ,';
                            $data[$i]['collection'] .= number_format($rent->amount_collected, 2).' ,';
                            $data[$i]['collection_day'] = number_format($rentOnDay->sum('amount_collected'), 2);
                            $data[$i]['Due'] .= number_format($rent->amount_remained, 2).' ,';
                            $data[$i]['Due_day'] = number_format($rentOnDay->sum('amount_remained'), 2);
                            $data[$i]['Damage'] .= ($rent->damage != null)?number_format($rent->damage->amount, 2).' ,':'-';
                            ($rent->damage != null)?$damage_total += $rent->damage->amount:$damage_total;
                            $data[$i]['Case'] .= ($rent->case != null)?$rent->case->case_id.' ,':'-';
                            $data[$i]['Case_Amount'] .= ($rent->case != null)?number_format($rent->case->penalty, 2).' ,':'-';
                            ($rent->case != null)?$case_total += $rent->case->penalty:$case_total;
                            $data[$i]['Case_PaymentBy'] .= ($rent->case != null)?$rent->case->paid_by.' ,':'-';
                            $data[$i]['Maintenance'] = number_format($maintenance->sum('sales_total'), 2);
                        }
                    }


                }

            }
            else{
                $data[$i]['Driver'] = '-';
                $data[$i]['collection'] = '-';
                $data[$i]['collection_day'] = '-';
                $data[$i]['Due'] = '-';
                $data[$i]['Due_day'] = '-';
                $data[$i]['Damage'] = '-';
                $data[$i]['Case'] = '-';
                $data[$i]['Case_Amount'] = '-';
                $data[$i]['Case_PaymentBy'] = '-';
                $data[$i]['Maintenance'] = number_format($maintenance->sum('sales_total'), 2);
            }


        }
        $data[$i+1]['date'] = '';
        $data[$i+1]['Driver'] = '';
        $data[$i+1]['collection'] = 'Total';
        $data[$i+1]['collection_day'] = number_format($collection_total, 2);
        $data[$i+1]['Due'] = '';
        $data[$i+1]['Due_day'] = '';
        $data[$i+1]['Damage'] = number_format($damage_total, 2);
        $data[$i+1]['Case'] = '-';
        $data[$i+1]['Case_Amount'] = number_format($case_total, 2);
        $data[$i+1]['Case_PaymentBy'] = '-';
        $data[$i+1]['Maintenance'] = number_format($maintenance_total, 2);
//dd($data);
        return Excel::download(new VehicleExport($data), 'vehicle '.$vehicle->registration_number.' Report From '.$from.' To '.$to.'.xlsx');

    }
    public function vehicleMaintenance(Request $request)
    {

        $rr = $request->vehicle_maintenance;
        $from = substr($rr, 0,10);
        $from_date = Carbon::parse($from);
        $to =  substr($rr, -10, 10);
        $to_date = Carbon::parse($to)->addDay(1);
        $vehicle = Vehicle::find($request->maintenance_vehicle_id);
        $sales = $vehicle->sales()->where('created_at' , '>=', $from_date)->where('created_at', '<=', $to_date)->get();

        $date_from = strtotime($from); // Convert date to a UNIX timestamp
        $date_to = strtotime($to); // Convert date to a UNIX timestamp
        $total_cost = 0;
        for ($i=$date_from; $i<=$date_to; $i+=86400) {
            $date_this = gmdate("Y-m-d", $i);
            $data[$i]['date'] = $date_this;
            $dateObj = Carbon::parse($date_this);
            $dateObj2 = Carbon::parse($date_this)->addDay(1);

            $daySales = $sales->where('created_at', '>', $dateObj)->where('created_at', '<', $dateObj2);

            $data[$i]['Cost'] = number_format($daySales->sum('sales_total'),2);
            $total_cost +=  $daySales->sum('sales_total');
            $data[$i]['Product'] = '';

            foreach ($daySales as $sale)
            {
                foreach ($sale->productList as $productList)
                {

                    $data[$i]['Product'] .= $productList->stock->stock_name.':'.$productList->sales_quantity.', ';

                }

            }
            $data[$i]['Product'] = substr($data[$i]['Product'], 0,-2);

        }
        $data[$i+1]['date'] = 'Total Cost';
        $data[$i+1]['cost'] = number_format($total_cost,2);
        return Excel::download(new VehicleMaintainExport($data), 'vehicle '.$vehicle->registration_number.' Maintenance Report From '.$from.' To '.$to.'.xlsx');
    }

    public function vehicleDetails(Request $request)
    {
        $vehicle = Vehicle::find($request->detail_vehicle_id);
        return Excel::download(new VehicleDetailExport($vehicle->id), 'vehicle Details '.$vehicle->registration_number.'.xlsx');
    }
    public function vehicleAll()
    {
        $vehicles = Vehicle::all();
        return Excel::download(new VehicleAllExport($vehicles), 'vehicles.xlsx');
    }
    public function driverAll()
    {
        $drivers = Driver::all();
        return Excel::download(new DriverAllExport($drivers), 'drivers.xlsx');
    }
    public function salesAll()
    {
        $sales = SalesDetail::where('vehicle_id', '=', null)->get();
        return Excel::download(new SalesAllExport($sales), 'sales.xlsx');
    }
    public function driverRents(Request $request)
    {
        $rr = $request->driver_rent_report;
        $from = substr($rr, 0,10);
        $from_date = Carbon::parse($from);
        $to =  substr($rr, -10, 10);
        $to_date = Carbon::parse($to)->addDay(1);
        $driver = Driver::find($request->rent_driver_id);
        $rents = $driver->rents()->where('rent_date' , '>=', $from)->where('rent_date', '<=', $to)->get();
        $rentsOnDay = $rents->groupBy('rent_date');

        $rent_total = 0;
        $damage_total = 0;
        $case_total = 0;
        $loan_total = 0;

        $date_from = strtotime($from); // Convert date to a UNIX timestamp
        $date_to = strtotime($to); // Convert date to a UNIX timestamp


        for ($i=$date_from; $i<=$date_to; $i+=86400) {
            $date_this = gmdate("Y-m-d", $i);
            $data[$i]['date'] = $date_this;
            $dateObj = Carbon::parse($date_this);
            $dateObj2 = Carbon::parse($date_this)->addDay(1);

            $data[$i]['Vehicle'] = '';
            $data[$i]['collection'] = '';
            $data[$i]['collection_day'] = '';
            $data[$i]['Due'] = '';
            $data[$i]['Due_day'] = '';
            $data[$i]['Damage'] = '';
            $data[$i]['Case'] = '';
            $data[$i]['Case_Amount'] = '';
            $data[$i]['Case_PaymentBy'] = '';
            $data[$i]['loan'] = '';
            $loan = $driver->loans->where('created_at', '>', $dateObj)->where('created_at', '<', $dateObj2);
            $loan_total += $loan->sum('amount');

            if(array_key_exists($date_this, $rentsOnDay->toArray()))
            {
                foreach ($rentsOnDay as $key => $rentOnDay)
                {

                    if($key == $date_this)
                    {
                        foreach ($rentOnDay as $rent)
                        {
                            $rent_total += $rent->amount_collected;

                            $data[$i]['Vehicle'] .= $rent->vehicle->registration_number.', ';
                            $data[$i]['collection'] .= number_format($rent->amount_collected, 2).', ';
                            $data[$i]['collection_day'] = number_format($rentOnDay->sum('amount_collected'), 2);
                            $data[$i]['Due'] .= number_format($rent->amount_remained, 2).' ,';
                            $data[$i]['Due_day'] = number_format($rentOnDay->sum('amount_remained'), 2);
                            $data[$i]['Damage'] .= ($rent->damage != null)?number_format($rent->damage->amount, 2).', ':'-';
                            ($rent->damage != null)?$damage_total += $rent->damage->amount:$damage_total;
                            $data[$i]['Case'] .= ($rent->case != null)?$rent->case->case_id.', ':'-';
                            $data[$i]['Case_Amount'] .= ($rent->case != null)?number_format($rent->case->penalty, 2).', ':'-';
                            ($rent->case != null)?$case_total += $rent->case->penalty:$case_total;
                            $data[$i]['Case_PaymentBy'] .= ($rent->case != null)?$rent->case->paid_by.', ':'-';
                            $data[$i]['loan'] = number_format($loan->sum('amount'), 2);
                        }
                    }


                }

            }
            else{
                $data[$i]['Vehicle'] = '-';
                $data[$i]['collection'] = '-';
                $data[$i]['collection_day'] = '-';
                $data[$i]['Due'] = '-';
                $data[$i]['Due_day'] = '-';
                $data[$i]['Damage'] = '-';
                $data[$i]['Case'] = '-';
                $data[$i]['Case_Amount'] = '-';
                $data[$i]['Case_PaymentBy'] = '-';
                $data[$i]['loan'] = number_format($loan->sum('amount'), 2);
            }


        }
        $data[$i+1]['date'] = '';
        $data[$i+1]['Vehicle'] = '';
        $data[$i+1]['collection'] = 'Total';
        $data[$i+1]['collection_day'] = number_format($rent_total, 2);
        $data[$i+1]['Due'] = '';
        $data[$i+1]['Due_day'] = '';
        $data[$i+1]['Damage'] = number_format($damage_total, 2);
        $data[$i+1]['Case'] = '';
        $data[$i+1]['Case_Amount'] = number_format($case_total, 2);
        $data[$i+1]['Case_PaymentBy'] = '-';
        $data[$i+1]['loan'] = number_format($loan_total, 2);

        return Excel::download(new DriverRentExport($data), 'Driver '.$driver->user->name.' Report From '.$from.' To '.$to.'.xlsx');
    }

    public function driverFinance(Request $request)
    {
        $rr = $request->driver_finance_report;
        $from = substr($rr, 0,10);
        $from_date = Carbon::parse($from);
        $to =  substr($rr, -10, 10);
        $to_date = Carbon::parse($to)->addDay(1);
        $driver = Driver::find($request->finance_driver_id);
        $transactions = $driver->transactions()->where('created_at' , '>=', $from_date)->where('created_at', '<=', $to_date)->get();

        $rent_total = 0;
        $damage_total = 0;
        $case_total = 0;
        $loan_total = 0;
        $loanPayment_total = 0;

        $date_from = strtotime($from); // Convert date to a UNIX timestamp
        $date_to = strtotime($to); // Convert date to a UNIX timestamp


        for ($i=$date_from; $i<=$date_to; $i+=86400) {
            $date_this = gmdate("Y-m-d", $i);
            $data[$i]['date'] = $date_this;
            $data[$i]['id'] = '';
            $data[$i]['rent'] = 0;
            $data[$i]['loan'] = 0;
            $data[$i]['loan_payment'] = 0;
            $data[$i]['damage_payment'] = 0;
            $data[$i]['case_payment'] = 0;
            $dateObj = Carbon::parse($date_this);
            $dateObj2 = Carbon::parse($date_this)->addDay(1);

            foreach ($transactions as $transaction)
            {
                if($transaction->created_at >= $dateObj && $transaction->created_at < $dateObj2) {

                    $data[$i]['id'] .= $transaction->id.', ';
                    $data[$i]['rent'] += 0;
                    $data[$i]['loan'] += 0;
                    $data[$i]['loan_payment'] += 0;
                    $data[$i]['damage_payment'] += 0;
                    $data[$i]['case_payment'] += 0;
                    if ($transaction->payment_for == 'rent') {
                        $data[$i]['rent'] += $transaction->amount;
                        $rent_total += $transaction->amount;
                    }
                    if ($transaction->payment_for == 'loan') {

                        $data[$i]['loan'] += $transaction->amount;
                        $loan_total += $transaction->amount;
                    }
                    if ($transaction->payment_for == 'loanPayment') {

                        $data[$i]['loan_payment'] += $transaction->amount;
                        $loanPayment_total += $transaction->amount;
                    }
                    if ($transaction->payment_for == 'addDamage') {

                        $data[$i]['damage_payment'] += $transaction->amount;

                        $damage_total += $transaction->amount;
                    }
                    if ($transaction->payment_for == 'collectCase') {
                        $data[$i]['case_payment'] += $transaction->amount;
                        $case_total += $transaction->amount;
                    }
                }

            }
        }
        $data[$i+1]['date'] = '';
        $data[$i+1]['id'] = 'Total';
        $data[$i+1]['rent'] = number_format($rent_total, 2);
        $data[$i+1]['loan'] = number_format($loan_total,2);
        $data[$i+1]['loan_payment'] = number_format($loanPayment_total, 2);
        $data[$i+1]['damage_payment'] = number_format($damage_total, 2);
        $data[$i+1]['case_payment'] = number_format($case_total, 2);

        return Excel::download(new DriverFinanceExport($data), 'Driver '.$driver->user->name.' Report From '.$from.' To '.$to.'.xlsx');

    }
    public function driverDetail(Request $request)
    {
        $driver = Driver::find($request->detail_driver_id);
        return Excel::download(new VehicleDetailExport($driver->id), 'Driver Details '.$driver->user->name.'.xlsx');
    }

    public function inventorySales(Request $request)
    {
        $rr = $request->sales_report;
        $from = substr($rr, 0,10);
        $from_date = Carbon::parse($from);
        $to =  substr($rr, -10, 10);
        $to_date = Carbon::parse($to)->addDay(1);

        $sales = SalesDetail::where('vehicle_id', null)->whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->get();


        $salesOnDays =   $sales->groupBy('sales_date');
        $date_from = strtotime($from); // Convert date to a UNIX timestamp
        $date_to = strtotime($to); // Convert date to a UNIX timestamp
        for ($i=$date_from; $i<=$date_to; $i+=86400) {
            $date_this = gmdate("Y-m-d", $i);
            $data[$i]['date'] = $date_this;
            $data[$i]['sales_id'] = '';
            $data[$i]['customer_id'] = '';
            $data[$i]['Customer_Name'] = '';
            $data[$i]['opening_due'] = '';
            $data[$i]['Sales_Total'] = '';
            $data[$i]['grand_total'] = '';
            $data[$i]['Payment'] = '';
            $data[$i]['Customer_Closing_Due'] = '';

            if(array_key_exists($date_this, $salesOnDays->toArray()))
            {
                foreach ($salesOnDays[$date_this] as $salesOnDay)
                {
                    $i += 1;
                    $data[$i]['date'] = '';
                    $data[$i]['sales_id'] = $salesOnDay->id;
                    $data[$i]['customer_id'] = $salesOnDay->customer_id;
                    $data[$i]['Customer_Name'] = $salesOnDay->customer_name;
                    $data[$i]['opening_due'] = $salesOnDay->opening_due;
                    $data[$i]['Sales_Total'] = $salesOnDay->sales_total;
                    $data[$i]['grand_total'] = $salesOnDay->grand_total;
                    $data[$i]['Payment'] = $salesOnDay->payment;
                    $data[$i]['Customer_Closing_Due'] = $salesOnDay->closing_due;
                }
                $i -= count($salesOnDays[$date_this]);
            }
        }

        return Excel::download(new SalesDateExport($data), 'Sales Details '.$from.' To '.$to.'.xlsx');
    }
    public function inventoryPurchase(Request $request)
    {
        $rr = $request->purchase_report;
        $from = substr($rr, 0,10);
        $from_date = Carbon::parse($from);
        $to =  substr($rr, -10, 10);
        $to_date = Carbon::parse($to)->addDay(1);

        $purchase = PurchaseDetail::whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->get();


        $purchasesOnDays =   $purchase->groupBy('purchase_date');
        $date_from = strtotime($from); // Convert date to a UNIX timestamp
        $date_to = strtotime($to); // Convert date to a UNIX timestamp
        for ($i=$date_from; $i<=$date_to; $i+=86400) {
            $date_this = gmdate("Y-m-d", $i);
            $data[$i]['date'] = $date_this;
            $data[$i]['purchase_id'] = '';
            $data[$i]['supplier_id'] = '';
            $data[$i]['supplier_Name'] = '';
            $data[$i]['opening_due'] = '';
            $data[$i]['purchase_Total'] = '';
            $data[$i]['grand_total'] = '';
            $data[$i]['Payment'] = '';
            $data[$i]['supplier_Closing_Due'] = '';

            if(array_key_exists($date_this, $purchasesOnDays->toArray()))
            {
                foreach ($purchasesOnDays[$date_this] as $purchaseOnDay)
                {
                    $i += 1;
                    $data[$i]['date'] = '';
                    $data[$i]['purchase_id'] = $purchaseOnDay->id;
                    $data[$i]['supplier_id'] = $purchaseOnDay->supplier_id;
                    $data[$i]['supplier_Name'] = $purchaseOnDay->supplier_name;
                    $data[$i]['opening_due'] = $purchaseOnDay->opening_due;
                    $data[$i]['purchase_Total'] = $purchaseOnDay->purchase_total;
                    $data[$i]['grand_total'] = $purchaseOnDay->grand_total;
                    $data[$i]['Payment'] = $purchaseOnDay->payment;
                    $data[$i]['supplier_Closing_Due'] = $purchaseOnDay->closing_due;
                }
                $i -= count($purchasesOnDays[$date_this]);
            }
        }

        return Excel::download(new PurchaseDateExport($data), 'Purchase Details '.$from.' To '.$to.'.xlsx');
    }

    public function inventoryStock()
    {
        $today = Carbon::today();
        $stocks = StockDetail::all();

        $data = [];
        $i= 0;
            foreach ($stocks as $stock)
            {
                $data[$i+1]['key'] = $stock->category_name;
                $data[$i+1]['stock_name'] = $stock->stock_name;
                $data[$i+1]['stock_quantity'] = $stock->stock_quantity;
                $data[$i+1]['purchase_cost'] = $stock->purchase_cost;
                $data[$i+1]['selling_cost'] = $stock->selling_cost;
                $data[$i+1]['supplier_name'] = $stock->supplier_name;
                $i += 50000;
            }

        return Excel::download(new StockDetailsExport($data), 'Stock Details '.$today.'.xlsx');
    }

    public function transactionDebit(Request $request)
    {

        if($request->type == 'Debit')
        {

            $rr = $request->transaction_debit_report;
        }
        else
        {

            $rr = $request->transaction_credit_report;
        }

        $from = substr($rr, 0,10);
        $from_date = Carbon::parse($from);
        $to =  substr($rr, -10, 10);
        $to_date = Carbon::parse($to)->addDay(1);
        $date_from = strtotime($from); // Convert date to a UNIX timestamp
        $date_to = strtotime($to); // Convert date to a UNIX timestamp
        $total_amount = 0;
        if($request->debit_for == 'all')
        {
            $transactions = Transaction::where('type', $request->type)->whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->get();
        }
        else{
            $transactions = Transaction::where('type', $request->type)->where('payment_for', $request->debit_for)->whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->get();
        }
        $transactionsOnDays = $transactions->groupBy('transaction_date');
        for ($i=$date_from; $i<=$date_to; $i+=86400) {
            $date_this = gmdate("Y-m-d", $i);
            $data[$i]['date'] = $date_this;
            $data[$i]['transaction_id'] = '';
            $data[$i]['payment_for'] = '';
            $data[$i]['amount'] = '';
            $data[$i]['notes'] = '';

            if(array_key_exists($date_this, $transactionsOnDays->toArray()))
            {
                foreach ($transactionsOnDays[$date_this] as $transactionOnDay)
                {
                    $i += 1;
                    $data[$i]['date'] = '';
                    $data[$i]['transaction_id'] = $transactionOnDay->id;
                    $data[$i]['payment_for'] = $transactionOnDay->payment_for;
                    $data[$i]['amount'] = $transactionOnDay->amount;
                    $total_amount += $transactionOnDay->amount;
                    $data[$i]['notes'] = $transactionOnDay->notes;

                }
                $i -= count($transactionsOnDays[$date_this]);
            }
        }
        $data[$i+1]['date'] = '';
        $data[$i+1]['transaction_id'] = '';
        $data[$i+1]['payment_for'] = 'Total';
        $data[$i+1]['amount'] = $total_amount;
        $data[$i+1]['notes'] = '';

        return Excel::download(new TransactionExport($data), $request->type.' '.$request->debit_for.' Transaction Export From'.$from.' To '.$to.'.xlsx');
    }

    public function transactionAll(Request $request)
    {
        $rr = $request->transaction_report;
        $from = substr($rr, 0,10);
        $total_debit = 0;
        $total_credit = 0;
        $from_date = Carbon::parse($from);
        $to =  substr($rr, -10, 10);
        $to_date = Carbon::parse($to)->addDay(1);
        $date_from = strtotime($from); // Convert date to a UNIX timestamp
        $date_to = strtotime($to); // Convert date to a UNIX timestamp
        $total_amount = 0;
        $transactions = Transaction::whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->get();
        $transactionsOnDays = $transactions->groupBy('transaction_date');
        for ($i=$date_from; $i<=$date_to; $i+=86400) {
            $date_this = gmdate("Y-m-d", $i);
            $data[$i]['date'] = $date_this;
            $data[$i]['debit'] = '';
            $data[$i]['credit'] = '';
            $data[$i]['payment_for'] = '';
            $data[$i]['notes'] = '';

            if(array_key_exists($date_this, $transactionsOnDays->toArray()))
            {
                foreach ($transactionsOnDays[$date_this] as $transactionOnDay)
                {
                    $i += 1;
                    $data[$i]['date'] = '';
                    if($transactionOnDay->type == 'Debit')
                    {
                        $data[$i]['debit'] = $transactionOnDay->amount;
                        $data[$i]['credit'] = '';
                        $total_debit += $transactionOnDay->amount;
                    }
                    else
                    {
                        $data[$i]['debit'] = '';
                        $data[$i]['credit'] = $transactionOnDay->amount;
                        $total_credit += $transactionOnDay->amount;
                    }
                    $data[$i]['payment_for'] = $transactionOnDay->payment_for;
                    $data[$i]['notes'] = $transactionOnDay->notes;

                }
                $i -= count($transactionsOnDays[$date_this]);
            }
        }
        $data[$i+1]['date'] = '';
        $data[$i+1]['debit'] = $total_debit;
        $data[$i+1]['credit'] = $total_credit;
        $data[$i+1]['payment_for'] = $total_debit - $total_credit;
        $data[$i+1]['notes'] = '';

        return Excel::download(new DebitCreditExport($data), 'Debit Vs Credit Export From'.$from.' To '.$to.'.xlsx');
    }
}
