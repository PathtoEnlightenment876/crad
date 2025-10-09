<?php

namespace App\Http\Controllers;
use App\Models\Submission;
use Illuminate\Http\Request;
use App\Models\Notification;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Key statistics
        $totalSubmissions = Submission::count();
        $pendingSubmissions = Submission::where('status', 'Pending')->count();
        $approvedSubmissions = Submission::where('status', 'Approved')->count();
        $rejectedSubmissions = Submission::where('status', 'Rejected')->count();
        
        // Recent submissions
        $recentSubmissions = Submission::with('user')->latest()->take(5)->get();
        
        // Department breakdown
        $departmentStats = Submission::selectRaw('department, COUNT(*) as count')
            ->groupBy('department')
            ->get();
            
        // Monthly submission trends (last 6 months)
        $monthlyStats = Submission::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
            
        return view('admin-dashboard', compact(
            'totalSubmissions', 'pendingSubmissions', 'approvedSubmissions', 'rejectedSubmissions',
            'recentSubmissions', 'departmentStats', 'monthlyStats'
        ));
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
        $approvedSubmissions = (clone $query)->where('status', 'Approved')->count();
        $rejectedSubmissions = (clone $query)->where('status', 'Rejected')->count();
        $pendingSubmissions = (clone $query)->where('status', 'Pending')->count();
        
        // Completion rate
        $completionRate = $totalSubmissions > 0 ? round(($approvedSubmissions / $totalSubmissions) * 100, 1) : 0;
        
        // Department statistics
        $departmentStats = Submission::selectRaw('department, 
            COUNT(*) as total,
            SUM(CASE WHEN status = "Approved" THEN 1 ELSE 0 END) as approved,
            SUM(CASE WHEN status = "Rejected" THEN 1 ELSE 0 END) as rejected,
            SUM(CASE WHEN status = "Pending" THEN 1 ELSE 0 END) as pending')
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
        'Approved' => "Your proposal '{$submission->documents}' has been approved.",
        'Rejected' => "Your proposal '{$submission->documents}' has been rejected. Please revise and resubmit.",
        default => "Feedback received for '{$submission->documents}': {$submission->feedback}",
    };

    Notification::create([
        'user_id' => $submission->user_id,
        'type' => $request->status,
        'message' => $message,
    ]);

    return back()->with('success', 'Status updated and notification sent.');
}

}

