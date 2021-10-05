@extends('layouts.app')

@section('content')
    <div class="w3-sidebar w3-bar-block" style="width:15%">
        <a href="/admin/attendances" class="w3-bar-item w3-button w3-border-bottom">Attendances</a>
        <a href="/admin/locations" class="w3-bar-item w3-button w3-border-bottom">Locations</a>
        <a href="/admin/networks" class="w3-bar-item w3-button w3-border-bottom">Networks</a>
        <a href="/admin/users" class="w3-bar-item w3-button w3-border-bottom">Users</a>
    </div>

    <div style="margin-left:20%">
{{--        <button class="w3-button w3-blue w3-round-xxlarge">+ Add New</button>--}}
        <table class="w3-table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Attendance Type</th>
                <th>Selected Location</th>
                <th>Selected Network Type</th>
                <th>Actions</th>
            </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->typeName }}</td>
                <td>{{ $user->locationName }}</td>
                <td>{{ $user->ssid }}</td>
                <td>
{{--                    <button class="w3-button w3-circle w3-grey" onclick="window.location.href='users/{{$user->id}}'"><i class="fa fa-eye"></i></button>--}}
                    <button class="w3-button w3-circle w3-blue" onclick="window.location.href='users/edit/{{$user->id}}'"><i class="fa fa-edit"></i></button>
                    <form action="users/{{$user->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="w3-button w3-circle w3-red"><i class="fa fa-trash" ></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </table>
    </div>
@endsection
