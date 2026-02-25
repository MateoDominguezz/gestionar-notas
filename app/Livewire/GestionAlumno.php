<?php

namespace App\Livewire;

use App\Models\Inscription;
use App\Models\Student;
use App\Models\Subject;
use Livewire\Component;
use Livewire\WithPagination;

class GestionAlumno extends Component
{
    // Paginacion
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //Variables publicas
    public $nombre;
    public $id_materia;
    public $buscador = "";
    public $mostrarFormulario = false;

    // Funcion para mostrar el formulario
    public function verFormulario()
    {
        $this->mostrarFormulario = !$this->mostrarFormulario;
    }

    //Funcion de crear alumno con Materia
    public function crearAlumno()
    {
        $this->validate([
            "nombre" => "required|string|min:3|max:100",
            "id_materia" => "required|exists:subjects,id"
        ]);

        $alumno = Student::create([
            "name" => $this->nombre
        ]);


        Inscription::create([
            "student_id" => $alumno->id,
            "subject_id" => $this->id_materia,
            "registration_date" => now() 
        ]);

        $this->mostrarFormulario = false;
        $this->reset(["nombre", "id_materia"]);
        session()->flash("message", "Alumno inscripto con exito");
    }

    // Funcion para buscar Alumnos
    public function mostrarAlumnos()
    {
        return Student::query()
            ->where("name", "like", "%" . $this->buscador ."%")
            ->withCount("subjects")
            ->orderBy("name","asc")
            ->paginate(10);
    }

    //Funcion para resetear el buscador
    public function resetBuscador()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.gestion-alumno', [
            "alumnos" => $this->mostrarAlumnos(),
            "materias" =>Subject::OrderBy("name", "asc")->get()
        ]);
    }
}
