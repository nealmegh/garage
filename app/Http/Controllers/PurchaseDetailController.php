<?php

namespace App\Http\Controllers;

use App\Category;
use App\InventoryTransaction;
use App\PurchaseDetail;
use App\PurchaseProductList;
use App\StockDetail;
use App\Supplier;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $title = 'Dashboard - Purchase';
        $purchases = PurchaseDetail::orderBy('id', 'desc')->get();
        return view('purchase.index')->with(compact('purchases','title'));
    }

    public function view()
    {
        $title = 'Dashboard - Purchase';
        return view('purchase.view')->with(compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {

        $title = 'Dashboard - Purchase';
        return view('purchase.create')->with(compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

        $data = $request->all();

        $purchase_product = array();
        $now = Carbon::today()->format('Y-m-d');

        $request->request->add(['purchase_date' => $now]);
        unset($request['category_name'],$request['category_id'],$request['stock_id'],$request['purchase_cost'],$request['selling_cost'],$request['opening_stock'],$request['closing_stock'],$request['purchase_quantity'],$request['sub_total']);

        $PurchaseDetail = PurchaseDetail::create($request->all());

        foreach ($data['stock_id'] as $key => $value) {

            $purchase_product[$key]['purchase_id'] = $PurchaseDetail->id;
            $purchase_product[$key]['stock_id'] = $value;
            $purchase_product[$key]['category_name'] = $data['category_name'][$key];
            $purchase_product[$key]['category_id'] = $data['category_id'][$key];
            $purchase_product[$key]['purchase_cost'] = $data['purchase_cost'][$key];
            $purchase_product[$key]['opening_stock'] = $data['opening_stock'][$key];
            $purchase_product[$key]['closing_stock'] = $data['closing_stock'][$key];
            $purchase_product[$key]['purchase_quantity'] = $data['purchase_quantity'][$key];
            $purchase_product[$key]['sub_total'] = $data['sub_total'][$key];
        }

        $SalesProduct = PurchaseProductList::insert($purchase_product);

        foreach ($purchase_product as $key => $value) {

            StockDetail::where('id',$value['stock_id'])->update(['stock_quantity'=>$value['closing_stock']]);
        }

        $SupplierDetail =  Supplier::where('id',$request['supplier_id'])
            ->update([
                'balance'=>$request['closing_balance'],
                'due'=>$request['closing_due']
            ]);
        $MainTransTime = Carbon::today()->format('Y-m-d');

        $transactionMain = [
            'amount' => $PurchaseDetail->payment,
            'type' => 'Credit',
            'method' => 'cash',
            'payment_for' => 'purchase',
            'user_id' => Auth::user()->id,
            'purchasedetail_id' => $PurchaseDetail->id,
            'transaction_date' => $MainTransTime,
        ];
        $transaction = Transaction::create($transactionMain);

        $transaction_details = [
            'type' => 1,
            'purchase_id'=>$PurchaseDetail->id,
            'supplier_id'=>$PurchaseDetail->supplier_id,
            'subtotal'=>$PurchaseDetail->grand_total,

            'payment'=>$PurchaseDetail->payment,
            'balance'=>$PurchaseDetail->closing_balance,
            'due'=>$PurchaseDetail->closing_due,
            'mode'=>$PurchaseDetail->mode,
            'transaction_id' => $transaction->id
        ];

        $inventoryTransaction = InventoryTransaction::create($transaction_details);
        $transaction->inventorytransaction_id = $inventoryTransaction->id;
        $transaction->save();

        $messageType = 1;
        $message = "Purchase created successfully !";


        } catch(\Illuminate\Database\QueryException $ex){
            $messageType = 2;
            $message = "Purchase creation failed !";
        }

        return redirect(route('purchase.index'))->with('messageType',$messageType)->with('message',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('N\A');
        $purchase_details = PurchaseDetail::find($id);

        $category_details = Category::pluck('category_name','id');

        $supplier_details = Supplier::pluck('supplier_name','id');

        return view('purchase.edit')->with('purchase_details',$purchase_details)->with('category_details',$category_details)->with('supplier_details',$supplier_details);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $purchase = \App\PurchaseDetail::find($id);

            $purchase->update($request->all());

            $messageType = 1;
            $message = "Purchase ".$purchase->purchase_name." details updated successfully !";

        } catch(\Illuminate\Database\QueryException $ex){
            $messageType = 2;
            $message = "Purchase updation failed !";
        }

        return redirect(route('purchase.index'))->with('messageType',$messageType)->with('message',$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $purchase = \App\PurchaseDetail::find($id);

            $purchase->delete();

            $messageType = 1;
            $message = "Purchase ".$purchase->purchase_name." details deleted successfully !";

        } catch(\Illuminate\Database\QueryException $ex){
            $messageType = 2;
            $message = "Purchase deletion failed !";
        }

        return redirect(route('purchase.index'))->with('messageType',$messageType)->with('message',$message);
    }


    public function supplier_name(Request $request){

        $term = $request['term'];

        $results = array();

        $queries = Supplier::where('supplier_name', 'LIKE', '%'.$term.'%')->take(5)->get();

        foreach ($queries as $key => $value)
        {
            $queries[$key]['value'] = $value->supplier_name;
        }
//        dd('hi', $queries);
        return \Response::json($queries);
    }

    public function purchase_category_name(Request $request){

        $term = $request['term'];

        $results = array();

        $queries = Category::where('category_name', 'LIKE', '%'.$term.'%')->take(5)->get();

//         dd($queries->toarray());

        $data = array();

        foreach ($queries as $key => $value)
        {
            $data[$key]['id'] = $value->id;
            $data[$key]['value'] = $value->category_name;

            foreach ($value->stocks as $key1 => $val1) {
//dd($val1->stock_name);
//                $data[$key]['stocks'][$val1->stock_id]['dimention'] = null;

//                foreach ($val1->stock_unit as $key2 => $val2) {

                    $data[$key]['stocks'][$val1->id]['purchase_cost'] = $val1->purchase_cost;
                    $data[$key]['stocks'][$val1->id]['selling_cost'] = $val1->selling_cost;
                    $data[$key]['stocks'][$val1->id]['opening_stock'] = $val1->stock_quantity;
                    $data[$key]['stocks'][$val1->id]['title'] = $val1->stock_name;
//                    if($data[$key]['stocks'][$val1->stock_id]['dimention'] == null){
//                        $data[$key]['stocks'][$val1->stock_id]['title'] = $val2->measures->name;
//                        $data[$key]['stocks'][$val1->stock_id]['dimention'] = $val2->value.$val2->uom->symbol;
//                    }
//                    else{
//                        $data[$key]['stocks'][$val1->stock_id]['title'] = $data[$key]['stocks'][$val1->stock_id]['title'].' x '.$val2->measures->name;
//                        $data[$key]['stocks'][$val1->stock_id]['dimention'] = $data[$key]['stocks'][$val1->stock_id]['dimention'].' x '.$val2->value.$val2->uom->symbol;
//                    }

//                }

            }
        }
// dd($data);

        return \Response::json($data);
    }
}
