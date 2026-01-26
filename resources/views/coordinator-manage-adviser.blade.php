@extends('layouts.coordinator')

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
@endsection

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Manage Adviser</h2>
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0 text-success fw-bold">Adviser Management</h5>
        <div>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addAdviserModal">
                <i class="bi bi-person-plus-fill me-1"></i> Add Adviser
            </button>
            <button class="btn btn-secondary ms-2" data-bs-toggle="modal" data-bs-target="#archiveAdviserModal">
                <i class="bi bi-archive me-1"></i> Inactive
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            @if(isset($advisers) && $advisers->count() > 0)
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
                                            $assignedToThis = isset($assignments) ? $assignments->where('department', $adviser->department)
                                                                            ->where('section', $section)
                                                                            ->where('adviser_id', $adviser->id)
                                                                            ->first() : null;
                                            $assignedToOther = isset($assignments) ? $assignments->where('department', $adviser->department)
                                                                            ->where('section', $section)
                                                                            ->where('adviser_id', '!=', $adviser->id)
                                                                            ->first() : null;
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
                                    <button class="btn btn-sm btn-secondary" onclick="deleteAdviser({{ $adviser->id }})">
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

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationTitle">Are you sure?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="confirmationMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmationBtn">Confirm</button>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-success">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successTitle">Success</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="bi bi-check-circle" style="font-size: 3rem; color: #34a853;"></i>
                    <p id="successMessage" class="mt-3"></p>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
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
                        <input type="text" name="department" class="form-control" value="{{ Auth::user()->department }}" readonly required>
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
                        <select name="expertise" class="form-select" required onchange="toggleAdviserOthersInput(this)">
                            <option value="">Select Expertise</option>
                            <option value="Instructor">Instructor</option>
                            <option value="Assistant Professor">Assistant Professor</option>
                            <option value="Associate Professor">Associate Professor</option>
                            <option value="Professor">Professor</option>
                            <option value="Doctoral">Doctoral</option>
                            <option value="Industry Expert">Industry Expert</option>
                            <option value="Research Specialist">Research Specialist</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="mb-3" id="adviserOthersInputDiv" style="display: none;">
                        <label for="adviserOthersInput" class="form-label">Specify Other Expertise</label>
                        <input type="text" id="adviserOthersInput" name="others_expertise" class="form-control" placeholder="Enter specific expertise">
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

