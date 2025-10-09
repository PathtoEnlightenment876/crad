<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Panel;
use App\Models\Adviser;

class PanelAdviserController extends Controller
{
    public function showPanelAdviserPage()
    {
        $advisers = Adviser::all();
        $panels = Panel::all();
        $assignments = Assignment::with(['adviser', 'assignmentPanels'])->orderBy('created_at', 'desc')->get();
        
        return view('panel-adviser', compact('advisers', 'panels', 'assignments'));
    }

    public function apiAssignments(Request $request)
    {
        // Adjust query if you want to filter by department/section via query params.
        $assignments = Assignment::with('adviser')->orderBy('created_at', 'desc')->get();

        $payload = $assignments->map(function ($a) {
            // Ensure panel_ids is an array
            $ids = $a->panel_ids;
            if (is_string($ids)) {
                $ids = json_decode($ids, true) ?: [];
            }
            $ids = is_array($ids) ? $ids : [];

            // Retrieve panels
            $panels = Panel::whereIn('id', $ids)->orderBy('name')->get()->map(function ($p) {
                // Try to decode availability if it's JSON
                $availability = $p->availability;
                if (is_string($availability)) {
                    $decoded = json_decode($availability, true);
                    $availability = is_array($decoded) ? $decoded : $availability;
                }
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'expertise' => $p->expertise,
                    'availability' => $availability,
                ];
            });

            return [
                'id' => $a->id,
                'department' => $a->department,
                'section' => $a->section, // cluster/section string
                'adviser' => $a->adviser ? $a->adviser->name : null,
                'panel_ids' => $ids,
                'panels' => $panels,
                'created_at' => $a->created_at ? $a->created_at->toDateTimeString() : null,
            ];
        });

        return response()->json($payload);
    }
}

