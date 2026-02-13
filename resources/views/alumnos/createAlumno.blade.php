@extends("layouts.base")
@section('title', "CrearAlumno")

@section('content')

<!-- Errores-->
@error('name')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Nuevo Alumno</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('store.alumno') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre del Alumno</label>
                            <input type="text" 
                                   name="name" 
                                   id="name"
                                   class="form-control" 
                                   placeholder="Ingrese el nombre"
                                   >
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('index.alumnos') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Guardar Alumno</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection