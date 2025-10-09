<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adviser;
use App\Models\Panel;
use App\Models\Assignment;

class Controller extends \Illuminate\Routing\Controller
{
    public function index()
    {
        $advisers = Adviser::all(); // get all advisers
        $panels = Panel::all();     // get all panels
        return view('assignments.index', compact('advisers', 'panels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department' => 'required|string',
            'section' => 'required|string',
            'adviser' => 'required|string',
            'panels' => 'required|array',
        ]);

        Assignment::create([
            'department' => $validated['department'],
            'section' => $validated['section'],
            'adviser' => $validated['adviser'],
            'panels' => json_encode($validated['panels']),
        ]);

        return response()->json(['success' => true, 'message' => 'Assignment finalized!']);
    }
}
