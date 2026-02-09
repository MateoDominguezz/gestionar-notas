<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $alumnos = Student::all()->count("id");
        $materias = Subject::all()->count("id");
        $notas = Record::all()->avg("note");
        return view("index", compact(["materias", "alumnos", "notas"]));
    }
}
