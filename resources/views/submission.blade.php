@extends('layouts.student')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4 text-primary">Upload Documents</h1>

    <!-- Upload Section -->
    <div class="card p-4 mt-4 shadow-sm">
        <a class="btn btn-link text-decoration-none d-block text-start p-0 mb-3"
           data-bs-toggle="collapse"
           href="#documentUploadCollapse"
           role="button"
           aria-expanded="true"
           aria-controls="documentUploadCollapse">
            <h5 class="d-inline-block mb-0">My Documents</h5>
            <i class="bi bi-caret-down-fill ms-2"></i>
        </a>

        <div class="collapse multi-collapse show" id="documentUploadCollapse">
            <div id="documentUploadList">

                @foreach(['Research Title Proposal', 'Research Forum', 'Title Proposal', 'Clearance'] as $docTitle)
    <div class="card mb-3">
        <div class="card-body">
            <h6 class="card-title document-title">
                <span>{{ $docTitle }}</span>
            </h6>
            <div class="upload-form-container">
                <form action="{{ route('student.submissions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="documents" value="{{ $docTitle }}">
                    <input type="hidden" name="department" value="N/A">
                    <input type="hidden" name="cluster" value="0">
                    <input type="hidden" name="group_no" value="0">

                    <label class="form-label">Upload a File</label>
                    <div class="input-group">
                        <input type="file" name="file" class="form-control" required>
                        <button class="btn btn-primary" type="submit">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach


            </div>
        </div>
    </div>

    <!-- Status Section -->
    <h1 class="text-center mb-4 mt-5 text-primary">Document Status</h1>
    <div class="card p-4 mt-4 shadow-sm">
        <a class="btn btn-link text-decoration-none d-block text-start p-0 mb-3"
           data-bs-toggle="collapse"
           href="#documentStatusCollapse"
           role="button"
           aria-expanded="true"
           aria-controls="documentStatusCollapse">
            <h5 class="d-inline-block mb-0">My Documents</h5>
            <i class="bi bi-caret-down-fill ms-2"></i>
        </a>

        <div class="collapse multi-collapse show" id="documentStatusCollapse">
            <div id="documentStatusList">
                @forelse($submissions as $submission)
                    @php
                        $statusClass = match($submission->status) {
                            'Approved' => 'bg-success',
                            'Rejected' => 'bg-danger',
                            default => 'bg-warning text-dark',
                        };
                    @endphp

                    <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                        <div>
                            <h6 class="mb-1">{{ $submission->documents }}</h6>
                            <small class="text-muted d-block">Submitted: {{ $submission->created_at->format('Y-m-d') }}</small>
                            <small class="text-muted d-block">Approval:
                                {{ $submission->updated_at->format('Y-m-d') ?? 'N/A' }}
                            </small>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <span class="badge {{ $statusClass }} status-badge">{{ $submission->status }}</span>

                            @if($submission->status === 'Rejected')
                                <button class="btn btn-sm btn-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#resubmitModal{{ $submission->id }}">
                                    <i class="bi bi-arrow-repeat"></i> Resubmit
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Resubmit Modal -->
                    @if($submission->status === 'Rejected')
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
                                                <input type="text" name="documents" class="form-control rounded-3"
                                                       value="{{ $submission->documents }}" required>
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
                    <p class="text-muted text-center">No submissions yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.document-title').forEach(title => {
            title.addEventListener('click', (e) => {
                const formContainer = e.target.closest('.card-body').querySelector('.upload-form-container');
                if (formContainer) {
                    formContainer.style.display = (formContainer.style.display === 'block') ? 'none' : 'block';
                }
            });
        });
    });
</script>

@endsection
