@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Mis Materias</h2>
        <button class="btn btn-primary shadow" data-bs-toggle="modal" data-bs-target="#modalCrearMateria">
            + Nueva Materia
        </button>
    </div>

    <div class="row">
        @foreach ($materias as $materia)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h4 class="card-title text-primary">{{ $materia->name }}</h4>
                    <p class="text-muted">{{ $materia->academic_year }}</p>
                    <p class="small">👨‍🎓 {{ $materia->students_count }} Alumnos</p>
                    <a href="{{ route('materias.show', $materia->id) }}" class="btn btn-outline-primary w-100 mt-2">Entrar</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="modal fade" id="modalCrearMateria" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('materias.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Nueva Materia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Nombre de la Materia</label>
                    <input type="text" name="name" class="form-control" placeholder="Ej: Matemáticas" required>
                </div>
                <div class="mb-3">
                    <label>Año</label>
                    <input type="text" name="academic_year" class="form-control" placeholder="Ej: 2024">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection