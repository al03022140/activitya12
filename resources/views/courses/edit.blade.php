@extends('layouts.plantilla')

@section('titulo', 'Editar Curso')

@section('header')
    <h1>Editar Curso</h1>
    <x-action-button href="{{ route('courses.show', $course->id) }}">Volver al Curso</x-action-button>
@endsection

@section('contenido')
    @if ($errors->any())
        <x-alert-message type="error">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-alert-message>
    @endif

    <x-content-card>
        <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 20px;">
                <label for="code" style="display: block; margin-bottom: 5px; font-weight: bold;">Código del Curso:</label>
                <input type="text" id="code" name="code" value="{{ old('code', $course->code) }}" required 
                       style="width: 100%; padding: 10px; border: 1px solid black; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="name" style="display: block; margin-bottom: 5px; font-weight: bold;">Nombre del Curso:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $course->name) }}" required 
                       style="width: 100%; padding: 10px; border: 1px solid black; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="credits" style="display: block; margin-bottom: 5px; font-weight: bold;">Créditos:</label>
                <input type="number" id="credits" name="credits" value="{{ old('credits', $course->credits) }}" required min="1" max="10" 
                       style="width: 100%; padding: 10px; border: 1px solid black; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="semester" style="display: block; margin-bottom: 5px; font-weight: bold;">Semestre:</label>
                <input type="number" id="semester" name="semester" value="{{ old('semester', $course->semester) }}" required min="1" max="12" 
                       style="width: 100%; padding: 10px; border: 1px solid black; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="robotics_kit_id" style="display: block; margin-bottom: 5px; font-weight: bold;">Kit de Robótica:</label>
                <select id="robotics_kit_id" name="robotics_kit_id" 
                        style="width: 100%; padding: 10px; border: 1px solid black; border-radius: 4px;">
                    <option value="">Seleccionar Kit (Opcional)</option>
                    @foreach($roboticsKits as $kit)
                        <option value="{{ $kit->id }}" {{ old('robotics_kit_id', $course->robotics_kit_id) == $kit->id ? 'selected' : '' }}>
                            {{ $kit->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 20px;">
                <label for="description" style="display: block; margin-bottom: 5px; font-weight: bold;">Descripción:</label>
                <textarea id="description" name="description" rows="4" 
                          style="width: 100%; padding: 10px; border: 1px solid black; border-radius: 4px;">{{ old('description', $course->description) }}</textarea>
            </div>

            <div style="margin-bottom: 20px;">
                <label for="attachment" style="display: block; margin-bottom: 5px; font-weight: bold;">Archivo Adjunto (Opcional):</label>
                @if($course->attachment)
                    <p style="margin-bottom: 10px;">Archivo actual: 
                        <a href="{{ Storage::url($course->attachment) }}" target="_blank">Ver archivo</a>
                    </p>
                @endif
                <input type="file" id="attachment" name="attachment" 
                       style="width: 100%; padding: 10px; border: 1px solid black; border-radius: 4px;">
            </div>

            <div style="display: flex; gap: 10px;">
                <x-action-button type="submit">Actualizar Curso</x-action-button>
                <x-action-button href="{{ route('courses.show', $course->id) }}">Cancelar</x-action-button>
            </div>
        </form>
    </x-content-card>
@endsection
