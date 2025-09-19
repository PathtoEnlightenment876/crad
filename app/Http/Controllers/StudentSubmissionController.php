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
        $submissions = Submission::where('user_id', Auth::id())->get();
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
    $submission = Submission::findOrFail($id);

    // validate
    $request->validate([
        'title' => 'required|string|max:255',
        'file'  => 'required|mimes:pdf,doc,docx|max:2048',
    ]);

    // update title
    $submission->title = $request->title;

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
