<?php

namespace App\Livewire;

use App\Models\Evaluation;
use App\Models\Inscription;
use App\Models\Record;
use App\Models\Student;
use App\Models\Subject;
use Livewire\Component;
use Livewire\WithPagination;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use PhpParser\Node\Expr\Eval_;

class MateriaGestion extends Component
{
    use WithPagination;

    public Subject $materia;
    public $nombreAlumno;
    public $nombreEvaluacion;
    public $alumnoPromedio;
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


    public function render()
    {
    $evaluaciones = $this->materia->evaluations; 
    $evaluacionIds = $evaluaciones->pluck("id");

    $idsAlumnosMateria = Inscription::where("subject_id", $this->materia->id)
                                    ->pluck("student_id");    

    $alumnosInscriptos = Student::whereHas("inscriptions", function($e) {
            $e->where("subject_id", $this->materia->id);
        })
        ->with(["records" => function($e) use ($evaluacionIds) {
            $e->whereIn("student_evaluation", $evaluacionIds);
        }])
        ->paginate(10);

    $promedioGeneral = Record::whereIn("student_evaluation", $evaluacionIds)
                             ->whereIn("student_id", $idsAlumnosMateria)
                             ->avg("note");

    return view('livewire.materia-gestion', [
        "alumnos" => $alumnosInscriptos,
        "evaluaciones" => $evaluaciones,
        "promedioGeneral" => $promedioGeneral
    ]);
    }}