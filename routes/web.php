<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

// Inicio
Route::get("/", [IndexController::class, "index"])->name("index");

//Alumnos
Route::get("/alumnos", [StudentController::class, "index"])->name("index.alumnos");
Route::get("alumnos/create", [StudentController::class, "create"])->name("create.alumno");
Route::post("alumnos/createAlumno", [StudentController::class, "store"])->name("store.alumno");
Route::get("alumnos/editAlumno/{id}", [StudentController::class, "edit"])->name("edit.alumno");

//Materia
Route::get("/materias", [SubjectController::class, "index"])->name("index.materias");
Route::get("/materia/crearMateria", [SubjectController::class, "show"])->name("show.materia");
Route::get("/materia/{materia}", [SubjectController::class, "view"])->name("view.materia");
Route::post("/materia/GuardarMateria", [SubjectController::class, "create"])->name("store.materia");
