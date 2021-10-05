<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$attendances = Attendance::all();
        //return $attendances;

        $attendances = DB::table('attendances')
            -> join('users', 'users.id','=','attendances.user_id')
            ->select('attendances.*','users.name')
            ->get();
        //return $attendances;
        return view('admin.attendance.index')->with('attendances',$attendances);
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
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $attendance = Attendance::find($id);
        return view('admin.attendance.show')->with('attendance',$attendance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        //
        $attendance = Attendance::findOrFail($req->id);
        $attendance->user_id = $req->user_id;
        $attendance->entry_time = $req->entry_time;
        $attendance->exit_time = $req->exit_time;
        $attendance->save();

        return redirect('/admin/attendances');
    }

    public function edit($id)
    {
        //
        $attendance = Attendance::findOrFail($id);
        return view('admin.attendance.edit')->with('attendance',$attendance);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return redirect('/admin/attendances');
    }
}
