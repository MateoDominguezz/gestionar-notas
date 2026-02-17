<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <!-- Mensajes personalizados -->
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Buscador y Boton de Formulario -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <h2 class="mb-0 fw-bold">Alumnos</h2>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                                <input type="text" class="form-control border-start-0" 
                                       placeholder="Buscar por nombre" 
                                       wire:model.live="buscador">
                            </div>
                        </div>
                        <div class="col-md-3 text-end">
                            <button wire:click="verFormulario" class="btn {{ $mostrarFormulario ? 'btn-danger' : 'btn-primary' }} w-100">
                                <i class="bi {{ $mostrarFormulario ? 'bi-x-lg' : 'bi-person-plus-fill' }} me-2"></i>
                                {{ $mostrarFormulario ? 'Cancelar' : 'Nuevo Alumno' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario de inscripcion -->
            @if($mostrarFormulario)
                <div class="card shadow-sm border-primary mb-4 animate__animated animate__fadeInDown">
                    <div class="card-body bg-light">
                        <form wire:submit.prevent="crearAlumno" class="row g-3">
                            <div class="col-md-5">
                                <label class="form-label fw-bold small text-uppercase text-muted">Nombre Completo</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" wire:model="nombre">
                                @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-bold small text-uppercase text-muted">Materia</label>
                                <select class="form-select @error('id_materia') is-invalid @enderror" wire:model="id_materia">
                                    <option value="">Seleccionar...</option>
                                    @foreach($materias as $materia)
                                        <option value="{{ $materia->id }}">{{ $materia->name }}</option>
                                    @endforeach
                                </select>
                                @error('id_materia') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-success w-100">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            <!-- Tabla -->
            <div class="table-responsive shadow-sm rounded border">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 10%;">ID</th>
                            <th style="width: 30%;">Nombre Completo</th>
                            <th style="width: 40%;">Materias</th>
                            <th style="width: 20%;" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($alumnos as $alumno)
                            <tr wire:key="alumno-{{ $alumno->id }}">
                                <td class="fw-bold">{{ $alumno->id }}</td>
                                <td class="fw-bold">{{ $alumno->name }}</td>
                                <td>
                                    @foreach ($alumno->subjects as $subject)
                                        <span class="badge bg-info text-dark">{{ $subject->name }}</span>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">No se encontraron alumnos.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginacion -->
            <div class="mt-4">
                {{ $alumnos->links() }}
            </div>

        </div>
    </div>
</div>