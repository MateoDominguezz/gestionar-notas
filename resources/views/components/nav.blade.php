<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top custom-nav">
    <div class="container">
        <!-- Logo -->
        <a href="{{ route('index') }}" class="navbar-brand d-flex align-items-center text-decoration-none">
            <div class="d-flex flex-column justify-content-center">
                <span class="fs-5 fw-bolder text-dark lh-1 mb-1">
                    JUAN<span class="text-primary">NOTAS</span>
                </span>
                <span class="badge bg-light text-secondary border fw-normal p-1" style="font-size: 0.65rem; letter-spacing: 0.5px;">
                    GESTION ACADEMICA
                </span>
            </div>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navModern">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navModern">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-3">
                <li class="nav-item">
                    <a class="nav-link nav-custom-link active" href="{{ route("index") }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-custom-link active" href="{{ route("index.materias") }}">Cursos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-custom-link active" href="{{ route("index.alumnos") }}">Alumnos</a>
                </li>
            </ul>
        </div>
    </div>
</nav>