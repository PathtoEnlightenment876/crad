@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title mb-0">Total Submissions</h6>
                            <h2 class="mb-0">{{ $totalSubmissions }}</h2>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-file-earmark-text fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title mb-0">Pending Review</h6>
                            <h2 class="mb-0">{{ $pendingSubmissions }}</h2>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-clock fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title mb-0">Approved</h6>
                            <h2 class="mb-0">{{ $approvedSubmissions }}</h2>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-check-circle fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title mb-0">Rejected</h6>
                            <h2 class="mb-0">{{ $rejectedSubmissions }}</h2>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-x-circle fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-4">
        <!-- Recent Submissions -->
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-clock-history me-2"></i>Recent Submissions
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Student</th>
                                    <th>Documents</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentSubmissions as $submission)
                                <tr>
                                    <td>{{ $submission->user->name ?? 'N/A' }}</td>
                                    <td>{{ Str::limit($submission->documents, 30) }}</td>
                                    <td>{{ $submission->department }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($submission->status == 'Approved') bg-success
                                            @elseif($submission->status == 'Rejected') bg-danger
                                            @else bg-warning
                                            @endif">
                                            {{ $submission->status }}
                                        </span>
                                    </td>
                                    <td>{{ $submission->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.track-proposal') }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        No submissions yet
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-light text-center">
                    <a href="{{ route('admin.track-proposal') }}" class="btn btn-primary">
                        <i class="bi bi-list-ul me-1"></i>View All Submissions
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Department Statistics -->
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-building me-2"></i>Department Overview
                    </h5>
                </div>
                <div class="card-body">
                    @forelse($departmentStats as $dept)
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="mb-0">{{ $dept->department }}</h6>
                        </div>
                        <div>
                            <span class="badge bg-primary">{{ $dept->count }} submissions</span>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted text-center">No department data available</p>
                    @endforelse
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="card shadow mt-4">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-lightning me-2"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.track-proposal') }}" class="btn btn-outline-primary">
                            <i class="bi bi-list-check me-2"></i>Review Submissions
                        </a>
                        <a href="{{ url('/panel-adviser') }}" class="btn btn-outline-info">
                            <i class="bi bi-people me-2"></i>Manage Panel & Advisers
                        </a>
                        <a href="{{ route('admin.analytics') }}" class="btn btn-outline-success">
                            <i class="bi bi-graph-up me-2"></i>View Analytics
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Feedback Modal -->
        <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form id="feedbackForm" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="feedbackModalLabel">Send Feedback</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <textarea name="feedback" class="form-control" rows="4" placeholder="Enter feedback..." required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send Feedback</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    var feedbackModal = document.getElementById('feedbackModal');
    var feedbackForm = document.getElementById('feedbackForm');

    feedbackModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; 
        var fileId = button.getAttribute('data-id'); 

        feedbackForm.action = "/admin/submission/" + fileId + "/feedback";
    });
});
</script>
@endsection
