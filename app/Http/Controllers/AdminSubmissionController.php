<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Committee;
use App\Models\SubmissionHistory;
use Illuminate\Http\Request;
use App\Models\Notification;

class AdminSubmissionController extends Controller
{
    public function trackProposal(Request $request)
    {
        // Get unique values from authenticated users and their submissions
        $departments = Submission::distinct()->pluck('department')->filter();
        $clusters = Submission::distinct()->pluck('cluster')->filter();
        $groups = Submission::distinct()->pluck('group_no')->filter();
    
        // Show submissions if any filter is applied
        if ($request->hasAny(['department', 'cluster', 'group_no'])) {
            $query = Submission::with('user');
        
            if ($request->filled('department')) {
                $query->where('department', $request->department);
            }
            if ($request->filled('cluster')) {
                $query->where('cluster', $request->cluster);
            }
            if ($request->filled('group_no')) {
                $query->where('group_no', $request->group_no);
            }
        
            $submissions = $query->orderBy('created_at', 'desc')->get();
            
            // Ensure user data consistency
            $submissions->each(function($submission) {
                if ($submission->user) {
                    $submission->department = $submission->user->department ?? $submission->department;
                }
            });
        } else {
            $submissions = collect();
        }
        
        // Get history logs from processed submissions
        $historyLogs = Submission::with('user')
            ->where(function($query) {
                $query->whereNotNull('feedback')
                      ->orWhere('status', '!=', 'Pending');
            })
            ->orderBy('updated_at', 'desc')
            ->get();
    
        return view('track-proposal', compact('departments', 'clusters', 'groups', 'submissions', 'historyLogs'));
    }
    


public function updateStatus(Request $request, $id)
{
    $submission = Submission::findOrFail($id);
    
    // Only update status if provided
    if ($request->has('status')) {
        $submission->status = $request->status;
        
        // Create notification for status change
        $message = match($request->status) {
            'Approved' => "Your proposal '{$submission->documents}' has been approved.",
            'Rejected' => "Your proposal '{$submission->documents}' has been rejected.",
            default => "Your proposal '{$submission->documents}' status has been updated to {$request->status}."
        };
        
        Notification::create([
            'user_id' => $submission->user_id,
            'type' => 'status',
            'message' => $message,
        ]);
    }
    
    // Only update feedback if provided
    if ($request->has('feedback')) {
        $submission->feedback = $request->feedback;
        
        // Create notification for feedback
        Notification::create([
            'user_id' => $submission->user_id,
            'type' => 'feedback',
            'message' => "New feedback received for '{$submission->documents}': {$request->feedback}",
        ]);
    }
    
    $submission->save();

    // Always return JSON for this endpoint
    return response()->json(['success' => true, 'message' => 'Submission updated successfully.']);
}

    public function viewFile($id)
    {
        $submission = Submission::findOrFail($id);
        $filePath = storage_path('app/public/' . $submission->file_path);
        
        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }
        
        $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $fileName = basename($submission->file_path);
        
        $mimeTypes = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ];
        
        $contentType = $mimeTypes[$fileExtension] ?? 'application/octet-stream';
        
        // For PDFs, display inline; for others, force download
        $disposition = ($fileExtension === 'pdf') ? 'inline' : 'attachment';
        
        return response()->file($filePath, [
            'Content-Type' => $contentType,
            'Content-Disposition' => $disposition . '; filename="' . $fileName . '"'
        ]);
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

public function getSubmissionsByGroup($group)
{
    $submissions = Submission::with('user')
        ->where('group_no', $group)
        ->orderBy('created_at', 'desc')
        ->get();
    
    return response()->json([
        'success' => $submissions->isNotEmpty(),
        'submissions' => $submissions
    ]);
}

public function downloadFile($id)
{
    $submission = Submission::findOrFail($id);
    $filePath = storage_path('app/public/' . $submission->file_path);
    
    if (!file_exists($filePath)) {
        abort(404, 'File not found');
    }
    
    return response()->download($filePath, basename($submission->file_path));
}

public function panelAdviser()
    {
        // Fetch all submissions with their committee info
        $submissions = Submission::with('committee')->get();
        
        // Fetch advisers and panels for the view
        $advisers = \App\Models\Adviser::all();
        $panels = \App\Models\Panel::all();

        // Return to the panel-adviser view
        return view('panel-adviser', compact('submissions', 'advisers', 'panels'));
    }


}