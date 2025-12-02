@extends('layouts.plantilla')

@section('titulo', $kit->name)

@section('header')
    <h1>{{ $kit->name }}</h1>
    <x-action-button href="{{ route('robotics.index') }}">Volver</x-action-button>
@endsection

@section('contenido')
    <x-content-card>
        <p><strong>ID:</strong> {{ $kit->id }}</p>
        <p><strong>Nombre:</strong> {{ $kit->name }}</p>
        
        <div style="margin: 20px 0;">
            <x-action-button href="{{ route('robotics.edit', $kit->id) }}">Editar</x-action-button>
        </div>
    </x-content-card>

    <x-content-card>
        <h2>Cursos Asociados</h2>
        
        @forelse($kit->courses as $course)
            <div style="padding: 10px; border-bottom: 1px solid black;">
                {{ $course->name }}
            </div>
        @empty
            <p>No hay cursos asociados a este kit.</p>
        @endforelse
    </x-content-card>

    <x-content-card>
        <form action="{{ route('robotics.destroy', $kit->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este kit?')">
            @csrf
            @method('delete')
            <x-action-button type="submit" variant="danger">
                Eliminar Kit
            </x-action-button>
        </form>
    </x-content-card>
@endsection
