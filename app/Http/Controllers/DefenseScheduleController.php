<?php

namespace App\Http\Controllers;

use App\Models\AssignmentPanel;
use App\Models\Assignment;
use App\Models\DefenseSchedule;
use Illuminate\Http\Request;

class DefenseScheduleController extends Controller
{
    public function index()
    {
        $departments = ['BSIT', 'CRIM', 'EDUC', 'BSBA', 'Psychology', 'BSHM', 'BSTM'];
        $clusters = [4101, 4102, 4103, 4104, 4105, 4106, 4107, 4108, 4109, 4110];
        $defenseTypes = ['PRE-ORAL', 'FINAL DEFENSE', 'REDEFENSE'];
        
        // Get assignments with adviser and panel data
        $assignments = Assignment::with(['adviser', 'assignmentPanels'])->get();
        
        return view('def-sched', compact('departments', 'clusters', 'defenseTypes', 'assignments'));
    }

    public function getData(Request $request)
    {
        $department = $request->get('department');
        $cluster = $request->get('cluster');
        $defenseType = $request->get('defense_type');
        
        // Get assignments for the specific department and cluster
        $assignments = Assignment::with(['adviser', 'assignmentPanels'])
            ->where('department', $department)
            ->where('section', $cluster)
            ->get();
            
        return response()->json(['assignments' => $assignments]);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'department' => 'required|string',
            'cluster' => 'required|integer',
            'group_id' => 'required|string',
            'defense_type' => 'required|string',
            'schedule_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'set_letter' => 'required|string|max:1',
            'adviser' => 'required|string',
            'chairperson' => 'required|string',
            'members' => 'required|string'
        ]);
        
        $schedule = DefenseSchedule::create($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Schedule created successfully',
            'schedule' => $schedule
        ]);
    }
    
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Passed,Failed'
        ]);
        
        $schedule = DefenseSchedule::findOrFail($id);
        $schedule->update(['status' => $validated['status']]);
        
        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    }
}
