<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Attendance;
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


Route::post('/attendance', function (){
    request()->validate(
        [
            'user_id' => 'required',
            'entry_time' => 'required',
        ]
    );
    $attendance = new Attendance();
    $attendance->user_id = request('user_id');
    $attendance->entry_time = request('entry_time');
    $attendance->save();
    return ['success' =>  'Entry Successful'];
});
