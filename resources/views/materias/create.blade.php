@extends('layouts.app')
<form action="{{ route('materias.store') }}" method="POST">
    @csrf
    
    <div class="mb-3">
        <label>Nombre de la Materia</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Año Académico</label>
        <input type="text" name="academic_year" class="form-control">
    </div>

    <div class="mb-3">
        <label>Inscribir Alumnos (Mantén presionada tecla Ctrl para seleccionar varios)</label>
        <select name="students[]" class="form-control" multiple>
            @foreach($students as $student)
                <option value="{{ $student->id }}">{{ $student->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Guardar Materia</button>
</form>