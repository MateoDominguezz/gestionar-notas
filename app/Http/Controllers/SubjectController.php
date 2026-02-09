<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use Illuminate\Http\Request;
 

class SubjectController extends Controller
{
    public function index()
    {
        $materias = Subject::all();
        return view("materias.indexMaterias", compact("materias"));
    }
}


