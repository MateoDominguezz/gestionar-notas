@extends("layouts.base")
@section("title", "CreacionMateria")
@section("content")
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mb-3">
                    <a href="{{ route('index.materias') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Volver al listado
                    </a>
                </div>
            
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white p-3">
                        <h5 class="mb-0"><i class="bi bi-journal-plus me-2"></i> Crear Nueva Materia</h5>
                    </div>
                    
                    <div class="card-body p-4">
                        <form action="{{ route('store.materia') }}" method="POST">
                            @csrf
                        
                            <!-- Nombre de la materia-->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Nombre de la Materia</label>
                                <input type="text" name="name" id="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name') }}" placeholder="Ej: Dibujo 1" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <!-- Año Academico -->
                            <div class="mb-3">
                                <label for="academic_year" class="form-label fw-bold">Año Académico</label>
                                <input type="number" name="academic_year" id="academic_year" 
                                       class="form-control @error('academic_year') is-invalid @enderror" 
                                       value="{{ old('academic_year', date('Y')) }}" placeholder="Ej: 2026" required>
                                @error('academic_year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <hr>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-check-circle"></i> Guardar Materia
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection