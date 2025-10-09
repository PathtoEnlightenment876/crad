@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4 text-primary fw-bold">Track Student Proposals</h1>

    <!-- Filters -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.submissions.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Department</label>
                    <select name="department" class="form-select">
                        <option value="">All</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>
                                {{ $dept }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Cluster</label>
                    <select name="cluster" class="form-select">
                        <option value="">All</option>
                        @foreach($clusters as $cl)
                            <option value="{{ $cl }}" {{ request('cluster') == $cl ? 'selected' : '' }}>
                                Cluster {{ $cl }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Group</label>
                    <select name="group_no" class="form-select">
                        <option value="">All</option>
                        @foreach($groups as $grp)
                            <option value="{{ $grp }}" {{ request('group_no') == $grp ? 'selected' : '' }}>
                                Group {{ $grp }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Submissions -->
    <div class="row g-4 justify-content-center">
        @if(request()->hasAny(['department', 'cluster', 'group_no']))
            @forelse ($submissions as $submission)
            <div class="col-md-6">
                <div class="card p-4 shadow-sm h-100">
                    <h5 class="card-title text-center text-secondary mb-3">
                        {{ $submission->documents }}
                    </h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <strong>{{ $submission->user->name ?? 'Unknown Student' }}</strong>  
                                <br>
                                <small class="text-muted">
                                    {{ $submission->department }} | Cluster {{ $submission->cluster }} | Group {{ $submission->group_no }}
                                </small>
                            </span>
                            <span class="badge 
                                {{ $submission->status == 'Approved' ? 'bg-success' : ($submission->status == 'Rejected' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                {{ $submission->status }}
                            </span>
                        </li>
                        <li class="list-group-item">
                            <small class="fw-bold">Feedback:</small>  
                            {{ $submission->feedback ?? 'No feedback yet' }}
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <small class="text-muted">Submitted: {{ $submission->created_at->format('M d, Y') }}</small>
                            <div class="d-flex gap-2">
                                <!-- View -->
                                <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                    data-bs-target="#fileModal{{ $submission->id }}" documents="View File">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <!-- Approve -->
                                <form action="{{ route('admin.submissions.updateStatus', $submission->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="Approved">
                                    <button type="submit" class="btn btn-sm btn-outline-success" documents="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>

                                <!-- Reject -->
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#rejectModal{{ $submission->id }}" documents="Reject">
                                    <i class="fas fa-times"></i>
                                </button>

                                <!-- Feedback -->
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                    data-bs-target="#feedbackModal{{ $submission->id }}" documents="Feedback">
                                    <i class="fas fa-comment-dots"></i>
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- File Modal -->
            <div class="modal fade" id="fileModal{{ $submission->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $submission->documents }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center">
                            @php
                                $fileExtension = pathinfo($submission->file_path, PATHINFO_EXTENSION);
                            @endphp
                            
                            @if(in_array(strtolower($fileExtension), ['pdf']))
                                <iframe src="{{ route('admin.track-proposal.view', $submission->id) }}" width="100%" height="500px" style="border:none;"></iframe>
                            @elseif(in_array(strtolower($fileExtension), ['doc', 'docx']))
                                <div class="alert alert-info">
                                    <i class="fas fa-file-word"></i> Word Document Preview
                                    <br><br>
                                    <a href="{{ route('admin.track-proposal.view', $submission->id) }}" class="btn btn-primary" target="_blank">
                                        <i class="fas fa-download"></i> Download to View
                                    </a>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle"></i> File preview not available
                                    <br><br>
                                    <a href="{{ route('admin.track-proposal.view', $submission->id) }}" class="btn btn-primary" target="_blank">
                                        <i class="fas fa-download"></i> Download File
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reject Modal -->
            <div class="modal fade" id="rejectModal{{ $submission->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('admin.submissions.updateStatus', $submission->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="Rejected">
                            <div class="modal-header">
                                <h5 class="modal-title">Reject Proposal: {{ $submission->documents }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <textarea name="feedback" class="form-control" rows="3" placeholder="Enter reason for rejection"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Reject</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
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
                                <h5 class="modal-title">Feedback for {{ $submission->documents }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <textarea name="feedback" class="form-control" rows="4" placeholder="Enter your feedback here...">{{ $submission->feedback }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save Feedback</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No submissions found for the selected filters.</p>
                </div>
            @endforelse
        @else
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Please select a department, cluster, or group number to view submissions.
                </div>
            </div>
        @endif
    </div>

    <!-- History Logs -->
    <div class="card mt-5 shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fas fa-history"></i> History Logs</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Documents</th>
                            <th>Department</th>
                            <th>Cluster</th>
                            <th>Group</th>
                            <th>Status</th>
                            <th>Feedback</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($historyLogs as $log)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $log->user->name ?? 'Unknown' }}</td>
                                <td>{{ $log->documents }}</td>
                                <td>{{ $log->department }}</td>
                                <td>{{ $log->cluster }}</td>
                                <td>{{ $log->group_no }}</td>
                                <td>
                                    <span class="badge 
                                        {{ $log->status == 'Approved' ? 'bg-success' : ($log->status == 'Rejected' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                        {{ $log->status }}
                                    </span>
                                </td>
                                <td>{{ $log->feedback ?? 'N/A' }}</td>
                                <td>{{ $log->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">No history logs available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