<!-- Edit Adviser Modals -->
@if(isset($advisers))
    @foreach($advisers as $adviser)
        <div class="modal fade" id="editAdviserModal{{ $adviser->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="editAdviserForm{{ $adviser->id }}" action="{{ route('advisers.update', $adviser->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Edit Adviser</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Department *</label>
                                        <input type="text" name="department" class="form-control form-control-sm" value="{{ $adviser->department }}" readonly required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Name *</label>
                                        <input type="text" name="name" class="form-control form-control-sm" value="{{ $adviser->name }}" required />
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Expertise *</label>
                                <select name="expertise" class="form-select form-select-sm" required>
                                    <option value="Instructor" {{ $adviser->expertise == 'Instructor' ? 'selected' : '' }}>Instructor</option>
                                    <option value="Assistant Professor" {{ $adviser->expertise == 'Assistant Professor' ? 'selected' : '' }}>Assistant Professor</option>
                                    <option value="Associate Professor" {{ $adviser->expertise == 'Associate Professor' ? 'selected' : '' }}>Associate Professor</option>
                                    <option value="Professor" {{ $adviser->expertise == 'Professor' ? 'selected' : '' }}>Professor</option>
                                    <option value="Doctoral" {{ $adviser->expertise == 'Doctoral' ? 'selected' : '' }}>Doctoral</option>
                                    <option value="Industry Expert" {{ $adviser->expertise == 'Industry Expert' ? 'selected' : '' }}>Industry Expert</option>
                                    <option value="Research Specialist" {{ $adviser->expertise == 'Research Specialist' ? 'selected' : '' }}>Research Specialist</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Sections *</label>
                                <div class="border rounded p-3" style="background-color: #f8f9fa; max-height: 250px; overflow-y: auto;">
                                    <div class="row g-2">
                                        @foreach(['4101', '4102', '4103', '4104', '4105', '4106', '4107', '4108', '4109', '4110'] as $section)
                                            <div class="col-6">
                                                @php
                                                    $isOccupiedByOther = isset($assignments) ? $assignments->where('department', $adviser->department)
                                                                                  ->where('section', $section)
                                                                                  ->where('adviser_id', '!=', $adviser->id)
                                                                                  ->first() : null;
                                                    $isCurrentlyAssigned = is_array($adviser->sections) && in_array($section, $adviser->sections);
                                                @endphp
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="sections[]"
                                                        value="{{ $section }}" id="editSection{{ $adviser->id }}{{ $section }}" 
                                                        {{ $isCurrentlyAssigned ? 'checked' : '' }}
                                                        {{ $isOccupiedByOther ? 'disabled' : '' }}>
                                                    <label class="form-check-label {{ $isOccupiedByOther ? 'text-muted text-decoration-line-through' : '' }}" for="editSection{{ $adviser->id }}{{ $section }}">
                                                        <small>{{ $section }}
                                                        @if($isOccupiedByOther)
                                                            <span class="badge bg-danger ms-1">Taken</span>
                                                        @endif
                                                        </small>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <small class="text-info d-block mt-2"><i class="bi bi-info-circle me-1"></i>Sections with "Taken" are assigned to other advisers.</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check-circle me-1"></i>Update Adviser</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif

<!-- Archive Adviser Modal -->
<div class="modal fade" id="archiveAdviserModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h5 class="modal-title">Inactive Advisers</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="min-height: 300px; max-height: 500px; overflow-y: auto;">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Expertise</th>
                                <th>Sections</th>
                                <th>Inactive Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="archivedAdvisersBody">
                            <tr><td colspan="6" class="text-center text-muted">Loading...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
let confirmationCallback = null;

function showConfirmation(message, callback, buttonText = 'Confirm', buttonClass = 'btn-danger') {
    const confirmationModal = document.getElementById('confirmationModal');
    const modal = new bootstrap.Modal(confirmationModal);
    document.getElementById('confirmationMessage').textContent = message;
    const confirmBtn = document.getElementById('confirmationBtn');
    confirmBtn.textContent = buttonText;
    confirmBtn.className = `btn ${buttonClass}`;
    confirmationCallback = callback;
    modal.show();
}

document.getElementById('confirmationBtn').addEventListener('click', function() {
    if (confirmationCallback) {
        confirmationCallback();
        bootstrap.Modal.getInstance(document.getElementById('confirmationModal')).hide();
        confirmationCallback = null;
    }
});

function toggleAdviserOthersInput(select) {
    const othersDiv = document.getElementById('adviserOthersInputDiv');
    const othersInput = document.getElementById('adviserOthersInput');
    
    if (select.value === 'Others') {
        othersDiv.style.display = 'block';
        othersInput.required = true;
    } else {
        othersDiv.style.display = 'none';
        othersInput.required = false;
        othersInput.value = '';
    }
}

function updateAdviserSections() {
    const modal = document.getElementById('addAdviserModal');
    const dept = modal.querySelector('input[name="department"]').value;
    const checkboxes = modal.querySelectorAll('.section-checkbox');
    const assignmentsData = @json(isset($assignments) ? $assignments : []);
    
    checkboxes.forEach(checkbox => {
        const section = checkbox.dataset.section;
        const indicator = checkbox.parentElement.querySelector('.occupied-indicator');
        const label = checkbox.parentElement.querySelector('label');
        const formCheck = checkbox.parentElement.parentElement;
        
        const isOccupied = assignmentsData.some(assignment => 
            assignment.department === dept && assignment.section === section
        );
        
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

function deleteAdviser(adviserId) {
    showConfirmation(
        'Are you sure you want to archive this adviser? This action can be undone by restoring it.',
        function() {
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
                    document.getElementById('successMessage').textContent = 'Adviser has been successfully archived!';
                    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                    successModal.show();
                    document.getElementById('successModal').addEventListener('hidden.bs.modal', () => {
                        location.reload();
                    }, { once: true });
                } else {
                    alert('Error archiving adviser: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while archiving the adviser.');
            });
        },
        'Archive Adviser'
    );
}

function loadArchivedAdvisers() {
    fetch('/advisers/archived')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('archivedAdvisersBody');
            if (!tbody) return;
            
            if (!data || data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted">No inactive advisers</td></tr>';
                return;
            }
            
            tbody.innerHTML = data.map(adviser => {
                return `
                <tr>
                    <td>${adviser.name || ''}</td>
                    <td>${adviser.department || ''}</td>
                    <td>${adviser.expertise || ''}</td>
                    <td>${adviser.sections ? (Array.isArray(adviser.sections) ? adviser.sections.join(', ') : adviser.sections) : 'N/A'}</td>
                    <td>${adviser.deleted_at ? new Date(adviser.deleted_at).toLocaleDateString() : ''}</td>
                    <td>
                        <button class="btn btn-sm btn-secondary" type="button" onclick="restoreAdviser(${adviser.id})">
                            <i class="bi bi-arrow-clockwise"></i> Restore
                        </button>
                    </td>
                </tr>
                `;
            }).join('');
        })
        .catch(error => {
            console.error('Error loading archived advisers:', error);
            const tbody = document.getElementById('archivedAdvisersBody');
            if (tbody) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center text-danger">Error loading data</td></tr>';
            }
        });
}

function restoreAdviser(adviserId) {
    showConfirmation(
        'Are you sure you want to restore this adviser?',
        function() {
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
                    document.getElementById('successMessage').textContent = 'Adviser has been successfully restored!';
                    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                    successModal.show();
                    document.getElementById('successModal').addEventListener('hidden.bs.modal', () => {
                        loadArchivedAdvisers();
                        location.reload();
                    }, { once: true });
                } else {
                    alert('Error restoring adviser: ' + data.message);
                }
            });
        },
        'Restore Adviser',
        'btn-secondary'
    );
}

