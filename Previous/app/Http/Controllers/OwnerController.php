<?php

namespace App\Http\Controllers;

use App\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'Dashboard - Owner';
        $owners = Owner::orderBy('id', 'desc')->get();
        return view('backend.owner.index')->with(compact('owners', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $title = 'Dashboard - Owner';
        return view('backend.owner.create')->with(compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $password = $this->randomPassword();
        $request->request->add(['password' => $password]);
        $request->request->add(['password_confirmation' => $password]);
        try{
            $user = app('App\Http\Controllers\Auth\RegisterController')->register($request);

        }
        catch (Exception $exception)
        {
            echo $exception;
        }
        $request->request->add(['user_id' => $user->id]);
        $owner = Owner::create($request->all());

        $allowedFileExtension = ['jpg', 'png'];
        $Filename = '';

        if($request->hasFile('photo')) {
            $Photo = $request->file('photo');
            $extension = $Photo->getClientOriginalExtension();
            $Filename = 'photo_'.$owner->id.'.'.$extension;
            $check1 = in_array($extension,$allowedFileExtension);
            if($check1)
            {
                $Filename = $request->photo->storeAs('photo', $Filename);
            }
        }
        $owner->photo = $Filename;
        $owner->save();
        return redirect(route('owner.index'))->with('message', 'Owner Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Owner  $owner
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($owner)
    {
        $title = 'Dashboard - Owner';
        $owner = Owner::find($owner);
        return view('backend.owner.edit')->with(compact('owner','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Owner  $owner
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $owner)
    {
        $owner = Owner::find($owner);
        $owner->user->name = $request->name;
        $owner->user->email = $request->email;
        $owner->user->save();
        $owner->phone_number = $request->phone_number;
        $owner->save();
        $allowedFileExtension = ['jpg', 'png'];
        $Filename = $owner->photo;
        if($request->hasFile('photo')) {
            $Photo = $request->file('photo');
            $extension = $Photo->getClientOriginalExtension();
            $Filename = 'photo_'.$owner->id.'.'.$extension;
            $check1 = in_array($extension,$allowedFileExtension);
            if($check1)
            {
                $Filename = $request->photo->storeAs('photo', $Filename);
            }
            $owner->photo = $Filename;
            $owner->save();
        }
        return redirect(route('owner.index'))->with('message', 'Owner Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Owner $owner)
    {
        //
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
}
