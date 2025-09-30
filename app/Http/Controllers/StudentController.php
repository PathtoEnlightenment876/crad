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

    $submissions = Submission::with('committee')->where('user_id', $userId)->get();
    $submissionWithCommittee = $submissions->first(function($submission) {
        return $submission->committee !== null;
    });
    
    $latestSubmission = $submissions->last();
    $submissionStatus = $latestSubmission ? $latestSubmission->status : 'PENDING';
    
    // Calculate progress based on submission types and status
    $progressSteps = [
        1 => $submissions->where('type', 'proposal')->where('status', 'Approved')->count() > 0,
        2 => $submissions->where('type', 'research_forum')->where('status', 'Approved')->count() > 0,
        3 => $submissions->where('type', 'clearance_1')->where('status', 'Approved')->count() > 0,
        4 => $submissions->where('type', 'pre_oral')->where('status', 'Approved')->count() > 0,
        5 => $submissions->where('type', 'clearance_2')->where('status', 'Approved')->count() > 0,
        6 => $submissions->where('type', 'final_defense')->where('status', 'Approved')->count() > 0,
    ];
    
    $progress = collect($progressSteps)->filter()->count();
    
    $committee = $submissionWithCommittee ? $submissionWithCommittee->committee : null;
    
    $adviser = $committee ? (object) ['name' => $committee->adviser_name] : (object) ['name' => 'N/A'];
    
    $panels = collect();
    if ($committee) {
        if ($committee->panel1) $panels->push((object) ['name' => $committee->panel1, 'role' => 'Panel Member 1']);
        if ($committee->panel2) $panels->push((object) ['name' => $committee->panel2, 'role' => 'Panel Member 2']);
        if ($committee->panel3) $panels->push((object) ['name' => $committee->panel3, 'role' => 'Panel Member 3']);
    }
    
    $group = (object) [
        'group_no' => auth()->user()->group_no ?? 'N/A', 
        'department' => auth()->user()->department ?? 'N/A',
        'adviser' => $adviser,
        'panels' => $panels
    ];

    return view('std-dashboard', compact('upcomingSubmissions', 'chapters', 'submissionStatus', 'progress', 'progressSteps', 'group'));
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
        'documents' => $request->documents,
        'department' => $request->department,
        'cluster' => $request->cluster,
        'group_no' => $request->group_no,
        'file_path' => $path,
        'status' => 'Pending',
    ]);
    

    return back()->with('success', 'Submission uploaded successfully!');
}

public function notifications()
{
    $notifications = Notification::where('user_id', auth()->id())
                                 ->orderBy('created_at', 'desc')
                                 ->get();
    
    // Mark all notifications as read
    Notification::where('user_id', auth()->id())
                ->where('read', false)
                ->update(['read' => true]);
    
    return redirect()->back()->with('success', 'All notifications marked as read!');
}

}
