@extends('layouts.plantilla')

@section('titulo', 'Kits de Robótica')

@section('header')
    <h1>Kits de Robótica</h1>
    <x-action-button href="{{ route('robotics.create') }}">Crear Nuevo Kit</x-action-button>
@endsection

@section('contenido')
    @if(session('success'))
        <x-alert-message type="success">
            {{ session('success') }}
        </x-alert-message>
    @endif

    <x-content-card>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="padding: 12px; text-align: left; border-bottom: 2px solid black;">ID</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 2px solid black;">Nombre</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 2px solid black;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kits as $kit)
                    <tr>
                        <td style="padding: 12px; border-bottom: 1px solid black;">{{ $kit->id }}</td>
                        <td style="padding: 12px; border-bottom: 1px solid black;">{{ $kit->name }}</td>
                        <td style="padding: 12px; border-bottom: 1px solid black;">
                            <a href="{{ route('robotics.show', $kit->id) }}" style="margin-right: 10px;">Ver</a>
                            <a href="{{ route('robotics.edit', $kit->id) }}" style="margin-right: 10px;">Editar</a>
                            <form method="POST" action="{{ route('robotics.destroy', $kit->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; cursor: pointer;" onclick="return confirm('¿Estás seguro de que quieres eliminar este kit?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="padding: 12px; text-align: center;">
                            No hay kits de robótica registrados
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-content-card>
@endsection
