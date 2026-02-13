@extends("layouts.base")

@section("title", "Alumnos")

@section("content")

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4 text-center">Alumnos Totales</h1>
            
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route("create.alumno") }}">
                    <i class="bi bi-person-plus-fill me-2"></i>Añadir Alumno
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover border shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="width: 5%;">ID</th>
                            <th scope="col" style="width: 35%;">Nombre del Alumno</th>
                            <th scope="col" style="width: 40%;">Materias Inscriptas</th>
                            <th scope="col" style="width: 10%;" class="text-center">Editar</th>
                            <th scope="col" style="width: 10%;" class="text-center">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alumnos as $alumno)
                            <tr>
                                <th scope="row">{{ $alumno->id }}</th>
                                <td class="fw-bold text-uppercase">{{ $alumno->name }}</td>
                                <td>
                                    @if($alumno->subjects->isEmpty())
                                        <span class="text-muted fst-italic">Sin materias inscriptas</span>
                                    @else
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($alumno->subjects as $subject)
                                                <li>
                                                    <i class="bi bi-book-fill me-2"></i> 
                                                    <span class="badge bg-info text-dark">{{ $subject->name }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route("edit.alumno", $alumno->id) }}" class="btn btn-sm btn-warning" title="Editar alumno">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <form action="" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar a {{ $alumno->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar alumno">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($alumnos->isEmpty())
                <div class="alert alert-warning text-center mt-3">
                    No se encontraron alumnos registrados.
                </div>
            @endif
        </div>
    </div>
</div>

@endsection