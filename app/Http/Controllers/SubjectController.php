<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Record;

class SubjectController extends Controller
{
    // --- PANTALLA 1: LISTADO DE MATERIAS ---
    
    public function index()
    {
        $materias = Subject::withCount('students')->get();
        return view('materias.index', compact('materias'));
    }

    public function store(Request $request)
    {
        // Crear Materia nueva desde el Modal del Index
        $request->validate([
            'name' => 'required', 
            'academic_year' => 'requiered'
        ]);

        Subject::create($request->all());
        return back()->with('success', '¡Materia creada!');
    }

    // --- PANTALLA 2: DENTRO DE LA MATERIA ---

    public function show($id)
    {
        $materia = Subject::with(['evaluations', 'students.records'])->findOrFail($id);
        return view('materias.show', compact('materia'));
    }

    // Crear Evaluación (Parcial, TP) dentro de la materia
    public function storeEvaluation(Request $request, $id)
    {
        $request->validate(['name' => 'required']);
        $materia = Subject::findOrFail($id);
        $materia->evaluations()->create(['name' => $request->name]);
        return back()->with('success', 'Evaluación agregada a la planilla.');
    }

    // Guardar las notas de la planilla
    public function updateGrades(Request $request, $id)
    {
        $notas = $request->input('notas', []);
        foreach ($notas as $studentId => $evaluaciones) {
            foreach ($evaluaciones as $evaluationId => $valorNota) {
                if ($valorNota === null) continue;
                Record::updateOrCreate(
                    ['id_student' => $studentId,
                    'id_evaluation' => $evaluationId],
                    ['note' => $valorNota]
                );
            }
        }
        return back()->with('success', 'Notas guardadas.');
    }

    public function storeStudent(Request $request, $id)
{
    // 1. Validamos que escribieron un nombre
    $request->validate([
        'name' => 'required|string|max:255'
    ]);

    // 2. Buscamos la materia actual
    $materia = Subject::findOrFail($id);

    // 3. Creamos el alumno en la base de datos
    $alumno = Student::create([
        'name' => $request->name
    ]);

    // 4. Lo vinculamos (inscribimos) en esta materia
    $materia->students()->attach($alumno->id, [
        'registration_date' => now()
    ]);

    // 5. Recargamos la página con un mensaje de éxito
    return back()->with('success', "El alumno {$alumno->name} ha sido inscrito correctamente.");
}
}

