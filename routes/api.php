<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/networks', function (){
   return \App\Models\Network::all();
});

Route::get('/network/{id}', function ($id){

    return \App\Models\Network::where('id',$id)->first();
});

Route::get('/locations', function (){
    return \App\Models\Location::all();
});

Route::get('/location/{id}', function ($id){

    return \App\Models\Location::where('id',$id)->first();
});

Route::post('/register', function (){
    request()->validate(
        [
            'email' => 'required',
            'password' => 'required',
        ]
    );
    $user = new User();
    $user->name = request('name');
    $user->email = request('email');
    $user->password = request('password');
    $user->device_token = request('device_token');
    $user->save();
    $resuser = User::where('email','=',request('email'))
        //->where('password','=',request('password'))
        ->first();
    return $resuser;
});

Route::post('/login', function (){
    request()->validate(
        [
            'email' => 'required',
            'password' => 'required',
        ]
    );
    $user = User::where('email','=',request('email'))
        //->where('password','=',request('password'))
        ->first();
    $user->device_token = request('device_token');
    $user->save();
    return $user;
    //$user->device_token = request('device_token');
   // $user->save();
   //return User::where('email',request('email'))->get();
});


Route::post('/entry', function (){
    request()->validate(
        [
            'user_id' => 'required'
        ]
    );

    $userAt = Attendance::where('user_id',request('user_id'))->orderBy('attendances.id','desc')->first();
    //$currentTime = \Illuminate\Support\Carbon::now();

    //dd($oldDate->diffInDays($newDate));
    //return $userAt;
    //return $userAt;

    if(request('entry_time')!=null){

    if($userAt== null){
        $attendance = new Attendance();
        $attendance->user_id = request('user_id');
        $attendance->entry_time = request('entry_time');
        $attendance->save();
        return ['message' =>  'Entry Successful'];
    }elseif ($userAt->entry_time == null){
        //$attendance = new Attendance();
        $userAt->user_id = request('user_id');
        $userAt->entry_time = request('entry_time');
        $userAt->save();
        return ['message' =>  'Entry Successful'];
    }
    else{
        $newDate = \Illuminate\Support\Carbon::parse(request('entry_time'));
        $oldDate = \Illuminate\Support\Carbon::parse($userAt->entry_time);

        if($oldDate->diffInDays($newDate)==0){
            return ['message' =>  'already exists'];
        } else{

            $attendance = new Attendance();
            $attendance->user_id = request('user_id');
            $attendance->entry_time = request('entry_time');
            $attendance->save();
            return ['message' =>  'Entry Successful'];
        }
    }
    }else{

    $attendance = Attendance::where('user_id',request('user_id'))->orderBy('attendances.id','desc')->first();
        //$currentTime = \Illuminate\Support\Carbon::now();
        $newDate = \Illuminate\Support\Carbon::parse(request('exit_time'));
        $oldDate = \Illuminate\Support\Carbon::parse($attendance->entry_time);
        //dd($oldDate->diffInDays($newDate));
        //return $userAt;
        if($attendance->exit_time != null){
            return ['message' =>  'already exists'];
        }else{

            //$attendance = new Attendance();
            $attendance->user_id = request('user_id');
            $attendance->exit_time = request('exit_time');
            $attendance->save();
            return ['message' =>  'Entry Successful'];
        }
    }


});

Route::post('/exit', function (){
    request()->validate(
        [
            'user_id' => 'required',
            'exit_time' => 'required',
        ]
    );
    $attendance = Attendance::where('user_id',request('user_id'))->orderBy('attendances.id','desc')->first();
    //$currentTime = \Illuminate\Support\Carbon::now();
    $newDate = \Illuminate\Support\Carbon::parse(request('exit_time'));
    $oldDate = \Illuminate\Support\Carbon::parse($attendance->entry_time);
    //dd($oldDate->diffInDays($newDate));
    //return $userAt;
    if($attendance->exit_time != null){
        return ['message' =>  'already exists'];
    }else{

        //$attendance = new Attendance();
        $attendance->user_id = request('user_id');
        $attendance->exit_time = request('exit_time');
        $attendance->save();
        return ['message' =>  'Entry Successful'];
    }
});

Route::get('/homescreendata/{id}', function($id){
    $data =  DB::table('users')
        ->join('attendances','users.id','=','attendances.user_id')
        ->select('users.name', 'users.attendance_type', 'users.location_id','users.network_id','attendances.entry_time', 'attendances.exit_time')
        ->where('users.id',$id)->orderBy('attendances.id','desc')->first();
    if($data== null){
        $attendance = new Attendance();
        $attendance->user_id = $id;
        $attendance->entry_time = null;
        $attendance->save();
        $data =  DB::table('users')
            ->join('attendances','users.id','=','attendances.user_id')
            ->select('users.name', 'users.attendance_type', 'users.location_id','users.network_id','attendances.entry_time', 'attendances.exit_time')
            ->where('users.id',$id)->orderBy('attendances.id','desc')->first();
    }
    return $data;
});

Route::post('/attendance', function(){
request()->validate(
        [
            'user_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'ssid' => 'required'
        ]
    );
            $userData = DB::table('users')
            ->where('id','=' ,request('user_id'))
            ->first();

            $userAssignedLocationData = DB::table('locations')
            ->where('id', '=', $userData->location_id)
            ->first();

            $userAssignedNetworkData = DB::table('networks')
            ->where('id', '=', $userData->network_id)
            ->first();


            $userAssignedSSID = $userAssignedNetworkData->ssid;
            $userAssignedLatitude = $userAssignedLocationData->latitude;
            $userAssignedLongitude = $userAssignedLocationData->longitude;
            $userAssignedAttendanceType = $userData->attendance_type;
            $userAssignedRadius = $userAssignedLocationData->radius;
            $currentTime = \Illuminate\Support\Carbon::now();

            //$apiKey = 'AIzaSyCHZWSE97Js_lHU9UF4OWLuZHcrVeE6Qyo';
            $apiKey = 'AIzaSyBzQ7shRAOAFAdZtIpYp9bNnQnFerPgotw';

            if($userAssignedAttendanceType == 1){
            //check the distance
            $userCurrentLatitude = request('latitude');
            $userCurrentLongitude = request('longitude');

            $response = Http::get('https://maps.googleapis.com/maps/api/directions/json?origin='.$userCurrentLatitude.','.$userCurrentLongitude.'&destination='.$userAssignedLatitude.','.$userAssignedLongitude.'&key='.$apiKey);
            $distance = $response["routes"][0]["legs"][0]["distance"]['value'];

            if($distance <= $userAssignedRadius){
                //return$userAssignedRadius;
                //attendance entry/exit code
                $userAt = Attendance::where('user_id',request('user_id'))->orderBy('attendances.id','desc')->first();
                if($userAt== null){
                    $attendance = new Attendance();
                    $attendance->user_id = request('user_id');
                    $attendance->entry_time = $currentTime;
                    $attendance->save();
                    return ['message' =>  'Entry Successful'];
                }elseif ($userAt->entry_time == null){
                    //$attendance = new Attendance();
                    $userAt->user_id = request('user_id');
                    $userAt->entry_time = $currentTime;
                    $userAt->save();
                    return ['message' =>  'Entry Successful'];
                }
                else{
                    $newDate = \Illuminate\Support\Carbon::parse($currentTime);
                    $oldDate = \Illuminate\Support\Carbon::parse($userAt->entry_time);

                    if($oldDate->diffInDays($newDate)==0){
                        return ['message' =>  'already exists'];
                    } else{

                        $attendance = new Attendance();
                        $attendance->user_id = request('user_id');
                        $attendance->entry_time = $currentTime;
                        $attendance->save();
                        return ['message' =>  'Entry Successful'];
                    }
                }
            }else{
                $attendance = Attendance::where('user_id',request('user_id'))->orderBy('attendances.id','desc')->first();
                if($attendance != null) {

                    if ($attendance->exit_time != null) {
                        return ['message' => 'already exists'];
                    } else if ($attendance->entry_time != null) {

                        //$attendance = new Attendance();
                        $attendance->user_id = request('user_id');
                        $attendance->exit_time = $currentTime;
                        $attendance->save();
                        return ['message' => 'Entry Successful'];
                    } else {
                        return ['message' => 'Entry first'];
                    }
                }else{
                    return ['message' => 'Entry first'];
                }
            }
            }
            else if($userAssignedAttendanceType ==2){
            //check the ssid
            if($userAssignedSSID == request('ssid')){
                //attendance entry/exit code
                $userAt = Attendance::where('user_id',request('user_id'))->orderBy('attendances.id','desc')->first();
                if($userAt== null){
                    $attendance = new Attendance();
                    $attendance->user_id = request('user_id');
                    $attendance->entry_time = $currentTime;
                    $attendance->save();
                    return ['message' =>  'Entry Successful'];
                }elseif ($userAt->entry_time == null){
                    //$attendance = new Attendance();
                    $userAt->user_id = request('user_id');
                    $userAt->entry_time = $currentTime;
                    $userAt->save();
                    return ['message' =>  'Entry Successful'];
                }
                else{
                    $newDate = \Illuminate\Support\Carbon::parse($currentTime);
                    $oldDate = \Illuminate\Support\Carbon::parse($userAt->entry_time);

                    if($oldDate->diffInDays($newDate)==0){
                        return ['message' =>  'already exists'];
                    } else{

                        $attendance = new Attendance();
                        $attendance->user_id = request('user_id');
                        $attendance->entry_time = $currentTime;
                        $attendance->save();
                        return ['message' =>  'Entry Successful'];
                    }
                }
            }else{
                $attendance = Attendance::where('user_id',request('user_id'))->orderBy('attendances.id','desc')->first();
                if($attendance != null) {

                    if ($attendance->exit_time != null) {
                        return ['message' => 'already exists'];
                    } else if ($attendance->entry_time != null) {

                        //$attendance = new Attendance();
                        $attendance->user_id = request('user_id');
                        $attendance->exit_time = $currentTime;
                        $attendance->save();
                        return ['message' => 'Entry Successful'];
                    } else {
                        return ['message' => 'Entry first'];
                    }
                }else{
                    return ['message' => 'Entry first'];
                }
            }
            }
        return $userAssignedAttendanceType;
});
