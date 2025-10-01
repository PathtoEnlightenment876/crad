@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4 text-primary">Assign Adviser & Panel</h1>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Submissions & Committees</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Documents</th>
                            <th>Department</th>
                            <th>Cluster</th>
                            <th>Committee</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($submissions as $submission)
                            <tr>
                                <td><strong>{{ $submission->documents }}</strong></td>
                                <td>{{ $submission->department }}</td>
                                <td>{{ $submission->cluster }}</td>
                                <td>
                                    @if($submission->committee)
                                        <div class="p-2 bg-light rounded">
                                            <p class="mb-1"><strong>Adviser:</strong> {{ $submission->committee->adviser_name }}</p>
                                            <p class="mb-1"><strong>Panel 1:</strong> {{ $submission->committee->panel1 }}</p>
                                            <p class="mb-1"><strong>Panel 2:</strong> {{ $submission->committee->panel2 }}</p>
                                            <p class="mb-0"><strong>Panel 3:</strong> {{ $submission->committee->panel3 }}</p>
                                        </div>
                                    @else
                                        <span class="badge bg-secondary">Not Assigned</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <!-- Assign Button -->
                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#assignModal{{ $submission->id }}">
                                            <i class="bi bi-person-plus"></i> Assign
                                        </button>

                                        @if($submission->committee)
                                            <!-- Edit Button -->
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $submission->committee->id }}">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>

                                            <!-- Delete Button -->
                                            <form action="{{ route('committee.destroy', $submission->committee->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Delete this committee?')">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <!-- Assign Modal -->
                            <div class="modal fade" id="assignModal{{ $submission->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('committee.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="submission_id" value="{{ $submission->id }}">

                                            <div class="modal-header bg-success text-white">
                                                <h5 class="modal-title">Assign Committee ({{ $submission->documents }})</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <!-- Adviser -->
                                                <div class="mb-3">
                                                    <label class="form-label">Adviser</label>
                                                    <input type="text" name="adviser_name" class="form-control"
                                                        value="{{ old('adviser_name') }}" required>
                                                </div>

                                                <!-- Panel 1 -->
                                                <div class="mb-3">
                                                    <label class="form-label">Panel 1</label>
                                                    <input type="text" name="panel1" class="form-control"
                                                        value="{{ old('panel1') }}" required>
                                                </div>

                                                <!-- Panel 2 -->
                                                <div class="mb-3">
                                                    <label class="form-label">Panel 2</label>
                                                    <input type="text" name="panel2" class="form-control"
                                                        value="{{ old('panel2') }}" required>
                                                </div>

                                                <!-- Panel 3 -->
                                                <div class="mb-3">
                                                    <label class="form-label">Panel 3</label>
                                                    <input type="text" name="panel3" class="form-control"
                                                        value="{{ old('panel3') }}" required>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success">Assign</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            @if($submission->committee)
                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $submission->committee->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('committee.update', $submission->committee->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title">Edit Committee ({{ $submission->documents }})</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Adviser</label>
                                                        <input type="text" name="adviser_name" class="form-control"
                                                            value="{{ $submission->committee->adviser_name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Panel 1</label>
                                                        <input type="text" name="panel1" class="form-control"
                                                            value="{{ $submission->committee->panel1 }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Panel 2</label>
                                                        <input type="text" name="panel2" class="form-control"
                                                            value="{{ $submission->committee->panel2 }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Panel 3</label>
                                                        <input type="text" name="panel3" class="form-control"
                                                            value="{{ $submission->committee->panel3 }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No submissions found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection