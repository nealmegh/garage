<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Owner;
use App\Vehicle;
use App\VehicleDetails;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'Dashboard - Vehicle';
        $vehicles = Vehicle::all();
        return view('backend.vehicle.index')->with(compact('vehicles', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $title = 'Dashboard - Vehicle';
        $owners = Owner::all();
        return view('backend.vehicle.create')->with(compact('owners','title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $tax_token_validity = strtotime($request->tax_token_validity);
        $newformat = date('Y-m-d',$tax_token_validity);
        $request->request->add(['tax_token_validity' => $newformat]);
        $fitness_validity = strtotime($request->fitness_validity);
        $newformat = date('Y-m-d',$fitness_validity);
        $request->request->add(['fitness_validity' => $newformat]);
        $insurance_validity = strtotime($request->insurance_validity);
        $newformat = date('Y-m-d',$insurance_validity);
        $request->request->add(['insurance_validity' => $newformat]);
        $route_permit_validity = strtotime($request->route_permit_validity);
        $newformat = date('Y-m-d',$route_permit_validity);
        $request->request->add(['route_permit_validity' => $newformat]);

        $vehicle = Vehicle::create($request->all());

        $allowedFileExtension = ['jpg', 'png'];
        $regFilename = '';
        $taxFilename = '';
        $fitFilename = '';
        $insFilename = '';
        $routeFilename = '';
        if($request->hasFile('registration_img')) {
            $regPhoto = $request->file('registration_img');
            $extension = $regPhoto->getClientOriginalExtension();
            $regFilename = 'REG_'.$vehicle->id.'.'.$extension;
            $extension = $regPhoto->getClientOriginalExtension();
            $check1 = in_array($extension,$allowedFileExtension);
            if($check1)
            {
                $regFilename = $request->registration_img->storeAs('registration', $regFilename);
            }

        }
        if($request->hasFile('route_permit_img')) {
            $routePhoto = $request->file('route_permit_img');
            $extension = $routePhoto->getClientOriginalExtension();
            $routeFilename = 'ROUTE_'.$vehicle->id.'.'.$extension;
            $extension = $routePhoto->getClientOriginalExtension();
            $check1 = in_array($extension,$allowedFileExtension);
            if($check1)
            {
                $routeFilename = $request->route_permit_img->storeAs('route', $routeFilename);
            }

        }
        if($request->hasFile('tax_img')) {
            $taxPhoto = $request->file('tax_img');
            $extension = $taxPhoto->getClientOriginalExtension();
            $taxFilename = 'TAX_'.$vehicle->id.'.'.$extension;
            $extension = $taxPhoto->getClientOriginalExtension();
            $check2 = in_array($extension,$allowedFileExtension);
            if($check2)
            {
                $taxFilename = $request->tax_img->storeAs('tax', $taxFilename);
            }

        }
        if($request->hasFile('insurance_img')) {
            $insPhoto = $request->file('insurance_img');
            $extension = $insPhoto->getClientOriginalExtension();
            $insFilename = 'INS_'.$vehicle->id.'.'.$extension;
            $extension = $insPhoto->getClientOriginalExtension();
            $check1 = in_array($extension,$allowedFileExtension);
            if($check1)
            {
                $insFilename = $request->insurance_img->storeAs('insurance', $insFilename);
            }

        }
        if($request->hasFile('fitness_img')) {
            $fitPhoto = $request->file('fitness_img');
            $extension = $fitPhoto->getClientOriginalExtension();
            $fitFilename = 'FIT_'.$vehicle->id.'.'.$extension;
            $extension = $fitPhoto->getClientOriginalExtension();
            $check1 = in_array($extension,$allowedFileExtension);
            if($check1)
            {
                $fitFilename = $request->fitness_img->storeAs('fitness', $fitFilename);
            }

        }
        VehicleDetails::create([
            'vehicle_id' => $vehicle->id,
            'registration_img' => $regFilename,
            'fitness_img' => $fitFilename,
            'tax_img' => $taxFilename,
            'insurance_img' => $insFilename,
            'route_permit_img' => $routeFilename
        ]);
        return redirect()->route('vehicle.index')->with('message', 'Vehicle Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($vehicle)
    {
        $title = 'Dashboard - Vehicle';
        $vehicle = Vehicle::find($vehicle);
//        $driver = Driver::find(1);
        $tax = now()->diffInDays(\Carbon\Carbon::parse($vehicle->tax_token_validity), false);
        $fitness = now()->diffInDays(\Carbon\Carbon::parse($vehicle->fitness_validity), false);
        $insurance = now()->diffInDays(\Carbon\Carbon::parse($vehicle->insurance_validity), false);
        $rPermit = now()->diffInDays(\Carbon\Carbon::parse($vehicle->route_permit_validity), false);
        return view('backend.vehicle.show')->with(compact('vehicle' , 'tax', 'fitness', 'insurance', 'title', 'rPermit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($vehicle)
    {
        $title = 'Dashboard - Vehicle';
        $vehicle = Vehicle::find($vehicle);
        $owners = Owner::all();
        return view('backend.vehicle.edit')->with(compact('vehicle', 'owners','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $vehicle)
    {
        $vehicle = Vehicle::find($vehicle);
        $vehicle->update($request->all());
        $allowedFileExtension = ['jpg', 'png'];
        $regFilename = $vehicle->details->registration_img;
        $taxFilename = $vehicle->details->tax_img;
        $fitFilename = $vehicle->details->insurance_img;
        $insFilename = $vehicle->details->fitness_img;
        $routeFilename = $vehicle->details->route_permit_img;;
        if($request->hasFile('registration_img')) {
            $regPhoto = $request->file('registration_img');
            $extension = $regPhoto->getClientOriginalExtension();
            $regFilename = 'REG_'.$vehicle->id.'.'.$extension;
            $extension = $regPhoto->getClientOriginalExtension();
            $check1 = in_array($extension,$allowedFileExtension);
            if($check1)
            {
                $regFilename = $request->registration_img->storeAs('registration', $regFilename);
            }
            $vehicle->details->registration_img = $regFilename;
            $vehicle->details->save();
        }
        if($request->hasFile('tax_img')) {
            $taxPhoto = $request->file('tax_img');
            $extension = $taxPhoto->getClientOriginalExtension();
            $taxFilename = 'TAX_'.$vehicle->id.'.'.$extension;
            $extension = $taxPhoto->getClientOriginalExtension();
            $check2 = in_array($extension,$allowedFileExtension);
            if($check2)
            {
                $taxFilename = $request->tax_img->storeAs('tax', $taxFilename);
            }
            $vehicle->details->tax_img = $taxFilename;
            $vehicle->details->save();

        }
        if($request->hasFile('insurance_img')) {
            $insPhoto = $request->file('insurance_img');
            $extension = $insPhoto->getClientOriginalExtension();
            $insFilename = 'INS_'.$vehicle->id.'.'.$extension;
            $extension = $insPhoto->getClientOriginalExtension();
            $check1 = in_array($extension,$allowedFileExtension);
            if($check1)
            {
                $insFilename = $request->insurance_img->storeAs('insurance', $insFilename);
            }
            $vehicle->details->insurance_img = $insFilename;
            $vehicle->details->save();

        }
        if($request->hasFile('fitness_img')) {
            $fitPhoto = $request->file('fitness_img');
            $extension = $fitPhoto->getClientOriginalExtension();
            $fitFilename = 'FIT_'.$vehicle->id.'.'.$extension;
            $extension = $fitPhoto->getClientOriginalExtension();
            $check1 = in_array($extension,$allowedFileExtension);
            if($check1)
            {
                $fitFilename = $request->fitness_img->storeAs('fitness', $fitFilename);
            }
            $vehicle->details->fitness_img = $fitFilename;
            $vehicle->details->save();

        }
        if($request->hasFile('route_permit_img')) {
            $routePhoto = $request->file('route_permit_img');
            $extension = $routePhoto->getClientOriginalExtension();
            $routeFilename = 'ROUTE_'.$vehicle->id.'.'.$extension;
            $extension = $routePhoto->getClientOriginalExtension();
            $check1 = in_array($extension,$allowedFileExtension);
            if($check1)
            {
                $routeFilename = $request->route_permit_img->storeAs('route', $routeFilename);
            }
            $vehicle->details->route_permit_img = $routeFilename;
            $vehicle->details->save();
        }

        return redirect()->route('vehicle.index')->with('message', 'Vehicle Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
