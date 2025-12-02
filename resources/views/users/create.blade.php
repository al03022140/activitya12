@extends('layouts.plantilla')

@section('titulo', 'Crear Usuario')

@section('contenido')
<h1>Create User</h1>

<form action="{{ route('users.store') }}" method="POST">
    @csrf

    <label>Name *</label>
    <input type="text" name="name" required style="border: 1px solid black; padding: 8px; margin: 5px 0; display: block; width: 300px;" />

    <br><br>

    <label>Email *</label>
    <input type="email" name="email" required style="border: 1px solid black; padding: 8px; margin: 5px 0; display: block; width: 300px;" />

    <br><br>

    <label>Password *</label>
    <input type="password" name="password" required style="border: 1px solid black; padding: 8px; margin: 5px 0; display: block; width: 300px;" />

    <br><br>

    <input type="submit" value="Create" class="btn" />
</form>
@endsection
