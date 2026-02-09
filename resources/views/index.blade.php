@extends("layouts.base")

@section("title", "Inicio")
@section("content")
<div class="container mt-4">
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-top border-primary border-4">
                <div class="card-body text-center p-4">
                    <div class="display-4 fw-bold text-primary mb-2">
                        <i class="bi bi-journal-bookmark-fill"></i> {{$materias}}
                    </div>
                    <h5 class="card-title fw-bold text-dark">Clases Creadas</h5>
                    <p class="card-text text-muted small">Total de materias</p>
                    <a href="{{ route('index.materias') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4">
                        Ver todas las materias
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
                    <div class="card h-100 shadow-sm border-top border-primary border-4">
                        <div class="card-body text-center p-4">
                            <div class="display-4 fw-bold text-primary mb-2">
                                <i class="bi bi-people-fill"></i> {{$alumnos}}
                            </div>
                            <h5 class="card-title fw-bold text-dark">Alumnos Registrados</h5>
                            <p class="card-text text-muted small">Cantidad total de estudiantes matriculados.</p>
                            <a href="{{ route('index.alumnos') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4 fw-bold">
                                Ver todos
                            </a>
                        </div>
                    </div>
        </div>

        <div class="col-md-12">
            <div class="card h-100 shadow-sm border-top border-primary border-4">
                <div class="card-body text-center p-4">
                    <div class="display-4 fw-bold text-primary mb-2">
                        <i class="bi bi-journal-bookmark-fill"></i> {{number_format($notas,1)}}
                    </div>
                    <h5 class="card-title fw-bold text-dark">Promedio general</h5>
                </div>
            </div>
        </div>        
</div>

@endsection