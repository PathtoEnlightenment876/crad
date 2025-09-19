<?php

namespace App\Http\Controllers;
use App\Models\Submission;
use Illuminate\Http\Request;
use App\Models\Notification;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin-dashboard');
    }

    public function analytics()
    {
        return view('analytics');
    }

    public function trackProposals()
{
    $submissions = Submission::with(['user', 'committee'])->latest()->get();

    return view('track-proposal', compact('submissions'));
}

public function updateStatus(Request $request, $submissionId)
{
    $submission = Submission::findOrFail($submissionId);
    $submission->status = $request->status;
    $submission->feedback = $request->feedback ?? $submission->feedback;
    $submission->save();

    // Create notification
    $message = match($request->status) {
        'Approved' => "Your proposal '{$submission->title}' has been approved.",
        'Rejected' => "Your proposal '{$submission->title}' has been rejected. Please revise and resubmit.",
        default => "Feedback received for '{$submission->title}': {$submission->feedback}",
    };

    Notification::create([
        'user_id' => $submission->user_id,
        'type' => $request->status,
        'message' => $message,
    ]);

    return back()->with('success', 'Status updated and notification sent.');
}

}

