@extends('layouts.app')

@section('content')
    <div class="w3-sidebar w3-bar-block" style="width:15%">
        <a href="/admin/attendances" class="w3-bar-item w3-button w3-border-bottom">Attendances</a>
        <a href="/admin/locations" class="w3-bar-item w3-button w3-border-bottom">Locations</a>
        <a href="/admin/networks" class="w3-bar-item w3-button w3-border-bottom">Networks</a>
        <a href="/admin/users" class="w3-bar-item w3-button w3-border-bottom">Users</a>
    </div>

    <div style="margin-left:20%">
        <p>{{ $attendance -> id }}</p>
        <p>{{ $attendance -> user_id }}</p>
        <p>{{ $attendance -> entry_time }}</p>
        <p>{{ $attendance -> exit_time }}</p>
        <p>{{ $attendance -> updated_at }}</p>

    </div>
@endsection
