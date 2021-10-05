@extends('layouts.app')

@section('content')
    <div class="w3-sidebar w3-bar-block" style="width:15%">
        <a href="/admin/attendances" class="w3-bar-item w3-button w3-border-bottom">Attendances</a>
        <a href="/admin/locations" class="w3-bar-item w3-button w3-border-bottom">Locations</a>
        <a href="/admin/networks" class="w3-bar-item w3-button w3-border-bottom">Networks</a>
        <a href="/admin/users" class="w3-bar-item w3-button w3-border-bottom">Users</a>
    </div>

    <div style="margin-left:20%">
        <h1>Edit Location</h1>
        <form action="/admin/attendances/update" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$attendance->id}}">
            <label for="name">Location name : </label>
            <input type = "text" id="name" name="name" value="{{$attendance->user_id}}"><br>
            <label for="latitude">Longitude : </label>
            <input type = "text" id="latitude" name="latitude" value="{{$attendance->entry_time}}"><br>
            <label for="longitude">Longitude : </label>
            <input type = "text" id="longitude" name="longitude" value="{{$attendance->exit_time}}"><br>
            <input type="submit" value="Update attendance">
        </form>
    </div>
@endsection
