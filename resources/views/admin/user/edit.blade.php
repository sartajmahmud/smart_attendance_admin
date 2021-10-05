@extends('layouts.app')

@section('content')
    <div class="w3-sidebar w3-bar-block" style="width:15%">
        <a href="/admin/attendances" class="w3-bar-item w3-button w3-border-bottom">Attendances</a>
        <a href="/admin/locations" class="w3-bar-item w3-button w3-border-bottom">Locations</a>
        <a href="/admin/networks" class="w3-bar-item w3-button w3-border-bottom">Networks</a>
        <a href="/admin/users" class="w3-bar-item w3-button w3-border-bottom">Users</a>
    </div>

    <div style="margin-left:20%">
        <h1>Edit User</h1>
        <form action="/admin/users/update" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$user->id}}">
            <label for="name">Name : </label>
            <input type = "text" id="name" name="name" value="{{$user->name}}"><br>
            <label for="email">Email : </label>
            <input type = "text" id="email" name="email" value="{{$user->email}}"><br>
            <label for="attendance_type">Attendance Type : </label>
            <select id="attendance_type" name="attendance_type" value="{{$user->typeName}}">
                <option value="0">Select</option>
                @foreach($types as $type)
                <option {{$user->typeName==$type->name ? 'selected' : ''}} value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
            </select><br>
{{--            <input type = "text" id="attendance_type" name="attendance_type" value="{{$user->attendance_type}}"><br>--}}
            <label for="location_id">Location : </label>
            <input type = "text" id="location_id" name="location_id" value="{{$user->locationName}}"><br>
            <label for="network_id">Network : </label>
            <input type = "text" id="network_id" name="network_id" value="{{$user->ssid}}"><br>
            <input type="submit" value="Update User">
        </form>
    </div>
@endsection
