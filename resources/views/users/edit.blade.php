@extends('layouts.plantilla')

@section('titulo', 'Editar Usuario')

@section('contenido')
<h1>Edit {{ $user->name }}</h1>

<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('patch')

    <label>Name *</label>
    <input type="text" name="name" value="{{ $user->name }}" required style="border: 1px solid black; padding: 8px; margin: 5px 0; display: block; width: 300px;" />

    <br><br>

    <label>Email *</label>
    <input type="email" name="email" value="{{ $user->email }}" required style="border: 1px solid black; padding: 8px; margin: 5px 0; display: block; width: 300px;" />

    <br><br>

    <label>Password (leave blank to keep current)</label>
    <input type="password" name="password" style="border: 1px solid black; padding: 8px; margin: 5px 0; display: block; width: 300px;" />

    <br><br>

    <input type="submit" value="Edit" class="btn" />
</form>
@endsection