document.addEventListener('DOMContentLoaded', function() {
    const adviserModal = document.getElementById('archiveAdviserModal');
    if (adviserModal) {
        adviserModal.addEventListener('show.bs.modal', function() {
            loadArchivedAdvisers();
        });
    }

    document.getElementById('addAdviserModal').addEventListener('show.bs.modal', () => {
        const modal = document.getElementById('addAdviserModal');
        updateAdviserSections();
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

    @if(isset($advisers))
        @foreach($advisers as $adviser)
            const form{{ $adviser->id }} = document.getElementById('editAdviserForm{{ $adviser->id }}');
            if (form{{ $adviser->id }}) {
                form{{ $adviser->id }}.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    const modalElement = document.getElementById('editAdviserModal{{ $adviser->id }}');
                    const formAction = this.action;
                    
                    showConfirmation(
                        'Are you sure you want to update this adviser information?',
                        function() {
                            fetch(formAction, {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => {
                                if (response.ok) {
                                    const modal = bootstrap.Modal.getInstance(modalElement);
                                    if (modal) modal.hide();
                                    
                                    document.getElementById('successMessage').textContent = 'Adviser information has been successfully updated!';
                                    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                                    successModal.show();
                                    
                                    document.getElementById('successModal').addEventListener('hidden.bs.modal', () => {
                                        location.reload();
                                    }, { once: true });
                                } else {
                                    alert('Error updating adviser. Please try again.');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('An error occurred while updating the adviser.');
                            });
                        },
                        'Update Adviser',
                        'btn-primary'
                    );
                });
            }
        @endforeach
    @endif
});
</script>
@endsection
