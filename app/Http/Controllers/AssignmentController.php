<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\AssignmentPanel;
use App\Models\Panel;
use App\Models\Adviser;

class AssignmentController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'department' => 'required|string',
                'section' => 'required|string',
                'adviser_id' => 'required|integer',
                'panel_ids' => 'required|array',
                'panel_ids.*' => 'integer',
            ]);

            // Check if an assignment already exists for this department and section
            $existingAssignment = Assignment::where('department', $validated['department'])
                ->where('section', $validated['section'])
                ->first();

            if ($existingAssignment) {
                return response()->json([
                    'success' => false,
                    'error' => 'An adviser is already assigned to ' . $validated['department'] . ' section ' . $validated['section'] . '. Please choose a different section or update the existing assignment.'
                ]);
            }

            // ✅ 1. Create the main assignment
            $assignment = Assignment::create([
                'department' => $validated['department'],
                'section' => $validated['section'],
                'adviser_id' => $validated['adviser_id'],
            ]);

            // ✅ 2. Adviser is already linked via adviser_id in assignments table
            // No need to insert adviser into assignment_panels table

            // ✅ 3. Insert panel members into assignment_panels
            foreach ($validated['panel_ids'] as $panelId) {
                $panel = Panel::find($panelId);
                if ($panel) {
                    AssignmentPanel::create([
                        'assignment_id' => $assignment->id,
                        'panel_id' => $panelId,
                        'name' => $panel->name,
                        'availability' => is_array($panel->availability)
                            ? json_encode($panel->availability)
                            : $panel->availability,
                        'role' => 'chairperson',
                        'expertise' => $panel->expertise,
                        'department' => $validated['department'],
                        'section' => $validated['section'],
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Assignment finalized successfully!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }
    }

    public function destroy(Assignment $assignment)
    {
        try {
            // Delete related assignment panels first
            AssignmentPanel::where('assignment_id', $assignment->id)->delete();
            
            // Delete the assignment
            $assignment->delete();

            return response()->json([
                'success' => true,
                'message' => 'Assignment deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
