<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\DefenseEvaluation;

class DefenseEvaluationController extends Controller
{
    public function show()
    {
        return view('def-eval');
    }
    
    public function getAssignments(Request $request)
    {
        $assignments = Assignment::with(['adviser', 'assignmentPanels'])
            ->when($request->department, function($query, $department) {
                return $query->where('department', $department);
            })
            ->when($request->section, function($query, $section) {
                return $query->where('section', $section);
            })
            ->get()
            ->map(function($assignment) {
                return [
                    'id' => $assignment->id,
                    'department' => $assignment->department,
                    'section' => $assignment->section,
                    'adviser' => $assignment->adviser ? $assignment->adviser->name : 'No Adviser',
                    'panels' => $assignment->assignmentPanels->map(function($panel) {
                        return [
                            'name' => $panel->name,
                            'role' => $panel->role
                        ];
                    })
                ];
            });
            
        return response()->json($assignments);
    }
    
    public function saveEvaluation(Request $request)
    {
        $validated = $request->validate([
            'department' => 'required|string',
            'cluster' => 'required|string',
            'group_id' => 'required|string',
            'defense_type' => 'required|in:PRE-ORAL,FINAL DEFENSE,REDEFENSE',
            'redefense_type' => 'nullable|in:PRE-ORAL,FINAL DEFENSE',
            'result' => 'required|in:Passed,Redefense,Failed,Feedback',
            'feedback' => 'nullable|string'
        ]);
        
        // For feedback-only entries, don't create duplicate evaluation records
        if ($validated['result'] === 'Feedback') {
            // Find existing evaluation record and update feedback
            $existing = DefenseEvaluation::where('department', $validated['department'])
                ->where('cluster', $validated['cluster'])
                ->where('group_id', $validated['group_id'])
                ->where('defense_type', $validated['defense_type'])
                ->where('redefense_type', $validated['redefense_type'])
                ->latest()
                ->first();
                
            if ($existing) {
                $existing->update(['feedback' => $validated['feedback']]);
            } else {
                // Create new record if no existing evaluation
                DefenseEvaluation::create($validated);
            }
        } else {
            DefenseEvaluation::create($validated);
        }
        
        return response()->json(['success' => true]);
    }
    
    public function getGroupStatus(Request $request)
    {
        $department = $request->get('department');
        $cluster = $request->get('cluster');
        $groupId = $request->get('group_id');
        $defenseType = $request->get('defense_type');
        $result = $request->get('result');
        
        if ($defenseType && $result === 'Redefense') {
            $groups = DefenseEvaluation::where('department', $department)
                ->where('cluster', $cluster)
                ->where('defense_type', $defenseType)
                ->where('result', 'Redefense')
                ->select('group_id')
                ->distinct()
                ->get()
                ->map(function($evaluation) {
                    return ['group_id' => $evaluation->group_id];
                });
                
            return response()->json(['groups' => $groups]);
        }
        
        if ($groupId) {
            $evaluations = DefenseEvaluation::getGroupStatus($department, $cluster, $groupId);
            return response()->json($evaluations);
        }
        
        return response()->json([]);
    }
}