@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4 text-primary">Track Student Proposals</h1>

        <div class="card shadow-sm mb-5">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">All Submissions</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Student</th>
                            <th>Department</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Feedback</th>
                            <th>Cluster</th>
                            <th>Group</th>
                            <th>Date Submitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($submissions as $submission)
                            <tr>
                                <td>{{ $submission->user->name ?? 'Unknown Student' }}</td>
                                <td>{{ $submission->department ?? '—' }}</td>
                                <td>{{ $submission->title }}</td>
                                <td>
                                    <span class="badge 
                                        {{ $submission->status == 'Approved' ? 'bg-success' : ($submission->status == 'Rejected' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                        {{ $submission->status }}
                                    </span>
                                </td>
                                <td>{{ $submission->feedback ?? 'No feedback yet' }}</td>
                                <td>{{ $submission->cluster }}</td>
                                <td>{{ $submission->group_no }}</td>
                                <td>{{ $submission->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">

                                        <!-- View File -->
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#fileModal{{ $submission->id }}" title="View File">
                                            <i class="bi bi-file-earmark-text"></i>
                                        </button>

                                        <!-- Approve -->
                                        <form action="{{ route('admin.submissions.updateStatus', $submission->id) }}" method="POST" class="m-0 p-0">
                                            @csrf
                                            <input type="hidden" name="status" value="Approved">
                                            <button type="submit" class="btn btn-success btn-sm" title="Approve">
                                                <i class="bi bi-check"></i>
                                            </button>
                                        </form>

                                        <!-- Reject -->
                                        <form action="{{ route('admin.submissions.updateStatus', $submission->id) }}" method="POST" class="m-0 p-0">
                                            @csrf
                                            <input type="hidden" name="status" value="Rejected">
                                            <button type="submit" class="btn btn-danger btn-sm" title="Reject">
                                                <i class="bi bi-x"></i>
                                            </button>
                                        </form>

                                        <!-- Pending -->
                                        <form action="{{ route('admin.submissions.updateStatus', $submission->id) }}" method="POST" class="m-0 p-0">
                                            @csrf
                                            <input type="hidden" name="status" value="Pending">
                                            <button type="submit" class="btn btn-warning btn-sm text-dark" title="Pending">
                                                <i class="bi bi-hourglass-split"></i>
                                            </button>
                                        </form>

                                        <!-- Feedback -->
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#feedbackModal{{ $submission->id }}" title="Feedback">
                                            <i class="bi bi-chat-left-text"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- File Modal -->
                            <div class="modal fade" id="fileModal{{ $submission->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ $submission->title }} -
                                                {{ $submission->user->name ?? 'Unknown' }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-0">
                                            <iframe src="{{ route('submission.file', $submission->id) }}" width="100%"
                                                height="500px" style="border:none;"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Feedback Modal -->
                            <div class="modal fade" id="feedbackModal{{ $submission->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.submissions.updateStatus', $submission->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="{{ $submission->status }}">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Feedback for {{ $submission->title }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="feedback{{ $submission->id }}" class="form-label fw-bold">Feedback</label>
                                                    <textarea name="feedback" id="feedback{{ $submission->id }}"
                                                        class="form-control" rows="4">{{ $submission->feedback }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Submit Feedback</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No submissions yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Committee Table -->
        <div class="card shadow-sm mb-5">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Committee Assignments</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Department</th>
                            <th>Group No.</th>
                            <th>Status</th>
                            <th>Committee</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($submissions as $submission)
                            <tr>
                                <td>{{ $submission->title }}</td>
                                <td>{{ $submission->department }}</td>
                                <td>{{ $submission->group_no }}</td>
                                <td>{{ $submission->status }}</td>
                                <td>
                                    @if($submission->committee)
                                        <strong>Adviser:</strong> {{ $submission->committee->adviser_name ?? 'Not Assigned' }}<br>
                                        <strong>Panel 1:</strong> {{ $submission->committee->panel1 ?? 'Not Assigned' }}<br>
                                        <strong>Panel 2:</strong> {{ $submission->committee->panel2 ?? 'Not Assigned' }}<br>
                                        <strong>Panel 3:</strong> {{ $submission->committee->panel3 ?? 'Not Assigned' }}
                                    @else
                                        <em>No committee assigned</em>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

      <!-- History Log Table -->
@isset($historyLogs)
<div class="card shadow-sm">
    <div class="card-header bg-secondary text-white">
        <h5 class="mb-0">History Log</h5>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Student</th>
                    <th>Proposal Title</th>
                    <th>Action</th>
                    <th>Status</th>
                    <th>Feedback</th>
                    <th>Changed By</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($historyLogs as $log)
                    <tr>
                        <td>{{ $log->submission->user->name ?? 'Unknown Student' }}</td>
                        <td>{{ $log->submission->title ?? 'N/A' }}</td>
                        <td>{{ $log->action }}</td>
                        <td>
                            <span class="badge 
                                {{ $log->status == 'Approved' ? 'bg-success' : ($log->status == 'Rejected' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                {{ $log->status }}
                            </span>
                        </td>
                        <td>{{ $log->feedback ?? '—' }}</td>
                        <td>{{ $log->changed_by ?? 'System' }}</td>
                        <td>{{ $log->created_at->format('M d, Y h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No history logs yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endisset

@endsection
