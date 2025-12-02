@extends('layouts.plantilla')

@section('titulo', 'Crear Kit de Robótica')

@section('header')
    <h1>Crear Nuevo Kit de Robótica</h1>
    <x-action-button href="{{ route('robotics.index') }}">Volver</x-action-button>
@endsection

@section('contenido')
    <x-content-card>
        <form action="{{ route('robotics.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Nombre *</label>
                <input type="text" name="name" required style="width: 100%; padding: 10px; border: 1px solid black; border-radius: 4px;" />
            </div>

            <x-action-button type="submit">Crear Kit</x-action-button>
        </form>
    </x-content-card>
@endsection
