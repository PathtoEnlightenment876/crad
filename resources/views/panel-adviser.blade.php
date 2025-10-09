@extends('layouts.app')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .section-occupied {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            opacity: 0.7;
        }
        .section-available {
            transition: all 0.2s ease;
        }
        .section-available:hover {
            background-color: #e7f3ff;
            border-radius: 0.375rem;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-5">ADVISER & PANEL ASSIGNMENT</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <ul class="nav nav-tabs" id="mainTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="adviser-tab" data-bs-toggle="tab" data-bs-target="#adviser-content"
                    type="button" role="tab">
                    <i class="bi bi-person-badge-fill me-2"></i> Manage Advisers
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="panel-tab" data-bs-toggle="tab" data-bs-target="#panel-content" type="button"
                    role="tab">
                    <i class="bi bi-person-workspace me-2"></i> Manage Panels
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="assignment-tab" data-bs-toggle="tab" data-bs-target="#assignment-content" type="button"
                    role="tab">
                    <i class="bi bi-clipboard-check me-2"></i> Assignment
                </button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="adviser-content" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center mb-4 pt-3">
                    <h2 class="h5 mb-0 text-success fw-bold">Adviser Management</h2>
                    <div>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addAdviserModal">
                            <i class="bi bi-person-plus-fill me-1"></i> Add Adviser
                        </button>
                        <button class="btn btn-secondary ms-2" data-bs-toggle="modal" data-bs-target="#archiveAdviserModal">
                            <i class="bi bi-archive me-1"></i> Archive
                        </button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <label for="adviserFilter" class="form-label me-2">Filter by Department:</label>
                        <select id="adviserFilter" class="form-select w-auto" onchange="filterAdvisers()">
                            <option value="">All Departments</option>
                            <option value="BSIT">BSIT</option>
                            <option value="CRIM">CRIM</option>
                            <option value="EDUC">EDUC</option>
                            <option value="BSBA">BSBA</option>
                            <option value="Psychology">Psychology</option>
                            <option value="BSHM">BSHM</option>
                            <option value="BSTM">BSTM</option>
                        </select>
                    </div>
                    <div class="card-body">
                        @if($advisers->count() > 0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Department</th>
                                        <th>Name</th>
                                        <th>Expertise</th>
                                        <th>Sections</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="adviserTableBody">
                                    @foreach($advisers as $adviser)
                                        <tr data-department="{{ $adviser->department }}">
                                            <td>{{ $adviser->department }}</td>
                                            <td>{{ $adviser->name }}</td>
                                            <td>{{ $adviser->expertise }}</td>
                                            <td>
                                                @php
                                                    $adviserSections = is_array($adviser->sections) ? $adviser->sections : [$adviser->sections];
                                                @endphp
                                                @foreach($adviserSections as $section)
                                                    @php
                                                        $assignedToThis = $assignments->where('department', $adviser->department)
                                                                                ->where('section', $section)
                                                                                ->where('adviser_id', $adviser->id)
                                                                                ->first();
                                                        $assignedToOther = $assignments->where('department', $adviser->department)
                                                                                ->where('section', $section)
                                                                                ->where('adviser_id', '!=', $adviser->id)
                                                                                ->first();
                                                    @endphp
                                                    @if($assignedToThis)
                                                        <span class="badge bg-success me-1">
                                                            {{ $section }} <i class="bi bi-check-circle ms-1"></i>
                                                        </span>
                                                    @elseif($assignedToOther)
                                                        <span class="badge bg-danger me-1">
                                                            {{ $section }} <i class="bi bi-x-circle ms-1"></i>
                                                        </span>
                                                    @else
                                                        <span class="badge bg-secondary me-1">
                                                            {{ $section }}
                                                        </span>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal"
                                                    data-bs-target="#editAdviserModal{{ $adviser->id }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="deleteAdviser({{ $adviser->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-center text-muted">No advisers found. Add one to get started.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="panel-content" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center mb-4 pt-3">
                    <h2 class="h5 mb-0 text-primary fw-bold">Panel Management</h2>
                    <div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPanelModal">
                            <i class="bi bi-person-plus-fill me-1"></i> Add Panel Member
                        </button>
                        <button class="btn btn-secondary ms-2" data-bs-toggle="modal" data-bs-target="#archivePanelModal">
                            <i class="bi bi-archive me-1"></i> Archive
                        </button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <label for="panelFilter" class="form-label me-2">Filter by Department:</label>
                        <select id="panelFilter" class="form-select w-auto" onchange="filterPanels()">
                            <option value="">All Departments</option>
                            <option value="BSIT">BSIT</option>
                            <option value="CRIM">CRIM</option>
                            <option value="EDUC">EDUC</option>
                            <option value="BSBA">BSBA</option>
                            <option value="Psychology">Psychology</option>
                            <option value="BSHM">BSHM</option>
                            <option value="BSTM">BSTM</option>
                        </select>
                    </div>
                    <div class="card-body">
                        @if($panels->count() > 0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Department</th>
                                        <th>Name</th>
                                        <th>Expertise</th>
                                        <th>Availability</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="panelTableBody">
                                    @foreach($panels as $panel)
                                        <tr data-department="{{ $panel->department }}">
                                            <td>{{ $panel->department }}</td>
                                            <td>{{ $panel->name }}</td>
                                            <td>{{ $panel->expertise }}</td>
                                            <td>
                                                @if(is_array($panel->availability) && count($panel->availability) > 0)
                                                    <ul class="list-unstyled mb-0">
                                                        @foreach(array_slice($panel->availability, 0, 2) as $slot)
                                                            <li>
                                                                <small>{{ $slot['date'] }} ({{ $slot['time'] }})</small>
                                                            </li>
                                                        @endforeach
                                                        @if(count($panel->availability) > 2)
                                                            <li><small class="text-muted">+{{ count($panel->availability) - 2 }} more</small></li>
                                                        @endif
                                                    </ul>
                                                @else
                                                    <small class="text-muted">No availability</small>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal"
                                                    data-bs-target="#editPanelModal{{ $panel->id }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="deletePanel({{ $panel->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-center text-muted">No panel members found. Add one to get started.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="assignment-content" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center mb-4 pt-3">
                    <h2 class="h5 mb-0 text-warning fw-bold">Assignment</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAssignmentModal">
                        <i class="bi bi-plus-circle-fill me-1"></i> Add Assignment
                    </button>
                </div>

                <div class="card">
                    <div class="card-header">
                        <label for="assignmentFilter" class="form-label me-2">Filter by Department:</label>
                        <select id="assignmentFilter" class="form-select w-auto" onchange="filterAssignments()">
                            <option value="">All Departments</option>
                            <option value="BSIT">BSIT</option>
                            <option value="CRIM">CRIM</option>
                            <option value="EDUC">EDUC</option>
                            <option value="BSBA">BSBA</option>
                            <option value="Psychology">Psychology</option>
                            <option value="BSHM">BSHM</option>
                            <option value="BSTM">BSTM</option>
                        </select>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Department</th>
                                        <th>Section</th>
                                        <th>Adviser</th>
                                        <th>Expertise</th>
                                        <th>Panel Members</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="assignmentTableBody">
                                    @forelse($assignments as $assignment)
                                        <tr>
                                            <td>{{ $assignment->department }}</td>
                                            <td>{{ $assignment->section }}</td>
                                            <td>{{ $assignment->adviser ? $assignment->adviser->name : 'No Adviser' }}</td>
                                            <td>{{ $assignment->adviser ? $assignment->adviser->expertise : 'N/A' }}</td>
                                            <td>
                                                @if($assignment->assignmentPanels && $assignment->assignmentPanels->count() > 0)
                                                    @foreach($assignment->assignmentPanels as $panel)
                                                        <span class="badge bg-secondary me-1">{{ $panel->name }}</span>
                                                    @endforeach
                                                @else
                                                    <span class="text-muted">No panels</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#editAssignmentModal{{ $assignment->id }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="deleteAssignment({{ $assignment->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-3 text-muted">
                                                No assignments found. Click "Add Assignment" to create your first assignment.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Adviser Modal -->
    <div class="modal fade" id="addAdviserModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('advisers.store') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Add New Adviser</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="department" class="form-label">Department *</label>
                            <select name="department" class="form-select" required onchange="updateAdviserSections()">
                                <option value="">Select Department</option>
                                <option value="BSIT">BSIT</option>
                                <option value="CRIM">CRIM</option>
                                <option value="EDUC">EDUC</option>
                                <option value="BSBA">BSBA</option>
                                <option value="Psychology">Psychology</option>
                                <option value="BSHM">BSHM</option>
                                <option value="BSTM">BSTM</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sections *</label>
                            <div class="row">
                                @foreach(['4101', '4102', '4103', '4104', '4105', '4106', '4107', '4108', '4109', '4110'] as $section)
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input section-checkbox" type="checkbox" name="sections[]"
                                                value="{{ $section }}" id="section{{ $section }}" data-section="{{ $section }}">
                                            <label class="form-check-label" for="section{{ $section }}">
                                                {{ $section }} <span class="occupied-indicator"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <small class="text-info"><i class="bi bi-info-circle me-1"></i>Select a department first to see section availability. Occupied sections cannot be selected.</small>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" name="name" class="form-control" placeholder="E.g., Prof. Maria Santos"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="expertise" class="form-label">Expertise *</label>
                            <select name="expertise" class="form-select" required>
                                <option value="">Select Expertise</option>
                                <option value="Instructor">Instructor</option>
                                <option value="Assistant Professor">Assistant Professor</option>
                                <option value="Associate Professor">Associate Professor</option>
                                <option value="Professor">Professor</option>
                                <option value="Doctoral">Doctoral</option>
                                <option value="Industry Expert">Industry Expert</option>
                                <option value="Research Specialist">Research Specialist</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save Adviser</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Panel Modal -->
    <div class="modal fade" id="addPanelModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="{{ route('panels.store') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Add New Panel Member</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="department" class="form-label">Department *</label>
                                    <select name="department" class="form-select" required>
                                        <option value="">Select Department</option>
                                        <option value="BSIT">BSIT</option>
                                        <option value="CRIM">CRIM</option>
                                        <option value="EDUC">EDUC</option>
                                        <option value="BSBA">BSBA</option>
                                        <option value="Psychology">Psychology</option>
                                        <option value="BSHM">BSHM</option>
                                        <option value="BSTM">BSTM</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name *</label>
                                    <input type="text" name="name" class="form-control" placeholder="E.g., Dr. Juan Dela Cruz" required />
                                </div>
                                <div class="mb-3">
                                    <label for="expertise" class="form-label">Expertise *</label>
                                    <select name="expertise" class="form-select" required>
                                        <option value="">Select Expertise</option>
                                        <option value="Instructor">Instructor</option>
                                        <option value="Assistant Professor">Assistant Professor</option>
                                        <option value="Associate Professor">Associate Professor</option>
                                        <option value="Professor">Professor</option>
                                        <option value="Doctoral">Doctoral</option>
                                        <option value="Industry Expert">Industry Expert</option>
                                        <option value="Research Specialist">Research Specialist</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Availability Summary</label>
                                    <textarea id="availabilitySummary" class="form-control" rows="3" readonly></textarea>
                                    <input type="hidden" name="availability" id="availabilityInput">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-3">Add Availability Slots *</h6>
                                <div class="mb-3">
                                    <label for="slotDate" class="form-label">Date</label>
                                    <input type="date" id="slotDate" class="form-control" />
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="startTime" class="form-label">Start Time</label>
                                        <input type="time" id="startTime" class="form-control" />
                                    </div>
                                    <div class="col-6">
                                        <label for="endTime" class="form-label">End Time</label>
                                        <input type="time" id="endTime" class="form-control" />
                                    </div>
                                </div>
                                <button type="button" class="btn btn-info w-100 text-white fw-bold mb-3" onclick="addSlot()">
                                    <i class="bi bi-plus-circle-fill me-1"></i> Add Slot
                                </button>
                                <h6><i class="bi bi-clock-history me-1"></i> Added Slots:</h6>
                                <ul id="slotsList" class="list-group list-group-flush border rounded p-2">
                                    <li class="text-muted small">No slots added yet.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Panel Member</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Edit Adviser Modals -->
    @foreach($advisers as $adviser)
        <div class="modal fade" id="editAdviserModal{{ $adviser->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('advisers.update', $adviser->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title">Edit Adviser</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Department *</label>
                                <select name="department" class="form-select" required>
                                    <option value="BSIT" {{ $adviser->department == 'BSIT' ? 'selected' : '' }}>BSIT</option>
                                    <option value="CRIM" {{ $adviser->department == 'CRIM' ? 'selected' : '' }}>CRIM</option>
                                    <option value="EDUC" {{ $adviser->department == 'EDUC' ? 'selected' : '' }}>EDUC</option>
                                    <option value="BSBA" {{ $adviser->department == 'BSBA' ? 'selected' : '' }}>BSBA</option>
                                    <option value="Psychology" {{ $adviser->department == 'Psychology' ? 'selected' : '' }}>Psychology</option>
                                    <option value="BSHM" {{ $adviser->department == 'BSHM' ? 'selected' : '' }}>BSHM</option>
                                    <option value="BSTM" {{ $adviser->department == 'BSTM' ? 'selected' : '' }}>BSTM</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sections *</label>
                                <div class="row">
                                    @foreach(['4101', '4102', '4103', '4104', '4105', '4106', '4107', '4108', '4109', '4110'] as $section)
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="sections[]"
                                                    value="{{ $section }}" id="editSection{{ $adviser->id }}{{ $section }}" {{ is_array($adviser->sections) && in_array($section, $adviser->sections) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="editSection{{ $adviser->id }}{{ $section }}">{{ $section }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name *</label>
                                <input type="text" name="name" class="form-control" value="{{ $adviser->name }}" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Expertise *</label>
                                <select name="expertise" class="form-select" required>
                                    <option value="Instructor" {{ $adviser->expertise == 'Instructor' ? 'selected' : '' }}>Instructor</option>
                                    <option value="Assistant Professor" {{ $adviser->expertise == 'Assistant Professor' ? 'selected' : '' }}>Assistant Professor</option>
                                    <option value="Associate Professor" {{ $adviser->expertise == 'Associate Professor' ? 'selected' : '' }}>Associate Professor</option>
                                    <option value="Professor" {{ $adviser->expertise == 'Professor' ? 'selected' : '' }}>Professor</option>
                                    <option value="Doctoral" {{ $adviser->expertise == 'Doctoral' ? 'selected' : '' }}>Doctoral</option>
                                    <option value="Industry Expert" {{ $adviser->expertise == 'Industry Expert' ? 'selected' : '' }}>Industry Expert</option>
                                    <option value="Research Specialist" {{ $adviser->expertise == 'Research Specialist' ? 'selected' : '' }}>Research Specialist</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Update Adviser</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Edit Panel Modals -->
    @foreach($panels as $panel)
        <div class="modal fade" id="editPanelModal{{ $panel->id }}" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form action="{{ route('panels.update', $panel->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Edit Panel Member</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Department *</label>
                                        <select name="department" class="form-select" required>
                                            <option value="BSIT" {{ $panel->department == 'BSIT' ? 'selected' : '' }}>BSIT</option>
                                            <option value="CRIM" {{ $panel->department == 'CRIM' ? 'selected' : '' }}>CRIM</option>
                                            <option value="EDUC" {{ $panel->department == 'EDUC' ? 'selected' : '' }}>EDUC</option>
                                            <option value="BSBA" {{ $panel->department == 'BSBA' ? 'selected' : '' }}>BSBA</option>
                                            <option value="Psychology" {{ $panel->department == 'Psychology' ? 'selected' : '' }}>Psychology</option>
                                            <option value="BSHM" {{ $panel->department == 'BSHM' ? 'selected' : '' }}>BSHM</option>
                                            <option value="BSTM" {{ $panel->department == 'BSTM' ? 'selected' : '' }}>BSTM</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Name *</label>
                                        <input type="text" name="name" class="form-control" value="{{ $panel->name }}" required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Expertise *</label>
                                        <select name="expertise" class="form-select" required>
                                            <option value="Instructor" {{ $panel->expertise == 'Instructor' ? 'selected' : '' }}>Instructor</option>
                                            <option value="Assistant Professor" {{ $panel->expertise == 'Assistant Professor' ? 'selected' : '' }}>Assistant Professor</option>
                                            <option value="Associate Professor" {{ $panel->expertise == 'Associate Professor' ? 'selected' : '' }}>Associate Professor</option>
                                            <option value="Professor" {{ $panel->expertise == 'Professor' ? 'selected' : '' }}>Professor</option>
                                            <option value="Doctoral" {{ $panel->expertise == 'Doctoral' ? 'selected' : '' }}>Doctoral</option>
                                            <option value="Industry Expert" {{ $panel->expertise == 'Industry Expert' ? 'selected' : '' }}>Industry Expert</option>
                                            <option value="Research Specialist" {{ $panel->expertise == 'Research Specialist' ? 'selected' : '' }}>Research Specialist</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Availability Summary</label>
                                        <textarea id="editAvailabilitySummary{{ $panel->id }}" class="form-control" rows="3" readonly></textarea>
                                        <input type="hidden" name="availability" id="editAvailabilityInput{{ $panel->id }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="mb-3">Add Availability Slots</h6>
                                    <div class="mb-3">
                                        <label for="editSlotDate{{ $panel->id }}" class="form-label">Date</label>
                                        <input type="date" id="editSlotDate{{ $panel->id }}" class="form-control" />
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label for="editStartTime{{ $panel->id }}" class="form-label">Start Time</label>
                                            <input type="time" id="editStartTime{{ $panel->id }}" class="form-control" />
                                        </div>
                                        <div class="col-6">
                                            <label for="editEndTime{{ $panel->id }}" class="form-label">End Time</label>
                                            <input type="time" id="editEndTime{{ $panel->id }}" class="form-control" />
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-info w-100 text-white fw-bold mb-3" onclick="addEditSlot({{ $panel->id }})">
                                        <i class="bi bi-plus-circle-fill me-1"></i> Add Slot
                                    </button>
                                    <h6><i class="bi bi-clock-history me-1"></i> Current Slots:</h6>
                                    <ul id="editSlotsList{{ $panel->id }}" class="list-group list-group-flush border rounded p-2">
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Panel Member</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Archive Adviser Modal -->
    <div class="modal fade" id="archiveAdviserModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title">Archived Advisers</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Expertise</th>
                                    <th>Archived Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="archivedAdvisersBody">
                                <tr><td colspan="5" class="text-center">Loading...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Archive Panel Modal -->
    <div class="modal fade" id="archivePanelModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title">Archived Panel Members</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Expertise</th>
                                    <th>Archived Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="archivedPanelsBody">
                                <tr><td colspan="5" class="text-center">Loading...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Assignment Modal -->
    <div class="modal fade" id="addAssignmentModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="addAssignmentForm">
                    @csrf
                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title">Add New Assignment</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Department *</label>
                                <select name="department" class="form-select" required onchange="filterModalMembers()">
                                    <option value="">Select Department</option>
                                    <option value="BSIT">BSIT</option>
                                    <option value="CRIM">CRIM</option>
                                    <option value="EDUC">EDUC</option>
                                    <option value="BSBA">BSBA</option>
                                    <option value="Psychology">Psychology</option>
                                    <option value="BSHM">BSHM</option>
                                    <option value="BSTM">BSTM</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Section/Cluster *</label>
                                <select name="section" class="form-select" required onchange="filterModalMembers()">
                                    <option value="">Select Section</option>
                                    @foreach(['4101', '4102', '4103', '4104', '4105', '4106', '4107', '4108', '4109', '4110'] as $section)
                                        <option value="{{ $section }}" data-section="{{ $section }}">
                                            {{ $section }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Adviser *</label>
                            <select name="adviser_id" class="form-select" required>
                                <option value="">Select Adviser</option>
                                @foreach($advisers as $adviser)
                                    <option value="{{ $adviser->id }}" data-department="{{ $adviser->department }}" data-sections="{{ is_array($adviser->sections) ? implode(',', $adviser->sections) : $adviser->sections }}">
                                        {{ $adviser->name }} ({{ $adviser->department }} - {{ is_array($adviser->sections) ? implode(', ', $adviser->sections) : $adviser->sections }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Panel Members *</label>
                            <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                                @foreach($panels as $panel)
                                    <div class="form-check modal-panel-member" data-department="{{ $panel->department }}">
                                        <input class="form-check-input" type="checkbox" name="panel_ids[]" value="{{ $panel->id }}" id="modalPanel{{ $panel->id }}">
                                        <label class="form-check-label" for="modalPanel{{ $panel->id }}">
                                            {{ $panel->name }} ({{ $panel->department }} - {{ $panel->expertise }})
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning" id="createAssignmentBtn">Create Assignment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Assignment Modals -->
    @foreach($assignments as $assignment)
        <div class="modal fade" id="editAssignmentModal{{ $assignment->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="editAssignmentForm{{ $assignment->id }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-header bg-warning text-white">
                            <h5 class="modal-title">Edit Assignment</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Department *</label>
                                    <select name="department" class="form-select" required>
                                        <option value="BSIT" {{ $assignment->department == 'BSIT' ? 'selected' : '' }}>BSIT</option>
                                        <option value="CRIM" {{ $assignment->department == 'CRIM' ? 'selected' : '' }}>CRIM</option>
                                        <option value="EDUC" {{ $assignment->department == 'EDUC' ? 'selected' : '' }}>EDUC</option>
                                        <option value="BSBA" {{ $assignment->department == 'BSBA' ? 'selected' : '' }}>BSBA</option>
                                        <option value="Psychology" {{ $assignment->department == 'Psychology' ? 'selected' : '' }}>Psychology</option>
                                        <option value="BSHM" {{ $assignment->department == 'BSHM' ? 'selected' : '' }}>BSHM</option>
                                        <option value="BSTM" {{ $assignment->department == 'BSTM' ? 'selected' : '' }}>BSTM</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Section/Cluster *</label>
                                    <select name="section" class="form-select" required>
                                        @foreach(['4101', '4102', '4103', '4104', '4105', '4106', '4107', '4108', '4109', '4110'] as $section)
                                            <option value="{{ $section }}" {{ $assignment->section == $section ? 'selected' : '' }}>{{ $section }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Adviser *</label>
                                <select name="adviser_id" class="form-select" required>
                                    @foreach($advisers as $adviser)
                                        <option value="{{ $adviser->id }}" {{ $assignment->adviser_id == $adviser->id ? 'selected' : '' }}>
                                            {{ $adviser->name }} ({{ $adviser->department }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Panel Members *</label>
                                <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                                    @foreach($panels as $panel)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="panel_ids[]" value="{{ $panel->id }}" id="editPanel{{ $assignment->id }}_{{ $panel->id }}" 
                                                {{ $assignment->assignmentPanels->contains('panel_id', $panel->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="editPanel{{ $assignment->id }}_{{ $panel->id }}">
                                                {{ $panel->name }} ({{ $panel->department }} - {{ $panel->expertise }})
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-warning">Update Assignment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('scripts')
<script>
    function togglePanelDropdown() {
    const menu = document.getElementById('panelDropdownMenu');
    menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
}
const advisersData = @json($advisers);  // Array of advisers
const panelsData = @json($panels); 

let availabilitySlots = [];          
let editAvailabilitySlots = {};






// ------------------
// Adviser & Panel Filtering
// ------------------
function filterAdvisers() {
    const filter = document.getElementById('adviserFilter').value.toLowerCase();
    document.querySelectorAll('#adviserTableBody tr').forEach(row => {
        row.style.display = (!filter || row.dataset.department.toLowerCase() === filter) ? '' : 'none';
    });
}

function filterPanels() {
    const filter = document.getElementById('panelFilter').value.toLowerCase();
    document.querySelectorAll('#panelTableBody tr').forEach(row => {
        row.style.display = (!filter || row.dataset.department.toLowerCase() === filter) ? '' : 'none';
    });
}

function filterAssignments() {
    const filter = document.getElementById('assignmentFilter').value.toLowerCase();
    document.querySelectorAll('#assignmentTableBody tr').forEach(row => {
        const departmentCell = row.cells[0];
        if (departmentCell) {
            const department = departmentCell.textContent.toLowerCase();
            row.style.display = (!filter || department === filter) ? '' : 'none';
        }
    });
}

// ------------------
// Modal Assignment Functions
// ------------------
function filterModalMembers() {
    const modal = document.getElementById('addAssignmentModal');
    const dept = modal.querySelector('select[name="department"]').value;
    const section = modal.querySelector('select[name="section"]').value;

    // Update section options based on department
    const sectionSelect = modal.querySelector('select[name="section"]');
    const sectionOptions = sectionSelect.querySelectorAll('option[data-section]');
    const assignmentsData = @json($assignments->groupBy('department'));
    
    sectionOptions.forEach(option => {
        const sectionValue = option.dataset.section;
        const isOccupied = dept && assignmentsData[dept] && 
            assignmentsData[dept].some(assignment => assignment.section === sectionValue);
        
        if (isOccupied) {
            option.disabled = true;
            option.textContent = sectionValue + ' (Occupied)';
        } else {
            option.disabled = false;
            option.textContent = sectionValue;
        }
    });

    // Filter advisers
    const adviserSelect = modal.querySelector('select[name="adviser_id"]');
    const adviserOptions = adviserSelect.querySelectorAll('option[data-department]');
    
    adviserOptions.forEach(option => {
        const optionDept = option.dataset.department;
        const optionSections = option.dataset.sections.split(',').map(s => s.trim());
        
        if (dept && section && optionDept === dept && optionSections.includes(section)) {
            option.style.display = 'block';
        } else if (!dept || !section) {
            option.style.display = 'block';
        } else {
            option.style.display = 'none';
        }
    });

    // Filter panel members
    const panelMembers = modal.querySelectorAll('.modal-panel-member');
    panelMembers.forEach(member => {
        member.style.display = (dept && member.dataset.department === dept) ? 'block' : 'none';
        member.querySelector('input').checked = false;
    });
}

// Update adviser sections based on department
function updateAdviserSections() {
    const modal = document.getElementById('addAdviserModal');
    const dept = modal.querySelector('select[name="department"]').value;
    const checkboxes = modal.querySelectorAll('.section-checkbox');
    const advisersData = @json($advisers->groupBy('department'));
    
    checkboxes.forEach(checkbox => {
        const section = checkbox.dataset.section;
        const indicator = checkbox.parentElement.querySelector('.occupied-indicator');
        const label = checkbox.parentElement.querySelector('label');
        const formCheck = checkbox.parentElement.parentElement;
        
        // Check if this section is already taken by another adviser in this department
        let isOccupied = false;
        if (dept && advisersData[dept]) {
            isOccupied = advisersData[dept].some(adviser => {
                const adviserSections = Array.isArray(adviser.sections) ? adviser.sections : [adviser.sections];
                return adviserSections.includes(section);
            });
        }
        
        if (isOccupied) {
            checkbox.disabled = true;
            checkbox.checked = false;
            label.classList.add('text-muted', 'text-decoration-line-through');
            formCheck.classList.add('section-occupied', 'p-2');
            formCheck.classList.remove('section-available');
            indicator.innerHTML = '<span class="badge bg-danger ms-2"><i class="bi bi-x-circle me-1"></i>Taken</span>';
        } else {
            checkbox.disabled = false;
            label.classList.remove('text-muted', 'text-decoration-line-through');
            formCheck.classList.remove('section-occupied', 'p-2');
            formCheck.classList.add('section-available', 'p-1');
            indicator.innerHTML = '<span class="badge bg-success ms-2"><i class="bi bi-check-circle me-1"></i>Available</span>';
        }
    });
}



// ------------------
// Add Panel Availability Slots
// ------------------
function addSlot() {
    const date = document.getElementById('slotDate').value;
    const startTime = document.getElementById('startTime').value;
    const endTime = document.getElementById('endTime').value;

    if (!date || !startTime || !endTime) { alert('Please fill all fields'); return; }
    if (new Date(`${date}T${startTime}`) >= new Date(`${date}T${endTime}`)) { alert('End time must be after start time'); return; }

    // Prevent duplicates
    if (!availabilitySlots.some(s => s.date === date && s.time === `${startTime} - ${endTime}`)) {
        availabilitySlots.push({ date, time: `${startTime} - ${endTime}` });
    }

    renderSlots();
}

function removeSlot(index) {
    availabilitySlots.splice(index, 1);
    renderSlots();
}

function renderSlots() {
    const list = document.getElementById('slotsList');
    const summary = document.getElementById('availabilitySummary');
    const input = document.getElementById('availabilityInput');

    list.innerHTML = '';
    if (!availabilitySlots.length) {
        list.innerHTML = '<li class="text-muted small">No slots added yet.</li>';
        summary.value = 'No availability slots added';
        input.value = JSON.stringify([]);
        return;
    }

    availabilitySlots.forEach((slot, i) => {
        const li = document.createElement('li');
        li.className = 'list-group-item d-flex justify-content-between align-items-center';
        li.innerHTML = `<span>${slot.date} (${slot.time})</span>
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeSlot(${i})">
                            <i class="bi bi-trash"></i>
                        </button>`;
        list.appendChild(li);
    });

    summary.value = availabilitySlots.map(s => `${s.date} (${s.time})`).join('\n');
    input.value = JSON.stringify(availabilitySlots);

    document.getElementById('slotDate').value = '';
    document.getElementById('startTime').value = '';
    document.getElementById('endTime').value = '';
}

// ------------------
// Edit Panel Slots
// ------------------
function addEditSlot(panelId) {
    const date = document.getElementById(`editSlotDate${panelId}`).value;
    const startTime = document.getElementById(`editStartTime${panelId}`).value;
    const endTime = document.getElementById(`editEndTime${panelId}`).value;

    if (!date || !startTime || !endTime) { alert('Please fill all fields'); return; }
    if (new Date(`${date}T${startTime}`) >= new Date(`${date}T${endTime}`)) { alert('End time must be after start time'); return; }

    if (!editAvailabilitySlots[panelId]) editAvailabilitySlots[panelId] = [];
    if (!editAvailabilitySlots[panelId].some(s => s.date === date && s.time === `${startTime} - ${endTime}`)) {
        editAvailabilitySlots[panelId].push({ date, time: `${startTime} - ${endTime}` });
    }
    renderEditSlots(panelId);
}

function removeEditSlot(panelId, index) {
    editAvailabilitySlots[panelId].splice(index, 1);
    renderEditSlots(panelId);
}

function renderEditSlots(panelId) {
    const list = document.getElementById(`editSlotsList${panelId}`);
    const summary = document.getElementById(`editAvailabilitySummary${panelId}`);
    const input = document.getElementById(`editAvailabilityInput${panelId}`);

    const slots = editAvailabilitySlots[panelId] || [];

    list.innerHTML = '';
    if (!slots.length) {
        list.innerHTML = '<li class="text-muted small">No slots added yet.</li>';
        summary.value = 'No availability slots added';
        input.value = JSON.stringify([]);
        return;
    }

    slots.forEach((slot, i) => {
        const li = document.createElement('li');
        li.className = 'list-group-item d-flex justify-content-between align-items-center';
        li.innerHTML = `<span>${slot.date} (${slot.time})</span>
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeEditSlot(${panelId}, ${i})">
                            <i class="bi bi-trash"></i>
                        </button>`;
        list.appendChild(li);
    });

    summary.value = slots.map(s => `${s.date} (${s.time})`).join('\n');
    input.value = JSON.stringify(slots);

    document.getElementById(`editSlotDate${panelId}`).value = '';
    document.getElementById(`editStartTime${panelId}`).value = '';
    document.getElementById(`editEndTime${panelId}`).value = '';
}

// ------------------
// Initialize Modals
// ------------------
document.getElementById('addPanelModal').addEventListener('show.bs.modal', () => {
    availabilitySlots = [];
    renderSlots();
});

document.getElementById('addAdviserModal').addEventListener('show.bs.modal', () => {
    // Reset form and update sections
    const modal = document.getElementById('addAdviserModal');
    modal.querySelector('select[name="department"]').value = '';
    const checkboxes = modal.querySelectorAll('.section-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
        checkbox.disabled = false;
        const formCheck = checkbox.parentElement.parentElement;
        const label = checkbox.parentElement.querySelector('label');
        const indicator = checkbox.parentElement.querySelector('.occupied-indicator');
        
        label.classList.remove('text-muted', 'text-decoration-line-through');
        formCheck.classList.remove('section-occupied', 'section-available', 'p-1', 'p-2');
        indicator.innerHTML = '';
    });
});

@foreach($panels as $panel)
document.getElementById('editPanelModal{{ $panel->id }}').addEventListener('show.bs.modal', () => {
    if (!editAvailabilitySlots[{{ $panel->id }}]) {
        editAvailabilitySlots[{{ $panel->id }}] = @json($panel->availability ?? []);
    }
    renderEditSlots({{ $panel->id }});
});
@endforeach

// ------------------
// Finalize Assignment Summary
// ------------------




// ------------------
// Add Assignment Form Handler
// ------------------
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('addAssignmentForm');
    const submitBtn = document.getElementById('createAssignmentBtn');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Check if selected section is occupied
        const sectionSelect = form.querySelector('select[name="section"]');
        const selectedOption = sectionSelect.options[sectionSelect.selectedIndex];
        
        if (selectedOption && selectedOption.disabled) {
            alert('❌ This section is already occupied by another adviser. Please select a different section.');
            return;
        }
        
        const formData = new FormData(form);
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i> Creating...';

        fetch("{{ route('assignments.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Create Assignment';

            console.log('Server response:', data);
            
            if (data.success) {
                alert('✅ Assignment created successfully!');
                location.reload();
            } else {
                alert('⚠️ Error: ' + (data.message || data.error || 'Please try again.'));
                console.error('Assignment creation failed:', data);
            }
        })
        .catch(error => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Create Assignment';
            console.error('Error:', error);
            alert('❌ Failed to create assignment. Please try again.');
        });
    });
});

// ------------------
// Delete Assignment Function
// ------------------
function deleteAssignment(assignmentId) {
    if (confirm('Are you sure you want to delete this assignment? This action cannot be undone.')) {
        fetch(`/assignments/${assignmentId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error deleting assignment: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the assignment.');
        });
    }
}



// Archive Functions
function loadArchivedAdvisers() {
    fetch('/advisers/archived')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('archivedAdvisersBody');
            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" class="text-center text-muted">No archived advisers</td></tr>';
                return;
            }
            tbody.innerHTML = data.map(adviser => `
                <tr>
                    <td>${adviser.name}</td>
                    <td>${adviser.department}</td>
                    <td>${adviser.expertise}</td>
                    <td>${new Date(adviser.deleted_at).toLocaleDateString()}</td>
                    <td>
                        <button class="btn btn-sm btn-success me-1" onclick="restoreAdviser(${adviser.id})">
                            <i class="bi bi-arrow-clockwise"></i> Restore
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="permanentDeleteAdviser(${adviser.id})">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </td>
                </tr>
            `).join('');
        });
}

function loadArchivedPanels() {
    fetch('/panels/archived')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('archivedPanelsBody');
            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" class="text-center text-muted">No archived panels</td></tr>';
                return;
            }
            tbody.innerHTML = data.map(panel => `
                <tr>
                    <td>${panel.name}</td>
                    <td>${panel.department}</td>
                    <td>${panel.expertise}</td>
                    <td>${new Date(panel.deleted_at).toLocaleDateString()}</td>
                    <td>
                        <button class="btn btn-sm btn-success me-1" onclick="restorePanel(${panel.id})">
                            <i class="bi bi-arrow-clockwise"></i> Restore
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="permanentDeletePanel(${panel.id})">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </td>
                </tr>
            `).join('');
        });
}

function restoreAdviser(adviserId) {
    if (confirm('Are you sure you want to restore this adviser?')) {
        fetch(`/advisers/${adviserId}/restore`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadArchivedAdvisers();
                location.reload();
            } else {
                alert('Error restoring adviser: ' + data.message);
            }
        });
    }
}

function restorePanel(panelId) {
    if (confirm('Are you sure you want to restore this panel member?')) {
        fetch(`/panels/${panelId}/restore`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadArchivedPanels();
                location.reload();
            } else {
                alert('Error restoring panel member: ' + data.message);
            }
        });
    }
}

// Load archived data when modals are opened
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('archiveAdviserModal').addEventListener('show.bs.modal', loadArchivedAdvisers);
    document.getElementById('archivePanelModal').addEventListener('show.bs.modal', loadArchivedPanels);
    
    // Restore active tab after page reload
    const activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        const tabButton = document.querySelector(`#${activeTab}`);
        const tabContent = document.querySelector(tabButton.getAttribute('data-bs-target'));
        
        // Remove active classes from all tabs
        document.querySelectorAll('.nav-link').forEach(tab => tab.classList.remove('active'));
        document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('show', 'active'));
        
        // Add active classes to selected tab
        tabButton.classList.add('active');
        tabContent.classList.add('show', 'active');
    }
    
    // Save active tab when clicked
    document.querySelectorAll('.nav-link').forEach(tab => {
        tab.addEventListener('click', function() {
            localStorage.setItem('activeTab', this.id);
        });
    });
});

// Delete Functions
function deleteAdviser(adviserId) {
    if (confirm('Are you sure you want to delete this adviser? This action cannot be undone.')) {
        fetch(`/advisers/${adviserId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error deleting adviser: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the adviser.');
        });
    }
}

function deletePanel(panelId) {
    if (confirm('Are you sure you want to delete this panel member? This action cannot be undone.')) {
        fetch(`/panels/${panelId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error deleting panel member: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the panel member.');
        });
    }
}

// Permanent Delete Functions
function permanentDeleteAdviser(adviserId) {
    if (confirm('⚠️ WARNING: This will permanently delete this adviser from the database. This action cannot be undone. Are you sure?')) {
        fetch(`/advisers/${adviserId}/force-delete`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadArchivedAdvisers();
            } else {
                alert('Error permanently deleting adviser: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while permanently deleting the adviser.');
        });
    }
}

function permanentDeletePanel(panelId) {
    if (confirm('⚠️ WARNING: This will permanently delete this panel member from the database. This action cannot be undone. Are you sure?')) {
        fetch(`/panels/${panelId}/force-delete`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadArchivedPanels();
            } else {
                alert('Error permanently deleting panel member: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while permanently deleting the panel member.');
        });
    }
}
</script>
@endsection