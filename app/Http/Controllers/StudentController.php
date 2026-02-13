<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnos = Student::with(["inscriptions","records","evaluations", "subjects"])->get();
        return view("alumnos.indexAlumnos", compact("alumnos"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("alumnos.createAlumno");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        Student::create($request->validated());
        return redirect()->route("index.alumnos")->with("success", "Se pudo insertar el alumno correctamente");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $alumno = Student::find($id);
        return view("alumnos.editAlumno", compact("alumno"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreStudentRequest $request, Student $student)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
