@extends('layouts.plantilla')

@section('titulo', 'Cursos')

@section('header')
    <h1>Cursos</h1>
    <x-action-button href="{{ route('courses.create') }}">Crear Nuevo Curso</x-action-button>
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
                    <th style="padding: 12px; text-align: left; border-bottom: 2px solid black;">Código</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 2px solid black;">Nombre</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 2px solid black;">Créditos</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 2px solid black;">Semestre</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 2px solid black;">Kit de Robótica</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 2px solid black;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                    <tr>
                        <td style="padding: 12px; border-bottom: 1px solid black;">{{ $course->code }}</td>
                        <td style="padding: 12px; border-bottom: 1px solid black;">{{ $course->name }}</td>
                        <td style="padding: 12px; border-bottom: 1px solid black;">{{ $course->credits }}</td>
                        <td style="padding: 12px; border-bottom: 1px solid black;">{{ $course->semester }}</td>
                        <td style="padding: 12px; border-bottom: 1px solid black;">{{ $course->roboticsKit ? $course->roboticsKit->name : 'N/A' }}</td>
                        <td style="padding: 12px; border-bottom: 1px solid black;">
                            <a href="{{ route('courses.show', $course->id) }}" style="margin-right: 10px;">Ver</a>
                            <a href="{{ route('courses.edit', $course->id) }}" style="margin-right: 10px;">Editar</a>
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; cursor: pointer;" onclick="return confirm('¿Estás seguro de eliminar este curso?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 12px; text-align: center;">
                            No hay cursos registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-content-card>
@endsection
