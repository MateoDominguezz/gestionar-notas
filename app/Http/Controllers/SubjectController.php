<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Http\Controllers\Response;
use App\Http\Requests\StoreSubjectRequest;
use Illuminate\Http\Request;


class SubjectController extends Controller
{
    public function index()
    {
        $materias = Subject::all();
        return view("materias.indexMaterias", compact("materias"));
    }

    public function view(Subject $materia)
    {
        return view("materias.idMateria", compact("materia"));
    }

    public function show ()
    {
        return view("materias.crearMateria");
    }


    public function create(StoreSubjectRequest $request)
    {
        Subject::create($request->validated());
        return redirect()->route("index.materias")->with("success", "Se pudo crear la materia correctamente");
    }
}


