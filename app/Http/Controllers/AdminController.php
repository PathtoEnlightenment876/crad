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

    public function analytics(Request $request)
    {
        $selectedDepartment = $request->get('department');
        
        // Get all departments for filter
        $departments = Submission::distinct()->pluck('department')->filter();
        
        // Base query
        $query = Submission::with('user');
        if ($selectedDepartment) {
            $query->where('department', $selectedDepartment);
        }
        
        // Key metrics
        $totalSubmissions = $query->count();
        $approvedSubmissions = $query->where('status', 'APPROVED')->count();
        $rejectedSubmissions = $query->where('status', 'REJECTED')->count();
        $pendingSubmissions = $query->where('status', 'PENDING')->count();
        
        // Completion rate
        $completionRate = $totalSubmissions > 0 ? round(($approvedSubmissions / $totalSubmissions) * 100, 1) : 0;
        
        // Department statistics
        $departmentStats = Submission::selectRaw('department, 
            COUNT(*) as total,
            SUM(CASE WHEN status = "APPROVED" THEN 1 ELSE 0 END) as approved,
            SUM(CASE WHEN status = "REJECTED" THEN 1 ELSE 0 END) as rejected,
            SUM(CASE WHEN status = "PENDING" THEN 1 ELSE 0 END) as pending')
            ->groupBy('department')
            ->get();
        
        // Recent submissions for table
        $recentSubmissions = $query->latest()->take(10)->get();
        
        return view('analytics', compact(
            'departments', 'selectedDepartment', 'totalSubmissions', 
            'approvedSubmissions', 'rejectedSubmissions', 'pendingSubmissions',
            'completionRate', 'departmentStats', 'recentSubmissions'
        ));
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

