@extends('layouts.plantilla')

@section('titulo', 'Editar Kit de Robótica')

@section('header')
    <h1>Editar {{ $kit->name }}</h1>
    <x-action-button href="{{ route('robotics.index') }}">Volver</x-action-button>
@endsection

@section('contenido')
    <x-content-card>
        <form action="{{ route('robotics.update', $kit->id) }}" method="POST">
            @csrf
            @method('patch')

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Nombre *</label>
                <input type="text" name="name" value="{{ $kit->name }}" required style="width: 100%; padding: 10px; border: 1px solid black; border-radius: 4px;" />
            </div>

            <x-action-button type="submit">Actualizar Kit</x-action-button>
        </form>
    </x-content-card>
@endsection
