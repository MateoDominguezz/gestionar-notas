<?php

use App\Http\Controllers\SubjectController;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Facades\Route;

Route::view("/", "inicio")->name("index");
Route::resource("/materias", SubjectController::class);
Route::post('/materias/{materia}/alumno', [SubjectController::class, 'storeStudent'])
    ->name('materias.student.store');

//Route::resource("/materia", [SubjectController::class]);
