<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;

class DefenseEvaluationController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with(['adviser', 'assignmentPanels'])->orderBy('created_at', 'desc')->get();
        return view('def-eval', compact('assignments'));
    }
}