<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class StudentController extends Controller
{

    public function index()
{
    $upcomingSubmissions = Submission::where('user_id', auth()->id())
        ->where('due_date', '>=', now())
        ->orderBy('due_date')
        ->get()
        ->map(function($submission){
            $submission->status_color = match($submission->status) {
                'Pending' => 'orange',
                'Submitted' => 'blue',
                'Resubmitted' => 'green',
                default => 'gray',
            };
            return $submission;
        });

    $chapters = [
        'Chapter 1: The Problem' => Submission::where('user_id', auth()->id())->where('chapter', 1)->first(),
        'Chapter 2: Review of Literature' => Submission::where('user_id', auth()->id())->where('chapter', 2)->first(),
        'Chapter 3: Methodology' => Submission::where('user_id', auth()->id())->where('chapter', 3)->first(),
        'Final Defense' => Submission::where('user_id', auth()->id())->where('chapter', 'final')->first(),
    ];

    // Optional: assign colors if needed
    foreach($chapters as $key => $chapter){
        if($chapter){
            $chapter->color = match($chapter->status) {
                'Pending' => '#ffc107',
                'Submitted' => '#0d6efd',
                'Resubmitted' => '#198754',
                default => '#6c757d',
            };
        }
    }

    return view('std-dashboard', compact('upcomingSubmissions', 'chapters'));
}


public function dashboard()
{
    $userId = Auth::id();

    // Upcoming submissions for the student
    $upcomingSubmissions = Submission::where('user_id', $userId)
        ->where('due_date', '>=', now())
        ->orderBy('due_date')
        ->get()
        ->map(function ($submission) {
            $submission->status_color = match($submission->status) {
                'Pending' => 'orange',
                'Submitted' => 'blue',
                'Resubmitted' => 'green',
                default => 'gray',
            };
            return $submission;
        });

    // Chapters progress
    $chapters = [
        'Chapter 1: The Problem' => Submission::where('user_id', $userId)->where('chapter', 1)->first(),
        'Chapter 2: Review of Literature' => Submission::where('user_id', $userId)->where('chapter', 2)->first(),
        'Chapter 3: Methodology' => Submission::where('user_id', $userId)->where('chapter', 3)->first(),
        'Final Defense' => Submission::where('user_id', $userId)->where('chapter', 'final')->first(),
    ];

    // Assign color based on status
    foreach ($chapters as $key => $chapter) {
        if ($chapter) {
            $chapter->color = match($chapter->status) {
                'Pending' => '#ffc107',
                'Submitted' => '#0d6efd',
                'Resubmitted' => '#198754',
                default => '#6c757d',
            };
        }
    }

    return view('std-dashboard', compact('upcomingSubmissions', 'chapters'));
}

    public function submission()
    {
         // Fetch student's submissions
        $submissions = Submission::where('user_id', auth()->id())->get();

        // Fetch notifications safely
        $notifications = Notification::where('user_id', auth()->id())
                                     ->orderBy('created_at', 'desc')
                                     ->get() ?? collect(); // Ensure it's always a collection

        // Pass data to the view
        return view('submission', compact('submissions', 'notifications'));
    }
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'file' => 'required|mimes:pdf,doc,docx|max:2048',
        'department' => 'required|string',
        'cluster' => 'required|integer',
        'group_no' => 'required|integer',
    ]);

    $path = $request->file('file')->store('submissions', 'public');

    Submission::create([
        'user_id' => auth()->id(),
        'submitted_by' => auth()->user()->name, // or whichever field you want
        'title' => $request->title,
        'department' => $request->department,
        'cluster' => $request->cluster,
        'group_no' => $request->group_no,
        'file_path' => $path,
        'status' => 'Pending',
    ]);
    

    return back()->with('success', 'Submission uploaded successfully!');
}



}
