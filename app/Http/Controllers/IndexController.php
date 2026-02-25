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
        $alumnos = Student::count();
        $materias = Subject::count();
        $notas = Record::whereHas("evaluation.subject")->avg("note") ?? 0;
        return view("index", compact(["materias", "alumnos", "notas"]));
    }
}
