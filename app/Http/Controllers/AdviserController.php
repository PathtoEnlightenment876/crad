<?php

namespace App\Http\Controllers;

use App\Models\Adviser;
use App\Models\Panel;
use App\Models\Submission;
use Illuminate\Http\Request;

class AdviserController extends Controller
{

    public function index()
    {
        $advisers = Adviser::whereNull('deleted_at')->get();
        $panels = Panel::whereNull('deleted_at')->get();
        $submissions = Submission::all();
    
        // Track assignments counts
        $adviserCounts = $advisers->pluck('id')->mapWithKeys(fn($id) => [$id => 0])->toArray();
        $panelCounts = $panels->pluck('id')->mapWithKeys(fn($id) => [$id => 0])->toArray();
    
        foreach ($submissions as $submission) {
            // --- Auto-assign Adviser ---
            $matchingAdvisers = $advisers->filter(function($adviser) use ($submission) {
                $sections = explode(',', $adviser->sections ?? '');
                return in_array($submission->section, $sections);
            });
    
            if ($matchingAdvisers->isNotEmpty()) {
                // Pick adviser with least assignments
                $assignedAdviser = $matchingAdvisers->sortBy(fn($a) => $adviserCounts[$a->id])->first();
                $submission->assigned_adviser_id = $assignedAdviser->id;
                $adviserCounts[$assignedAdviser->id]++;
            }
    
            // --- Auto-assign Panel ---
            $matchingPanels = $panels->filter(function($panel) use ($submission) {
                $expertises = explode(',', $panel->expertise ?? '');
                return in_array($submission->field, $expertises); // field = submission topic
            });
    
            if ($matchingPanels->isNotEmpty()) {
                // Pick panel with least assignments
                $assignedPanel = $matchingPanels->sortBy(fn($p) => $panelCounts[$p->id])->first();
                $submission->assigned_panel_id = $assignedPanel->id;
                $panelCounts[$assignedPanel->id]++;
            }
        }
    
        return view('panel-adviser', compact('advisers', 'panels', 'submissions'));
    }
        public function store(Request $request) {
        Adviser::create($request->all());
        return back()->with('success', 'Adviser added successfully.');
    }

    public function update(Request $request, $id)
{
    $adviser = Adviser::findOrFail($id);
    
    $adviser->department = $request->department;
    $adviser->name = $request->name;
    $adviser->expertise = $request->expertise;
    $adviser->sections = $request->sections ?? [];
    $adviser->save();
    
    return redirect('/panel-adviser')->with('success', 'Adviser updated successfully.');
}


    public function getAdvisersByDepartment($department)
    {
        $advisers = Adviser::where('department', $department)->get();
        return response()->json($advisers);
    }

    public function destroy(Adviser $adviser)
    {
        try {
            $adviser->delete();
            return response()->json([
                'success' => true,
                'message' => 'Adviser deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete adviser: ' . $e->getMessage()
            ], 500);
        }
    }

    public function archived()
    {
        $archivedAdvisers = Adviser::onlyTrashed()->get();
        return response()->json($archivedAdvisers);
    }

    public function restore($id)
    {
        try {
            $adviser = Adviser::onlyTrashed()->findOrFail($id);
            $adviser->restore();
            return response()->json([
                'success' => true,
                'message' => 'Adviser restored successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to restore adviser: ' . $e->getMessage()
            ], 500);
        }
    }

    public function forceDelete($id)
    {
        try {
            $adviser = Adviser::onlyTrashed()->findOrFail($id);
            $adviser->forceDelete();
            return response()->json([
                'success' => true,
                'message' => 'Adviser permanently deleted'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to permanently delete adviser: ' . $e->getMessage()
            ], 500);
        }
    }
    
}