@extends('layouts.app')

@section('content')
    <div class="w3-sidebar w3-bar-block" style="width:15%">
        <a href="/admin/attendances" class="w3-bar-item w3-button w3-border-bottom">Attendances</a>
        <a href="/admin/locations" class="w3-bar-item w3-button w3-border-bottom">Locations</a>
        <a href="/admin/networks" class="w3-bar-item w3-button w3-border-bottom">Networks</a>
        <a href="/admin/users" class="w3-bar-item w3-button w3-border-bottom">Users</a>
    </div>

    <div style="margin-left:20%">
        <button class="w3-button w3-blue w3-round-xxlarge" onclick="window.location.href='locations/create'">+ Add New</button>
        <table class="w3-table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Radius</th>
                <th>Updated at</th>
                <th>Actions</th>
            </tr>
            @foreach($locations as $location)
                <tr>
                    <td>{{ $location->id }}</td>
                    <td>{{ $location->name }}</td>
                    <td>{{ $location->latitude }}</td>
                    <td>{{ $location->longitude }}</td>
                    <td>{{ $location->radius }} meter</td>
                    <td>{{ $location->updated_at }}</td>
                    <td>
{{--                        <button class="w3-button w3-circle w3-grey" onclick="window.location.href='locations/{{$location->id}}'"><i class="fa fa-eye"></i></button>--}}
                        <button class="w3-button w3-circle w3-blue" onclick="window.location.href='locations/edit/{{$location->id}}'"><i class="fa fa-edit"></i></button>
                        <form action="locations/{{$location->id}}" method="POST">
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
