<?php

namespace App\Http\Controllers;

use App\Models\Network;
use Illuminate\Http\Request;

class NetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $networks = Network::all();
        return view('admin.network.index')->with('networks',$networks);
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
        $network = new Network();
        $network -> ssid = request('ssid');
        $network ->password = request('password');
        $network -> save();
        return redirect('/admin/networks');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Network  $network
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $network = Network::find($id);
        return view('admin.network.show')->with('network',$network);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Network  $network
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        //
        $network = Network::findOrFail($req->id);
        $network->ssid = $req->ssid;
        $network->password = $req->password;
        $network->save();

        return redirect('/admin/networks');
    }

    public function edit($id)
    {
        //
        $network = Network::findOrFail($id);
        return view('admin.network.edit')->with('network',$network);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Network  $network
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $network = Network::findOrFail($id);
        $network->delete();

        return redirect('/admin/networks');
    }

    public function create(){
        return view('admin.network.create');
    }
}
