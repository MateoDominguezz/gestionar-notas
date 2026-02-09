<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

// Inicio
Route::get("/", [IndexController::class, "index"])->name("index");

// Materias
Route::get("/materias", [SubjectController::class, "index"])->name("index.materias");

//Alumnos
Route::get("/alumnos", [StudentController::class, "index"])->name("index.alumnos");
