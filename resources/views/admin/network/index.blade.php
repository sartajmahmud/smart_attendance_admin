@extends('layouts.app')

@section('content')
    <div class="w3-sidebar w3-bar-block" style="width:15%">
        <a href="/admin/attendances" class="w3-bar-item w3-button w3-border-bottom">Attendances</a>
        <a href="/admin/locations" class="w3-bar-item w3-button w3-border-bottom">Locations</a>
        <a href="/admin/networks" class="w3-bar-item w3-button w3-border-bottom">Networks</a>
        <a href="/admin/users" class="w3-bar-item w3-button w3-border-bottom">Users</a>
    </div>

    <div style="margin-left:20%">
        <button class="w3-button w3-blue w3-round-xxlarge" onclick="window.location.href='networks/create'">+ Add New</button>
        <table class="w3-table">
            <tr>
                <th>ID</th>
                <th>SSID</th>
                <th>Password</th>
                <th>created at</th>
                <th>Updated at</th>
                <th>Actions</th>
            </tr>
            @foreach($networks as $network)
                <tr>
                    <td>{{ $network->id }}</td>
                    <td>{{ $network->ssid }}</td>
                    <td>{{ $network->password }}</td>
                    <td>{{ $network->created_at }}</td>
                    <td>{{ $network->updated_at }}</td>
                    <td>
{{--                        <button class="w3-button w3-circle w3-grey" onclick="window.location.href='networks/{{$network->id}}'"><i class="fa fa-eye"></i></button>--}}
                        <button class="w3-button w3-circle w3-blue" onclick="window.location.href='networks/edit/{{$network->id}}'"><i class="fa fa-edit"></i></button>
                        <form action="networks/{{$network->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="w3-button w3-circle w3-red"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
