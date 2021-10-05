<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $locations = Location::all();
        return view('admin.location.index')->with('locations',$locations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
        $location = new Location();
        $location -> name = request('name');
        $location ->latitude = request('latitude');
        $location ->longitude = request('longitude');
        $location ->radius = request('radius');
        $location -> save();
        return redirect('/admin/locations');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $location = Location::find($id);
        return view('admin.location.show')->with('location',$location);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        //
        $location = Location::findOrFail($req->id);
        $location->name = $req->name;
        $location->latitude = $req->latitude;
        $location->longitude = $req->longitude;
        $location->radius = $req->radius;
        $location->save();

        return redirect('/admin/locations');
    }

    public function edit($id)
    {
        //
        $location = Location::findOrFail($id);
        return view('admin.location.edit')->with('location',$location);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //return $id;
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect('/admin/locations');
    }

    Public function create(){
        return view("admin.location.create");
    }
}
