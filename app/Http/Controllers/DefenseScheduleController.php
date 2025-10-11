<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\DefenseSchedule;
use Illuminate\Http\Request;

class DefenseScheduleController extends Controller
{
    public function index()
    {
        try {
            $assignments = Assignment::with(['adviser', 'assignmentPanels'])->get();
            $defenseSchedules = DefenseSchedule::with('assignment.adviser', 'assignment.assignmentPanels')->get();
            
            // If no assignments exist, create some test data (only once)
            if ($assignments->count() === 0) {
                $this->createTestData();
                $assignments = Assignment::with(['adviser', 'assignmentPanels'])->get();
            }
            
            return view('def-sched', compact('assignments', 'defenseSchedules'));
        } catch (\Exception $e) {
            \Log::error('DefenseScheduleController index error: ' . $e->getMessage());
            return view('def-sched', ['assignments' => collect(), 'defenseSchedules' => collect()]);
        }
    }
    
    private function createTestData()
    {
        try {
            // Check if test data already exists
            if (Assignment::count() > 0) {
                return;
            }
            
            // Create test advisers
            $adviser1 = \App\Models\Adviser::firstOrCreate(
                ['name' => 'Dr. Smith', 'department' => 'BSIT'],
                ['expertise' => 'Software Engineering', 'sections' => ['4101', '4102']]
            );
            
            // Create test assignments (limit to 2 for performance)
            $assignment1 = Assignment::firstOrCreate([
                'department' => 'BSIT',
                'section' => '4101',
                'adviser_id' => $adviser1->id
            ]);
            
            // Create panel members for assignment
            \App\Models\AssignmentPanel::firstOrCreate([
                'assignment_id' => $assignment1->id,
                'name' => 'Dr. Elacion',
                'role' => 'Chairperson'
            ]);
            
            \App\Models\AssignmentPanel::firstOrCreate([
                'assignment_id' => $assignment1->id,
                'name' => 'Mr. Constantino', 
                'role' => 'Member'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error creating test data: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'department' => 'required|string',
                'section' => 'required|string', 
                'group_id' => 'required|string',
                'defense_type' => 'required|in:PRE-ORAL,FINAL DEFENSE,REDEFENSE',
                'assignment_id' => 'required|exists:assignments,id',
                'defense_date' => 'required|date',
                'start_time' => 'required',
                'end_time' => 'required',
                'set_letter' => 'required|string|max:1',
                'panel_data' => 'nullable'
            ]);

            DefenseSchedule::create($validated);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 422);
        }
    }

    public function update(Request $request, DefenseSchedule $defenseSchedule)
    {
        $request->validate([
            'status' => 'required|in:Pending,Scheduled,Passed,Failed,Re-defense'
        ]);

        $defenseSchedule->update($request->only('status'));

        // Handle status changes
        if ($request->status === 'Passed' && $defenseSchedule->defense_type === 'PRE-ORAL') {
            // Check if FINAL DEFENSE already exists for this group
            $existingFinalDefense = DefenseSchedule::where([
                'department' => $defenseSchedule->department,
                'section' => $defenseSchedule->section,
                'group_id' => $defenseSchedule->group_id,
                'defense_type' => 'FINAL DEFENSE'
            ])->first();
            
            // Create FINAL DEFENSE only if it doesn't exist
            if (!$existingFinalDefense) {
                DefenseSchedule::create([
                    'department' => $defenseSchedule->department,
                    'section' => $defenseSchedule->section,
                    'group_id' => $defenseSchedule->group_id,
                    'defense_type' => 'FINAL DEFENSE',
                    'assignment_id' => $defenseSchedule->assignment_id,
                    'panel_data' => $defenseSchedule->panel_data,
                    'set_letter' => $defenseSchedule->set_letter,
                    'status' => 'Pending'
                ]);
            }
        } elseif ($request->status === 'Re-defense') {
            // Move to REDEFENSE
            DefenseSchedule::create([
                'department' => $defenseSchedule->department,
                'section' => $defenseSchedule->section,
                'group_id' => $defenseSchedule->group_id,
                'defense_type' => 'REDEFENSE',
                'original_defense_type' => $defenseSchedule->defense_type,
                'assignment_id' => $defenseSchedule->assignment_id,
                'panel_data' => $defenseSchedule->panel_data,
                'set_letter' => $defenseSchedule->set_letter,
                'status' => 'Pending'
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function getByType(Request $request)
    {
        $query = DefenseSchedule::with('assignment.adviser', 'assignment.assignmentPanels')
            ->where('defense_type', $request->defense_type);

        if ($request->department) {
            $query->where('department', $request->department);
        }

        if ($request->section) {
            $query->where('section', $request->section);
        }

        if ($request->defense_type === 'REDEFENSE' && $request->original_defense_type) {
            $query->where('original_defense_type', $request->original_defense_type);
        }

        $schedules = $query->get();

        return response()->json($schedules);
    }
}