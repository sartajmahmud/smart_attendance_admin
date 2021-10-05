@extends('layouts.app')

@section('content')
    <div class="w3-sidebar w3-bar-block" style="width:15%">
        <a href="/admin/attendances" class="w3-bar-item w3-button w3-border-bottom">Attendances</a>
        <a href="/admin/locations" class="w3-bar-item w3-button w3-border-bottom">Locations</a>
        <a href="/admin/networks" class="w3-bar-item w3-button w3-border-bottom">Networks</a>
        <a href="/admin/users" class="w3-bar-item w3-button w3-border-bottom">Users</a>
</div>

<div style="margin-left:20%">
    <table class="w3-table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Entry time</th>
            <th>Exit time</th>
            <th>Updated at</th>
            <th>Actions</th>
        </tr>
        @foreach($attendances as $attendance)
            <tr>
                <td>{{ $attendance->id }}</td>
                <td>{{ $attendance->name }}</td>
                <td>{{ $attendance->entry_time }}</td>
                <td>{{ $attendance->exit_time }}</td>
                <td>{{ $attendance->updated_at }}</td>
                <td>
                    <button class="w3-button w3-circle w3-grey" onclick="window.location.href='attendances/{{$attendance->id}}'"><i class="fa fa-eye"></i></button>
{{--                    <button class="w3-button w3-circle w3-blue"><i class="fa fa-edit"></i></button>--}}
                    <form action="attendances/{{$attendance->id}}" method="POST">
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
