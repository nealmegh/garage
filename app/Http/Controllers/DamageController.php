<?php

namespace App\Http\Controllers;

use App\damage;
use Illuminate\Http\Request;

class DamageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'Dashboard - Damage';
        $damages = damage::all();
        return view('backend.damage.index')->with(compact('damages','title'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\damage  $damage
     * @return \Illuminate\Http\Response
     */
    public function show(damage $damage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\damage  $damage
     * @return \Illuminate\Http\Response
     */
    public function edit(damage $damage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\damage  $damage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, damage $damage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\damage  $damage
     * @return \Illuminate\Http\Response
     */
    public function destroy(damage $damage)
    {
        //
    }
}
