@extends("layouts.base")

@section("title", "Materias")

@section("content")

<div class="container py-5">
    <div class="d-flex align-items-center mb-4">
        <div class="bg-primary text-white p-3 rounded-3 me-3 shadow">
            <i class="bi bi-journal-text fs-3"></i>
        </div>
        <div>
            <h1 class="fw-bold mb-0">Todas las materias</h1>
            <p class="text-muted mb-0">Selecciona una materia para gestionar alumnos y notas.</p>
        </div>
        
        <div class="ms-auto">
            <a href="{{ route('show.materia') }}" class="btn btn-success fw-bold rounded-pill px-4 shadow-sm">
                <i class="bi bi-plus-lg me-2"></i> Añadir Materia
            </a>
        </div>
    </div>

    <hr class="mb-5 opacity-10">

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($materias as $materia)
            <div class="col">
                <div class="card h-100 shadow-sm border-0 transition-hover">
                    <div class="card-header bg-primary opacity-75 py-1"></div>
                    
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-title fw-bold text-dark mb-0">
                                {{ $materia->name }}
                            </h5>
                            <span class="badge rounded-pill bg-light text-primary border border-primary-subtle">
                                ID: {{ $materia->id }}
                            </span>
                        </div>

                        <div class="d-flex align-items-center text-muted mb-4">
                            <i class="bi bi-calendar-event me-2"></i>
                            <span>Año académico: <strong>{{ $materia->academic_year }}</strong></span>
                        </div>

                        <div class="d-grid">
                            <a href="{{ route('view.materia', $materia->id) }}" class="btn btn-outline-primary fw-semibold rounded-pill">
                                <i class="bi bi-eye-fill me-2"></i> Gestionar Materia
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    .transition-hover {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .transition-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
</style>

@endsection