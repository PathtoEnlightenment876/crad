@extends('layouts.student')

@section('content')
<div class="container my-5">

    <!-- Title -->
    <h1 class="text-center mb-4 fw-bold text-primary">
        <i class="bi bi-file-earmark-text"></i> Submit Your Proposal
    </h1>

    <!-- Submission Form -->
    <div class="card shadow-lg border-0 rounded-4 mb-5">
        <div class="card-body p-4">
            <form action="{{ route('student.files.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col-12 mb-3">
                        <label class="form-label fw-semibold">Proposal Title</label>
                        <input type="text" name="title" class="form-control rounded-3" placeholder="Enter your proposal title" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Department</label>
                        <select name="department" class="form-select rounded-3" required>
                            <option value="">-- Select Department --</option>
                            @foreach(['BSIT','BSCRIM','EDUC','BSHM','BSAIS','BSTM','BSOA','ENTREP','BSBA','BLIS','BSCPE','BSP'] as $dept)
                                <option value="{{ $dept }}">{{ $dept }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">Cluster</label>
                        <select name="cluster" class="form-select rounded-3" required>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">Cluster {{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">Group</label>
                        <select name="group_no" class="form-select rounded-3" required>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">Group {{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label fw-semibold">Upload File</label>
                        <input type="file" name="file" class="form-control rounded-3" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100 rounded-3 py-2 fw-semibold">
                            <i class="bi bi-upload"></i> Submit Proposal
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Status Section -->
    <h1 class="text-center mb-4 fw-bold text-primary">
        <i class="bi bi-clipboard-check"></i> Proposal Status
    </h1>

    <div class="row g-4">
        @forelse($submissions as $submission)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg border-0 h-100 rounded-4">
                    <div class="card-header bg-gradient text-black d-flex justify-content-between align-items-center rounded-top-4"
                        style="background: linear-gradient(90deg, #007bff, #0056b3);">
                        <h5 class="mb-0">{{ $submission->title }}</h5>
                        <span class="badge fs-6 px-3 py-2 rounded-pill 
                            {{ $submission->status == 'Approved' ? 'bg-success' : ($submission->status == 'Rejected' ? 'bg-danger' : 'bg-warning text-dark') }}">
                            {{ $submission->status }}
                        </span>
                    </div>
                    <div class="card-body">
                        <p><i class="bi bi-diagram-3 text-primary"></i> <strong>Cluster:</strong> {{ $submission->cluster }}</p>
                        <p><i class="bi bi-people text-primary"></i> <strong>Group:</strong> {{ $submission->group_no }}</p>
                        <p><i class="bi bi-building text-primary"></i> <strong>Department:</strong> {{ $submission->department }}</p>
                        <p><i class="bi bi-calendar-event text-primary"></i> <strong>Submitted:</strong> {{ $submission->created_at->format('M d, Y') }}</p>
                        <p><i class="bi bi-chat-left-dots text-primary"></i> <strong>Remarks:</strong> {{ $submission->feedback ?? '—' }}</p>

                        @if($submission->committee)
    <hr>
    <h6 class="fw-bold text-primary"><i class="bi bi-person-badge"></i> Committee</h6>

    <p>
        <strong>Adviser:</strong>
        {{ $submission->committee->adviser_name }} 
        ({{ $submission->committee->adviser_affiliation }})
    </p>

    <ul class="ps-3">
        @if(!empty($submission->committee->panel1_name))
            <li><strong>Panel 1:</strong> {{ $submission->committee->panel1_name }} ({{ $submission->committee->panel1_affiliation }})</li>
        @endif
        @if(!empty($submission->committee->panel2_name))
            <li><strong>Panel 2:</strong> {{ $submission->committee->panel2_name }} ({{ $submission->committee->panel2_affiliation }})</li>
        @endif
        @if(!empty($submission->committee->panel3_name))
            <li><strong>Panel 3:</strong> {{ $submission->committee->panel3_name }} ({{ $submission->committee->panel3_affiliation }})</li>
        @endif
    </ul>
@endif

                    

                        @if($submission->resubmissions->count() > 0)
                            <hr>
                            <h6 class="fw-bold text-primary"><i class="bi bi-clock-history"></i> Resubmission History</h6>
                            <ul class="list-unstyled small">
                                @foreach($submission->resubmissions as $resub)
                                    <li class="mb-1">
                                        <i class="bi bi-arrow-repeat text-secondary"></i>
                                        <strong>{{ $resub->title }}</strong> 
                                        <a href="{{ asset('storage/' . $resub->file_path) }}" target="_blank" class="text-decoration-none ms-1">(View)</a> 
                                        <small class="text-muted">[{{ $resub->created_at->format('M d, Y') }}]</small>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="card-footer bg-light d-flex justify-content-between rounded-bottom-4">
                        <a href="{{ route('submission.file', $submission->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-3">
                            <i class="bi bi-eye"></i> View File
                        </a>

                        @if($submission->status == 'Rejected')
                            <button class="btn btn-sm btn-warning rounded-3" data-bs-toggle="modal" data-bs-target="#resubmitModal{{ $submission->id }}">
                                <i class="bi bi-arrow-repeat"></i> Revise & Resubmit
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Resubmit Modal -->
            @if($submission->status == 'Rejected')
            <div class="modal fade" id="resubmitModal{{ $submission->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4">
                        <form action="{{ route('student.files.resubmit', $submission->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                        
                            <div class="modal-header bg-primary text-white rounded-top-4">
                                <h5 class="modal-title"><i class="bi bi-arrow-repeat"></i> Revise & Resubmit</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Proposal Title</label>
                                    <input type="text" name="title" class="form-control rounded-3" value="{{ $submission->title }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Upload New File</label>
                                    <input type="file" name="file" class="form-control rounded-3" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary rounded-3">Resubmit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif

        @empty
            <div class="col-12">
                <div class="alert alert-info text-center rounded-4 shadow-sm">
                    <i class="bi bi-info-circle"></i> No submissions yet.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
