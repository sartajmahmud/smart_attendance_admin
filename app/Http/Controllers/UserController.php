<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Network;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $join = DB::table('networks')
            -> join('users', 'users.network_id','=','networks.id')
            -> join('locations', 'users.location_id','=','locations.id')
            -> join('types', 'users.attendance_type' , '=' , 'types.id')
            ->select('users.id','users.name','users.email','types.name as typeName','locations.name as locationName','networks.ssid')
            ->get();
        //return $join;
        return view("admin.user.index") -> with('users' , $join);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("admin.user.index");
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::find($id);
        return view('admin.user.show')->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $networks = Network::all();
        $locations = Location::all();
        $join =  DB::table('networks')
            -> join('users', 'users.network_id','=','networks.id')
            -> join('locations', 'users.location_id','=','locations.id')
            -> join('types', 'users.attendance_type' , '=' , 'types.id')
            ->select('users.id','users.name','users.email','types.name as typeName','locations.name as locationName','networks.ssid')
            ->get();
        $types = DB::table('types') -> select('*')->get();
        //return $types;
        //return $join;
       // return $join;
        return view('admin.user.edit')
            ->with('user',$join[0])
            ->with('networks',$networks)
            ->with('locations',$locations)
            ->with('types', $types);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
       // return $req;
        //
        $user = User::findOrFail($req->id);
        $user->name = $req->name;
        $user->email = $req->email;
        //return $req->attendance_type;
        $user->attendance_type = $req->attendance_type;

        $location = Location::where('name',$req->location_id)->get();

        $user->location_id = $location[0]->id;
        $network = Network::where('ssid',$req->network_id)->get();
        $user->network_id = $network[0]->id;
        $user->save();

        return redirect('/admin/users');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/admin/users');
    }
}
