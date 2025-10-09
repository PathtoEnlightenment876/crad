<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use Illuminate\Http\Request;

class CommitteeController extends Controller
{
    /**
     * Assign committee to a submission
     */
    public function assign(Request $request, $submissionId)
    {
        $request->validate([
            'adviser_name' => 'required|string|max:255',
            'adviser_affiliation' => 'nullable|string|max:255',
            'panel1_name' => 'required|string|max:255',
            'panel1_affiliation' => 'nullable|string|max:255',
            'panel2_name' => 'nullable|string|max:255',
            'panel2_affiliation' => 'nullable|string|max:255',
            'panel3_name' => 'nullable|string|max:255',
            'panel3_affiliation' => 'nullable|string|max:255',
        ]);

        Committee::updateOrCreate(
            ['submission_id' => $submissionId],
            $request->only([
                'adviser_name', 'adviser_affiliation',
                'panel1_name', 'panel1_affiliation',
                'panel2_name', 'panel2_affiliation',
                'panel3_name', 'panel3_affiliation'
            ])
        );

        return redirect()->route('panel-adviser')->with('success', 'Committee assigned successfully.');
    }

    /**
     * Store a new committee assignment
     */
    public function store(Request $request)
    {
        $request->validate([
            'submission_id' => 'required|exists:submissions,id',
            'adviser_name'  => 'nullable|string|max:255',
            'panel1'        => 'nullable|string|max:255',
            'panel2'        => 'nullable|string|max:255',
            'panel3'        => 'nullable|string|max:255',
        ]);

        Committee::updateOrCreate(
            ['submission_id' => $request->submission_id],
            [
                'adviser_name' => $request->adviser_name,
                'panel1'       => $request->panel1,
                'panel2'       => $request->panel2,
                'panel3'       => $request->panel3,
            ]
        );

        return redirect()->route('panel-adviser')->with('success', 'Committee assigned successfully.');
    }

    /**
     * Update an existing committee
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'adviser_name' => 'nullable|string|max:255',
            'panel1'       => 'nullable|string|max:255',
            'panel2'       => 'nullable|string|max:255',
            'panel3'       => 'nullable|string|max:255',
        ]);

        $committee = Committee::findOrFail($id);

        $committee->update([
            'adviser_name' => $request->adviser_name,
            'panel1'       => $request->panel1,
            'panel2'       => $request->panel2,
            'panel3'       => $request->panel3,
        ]);

        return redirect()->route('panel-adviser')->with('success', 'Committee updated successfully.');
    }

    /**
     * Delete a committee
     */
    public function destroy($id)
    {
        $committee = Committee::findOrFail($id);
        $committee->delete();

        return redirect()->route('panel-adviser')->with('success', 'Committee deleted successfully.');
    }
}
