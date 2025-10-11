@extends('layouts.student')

@push('styles')
<style>
    :root {
        --bs-primary-dark: #284b9a;
        --bs-primary-light: #3B71CA;
        --bs-border-color: #dee2e6;
        --gradient-bg: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --card-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        --hover-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        font-family: 'Poppins', sans-serif;
        font-weight: 300;
        min-height: 100vh;
    }

    h1, h2, h3, h4, h5, h6, .fw-bold {
        font-weight: 700 !important;
    }
    
    .main-title {
        background: var(--gradient-bg);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        position: relative;
    }
    
    .main-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: var(--gradient-bg);
        border-radius: 2px;
    }
    
    .stage-box {
        border: none;
        padding: 30px; 
        margin-bottom: 40px; 
        border-radius: 20px; 
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .stage-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient-bg);
    }
    
    .stage-box:hover {
        transform: translateY(-5px);
        box-shadow: var(--hover-shadow);
    }

    .stage-title {
        text-align: center;
        font-weight: 700;
        margin-bottom: 30px;
        font-size: 2rem; 
        color: var(--bs-primary-dark);
        position: relative;
    }
    
    .stage-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: var(--bs-primary-light);
        border-radius: 2px;
    }

    .defense-section {
        border: none;
        padding: 2rem;
        margin-bottom: 2rem;
        border-radius: 15px;
        background: linear-gradient(145deg, #f8faff 0%, #e8f2ff 100%);
        box-shadow: inset 0 2px 10px rgba(59, 113, 202, 0.1);
        position: relative;
    }
    
    .defense-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--bs-primary-light), transparent);
        border-radius: 15px 15px 0 0;
    }

    .section-header {
        color: var(--bs-primary-dark);
        font-size: 1.3rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .section-header::before {
        content: '';
        width: 4px;
        height: 25px;
        background: var(--bs-primary-light);
        border-radius: 2px;
    }

    .document-item {
        border: none;
        padding: 18px 20px; 
        margin-bottom: 12px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.9);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .document-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--bs-primary-light);
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }
    
    .document-item:hover {
        background: rgba(255, 255, 255, 1);
        transform: translateX(5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    
    .document-item:hover::before {
        transform: scaleY(1);
    }

    .document-title-link {
        cursor: pointer;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #2c3e50;
        text-decoration: none;
        font-size: 1.1rem;
    }
    
    .document-title-link:hover {
        color: var(--bs-primary-dark);
    }
    
    .document-title-link i {
        transition: all 0.3s ease;
        color: var(--bs-primary-light);
        font-size: 1.2rem;
    }

    .document-title-link[aria-expanded="true"] i {
        transform: rotate(180deg);
        color: var(--bs-primary-dark);
    }
    
    .upload-form-content {
        padding-top: 1.5rem;
        border-top: 2px dashed rgba(59, 113, 202, 0.3);
        margin-top: 1.5rem;
        background: rgba(248, 250, 255, 0.5);
        border-radius: 8px;
        padding: 1.5rem;
    }
    
    .form-label-hidden {
        display: none;
    }
    
    .document-divider {
        height: 2px;
        background: linear-gradient(to right, transparent, rgba(59, 113, 202, 0.3), transparent);
        margin: 1.5rem 0;
        border: none;
        border-radius: 1px;
    }
    
    .btn-primary {
        background: var(--gradient-bg);
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(59, 113, 202, 0.3);
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 113, 202, 0.4);
        background: linear-gradient(135deg, #5a6fd8 0%, #6b5b95 100%);
    }
    
    .form-control {
        border: 2px solid rgba(59, 113, 202, 0.2);
        border-radius: 8px;
        padding: 12px 15px;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
    }
    
    .form-control:focus {
        border-color: var(--bs-primary-light);
        box-shadow: 0 0 0 0.2rem rgba(59, 113, 202, 0.25);
        background: white;
    }
    
    .input-group {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    
    <div class="stage-box p-4 mt-4 shadow-sm mb-5">
        <div class="stage-title text-center fw-bold fs-5">Submission</div> 
        
        <h5 class="section-header fw-bold mb-3 text-primary">Pre-Oral Defense</h5>
        <div class="defense-section p-3 p-md-4">
            <div class="accordion accordion-flush" id="preOralAccordion">
                @foreach(['Research Title Proposal', 'Research Forum', 'Clearance', 'Manuscript Chapter 1-3'] as $docTitle)
                    @php
                        $docUniqueID = 'pre-oral-' . strtolower(str_replace(' ', '-', $docTitle));
                        $formTargetID = 'form-collapse-submission-' . $docUniqueID;
                    @endphp
                    
                    <div class="accordion-item document-item">
                        <h2 class="accordion-header" id="heading-{{ $docUniqueID }}">
                            <button class="accordion-button document-title-link collapsed" type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#{{ $formTargetID }}" 
                                aria-expanded="false" 
                                aria-controls="{{ $formTargetID }}">
                                <span>{{ $docTitle }}</span>
                            </button>
                        </h2>
                        <div id="{{ $formTargetID }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $docUniqueID }}" data-bs-parent="#preOralAccordion">
                            <div class="accordion-body upload-form-content">
                                <form class="upload-form" action="{{ route('student.submissions.store') }}" method="POST" enctype="multipart/form-data" data-document="{{ $docTitle }}">
                                    @csrf
                                    <input type="hidden" name="documents" value="{{ $docTitle }}">
                                    <input type="hidden" name="defense_type" value="Pre-Oral">
                                    <input type="hidden" name="department" value="{{ auth()->user()->department ?? 'N/A' }}">
                                    <input type="hidden" name="cluster" value="{{ auth()->user()->section_cluster ?? 4101 }}">
                                    <input type="hidden" name="group_no" value="{{ auth()->user()->group_no ?? 0 }}">
                                    <label class="form-label mb-2 form-label-hidden">Upload a File</label>
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
        
        <h5 class="section-header fw-bold mb-3 mt-4 text-primary">Re-Defense</h5>
        <div class="defense-section p-3 p-md-4">
            <div class="accordion accordion-flush" id="preOralReDefenseAccordion">
                @php
                    $docTitle = 'Clearance';
                    $docUniqueID = 'pre-oral-re-defense-clearance';
                    $formTargetID = 'form-collapse-submission-' . $docUniqueID;
                @endphp
                <div class="accordion-item document-item">
                    <h2 class="accordion-header" id="heading-{{ $docUniqueID }}">
                        <button class="accordion-button document-title-link collapsed" type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#{{ $formTargetID }}" 
                            aria-expanded="false" 
                            aria-controls="{{ $formTargetID }}">
                            <span>{{ $docTitle }}</span>
                        </button>
                    </h2>
                    <div id="{{ $formTargetID }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $docUniqueID }}" data-bs-parent="#preOralReDefenseAccordion">
                        <div class="accordion-body upload-form-content">
                            <form class="upload-form" action="{{ route('student.submissions.store') }}" method="POST" enctype="multipart/form-data" data-document="{{ $docTitle }}">
                                @csrf
                                <input type="hidden" name="documents" value="{{ $docTitle }}">
                                <input type="hidden" name="defense_type" value="Pre-Oral Re-Defense">
                                <input type="hidden" name="department" value="{{ auth()->user()->department ?? 'N/A' }}">
                                <input type="hidden" name="cluster" value="{{ auth()->user()->section_cluster ?? 4101 }}">
                                <input type="hidden" name="group_no" value="{{ auth()->user()->group_no ?? 0 }}">
                                <label class="form-label mb-2 form-label-hidden">Upload a File</label>
                                <div class="input-group">
                                    <input type="file" name="file" class="form-control" required>
                                    <button class="btn btn-primary" type="submit">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="stage-box p-4 mt-4 shadow-sm mb-5">
        <div class="stage-title text-center fw-bold fs-5">Final Defense</div> 
        
        <h5 class="section-header fw-bold mb-3 text-primary">Final Defense</h5>
        <div class="defense-section p-3 p-md-4">
            <div class="accordion accordion-flush" id="finalDefenseAccordion">
                @foreach(['Summary of Corrections', 'Clearance', 'Manuscript Chapter 1-5'] as $docTitle)
                    @php
                        $docUniqueID = 'final-defense-' . strtolower(str_replace(' ', '-', $docTitle));
                        $formTargetID = 'form-collapse-finaldefense-' . $docUniqueID;
                    @endphp
                    
                    <div class="accordion-item document-item">
                        <h2 class="accordion-header" id="heading-{{ $docUniqueID }}">
                            <button class="accordion-button document-title-link collapsed" type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#{{ $formTargetID }}" 
                                aria-expanded="false" 
                                aria-controls="{{ $formTargetID }}">
                                <span>{{ $docTitle }}</span>
                            </button>
                        </h2>
                        <div id="{{ $formTargetID }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $docUniqueID }}" data-bs-parent="#finalDefenseAccordion">
                            <div class="accordion-body upload-form-content">
                                <form class="upload-form" action="{{ route('student.submissions.store') }}" method="POST" enctype="multipart/form-data" data-document="{{ $docTitle }}">
                                    @csrf
                                    <input type="hidden" name="documents" value="{{ $docTitle }}">
                                    <input type="hidden" name="defense_type" value="Final Defense">
                                    <input type="hidden" name="department" value="{{ auth()->user()->department ?? 'N/A' }}">
                                    <input type="hidden" name="cluster" value="{{ auth()->user()->section_cluster ?? 4101 }}">
                                    <input type="hidden" name="group_no" value="{{ auth()->user()->group_no ?? 0 }}">
                                    <label class="form-label mb-2 form-label-hidden">Upload a File</label>
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
        
        <h5 class="section-header fw-bold mb-3 mt-4 text-primary">Re-Defense</h5>
        <div class="defense-section p-3 p-md-4">
            <div class="accordion accordion-flush" id="finalDefenseReDefenseAccordion">
                @php
                    $docTitle = 'Clearance';
                    $docUniqueID = 'final-re-defense-clearance';
                    $formTargetID = 'form-collapse-finaldefense-' . $docUniqueID;
                @endphp
                <div class="accordion-item document-item">
                    <h2 class="accordion-header" id="heading-{{ $docUniqueID }}">
                        <button class="accordion-button document-title-link collapsed" type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#{{ $formTargetID }}" 
                            aria-expanded="false" 
                            aria-controls="{{ $formTargetID }}">
                            <span>{{ $docTitle }}</span>
                        </button>
                    </h2>
                    <div id="{{ $formTargetID }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $docUniqueID }}" data-bs-parent="#finalDefenseReDefenseAccordion">
                        <div class="accordion-body upload-form-content">
                            <form class="upload-form" action="{{ route('student.submissions.store') }}" method="POST" enctype="multipart/form-data" data-document="{{ $docTitle }}">
                                @csrf
                                <input type="hidden" name="documents" value="{{ $docTitle }}">
                                <input type="hidden" name="defense_type" value="Final Defense Re-Defense">
                                <input type="hidden" name="department" value="{{ auth()->user()->department ?? 'N/A' }}">
                                <input type="hidden" name="cluster" value="{{ auth()->user()->section_cluster ?? 4101 }}">
                                <input type="hidden" name="group_no" value="{{ auth()->user()->group_no ?? 0 }}">
                                <label class="form-label mb-2 form-label-hidden">Upload a File</label>
                                <div class="input-group">
                                    <input type="file" name="file" class="form-control" required>
                                    <button class="btn btn-primary" type="submit">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(isset($submissions) && $submissions->count() > 0)
    <div class="stage-box p-4 mt-4 shadow-sm">
        <div class="stage-title">Document Status</div>
        <div class="defense-section">
            @foreach($submissions as $submission)
                @php
                    $statusClass = match($submission->status) {
                        'Approved' => 'bg-success',
                        'Rejected' => 'bg-danger',
                        default => 'bg-warning text-dark',
                    };
                @endphp
                <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                    <div>
                        <h6 class="mb-1">{{ $submission->documents }} <small class="text-muted">({{ $submission->defense_type ?? 'N/A' }})</small></h6>
                        <small class="text-muted d-block">Submitted: {{ $submission->created_at->format('Y-m-d') }}</small>
                        <small class="text-muted d-block">Approval: {{ $submission->updated_at->format('Y-m-d') ?? 'N/A' }}</small>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge {{ $statusClass }} status-badge">{{ $submission->status }}</span>
                        @if($submission->status === 'Rejected')
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#resubmitModal{{ $submission->id }}">
                                <i class="bi bi-arrow-repeat"></i> Resubmit
                            </button>
                        @endif
                    </div>
                </div>
                
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
                                            <input type="text" name="documents" class="form-control rounded-3" value="{{ $submission->documents }}" required>
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
            @endforeach
        </div>
    </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    function attachFormEventListeners() {
        document.querySelectorAll('.upload-form').forEach(form => {
            form.removeEventListener('submit', handleFormSubmit);
            form.addEventListener('submit', handleFormSubmit);
        });
    }

    function handleFormSubmit(e) {
        const documentTitle = e.target.getAttribute('data-document');
        const fileInput = e.target.querySelector('input[type="file"]');
        const file = fileInput.files[0];

        if (!file) {
            e.preventDefault();
            alert('Please choose a file to upload.');
            return false;
        }
    }

    attachFormEventListeners();
});
</script>
@endsection