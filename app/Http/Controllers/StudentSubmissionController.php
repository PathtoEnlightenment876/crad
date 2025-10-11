<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentSubmissionController extends Controller
{
    public function submission()
    {
        $user = auth()->user();
        $submissions = Submission::where('user_id', $user->id)->get();
        
        return view('submission', compact('submissions'));
    }

    public function index()
    {
        $userId = auth()->id();
        $submissions = Submission::where('user_id', $userId)->get();
        
        $latestSubmission = $submissions->last();
        $submissionStatus = $latestSubmission ? $latestSubmission->status : 'PENDING';
        $progress = $submissions->count();
        
        $group = (object) [
            'group_no' => auth()->user()->group_no ?? 'N/A', 
            'department' => auth()->user()->department ?? 'N/A',
            'adviser' => (object) ['name' => 'N/A'],
            'panels' => collect()
        ];

        return view('std-dashboard', compact('submissions', 'submissionStatus', 'progress', 'group'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'documents' => 'required|string|max:255',
            'file'  => 'required|mimes:pdf,doc,docx|max:2048',
        ]);
        
        $path = $request->file('file')->store('submissions', 'public');
        $user = auth()->user();

        // Ensure data consistency - prioritize user model data over form data
        Submission::create([
            'user_id' => $user->id,
            'documents' => $request->documents,
            'defense_type' => $request->defense_type,
            'department' => $user->department ?? 'N/A',
            'cluster' => $user->section_cluster ?? 4101,
            'group_no' => $user->group_no ?? 0,
            'file_path' => $path,
            'status' => 'Pending',
        ]);

        return redirect()->route('student.submissions.index')
            ->with('success', 'Proposal submitted successfully!');
    }

    public function viewFile($id)
    {
        $submission = Submission::findOrFail($id);
        return response()->file(storage_path('app/public/' . $submission->file_path));
    }
    public function viewPanelAdviser()
    {
        $user = auth()->user();
        
        // Get assignment data for the user's department and cluster
        // User cluster field maps to Assignment section field
        $assignment = \App\Models\Assignment::with(['adviser', 'assignmentPanels'])
            ->where('department', $user->department)
            ->where('section', $user->cluster ?? '4101')
            ->first();
        
        return view('view-panel-adviser', compact('assignment'));
    }

    public function viewSchedules()
    {
        // Fetch defense schedules for section 4101, group 1, set A
        $schedules = \App\Models\DefenseSchedule::with('assignment.adviser', 'assignment.assignmentPanels')
            ->where('section', '4101')
            ->where('group_id', '1')
            ->where('set_letter', 'A')
            ->orderBy('defense_date', 'asc')
            ->get();
        
        return view('view-sched', compact('schedules'));
    }

public function resubmit(Request $request, $id)
{
    $submission = Submission::findOrFail($id);

    // validate
    $request->validate([
        'documents' => 'required|string|max:255',
        'file'  => 'required|mimes:pdf,doc,docx|max:2048',
    ]);

    // update title
    $submission->documents = $request->documents;

    // upload new file
    if ($request->hasFile('file')) {
        $path = $request->file('file')->store('submissions', 'public');

        if ($submission->file_path) {
            Storage::disk('public')->delete($submission->file_path);
        }

        $submission->file_path = $path;
    }

    $submission->status = 'Resubmitted';
    $submission->save();

    return redirect()->back()->with('success', 'Submission resubmitted successfully.');
}

}
