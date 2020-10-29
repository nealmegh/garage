<?php

namespace App\Http\Controllers;

use App\CustomerDetail;
use App\Driver;
use App\Incident;
use App\InventoryTransaction;
use App\Loan;
use App\SalesDetail;
use App\Supplier;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'Dashboard - Transaction';
        $debit = Transaction::where('type', 'Debit')->get();
        $totalDebit = $debit->sum('amount');
        $credit = $debits = Transaction::where('type', 'Credit')->get();
        $totalCredit = $credit->sum('amount');
        $total_amount = $totalDebit - $totalCredit;
        $transactions = Transaction::all();
        $customers = CustomerDetail::all();
        $suppliers = Supplier::all();
        $cases = Incident::where('payment_status', 0)->get();

        $drivers = Driver::all();
//        dd($drivers[0]->cases->sum('due_amount'));
        return view('backend.transactions.index')->with(compact('drivers', 'totalDebit', 'totalCredit', 'total_amount', 'transactions', 'customers', 'suppliers', 'cases','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $user = Auth()->user();
        $request->request->add(['user_id' => $user->id]);
        $now = Carbon::today()->format('Y-m-d');
        $request->request->add(['transaction_date' => $now]);

        if($request->payment_for == 'loan')
        {
//            dd($request->all());
            $request->request->add(['due_amount' => $request->amount]);
            $request->request->add(['status' => 'notPaid']);
            $loan = Loan::create($request->only('amount', 'due_amount', 'status', 'driver_id'));

            $request->request->add(['loan_id' => $loan->id]);
            $transaction = Transaction::create($request->request->all());
        }
        elseif($request->payment_for == 'loanPayment')
        {
            $amount = $request->amount;
            $driver = Driver::find($request->driver_id);
            $loanTrans = array();
                foreach($driver->loans as $loan)
                {
                    if($loan->due_amount > 0)
                    {
                        $amount = $amount - $loan->due_amount;
                        if($amount > 0)
                        {
                            $loanTrans = array($loan->id => $loan->due_amount);
                            $loan->due_amount = 0;
                            $loan->save();
                        }
                        else{
                            $loanTrans = array($loan->id => $request->amount);
                            $loan->due_amount = $loan->due_amount - $request->amount;
                            $loan->save();
                            break;
                        }
                    }
                }

            foreach($loanTrans as $key => $loanTran)
            {
                $request->request->add(['loan_id' => $key]);
                $request->request->add(['amount' => $loanTran]);
                $transaction = Transaction::create($request->request->all());
            }
        }
        elseif($request->payment_for == 'addDamage')
        {
            $driver_id = substr($request->driver_id, 2);

            $request->request->add(['driver_id' => $driver_id]);
            $driver = Driver::find($request->driver_id);

            $payment = $request->amount;
            foreach ($driver->damages as $damage)
            {
                if($payment <= $damage->driver_due_amount)
                {
                    $damage->driver_due_amount = $damage->driver_due_amount - $payment;
                    $damage->driver_paid_amount = $payment;
                    if($damage->driver_due_amount == 0)
                    {
                        $damage->status = 'Paid';
                    }
                    elseif ($damage->driver_due_amount > 0 && $damage->driver_paid_amount > 0)
                    {
                        $damage->status = 'parPaid';
                    }
                    else
                    {
                        $damage->status = 'notPaid';
                    }
                    $damage->save();
                    break;
                }
                else
                {
                    $damage->driver_paid_amount = $damage->driver_paid_amount + $damage->driver_due_amount;
                    $payment = $payment - $damage->driver_due_amount;
                    $damage->driver_due_amount =  0;
                    if($damage->driver_due_amount == 0)
                    {
                        $damage->status = 'Paid';
                    }
                    elseif ($damage->driver_due_amount > 0 && $damage->driver_paid_amount > 0)
                    {
                        $damage->status = 'parPaid';
                    }
                    else
                    {
                        $damage->status = 'notPaid';
                    }
                    $damage->save();

                }
            }
            $transaction = Transaction::create($request->request->all());

        }
        elseif($request->payment_for == 'collectCase')
        {
            $driver_id = substr($request->cDriver_id, 3);
            $request->request->add(['driver_id' => $driver_id]);
            $driver = Driver::find($request->driver_id);
            $payment = $request->amount;
            foreach ($driver->cases as $case)
            {
                if($payment <= $case->due_amount)
                {
                    $case->due_amount = $case->due_amount - $payment;
                    $case->save();
                    break;
                }
                else
                {
                    $payment = $payment - $case->due_amount;
                    $case->due_amount =  0;
                    $case->save();

                }
            }
            $transaction = Transaction::create($request->request->all());

        }
        elseif($request->payment_for == 'casePayment')
        {
            $case_id = substr($request->case_id, 3);
            $request->request->add(['case_id' => $case_id]);
            $case = Incident::find($request->case_id);
            $case->payment_status = 1;
            $case->save();
            $request->request->add(['amount' => $case->penalty]);
            $transaction = Transaction::create($request->request->all());

        }
        elseif($request->payment_for == 'collectCase')
        {
            $driver_id = substr($request->driver_id, 3);
            $request->request->add(['driver_id' => $driver_id]);
            $driver = Driver::find($request->driver_id);
            $payment = $request->amount;
            foreach ($driver->cases as $case)
            {
                if($payment <= $case->due_amount)
                {
                    $case->due_amount = $case->due_amount - $payment;
                    $case->save();
                    break;
                }
                else
                {
                    $payment = $payment - $case->due_amount;
                    $case->due_amount =  0;
                    $case->save();

                }
            }
            $transaction = Transaction::create($request->request->all());

        }
        elseif($request->payment_for == 'customerCollection')
        {
            $customer_id = substr($request->customer_id, 2);
            $request->request->add(['customer_id' => $customer_id]);

            $customer = CustomerDetail::where('id', $request->customer_id)->first();
            $sale = $customer->sales->last();

             if($request->amount <= $sale->closing_due)
             {
                 $sale->closing_due = $sale->closing_due - $request->amount;
                 $sale->payment = $sale->payment + $request->amount;
                 $sale->save();
                 $customer->due = $customer->due - $request->amount;
                 $customer->save();
                 $inventoryTransaction = InventoryTransaction::where('sales_id', $sale->id)->first();
                 $inventoryTransaction->payment = $sale->payment ;
                 $inventoryTransaction->due = $sale->closing_due ;
                 $inventoryTransaction->balance = $sale->closing_balance ;
                 $inventoryTransaction->save();

             }
             else
             {

                 $payment = $request->amount - $sale->closing_due;
                 $sale->closing_due = 0  ;
                 $sale->payment = $sale->payment + $request->amount;
                 $sale->closing_balance = $payment;
                 $sale->save();
                 $customer->balance = $payment;
                 $customer->due = 0;
                 $customer->save();
                 $inventoryTransaction = InventoryTransaction::where('sales_id', $sale->id)->first();
                 $inventoryTransaction->payment = $sale->payment ;
                 $inventoryTransaction->due = $sale->closing_due ;
                 $inventoryTransaction->balance = $sale->closing_balance ;
                 $inventoryTransaction->save();
             }
            $transaction = Transaction::create($request->request->all());

        }
        elseif($request->payment_for == 'supplierPayment')
        {
            $supplier_id = substr($request->supplier_id, 2);
            $request->request->add(['supplier_id' => $supplier_id]);

            $supplier = Supplier::where('id', $request->supplier_id)->first();

            $purchase = $supplier->purchase->last();
            if($request->amount <= $purchase->closing_due)
            {
                $purchase->closing_due = $purchase->closing_due - $request->amount;
                $purchase->payment = $purchase->payment + $request->amount;
                $purchase->save();
                $supplier->due = $supplier->due - $request->amount;
                $supplier->save();
                $inventoryTransaction = InventoryTransaction::where('purchase_id', $purchase->id)->first();
                $inventoryTransaction->payment = $purchase->payment ;
                $inventoryTransaction->due = $purchase->closing_due ;
                $inventoryTransaction->balance = $purchase->closing_balance ;
                $inventoryTransaction->save();

            }
            else
            {

                $payment = $request->amount - $purchase->closing_due;
                $purchase->closing_due = 0  ;
                $purchase->payment = $purchase->payment + $request->amount;
                $purchase->closing_balance = $payment;
                $purchase->save();
                $supplier->balance = $payment;
                $supplier->due = 0;
                $supplier->save();
                $inventoryTransaction = InventoryTransaction::where('purchase_id', $purchase->id)->first();
                $inventoryTransaction->payment = $purchase->payment ;
                $inventoryTransaction->due = $purchase->closing_due ;
                $inventoryTransaction->balance = $purchase->closing_balance ;
                $inventoryTransaction->save();
            }

            $transaction = Transaction::create($request->request->all());

        }
        else
        {
            Transaction::create($request->request->all());
        }
        return redirect('transactions')->with('message', 'Transaction Success');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
