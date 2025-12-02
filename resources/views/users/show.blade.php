@extends('layouts.plantilla')

@section('titulo', 'Usuario: ' . $user->name)

@section('contenido')
<h1>{{ $user->name }}</h1>

<p>ID: {{ $user->id }}</p>
<p>Email: {{ $user->email }}</p>

<a href="{{ route('users.edit', $user->id) }}" class="btn">Edit</a>

<hr style="border: 1px solid black; margin: 20px 0;">

<h2>Courses enrolled</h2>

<ul>
@forelse($user->courses as $course)
    <li>{{ $course->name }}</li>
@empty
    <p>There are no courses enrolled.</p>
@endforelse
</ul>

<hr style="border: 1px solid black; margin: 20px 0;">

<form action="{{ route('users.destroy', $user->id) }}" method="POST">
    @csrf
    @method('delete')

    <input type="submit" value="Delete record" class="btn" style="border: 1px solid black;" />
</form>
@endsection
