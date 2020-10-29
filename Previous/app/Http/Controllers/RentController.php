<?php

namespace App\Http\Controllers;

use App\damage;
use App\Driver;
use App\Incident;
use App\Rent;
use App\Transaction;
use App\Vehicle;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'Dashboard - Rents';
        $rents = Rent::orderBy('id', 'desc')->get();
// foreach($rents as $rent)
// {
//     if($rent->driver == null)
//     {
//         dd($rent);
//     }
// }
        return view('backend.rent.index')->with(compact('rents', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $title = 'Dashboard - Rents';
        $vehicles = Vehicle::where('rent_status', 0)->get();
        $drivers = Driver::where('rent_status', 0)->get();
//        dd($vehicles);
        return view('backend.rent.create')->with(compact('vehicles', 'drivers', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $rentDate = strtotime($request->rent_date);
        $newformat = date('Y-m-d',$rentDate);
        $request->request->add(['rent_date' => $newformat]);
        $request->request->add(['gate_pass' => 20]);
        $rent = 0;
        if($request->rent_type == 3)
        {
            $rent = 1000;
        }
        else
        {
            $rent = 500;
        }
        $request->request->add(['rent' => $rent]);
        $request->request->add(['total_collectable' => $rent + 20]);

        Vehicle::where('id', $request->vehicle_id)->update(['rent_status' => 1]);
        Driver::where('id', $request->driver_id)->update(['rent_status' => 1]);

        Rent::create($request->all());

        return redirect()->route('rent.index');
    }

    public function endTrip(Request $request)
    {

        $rent = Rent::find($request->rent_id);
        $collection = $request->collection;
        $discount = 0;
        if($request->discount != null)
        {
            $discount = $request->discount;
        }


//        $rent->collection = $request->collection;
        if($rent->total_collectable < $collection)
        {
            $rent->collection = $collection;
            $extra = $collection - $rent->total_collectable;
            $driver = Driver::find($rent->driver_id);
            foreach ($driver->rents as $dueRent)
            {
                if($dueRent->due > 0)
                {
                    $extra = $extra - $dueRent->due;
                    if($extra < 0)
                    {
                        $dueRent->due = (-1 * $extra);
                        $dueRent->collection = $dueRent->total_collectable - $dueRent->due;
                        $dueRent->save();
                        break;
                    }
                    else
                    {
                        $dueRent->due = 0;
                        $dueRent->collection = $dueRent->total_collectable;
                        $dueRent->save();
                    }
                }

            }
            if($extra > 0)
            {
                $rent->due = -1 * $extra;
            }
        }
        else
        {
            $rent->discount = $discount;
            $due = ( $rent->total_collectable ) - ($collection + $discount);
            $rent->collection = $collection;
            $rent->due = $due;
            $driver = Driver::find($rent->driver_id);
            $fillable = $driver->rents->sum('due');

            if($fillable < 0 && $due > 0)
            {

                foreach ($driver->rents as $dueRent)
                {
                    if($dueRent->due < 0)
                    {

                        $due = $due + $dueRent->due;

                        if($due >= 0)
                        {

                            $rent->collection = $rent->collection+(-1*$dueRent->due);
                            $dueRent->due = 0;
                            $dueRent->save();

                        }
                        else
                        {

                            $dueRent->due = $dueRent->due + ($rent->total_collectable - $collection);
                            $rent->collection = $rent->total_collectable ;
                            $dueRent->save();
                            break;
                        }
                    }
                    if($due >= 0)
                    {
                        $rent->due = $due;
                    }
                }
            }
        }
            $end_time = Carbon::now();
            $end_time->setTimezone('GMT+6');
            $end_time->toTimeString();
            $end_time->format('h:i');
            $rent->end_time = $end_time;
        $rent->status = 1;
        $rent->amount_collected = $collection;
        $rent->amount_remained = $rent->total_collectable - ($collection + $discount);
        $rent->save();
        Vehicle::where('id', $rent->vehicle_id)->update(['rent_status' => 0]);
        Driver::where('id', $rent->driver_id)->update(['rent_status' => 0]);

        if($request->damage != null)
        {
            if($request->damage_amount == null)
            {
                return redirect()->back();
            }
            else{

                $request->request->add(['amount' => $request->damage_amount]);
                $vehicle_id = $rent->vehicle->id;
                if($request->partial_payment != null)
                {
                    $request->request->add(['due_amount' => $request->damage_amount]);
                    $request->request->add(['driver_due_amount' => $request->partial_payment_amount]);
                    $request->request->add(['partial_payment_amount' => $request->partial_payment_amount]);
                    $request->request->add(['owner_amount' => $request->owner_amount]);
                    $request->request->add(['partial_payment' => 1]);


                }
                else
                {
                    $request->request->add(['due_amount' => $request->damage_amount]);
                    $request->request->add(['driver_due_amount' => $request->damage_amount]);
                    $request->request->add(['partial_payment_amount' => 0]);
                    $request->request->add(['owner_amount' => 0]);
                    $request->request->add(['partial_payment' => 0]);
                }

                $request->request->add(['vehicle_id' => $vehicle_id]);
                $request->request->add(['driver_id' => $rent->driver_id]);
                $request->request->add(['status' => 'notPaid']);

//                dd($request);

                $damage = damage::create($request->only('amount', 'due_amount', 'vehicle_id', 'rent_id', 'driver_id', 'status',
                    'partial_payment', 'owner_amount', 'partial_payment_amount', 'details', 'driver_due_amount'));
                $rent->damage_id = $damage->id;
            }
        }

        if($request->case != null)
        {
            if($request->penalty == null )
            {
                return redirect()->back();
            }
            else
            {
                $time = strtotime($request->last_date);

                $newformat = date('Y-m-d',$time);
                $request->request->add(['last_date' => $newformat]);
                $request->request->add(['doc_status' => 0]);
                $request->request->add(['payment_status' => 0]);
                $request->request->add(['due_amount' => $request->penalty]);
                $request->request->add(['driver_id' => $rent->driver_id]);
                $incident = Incident::create($request->except('collection', 'case', 'damage_amount', 'amount'));
                $rent->incident_id = $incident->id;
            }
        }

        $request->request->add(['amount' => $request->collection]);
        $request->request->add(['type' => 'Debit']);
        $request->request->add(['method' => 'cash']);
        $request->request->add(['payment_for' => 'rent']);
        $user = Auth()->user();
        $request->request->add(['user_id' => $user->id]);
        $request->request->add(['driver_id' => $rent->driver_id]);
        $transaction = Transaction::create($request->only('amount', 'type', 'method', 'payment_for', 'user_id', 'driver_id', 'rent_id'));
        $rent->save();
        return redirect()->route('rent.index')->with('message', 'Trip Ended Successfully');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function show(Rent $rent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function edit(Rent $rent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rent $rent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rent  $rent
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($rent)
    {
        $rent = Rent::find($rent);

        if($rent->end_time == '00:00:00')
        {
            Vehicle::where('id', $rent->vehicle_id)->update(['rent_status' => 0]);
            Driver::where('id', $rent->driver_id)->update(['rent_status' => 0]);
            $rent->delete();
            return redirect()->back()->with('message', 'Rent Deleted');
        }
        return redirect()->back()->with('message', 'Rent was not Deleted!, Error Occurred');
    }
}
