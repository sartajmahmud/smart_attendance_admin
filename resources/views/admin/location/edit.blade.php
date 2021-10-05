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
        <form action="/admin/locations/update" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$location->id}}">
            <label for="name">Location name : </label>
            <input type = "text" id="name" name="name" value="{{$location->name}}"><br>
            <label for="latitude">Longitude : </label>
            <input type = "text" id="latitude" name="latitude" value="{{$location->latitude}}"><br>
            <label for="longitude">Longitude : </label>
            <input type = "text" id="longitude" name="longitude" value="{{$location->longitude}}"><br>
            <label for="radius">Radius : </label>
            <input type = "text" id="radius" name="radius" value="{{$location->radius}}"><br>
            <input type="submit" value="Update Location">
        </form>
    </div>
@endsection
