<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentSubmissionController extends Controller
{
    public function index()
{
    $userId = auth()->id();

    $submissions = Submission::with('committee')->where('user_id', $userId)->get();
    
    // Find any submission with committee data
    $submissionWithCommittee = $submissions->first(function($submission) {
        return $submission->committee !== null;
    });
    
    $latestSubmission = $submissions->last();
    $submissionStatus = $latestSubmission ? $latestSubmission->status : 'PENDING';
    
    $progress = $submissions->count();
    
    $committee = $submissionWithCommittee ? $submissionWithCommittee->committee : null;
    
    // Debug: Log committee data
    \Log::info('Committee data:', ['committee' => $committee]);
    
    $adviser = $committee ? (object) ['name' => $committee->adviser_name] : (object) ['name' => 'N/A'];
    
    $panels = collect();
    if ($committee) {
        if ($committee->panel1) $panels->push((object) ['name' => $committee->panel1, 'role' => 'Panel Member 1']);
        if ($committee->panel2) $panels->push((object) ['name' => $committee->panel2, 'role' => 'Panel Member 2']);
        if ($committee->panel3) $panels->push((object) ['name' => $committee->panel3, 'role' => 'Panel Member 3']);
    }
    
    \Log::info('Panels created:', ['panels' => $panels->toArray()]);
    
    $group = (object) [
        'group_no' => auth()->user()->group_no ?? 'N/A', 
        'department' => auth()->user()->department ?? 'N/A',
        'adviser' => $adviser,
        'panels' => $panels
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

    Submission::create([
        'user_id' => $user->id,
        'documents' => $request->documents,
        'department' => $user->department ?? $request->department ?? 'N/A',
        'cluster' => $user->cluster ?? $request->cluster ?? 0,
        'group_no' => $user->group_no ?? $request->group_no ?? 0,
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
    $files = Submission::with('committee')
        ->where('user_id', auth()->id()) // or where('submitted_by', auth()->id()) depending on your DB
        ->get();

    return view('view-panel-adviser', compact('files'));
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
