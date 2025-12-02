@extends("layouts.app")
@section("content")

<button class="btn btn-success shadow-sm d-inline-flex align-items-center gap-2" 
        data-bs-toggle="modal" 
        data-bs-target="#modalNuevoAlumno">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
    </svg>
    <span>Nuevo Alumno</span>
</button>

<div class="modal fade" id="modalNuevoAlumno" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('materias.student.store', $materia->id) }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Inscribir Nuevo Alumno</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted small">Este alumno se creará y se asignará automáticamente a <strong>{{ $materia->name }}</strong>.</p>
                <div class="mb-3">
                    <label>Nombre Completo</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Guardar Alumno</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalNuevoAlumno" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #198754, #20c997);">
                <h5 class="modal-title fw-bold">
                    🎓 Inscribir Alumno
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('materias.student.store', $materia->id) }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="text-center mb-3">
                        <p class="text-muted small">
                            Se creará un nuevo alumno y se asignará automáticamente a la materia: <br>
                            <strong>{{ $materia->name }}</strong>
                        </p>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" 
                               class="form-control rounded-3" 
                               id="studentName" 
                               name="name" 
                               placeholder="Nombre del alumno" 
                               required 
                               autofocus>
                        <label for="studentName">Nombre y Apellido</label>
                    </div>
                </div>

                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-link text-secondary text-decoration-none" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success px-4 rounded-pill fw-bold shadow-sm">
                        Guardar e Inscribir
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection