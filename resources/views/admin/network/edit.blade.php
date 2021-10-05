@extends('layouts.app')

@section('content')
    <div class="w3-sidebar w3-bar-block" style="width:15%">
        <a href="/admin/attendances" class="w3-bar-item w3-button w3-border-bottom">Attendances</a>
        <a href="/admin/locations" class="w3-bar-item w3-button w3-border-bottom">Locations</a>
        <a href="/admin/networks" class="w3-bar-item w3-button w3-border-bottom">Networks</a>
        <a href="/admin/users" class="w3-bar-item w3-button w3-border-bottom">Users</a>
    </div>

    <div style="margin-left:20%">
        <h1>Edit Network</h1>
        <form action="/admin/networks/update" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$network->id}}">
            <label for="ssid">SSID : </label>
            <input type = "text" id="ssid" name="ssid" value="{{$network->ssid}}"><br>
            <label for="password">Password : </label>
            <input type = "text" id="password" name="password" value="{{$network->password}}"><br>
            <input type="submit" value="Update Network">
        </form>
    </div>
@endsection
