@extends('layouts.plantilla')

@section('titulo', 'Usuarios')

@section('contenido')
<h1>Users</h1>

<a href="{{ route('users.create') }}" class="btn">Create</a>

<br><br>

<table style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th style="border: 1px solid black; padding: 8px;">ID</th>
            <th style="border: 1px solid black; padding: 8px;">Name</th>
            <th style="border: 1px solid black; padding: 8px;">Email</th>
            <th style="border: 1px solid black; padding: 8px;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td style="border: 1px solid black; padding: 8px;">{{ $user->id }}</td>
                <td style="border: 1px solid black; padding: 8px;">{{ $user->name }}</td>
                <td style="border: 1px solid black; padding: 8px;">{{ $user->email }}</td>
                <td style="border: 1px solid black; padding: 8px;">
                    <a href="{{ route('users.show', $user->id) }}" class="btn">View</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
