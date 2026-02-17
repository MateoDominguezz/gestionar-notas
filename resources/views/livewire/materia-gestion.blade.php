<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('index.materias') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
            <h2 class="fw-bold text-primary mb-0">
                <i class="bi bi-journal-bookmark-fill"></i> Gestionando: {{ $materia->name }}
            </h2>
        </div>
        
    
        <span class="badge bg-primary rounded-pill px-3 py-2">
            {{ now()->format('d/m/Y') }}
        </span>
    </div>

    <div class="row g-3 mb-5">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body bg-light rounded">
                    <h6 class="card-subtitle mb-2 text-muted">Registro de Alumnos</h6>
                    <div class="input-group">
                        <input type="text" class="form-control" wire:model="nombreAlumno" placeholder="Nombre del nuevo alumno">
                        <button class="btn btn-primary" type="button" wire:click="agregarAlumno">
                            <i class="bi bi-person-plus"></i> Inscribir
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body bg-light rounded">
                    <h6 class="card-subtitle mb-2 text-muted">Creacion de Evaluaciones</h6>
                    <div class="input-group">
                        <input type="text" class="form-control" wire:model="nombreEvaluacion" placeholder="Nombre de la evaluacion (Ej: Parcial 1)">
                        <button class="btn btn-success" type="button" wire:click="agregarEvaluacion">
                            <i class="bi bi-file-earmark-plus"></i> Crear Evaluacion
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Buscador -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 10px;">
                <div class="card-body">
                    <label class="form-label fw-bold text-primary small mb-2">
                        <i class="bi bi-search me-1"></i> BUSCADOR DE ALUMNOS
                    </label>
                    
                    <div class="input-group">
                        <input type="text" 
                               class="form-control bg-light border-0" 
                               placeholder="Ingresa el nombre del alumno para ver en la tabla" 
                               wire:model.live.debounce.300ms="buscador"
                               style="padding: 12px;">
                        
                        @if($buscador)
                            <button class="btn btn-light border-0 text-danger" type="button" wire:click="$set('buscador', '')">
                                <i class="bi bi-x-circle-fill"></i> Limpiar
                            </button>
                        @endif
                    </div>
                
                    <div wire:loading wire:target="buscador" class="mt-2">
                        <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                        <small class="text-muted ms-1">Buscando...</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Planilla de Calificaciones</h5>
        </div>
        <div class="card-body p-0">
            <!-- Tabla-->
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle text-center">
                    <!-- Encabezado de la tabla -->
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4 text-start" style="width: 250px;">Nombre del Alumno</th>
                            @foreach($evaluaciones as $eval)
                                <th class="text-center eval-header">
                                    <!-- Boton para eliminar evaluacion-->
                                    <button 
                                        type="button"
                                        class="btn-delete-eval" 
                                        wire:click="eliminarEvaluacion({{ $eval->id }})"
                                        onclick="confirm('Estas seguro de eliminar la evaluacion: {{ $eval->name }}') || event.stopImmediatePropagation()"
                                        title="Eliminar">
                                        <i class="bi bi-x-circle-fill"></i>
                                    </button>
                                    <span class="fw-bold text-dark text-uppercase small" style="letter-spacing: 0.5px;">
                                        {{ $eval->name }}
                                    </span>
                                </th>
                            @endforeach
                            <th class="bg-primary text-white" style="width: 120px;">Promedio</th>
                        </tr>
                    </thead>
                    <!-- Cuerpo de la tabla -->
                    <tbody>
                        @foreach($alumnos as $alumno)
                            <tr wire:key="alumno-{{ $alumno->id }}">
                                <td class="ps-4 text-start fw-medium text-secondary student-cell">
                                    <!-- Boton de eliminacion Alumno -->
                                    <button 
                                        type="button" 
                                        class="btn btn-sm btn-link text-danger p-0 btn-delete-student"
                                        wire:click="eliminarAlumno({{ $alumno->id }})"
                                        onclick="confirm('¿Quitar a {{ $alumno->name }}?') || event.stopImmediatePropagation()">
                                        <i class="bi bi-x-circle-fill"></i>
                                    </button>
                                    <!-- Nombre del alumno-->
                                    <span class="student-name">{{ $alumno->name }}</span>
                                </td>
                            
                                <!-- Evaluaciones -->
                                @foreach($evaluaciones as $eval)
                                    <td wire:key="nota-{{ $alumno->id }}-{{ $eval->id }}">
                                        @php
                                            $record = $alumno->records->where('student_evaluation', $eval->id)->first();
                                        @endphp
                                        <div class="d-flex justify-content-center">
                                            <input type="number" 
                                                class="form-control text-center shadow-sm"
                                                value="{{ $record->note ?? '' }}" 
                                                wire:change="guardarNotas({{ $alumno->id }}, {{ $eval->id }}, $event.target.value)"
                                                style="width: 70px; border-radius: 8px;"
                                                min="0" max="10" step="0.1">
                                        </div>
                                    </td>
                                @endforeach
                                
                                <td class="fw-bold bg-light {{ ($alumno->records->avg('note') < 7) ? 'text-danger' : 'text-primary' }}">
                                    {{ $alumno->records->count() > 0 ? number_format($alumno->records->avg('note'), 2) : '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    <!--Footer de la tabla-->
                    <tfoot class="table-dark">
                        <tr>
                            <td colspan="{{ count($evaluaciones) + 1 }}" class="text-end pe-4 fw-bold">          
                            </td>
                            <!-- Promedio General-->
                            <td class="bg-warning text-dark fw-bolder">
                                {{ $promedioGeneral ? number_format($promedioGeneral, 2) : '0.00' }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Paginacion -->
    <div class="mt-2 d-flex justify-content-between align-items-center bg-light p-3 rounded shadow-sm">
        <div class="text-muted small">
            Mostrando <strong>{{ $alumnos->firstItem() }}</strong> a <strong>{{ $alumnos->lastItem() }}</strong> de <strong>{{ $alumnos->total() }}</strong> alumnos
        </div>
        <div class="pagination-sm">
            {{ $alumnos->links() }}
        </div>
    </div>







<style>
    .student-cell {
        position: relative;
    }
    .btn-delete-student {
        position: absolute;
        left: 5px; /* Pegado al borde izquierdo */
        top: 50%;
        transform: translateY(-50%);
        opacity: 0;
        transition: all 0.2s ease;
    }
    tr:hover .btn-delete-student {
        opacity: 1;
    }
    /* Añadimos un pequeño margen al nombre para que no lo tape el botón al aparecer */
    tr:hover .student-name {
        margin-left: 25px;
        transition: all 0.2s ease;
    }
    /* El contenedor del encabezado */
    .eval-header {
        position: relative;
        padding: 15px 10px !important;
    }
    /* El botón de borrar (flotante) */
    .btn-delete-eval {
        position: absolute;
        top: 2px;
        right: 2px;
        opacity: 0;
        transition: opacity 0.2s ease-in-out;
        color: #dc3545;
        background: none;
        border: none;
    }
    /* Solo se ve al pasar el mouse por la celda */
    .eval-header:hover .btn-delete-eval {
        opacity: 1;
    }
    /* Efecto al pasar el mouse por el tachito */
    .btn-delete-eval:hover {
        color: #a71d2a;
        transform: scale(1.1);
    }
</style>
</div>
