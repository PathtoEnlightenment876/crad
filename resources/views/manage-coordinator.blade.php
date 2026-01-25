@extends('layouts.app')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
<style>
    :root {
        --primary-blue: #1a73e8;
        --dark-blue-button: #003366;
        --light-bg: #f5f7fa;
        --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    body {
        background-color: var(--light-bg);
        font-family: 'Roboto', sans-serif;
    }

    .modal { z-index: 1055 !important; }
    .modal-backdrop { z-index: 1050 !important; }
</style>
@endsection

@section('content')
<div class="container-fluid" style="max-width: 1400px; margin: 0 auto;">
    <div class="bg-white p-4 rounded-3 mb-4 shadow-sm">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 fw-bold text-primary">
                <i class="bi bi-people-fill me-2"></i>MANAGE COORDINATORS
            </h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCoordinatorModal">
                <i class="bi bi-person-plus-fill me-1"></i> Add Coordinator
            </button>
        </div>

        <div class="card">
            <div class="card-header bg-light">
                <label for="deptFilter" class="form-label me-2 mb-0">Filter by Department:</label>
                <select id="deptFilter" class="form-select w-auto d-inline-block" onchange="filterCoordinators()">
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
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Contact</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="coordinatorTableBody">
                            @forelse($coordinators as $coordinator)
                            <tr data-department="{{ $coordinator->department }}">
                                <td>{{ $coordinator->name }}</td>
                                <td>{{ $coordinator->email }}</td>
                                <td>{{ $coordinator->department }}</td>
                                <td>{{ $coordinator->contact ?? 'N/A' }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary me-1" onclick="editCoordinator({{ $coordinator->id }}, '{{ $coordinator->name }}', '{{ $coordinator->email }}', '{{ $coordinator->department }}', '{{ $coordinator->contact }}')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteCoordinator({{ $coordinator->id }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center text-muted">No coordinators found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Coordinator Modal -->
<div class="modal fade" id="addCoordinatorModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addCoordinatorForm">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add New Coordinator</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name *</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password *</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" required minlength="8">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <small class="text-muted">Minimum 8 characters</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password *</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required minlength="8">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Department *</label>
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
                        <label class="form-label">Contact Number</label>
                        <input type="text" name="contact" class="form-control" placeholder="+63 912 345 6789">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Coordinator</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Coordinator Modal -->
<div class="modal fade" id="editCoordinatorModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editCoordinatorForm">
                @csrf
                <input type="hidden" id="edit_coordinator_id">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Edit Coordinator</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name *</label>
                        <input type="text" id="edit_name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" id="edit_email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Department *</label>
                        <select id="edit_department" name="department" class="form-select" required>
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
                        <label class="form-label">Contact Number</label>
                        <input type="text" id="edit_contact" name="contact" class="form-control" placeholder="+63 912 345 6789">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="confirmUpdate()">Update Coordinator</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Confirm Update Modal -->
<div class="modal fade" id="confirmUpdateModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Confirm Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to update this coordinator?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="submitUpdate()">Confirm</button>
            </div>
        </div>
    </div>
</div>

<!-- Confirm Delete Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this coordinator?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="submitDelete()">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let deleteCoordinatorId = null;

function togglePassword(fieldId, button) {
    const field = document.getElementById(fieldId);
    const icon = button.querySelector('i');
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}

function filterCoordinators() {
    const filter = document.getElementById('deptFilter').value.toLowerCase();
    document.querySelectorAll('#coordinatorTableBody tr').forEach(row => {
        const dept = row.dataset.department?.toLowerCase();
        row.style.display = (!filter || dept === filter) ? '' : 'none';
    });
}

document.getElementById('addCoordinatorForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('password_confirmation').value;
    
    if (password !== confirmPassword) {
        alert('Passwords do not match!');
        return;
    }
    
    if (password.length < 8) {
        alert('Password must be at least 8 characters long!');
        return;
    }
    
    const formData = new FormData(this);
    
    fetch('/coordinators', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Coordinator account created successfully!');
            location.reload();
        }
    })
    .catch(error => {
        alert('Error: ' + error.message);
    });
});

function deleteCoordinator(id) {
    deleteCoordinatorId = id;
    new bootstrap.Modal(document.getElementById('confirmDeleteModal')).show();
}

function submitDelete() {
    fetch(`/coordinators/${deleteCoordinatorId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}

function editCoordinator(id, name, email, department, contact) {
    document.getElementById('edit_coordinator_id').value = id;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_department').value = department;
    document.getElementById('edit_contact').value = contact || '';
    new bootstrap.Modal(document.getElementById('editCoordinatorModal')).show();
}

function confirmUpdate() {
    bootstrap.Modal.getInstance(document.getElementById('editCoordinatorModal')).hide();
    new bootstrap.Modal(document.getElementById('confirmUpdateModal')).show();
}

function submitUpdate() {
    const id = document.getElementById('edit_coordinator_id').value;
    const formData = new FormData(document.getElementById('editCoordinatorForm'));
    
    fetch(`/coordinators/${id}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            'X-HTTP-Method-Override': 'PUT'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => {
        alert('Error: ' + error.message);
    });
}
</script>
@endsection
