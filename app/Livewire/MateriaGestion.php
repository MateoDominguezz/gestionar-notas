<?php

namespace App\Livewire;

use App\Models\Evaluation;
use App\Models\Inscription;
use App\Models\Record;
use App\Models\Student;
use App\Models\Subject;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class MateriaGestion extends Component
{
    // Paginacion
    use WithPagination;

    // Variables Publicas
    public Subject $materia;
    public $nombreAlumno;
    public $nombreEvaluacion;
    public $alumnoPromedio;
    public $buscador = "";
    protected $paginationTheme = "bootstrap";


    // Funcion para crear alumnos
    public function agregarAlumno()
    {
        $alumno = Student::create(["name"=> $this->nombreAlumno]);

        Inscription::create([
            "student_id" => $alumno->id,
            "subject_id" => $this->materia->id,
            "registration_date" => now()

        ]);

        $this->reset("nombreAlumno");
    }


    // Funcion para agregar evaluaciones
    public function agregarEvaluacion()
    {
        Evaluation::create([
            "subject_id" => $this->materia->id,
            "name" => $this->nombreEvaluacion
        ]);

        $this->reset("nombreEvaluacion");
    }

    public function updatingBuscador()
    {
        $this->resetPage();
    }    

    // Funcion para buscar alumno
    public function getAlumno()
    {
        return Student::with("subjects")
            ->where("name", "like", "%" . $this->buscador ."%")
            ->has("subjects")
            ->paginate(10);
    }

    // Funcion para guardar o editar notas
    public function guardarNotas($id_alumno, $id_evaluacion, $valor_nota)
    {
        if(!is_numeric($valor_nota) || $valor_nota < 0 || $valor_nota > 10){
            return;
        }

        Record::updateOrCreate(
            ["student_id" => $id_alumno, "student_evaluation" => $id_evaluacion],
            ["note" => $valor_nota]
        );

        $this->materia->load("evaluations", "students.records");
    }

    // Funcion para ver todos los alumnos inscriptos
    public function alumnosInscriptos()
    {
        $idMateria = $this->materia->id;
        $evaluacionIds = Evaluation::where("subject_id", $idMateria)->pluck("id");

        return Student::whereHas("inscriptions", function($q) use ($idMateria) {
                $q->where("subject_id", $idMateria);
            })
            ->where("name", "like", "%" . $this->buscador . "%")
            ->with(["records" => function($q) use ($evaluacionIds) {
                $q->whereIn("student_evaluation", $evaluacionIds);
            }])
            ->paginate(10);
    }

    public function evaluaciones()
    {
        return $this->materia->evaluations;
    }    

    // Funcion para el promedio del alumno
    public function promedioAlumno($alumnoId)
    {
        return Record::where("student_id", $alumnoId)
                    ->whereIn("student_evaluation", $this->materia->evaluations->pluck("id"))
                    ->avg("note");
    }

    // Funcion para eliminar una nota
    public function eliminarEvaluacion($id)
    {
        $evaluacion = Evaluation::find($id);
        if($evaluacion){
            Record::where("student_evaluation", $id)->delete();
            $evaluacion->delete();
            session()->flash("message", "Evaluacion eliminada con exito");
        }
    }

    // Funcion para eliminar un alumno
    public function eliminarAlumno($id)
    {
    Inscription::where('subject_id', $this->materia->id)
               ->where('student_id', $id)
               ->delete();

    $evaluacionIds = $this->materia->evaluations->pluck('id');
    
    Record::where('student_id', $id)
          ->whereIn('student_evaluation', $evaluacionIds)
          ->delete();
    }

    // Funcion para el promedio general
    public function promedioGeneral()
    {
        $evaluacionIds = $this->materia->evaluations->pluck("id");
        $idsAlumnosMateria = Inscription::where("subject_id", $this->materia->id)->pluck("student_id");

        return Record::whereIn("student_evaluation", $evaluacionIds)
                     ->whereIn("student_id", $idsAlumnosMateria)
                     ->avg("note");
    }    

    // Funcion para eliminar Materia
    public function eliminarMateria($id)
    {
        $materia = Subject::findOrFail($id);
        Inscription::where("subject_id", $id)->delete();
        Evaluation::where("subject_id", $id)->delete();
            
        $materia->delete();

        return redirect()->route("index.materias")->with("message", "Materia eliminada correctamente");

        
    }

    public function render()
    {
    return view('livewire.materia-gestion', [
        "alumnos" => $this->alumnosInscriptos(),
        "evaluaciones" => $this->evaluaciones(),
        "promedioGeneral" => $this->promedioGeneral()
    ]);
    }}