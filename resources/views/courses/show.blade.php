@extends('layouts.plantilla')

@section('titulo', 'Detalles del Curso')

@section('header')
    <h1>Detalles del Curso</h1>
    <div style="display: flex; gap: 10px;">
        <x-action-button href="{{ route('courses.edit', $course->id) }}">Editar</x-action-button>
        <x-action-button href="{{ route('courses.index') }}">Volver a Cursos</x-action-button>
        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <x-action-button type="submit" onclick="return confirm('¿Estás seguro de eliminar este curso?')">
                Eliminar
            </x-action-button>
        </form>
    </div>
@endsection

@section('contenido')
    @if(session('success'))
        <x-alert-message type="success">
            {{ session('success') }}
        </x-alert-message>
    @endif

    <x-content-card title="Información del Curso">
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <strong>Código:</strong> {{ $course->code }}
            </div>
            <div>
                <strong>Nombre:</strong> {{ $course->name }}
            </div>
            <div>
                <strong>Créditos:</strong> {{ $course->credits }}
            </div>
            <div>
                <strong>Semestre:</strong> {{ $course->semester }}
            </div>
        </div>

        @if($course->roboticsKit)
            <div style="margin-bottom: 20px;">
                <strong>Kit de Robótica Asociado:</strong>
                <a href="{{ route('robotics.show', $course->roboticsKit->id) }}">
                    {{ $course->roboticsKit->name }}
                </a>
            </div>
        @endif

        @if($course->description)
            <div style="margin-bottom: 20px;">
                <strong>Descripción:</strong>
                <p style="margin-top: 5px;">{{ $course->description }}</p>
            </div>
        @endif

        @if($course->attachment)
            <div style="margin-bottom: 20px;">
                <strong>Archivo Adjunto:</strong>
                <a href="{{ Storage::url($course->attachment) }}" target="_blank">
                    Ver archivo
                </a>
            </div>
        @endif

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div>
                <strong>Fecha de Creación:</strong> {{ $course->created_at->format('d/m/Y H:i') }}
            </div>
            <div>
                <strong>Última Actualización:</strong> {{ $course->updated_at->format('d/m/Y H:i') }}
            </div>
        </div>
    </x-content-card>

    @if($course->students->count() > 0)
        <x-content-card title="Estudiantes Inscritos ({{ $course->students->count() }})">
            
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid black;">Nombre</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid black;">Email</th>
                        <th style="padding: 12px; text-align: left; border-bottom: 2px solid black;">Fecha de Inscripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($course->students as $student)
                        <tr>
                            <td style="padding: 12px; border-bottom: 1px solid black;">{{ $student->name }}</td>
                            <td style="padding: 12px; border-bottom: 1px solid black;">{{ $student->email }}</td>
                            <td style="padding: 12px; border-bottom: 1px solid black;">
                                {{ $student->pivot->created_at ? $student->pivot->created_at->format('d/m/Y') : 'N/A' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-content-card>
    @else
        <x-content-card>
            <p style="text-align: center;">No hay estudiantes inscritos en este curso.</p>
        </x-content-card>
    @endif
@endsection
