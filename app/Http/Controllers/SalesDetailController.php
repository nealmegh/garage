<?php

namespace App\Http\Controllers;


use App\CustomerDetail;
use App\InventoryTransaction;
use App\SalesProductList;
use App\SalesDetail;
use App\StockDetail;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'Dashboard - Sales';
        $sales = SalesDetail::all();
        return view('sales.index')->with(compact('sales','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $title = 'Dashboard - Sales';
        return view('sales.create')->with(compact('title'));
    }

    public function customer_name(Request $request){

        $term = $request['term'];

        $results = array();

        $queries = CustomerDetail::where('customer_name', 'LIKE', '%'.$term.'%')->take(5)->get();

        foreach ($queries as $key => $value)
        {
            $queries[$key]['value'] = $value->customer_name;
        }

        return \Response::json($queries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        try {

        $data = $request->all();

        $sales_product = array();
        $now = Carbon::today()->format('Y-m-d');

        $request->request->add(['sales_date' => $now]);
        unset($request['category_name'],$request['category_id'],$request['stock_id'],$request['purchase_cost'],$request['selling_cost'],$request['opening_stock'],$request['closing_stock'],$request['sales_quantity']);

        $SalesDetail = SalesDetail::create($request->except(['category_name', 'category_id', 'stock_id', 'purchase_cost', 'selling_cost', 'opening_stock', 'closing_stock', 'sales_quantity']));

        foreach ($data['stock_id'] as $key => $value) {

            $sales_product[$key]['sales_id'] = $SalesDetail->id;
            $sales_product[$key]['stock_id'] = $value;
            $sales_product[$key]['category_name'] = $data['category_name'][$key];
            $sales_product[$key]['category_id'] = $data['category_id'][$key];
            $sales_product[$key]['purchase_cost'] = $data['purchase_cost'][$key];
            $sales_product[$key]['selling_cost'] = $data['selling_cost'][$key];
            $sales_product[$key]['opening_stock'] = $data['opening_stock'][$key];
            $sales_product[$key]['closing_stock'] = $data['closing_stock'][$key];
            $sales_product[$key]['sales_quantity'] = $data['sales_quantity'][$key];
            $sales_product[$key]['sub_total'] = $data['sub_total'][$key];
        }

        $SalesProduct = SalesProductList::insert($sales_product);
//            dd($SalesProduct);
        foreach ($sales_product as $key => $value) {

            StockDetail::where('id',$value['stock_id'])->update(['stock_quantity'=>$value['closing_stock']]);

        }

        $CustomerDetail = CustomerDetail::where('id',$request['customer_id'])
            ->update([
                'balance'=>$request['closing_balance'],
                'due'=>$request['closing_due']
            ]);
            $MainTransTime = Carbon::today()->format('Y-m-d');
            $transactionMain = [
                'amount' => $SalesDetail->payment,
                'type' => 'Debit',
                'method' => 'cash',
                'payment_for' => 'sales',
                'user_id' => Auth::user()->id,
                'salesdetails_id' => $SalesDetail->id,
                'transaction_date' => $MainTransTime,
            ];
            $transaction = Transaction::create($transactionMain);

        $transaction_details = [
            'type' => 2,
            'sales_id'=>$SalesDetail->id,
            'customer_id'=>$SalesDetail->customer_id,
            'subtotal'=>$SalesDetail->grand_total,

            'payment'=>$SalesDetail->payment,
            'balance'=>$SalesDetail->closing_balance,
            'due'=>$SalesDetail->closing_due,
            'mode'=>$SalesDetail->mode,
            'transaction_id' => $transaction->id
        ];

//        InventoryTransaction::create($transaction_details);

            $inventoryTransaction = InventoryTransaction::create($transaction_details);
            $transaction->inventorytransaction_id = $inventoryTransaction->id;
            $transaction->save();


            $messageType = 1;
            $message = "Sales created successfully !";


        } catch(\Illuminate\Database\QueryException $ex){
            $messageType = 2;
            $message = "Sales creation failed !";
        }

        return redirect(route('sales.index'))->with('messageType',$messageType)->with('message',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SalesDetail  $salesDetail
     * @return \Illuminate\Http\Response
     */
    public function show(SalesDetail $salesDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SalesDetail  $salesDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesDetail $salesDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SalesDetail  $salesDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalesDetail $salesDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SalesDetail  $salesDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesDetail $salesDetail)
    {
        //
    }

    public function vehicle($id)
    {
        $title = 'Dashboard - Vehicle';
        return view('sales.vehicle')->with(compact('id','title'));
    }

    public function vehicleSalesStore(Request $request, $id)
    {

        try {

            $data = $request->all();

            $sales_product = array();

            $request->request->add(['vehicle_id' => $id]);
            $now = Carbon::today()->format('Y-m-d');

            $request->request->add(['sales_date' => $now]);
            unset($request['category_name'],$request['category_id'],$request['stock_id'],$request['purchase_cost'],$request['selling_cost'],$request['opening_stock'],$request['closing_stock'],$request['sales_quantity']);

            $SalesDetail = SalesDetail::create($request->except(['category_name', 'category_id', 'stock_id', 'purchase_cost', 'selling_cost', 'opening_stock', 'closing_stock', 'sales_quantity']));

            foreach ($data['stock_id'] as $key => $value) {

                $sales_product[$key]['sales_id'] = $SalesDetail->id;
                $sales_product[$key]['stock_id'] = $value;
                $sales_product[$key]['category_name'] = $data['category_name'][$key];
                $sales_product[$key]['category_id'] = $data['category_id'][$key];
                $sales_product[$key]['purchase_cost'] = $data['purchase_cost'][$key];
                $sales_product[$key]['selling_cost'] = $data['selling_cost'][$key];
                $sales_product[$key]['opening_stock'] = $data['opening_stock'][$key];
                $sales_product[$key]['closing_stock'] = $data['closing_stock'][$key];
                $sales_product[$key]['sales_quantity'] = $data['sales_quantity'][$key];
                $sales_product[$key]['sub_total'] = $data['sub_total'][$key];
            }

            $SalesProduct = SalesProductList::insert($sales_product);

            foreach ($sales_product as $key => $value) {

                StockDetail::where('id',$value['stock_id'])->update(['stock_quantity'=>$value['closing_stock']]);

            }

            $CustomerDetail = CustomerDetail::where('id',$request['customer_id'])
                ->update([
                    'balance'=>$request['closing_balance'],
                    'due'=>$request['closing_due']
                ]);

//            $transactionMain = [
//                'amount' => $SalesDetail->payment,
//                'type' => 'Debit',
//                'method' => 'cash',
//                'payment_for' => 'sales',
//                'user_id' => Auth::user()->id,
//                'salesdetail_id' => $SalesDetail->id,
//            ];
//            $transaction = Transaction::create($transactionMain);

//            $transaction_details = [
//                'type' => 2,
//                'sales_id'=>$SalesDetail->sales_id,
//                'customer_id'=>$SalesDetail->customer_id,
//                'subtotal'=>$SalesDetail->grand_total,
//
//                'payment'=>$SalesDetail->payment,
//                'balance'=>$SalesDetail->closing_balance,
//                'due'=>$SalesDetail->closing_due,
//                'mode'=>$SalesDetail->mode,
//                'transaction_id' => $transaction->id
//            ];

//        InventoryTransaction::create($transaction_details);

//            $inventoryTransaction = InventoryTransaction::create($transaction_details);
//            $transaction->inventorytransaction_id = $inventoryTransaction->id;
//            $transaction->save();


            $message = "Sales created successfully !";

        } catch(\Illuminate\Database\QueryException $ex){

            $message = "Sales creation failed !";
        }

        return redirect()->route('vehicle.index')->with('message',$message);
    }

}
