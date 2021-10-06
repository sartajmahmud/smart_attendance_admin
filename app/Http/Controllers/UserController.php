<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Network;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Http;

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
        $join = DB::table('users')
            ->leftJoin('networks', 'users.network_id','=','networks.id')
            -> leftJoin('locations', 'users.location_id','=','locations.id')
            -> leftJoin('types', 'users.attendance_type' , '=' , 'types.id')
            ->select('users.id','users.name','users.email','types.name as typeName','locations.name as locationName','networks.ssid')
            ->get();
        //return $join;
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
        $join =  DB::table('users')
            ->where('users.id',$id)
            -> join('networks', 'users.network_id','=','networks.id')
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

       // return $req;
        //$location = Location::where('name',$req->location_id)->get();

        //$user->location_id = $location[0]->id;
        $user->location_id = $req->location_id;
       // $network = Network::where('ssid',$req->network_id)->get();
        //$user->network_id = $network[0]->id;
        $user->network_id = $req->network_id;

        //return $user;
        $types = DB::table('types')->where('id',$user->attendance_type)->first();
        $nets = DB::table('networks')->where('id',$user->network_id)->first();
        $locs = DB::table('locations')->where('id',$user->location_id)->first();
        //return $types;
        $type = $types->name;
        $net = $nets->ssid;
        $loc = $locs->name;

            Http::withHeaders([
            'Authorization' => "key=AAAATj1i0lE:APA91bGDIDPbofZ1QdHQViFqjdNJ3sLj_B5oBBNkwjSzqgl_ZQy3dqlAAZuEbi0tKlOM8rDIG7Seg5VXN7cYgM4FjH44lg0kJfhP1wLiJkyTnuwc8DJ84QkdDRdM4i2GwcIIEEzKWafy"
        ])->post('https://fcm.googleapis.com/fcm/send',[
            'to' => $user->device_token,
            'notification' => [
                'body' => "Attendance-Type : $type , Assigned Network : $net, Assigned Location : $loc",
                'title' => 'User Data Changed'
            ]

        ]);
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
