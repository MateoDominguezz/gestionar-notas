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
            <div class="card shadow-sm border-0 mb-4 bg-white" style="border-radius: 15px;">
                <div class="card-body p-3">
                    <div class="row align-items-center g-3">

                        <div class="col-md-4">
                            <div class="d-flex align-items-center ps-2">
                                <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                                    <i class="bi bi-people-fill text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h4 class="mb-0 fw-bold text-dark">Alumnos</h4>
                                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.7rem; letter-spacing: 1px;">Listado General</small>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-md-5">
                            <div class="input-group input-group-lg shadow-none">
                                <span class="input-group-text bg-light border-0 ps-3" style="border-radius: 12px 0 0 12px;">
                                    <i class="bi bi-search text-primary"></i>
                                </span>
                                <input type="text" 
                                       class="form-control bg-light border-0 fs-6" 
                                       placeholder="Escribe un nombre para buscar..." 
                                       style="border-radius: 0 12px 12px 0; height: 50px;"
                                       wire:model.live.debounce.300ms="buscador">
                            </div>
                        </div>
                    
                        <div class="col-md-3">
                            <button wire:click="verFormulario" 
                                    class="btn {{ $mostrarFormulario ? 'btn-outline-danger' : 'btn-primary' }} w-100 d-flex align-items-center justify-content-center shadow-sm" 
                                    style="height: 50px; border-radius: 12px; transition: all 0.3s ease;">
                                <i class="bi {{ $mostrarFormulario ? 'bi-x-lg' : 'bi-person-plus-fill' }} fs-5 me-2"></i>
                                <span class="fw-bold">{{ $mostrarFormulario ? 'Cancelar' : 'Nuevo Alumno' }}</span>
                            </button>
                        </div>
                    
                    </div>
                </div>
            </div>

            <!-- Formulario de inscripcion -->
            @if($mostrarFormulario)
                <div class="card shadow border-0 mb-4 overflow-hidden animate__animated animate__fadeInDown">
                    <div class="bg-success" style="height: 4px;"></div>

                    <div class="card-body bg-white p-4">
                        <div class="d-flex align-items-center mb-3 text-success">
                            <i class="bi bi-person-plus-fill fs-4 me-2"></i>
                            <h5 class="card-title mb-0 fw-bold">Inscripcion a Alumno</h5>
                        </div>
                    
                        <form wire:submit.prevent="crearAlumno" class="row g-3">
                            <div class="col-md-5">
                                <label class="form-label small fw-bold text-muted text-uppercase">Datos del Estudiante</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-person-circle text-muted"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control bg-light border-start-0 ps-0 @error('nombre') is-invalid @enderror" 
                                           wire:model="nombre" 
                                           placeholder="Nombre y Apellido">
                                    @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        
                            <div class="col-md-5">
                                <label class="form-label small fw-bold text-muted text-uppercase">Materia a Asignar</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-book text-muted"></i>
                                    </span>
                                    <select class="form-select bg-light border-start-0 ps-0 @error('id_materia') is-invalid @enderror" 
                                            wire:model="id_materia">
                                        <option value="">Selecciona una opción...</option>
                                        @foreach($materias as $materia)
                                            <option value="{{ $materia->id }}">{{ $materia->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_materia') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-success w-100 fw-bold shadow-sm py-2">
                                    <i class="bi bi-check-lg me-1"></i> Confirmar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            <!-- Tabla -->
            <div class="card shadow-sm border-0" style="border-radius: 15px; overflow: hidden;">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted">
                            <tr>
                                <th class="border-0 ps-4 py-3 text-uppercase small fw-bold" style="width: 10%;">ID</th>
                                <th class="border-0 py-3 text-uppercase small fw-bold" style="width: 35%;">Nombre Completo</th>
                                <th class="border-0 py-3 text-uppercase small fw-bold" style="width: 35%;">Materias</th>
                                <th class="border-0 py-3 text-center text-uppercase small fw-bold" style="width: 20%;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @forelse ($alumnos as $alumno)
                                <tr wire:key="alumno-{{ $alumno->id }}" class="transition-all">
                                    <td class="ps-4">
                                        <span class="text-secondary fw-bold">{{ $alumno->id }}</span>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 0.8rem;">
                                                {{ strtoupper(substr($alumno->name, 0, 1)) }}
                                            </div>
                                            <span class="fw-bold text-dark">{{ $alumno->name }}</span>
                                        </div>
                                    </td>
                                
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            @foreach ($alumno->subjects as $subject)
                                                <span class="badge rounded-pill bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-3 py-2">
                                                    <i class="bi bi-book-half me-1"></i>{{ $subject->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <button class="btn btn-sm btn-light border shadow-sm text-warning" title="Editar">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button class="btn btn-sm btn-light border shadow-sm text-danger" title="Eliminar">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <i class="bi bi-emoji-frown fs-1 text-muted"></i>
                                        <p class="mt-2 text-muted fw-bold">No se encontraron alumnos registrados.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-between align-items-center px-2">
                <small class="text-muted fw-bold text-uppercase" style="font-size: 0.75rem;">
                    Mostrando {{ $alumnos->count() }} de {{ $alumnos->total() }} registros
                </small>
                <div>
                    {{ $alumnos->links() }}
                </div>
            </div>

        </div>
    </div>
</div>