<?php

namespace App\Http\Controllers;
use App\Models\Submission;
use App\Models\Committee;
use Illuminate\Http\Request;

class PanelAdviserController extends Controller
{
    public function index()
{
    $submissions = Submission::with('committee')->get();
    return view('panel-adviser', compact('submissions'));
}


    
    public function store(Request $request, $submissionId)
{
    $request->validate([
        'adviser_name' => 'required|string',
        'adviser_department' => 'nullable|string',
        'panel_names' => 'required|array|min:1',
        'panel_departments' => 'nullable|array',
    ]);

    // Adviser
    Committee::create([
        'submission_id' => $submissionId,
        'role' => 'Adviser',
        'name' => $request->adviser_name,
        'department' => $request->adviser_department,
    ]);

    // Panel Members
    foreach ($request->panel_names as $i => $panelName) {
        Committee::create([
            'submission_id' => $submissionId,
            'role' => 'Panel Member ' . ($i + 1),
            'name' => $panelName,
            'department' => $request->panel_departments[$i] ?? null,
        ]);
    }

    return redirect()->back()->with('success', 'Committee assigned successfully.');
}

    
}
