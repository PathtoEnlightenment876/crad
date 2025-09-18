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
        $submissions = Submission::where('submitted_by', Auth::id())->get();
        return view('std-dashboard', compact('submissions'));
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'department' => 'required|string',
        'cluster' => 'required|integer',
        'group_no' => 'required|integer',
        'file' => 'required|mimes:pdf,doc,docx|max:2048',
    ]);

    $path = $request->file('file')->store('submissions', 'public');

    Submission::create([
        'user_id' => auth()->id(), // 🔑 this connects to student
        'title' => $request->title,
        'department' => $request->department,
        'cluster' => $request->cluster,
        'group_no' => $request->group_no,
        'file_path' => $path,
        'status' => 'Pending',
    ]);

    return redirect()->route('student.submissions.index') // 👈 must point to the page with cards
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
    // Find the submission
    $submission = Submission::findOrFail($id);

    // Handle the new file upload (example)
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $path = $file->store('submissions');

        // Optionally delete old file
        if ($submission->file_path) {
            Storage::delete($submission->file_path);
        }

        $submission->file_path = $path;
    }

    // Update status if needed
    $submission->status = 'Resubmitted';
    $submission->save();

    return redirect()->back()->with('success', 'Submission resubmitted successfully.');
}

}
