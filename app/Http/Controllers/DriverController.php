<?php

namespace App\Http\Controllers;

use App\Driver;
use App\DriverPhoto;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'Dashboard - Driver';
        $drivers = Driver::all();
        return view('backend.driver.index')->with(compact('drivers','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $title = 'Dashboard - Driver';
        return view('backend.driver.create')->with(compact('title'));
    }

    private function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $password = $this->randomPassword();

      $license_validity = strtotime($request->license_validity);

      $newformat = date('Y-m-d',$license_validity);
      $email = rand(0, 99999).'@gmail.co';


        $data['phone_number'] = $request->phone_number;
        $data['license_number'] = $request->license_number;
        $data['license_validity'] = $newformat;
        $request->request->remove('phone_number');
        $request->request->remove('license_number');
        $request->request->remove('license_validity');
        $request->request->add(['password' => $password]);
        $request->request->add(['email' => $email]);
        $request->request->add(['password_confirmation' => $password]);

        try{
            $user = app('App\Http\Controllers\Auth\RegisterController')->register($request);

        }
        catch (Exception $exception)
        {
            echo $exception;
        }



        $request->request->add(['user_id' => $user->id]);
        $request->request->remove('name');
        $request->request->remove('email');
        $request->request->remove('password');
        $request->request->remove('password_confirmation');
        $request->request->add(['phone_number' => $data['phone_number']]);
        $request->request->add(['license_number' => $data['license_number']]);
        $request->request->add(['license_validity' => $data['license_validity']]);

        $driver = Driver::create($request->all());
        $allowedFileExtension = ['jpg', 'png'];
        $nidFilename = '';
        $dlFilename = '';
        $driverFilename = '';
        if($request->hasFile('nid_photo')) {
            $nidPhoto = $request->file('nid_photo');
            $extension = $nidPhoto->getClientOriginalExtension();
            $nidFilename = 'nid_'.$driver->id.'.'.$extension;
            $check1 = in_array($extension,$allowedFileExtension);
            if($check1)
            {
                $nidFilename = $request->nid_photo->storeAs('nid_photo', $nidFilename);
            }
        }
        if($request->hasFile('license_photo')) {
            $dlPhoto = $request->file('license_photo');
            $extension = $dlPhoto->getClientOriginalExtension();
            $dlFilename = 'DL_'.$driver->id.'.'.$extension;
            $extension = $dlPhoto->getClientOriginalExtension();
            $check2 = in_array($extension,$allowedFileExtension);
            if($check2)
            {
                $dlFilename = $request->license_photo->storeAs('license_photo', $dlFilename);
            }

        }
        if($request->hasFile('driver_photo')) {
            $driverFilename = $request->file('driver_photo');
            $extension = $driverFilename->getClientOriginalExtension();
            $driverFilename = 'driver_'.$driver->id.'.'.$extension;
            $check3 = in_array($extension, $allowedFileExtension);
            if($check3)
            {
                $driverFilename = $request->driver_photo->storeAs('driver_photo', $driverFilename);
            }
        }
        DriverPhoto::create([
            'driver_id' => $driver->id,
            'license_photo' => $dlFilename,
            'nid_photo' => $nidFilename,
            'nid' => $request->nid,
            'driver_photo' => $driverFilename
        ]);
        return redirect()->route('driver.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($driver)
    {
        $title = 'Dashboard - Driver';
        $driver = Driver::find($driver);
        $loans = $driver->loans->sum('due_amount');
        $due = $driver->rents->sum('due');
        $damage = $driver->damages->sum('driver_due_amount');
        $total_due = $loans + $due + $damage;
        return view('backend.driver.show')->with(compact('driver', 'loans', 'due', 'damage', 'total_due','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($driver)
    {
        $title = 'Dashboard - Driver';
        $driver = Driver::find($driver);
        return view('backend.driver.edit')->with(compact('driver','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Driver  $driver
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $driver)
    {
        $driver = Driver::find($driver);
        $driver->user->name = $request->name;
        $driver->user->save();
        $driver->phone_number = $request->phone_number;
        $driver->license_number = $request->license_number;
        $driver->license_validity = $request->license_validity;
        $driver->address = $request->address;
        $driver->ref_name = $request->ref_name;
        $driver->ref_phone = $request->ref_phone;
        $driver->save();
        $driver->details->nid = $request->nid;
        $driver->details->save();
        $allowedFileExtension = ['jpg', 'png'];
        $nidFilename = $driver->details->nid_photo;
        $dlFilename = $driver->details->license_photo;
        $driverFilename = $driver->details->driver_photo;
        if($request->hasFile('nid_photo')) {
            $nidPhoto = $request->file('nid_photo');
            $extension = $nidPhoto->getClientOriginalExtension();
            $nidFilename = 'nid_'.$driver->id.'.'.$extension;
            $check1 = in_array($extension,$allowedFileExtension);
            if($check1)
            {
                $nidFilename = $request->nid_photo->storeAs('nid_photo', $nidFilename);
            }
            $driver->details->nid_photo = $nidFilename;
            $driver->details->save();
        }
        if($request->hasFile('license_photo')) {
            $dlPhoto = $request->file('license_photo');
            $extension = $dlPhoto->getClientOriginalExtension();
            $dlFilename = 'DL_'.$driver->id.'.'.$extension;
            $extension = $dlPhoto->getClientOriginalExtension();
            $check2 = in_array($extension,$allowedFileExtension);
            if($check2)
            {
                $dlFilename = $request->license_photo->storeAs('license_photo', $dlFilename);
            }
            $driver->details->license_photo = $dlFilename;
            $driver->details->save();

        }
        if($request->hasFile('driver_photo')) {
            $driverFilename = $request->file('driver_photo');
            $extension = $driverFilename->getClientOriginalExtension();
            $driverFilename = 'driver_'.$driver->id.'.'.$extension;
            $check3 = in_array($extension, $allowedFileExtension);
            if($check3)
            {
                $driverFilename = $request->driver_photo->storeAs('driver_photo', $driverFilename);
            }
            $driver->details->driver_photo = $driverFilename;
            $driver->details->save();
        }
       return redirect(route('driver.index'))->with('message', 'Driver Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        //
    }
}
