<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Committee;
use Illuminate\Http\Request;
use App\Models\Notification;

class AdminSubmissionController extends Controller
{
    public function index()
{
    $submissions = Submission::with('committee')->get();
    return view('track-proposal', compact('submissions'));
}


    public function updateStatus(Request $request, $id)
    {
        $submission = Submission::findOrFail($id);

        // Update status or feedback
    $submission->status = $request->input('status', $submission->status);
    $submission->feedback = $request->input('feedback', $submission->feedback);
    $submission->save();
      // Create notification for the student
    $message = "Your submission '{$submission->title}' ";
    if ($request->has('status')) {
        $message .= "has been {$submission->status}. ";
    }
    if ($request->has('feedback') && $submission->feedback) {
        $message .= "Feedback: {$submission->feedback}";
    }
    Notification::create([
        'user_id' => $submission->user_id,
        'type' => $request->has('feedback') ? 'feedback' : 'status',
        'message' => $message,
    ]);

        $request->validate([
            'status' => 'required|in:Pending,Approved,Rejected',
            'feedback' => 'nullable|string|max:1000',
            'committee_id' => 'nullable|exists:committees,id'
        ]);

        $submission->status = $request->status;
        $submission->feedback = $request->feedback ?? $submission->feedback;

        if ($request->committee_id) {
            $submission->committee_id = $request->committee_id;
        }

        $submission->save();

        return redirect()->back()->with('success', 'Submission updated successfully.');
    }

    public function viewFile($id)
    {
        $submission = Submission::findOrFail($id);
        return response()->file(storage_path('app/public/' . $submission->file_path));
    }

    public function assignCommittee(Request $request, $submissionId)
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

    $committee = Committee::updateOrCreate(
        ['submission_id' => $submissionId],
        $request->only([
            'adviser_name','adviser_affiliation',
            'panel1_name','panel1_affiliation',
            'panel2_name','panel2_affiliation',
            'panel3_name','panel3_affiliation',
        ])
    );

    return redirect()->back()->with('success', 'Committee assigned successfully.');
}

public function panelAdviser()
    {
        // Fetch all submissions with their committee info
        $submissions = Submission::with('committee')->get();

        // Return to the panel-adviser view
        return view('panel-adviser', compact('submissions'));
    }


}