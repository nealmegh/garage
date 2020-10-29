<?php

namespace App\Http\Controllers;

use App\Category;
use App\StockUnitsDetail;
use App\StockDetail;
use App\Supplier;
use Illuminate\Http\Request;
use PHPUnit\Exception;
use function GuzzleHttp\Promise\all;

class StockDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'Dashboard - Stock';
        $stocks = StockDetail::all();
        return view('stock.index')->with(compact('stocks','title'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $title = 'Dashboard - Stock';
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('stock.create')->with(compact('categories', 'suppliers','title'));
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

            $stock = StockDetail::create($request->except('unit_type'));

            $request->request->add(['stock_id' => $stock->id]);
            StockUnitsDetail::create($request->only('category_id', 'stock_id', 'unit_type'));

            $messageType = 1;
            $message = "Stock created successfully !";

        } catch(\Illuminate\Database\QueryException $ex){
            $messageType = 2;
            $message = "Stock creation failed !";
        }
        return redirect(route('stock.index'))->with('messageType',$messageType)->with('message',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StockDetail  $stockDetail
     * @return \Illuminate\Http\Response
     */
    public function show(StockDetail $stockDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StockDetail  $stockDetail
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($stockDetail)
    {
        $title = 'Dashboard - Stock';
        $stockDetail = StockDetail::find($stockDetail);
        $suppliers = Supplier::all();
        return view('stock.edit')->with(compact('stockDetail', 'suppliers','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
 * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update(Request $request, $stockDetail)
    {
        $stockDetail = StockDetail::find($stockDetail);
        $stockDetail->update($request->except('_token', 'unit_type'));
        $messageType = 1;
        $message = "Stock Updated successfully !";
        return redirect()->route('stock.index')->with('messageType',$messageType)->with('message',$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StockDetail  $stockDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockDetail $stockDetail)
    {
        //
    }

    public function category_name(Request $request){

        $term = $request['term'];

        $results = array();

        $queries = Category::where('category_name', 'LIKE', '%'.$term.'%')->take(5)->get();

        foreach ($queries as $key => $value)
        {
            $queries[$key]['value'] = $value->category_name;
        }

        return \Response::json($queries);
    }

}
