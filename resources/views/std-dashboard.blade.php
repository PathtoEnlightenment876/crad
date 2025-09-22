@extends('layouts.student')

@section('content')
<div class="container-fluid py-4">

    <div class="row g-4">
        <!-- Group Details -->
        <div class="col-md-4">
            <div class="card shadow-sm rounded-3 h-100">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="fas fa-users me-2"></i> Your Group Details
                </div>
                <div class="card-body">
                    <p class="mb-2"><strong>Group #:</strong> {{ $group->group_no ?? 'N/A' }}</p>
                    <p class="mb-0"><strong>Department:</strong> {{ $group->department ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Adviser & Panel -->
        <div class="col-md-4">
            <div class="card shadow-sm rounded-3 h-100">
                <div class="card-header bg-info text-white fw-bold">
                    <i class="fas fa-user-tie me-2"></i> Adviser & Panel
                </div>
                <div class="card-body">
                    <p class="mb-2"><strong>Adviser:</strong> {{ $group->adviser->name ?? 'N/A' }}</p>
                    <hr class="my-2">
                    <p class="fw-bold mb-2">Panel Members</p>
                    <ul class="list-group list-group-flush">
                        @forelse($group->panels ?? [] as $panel)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $panel->name }}</span>
                                <span class="badge bg-secondary">{{ $panel->role }}</span>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">No panel members assigned</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Research Status -->
        <div class="col-md-4">
            <div class="card shadow-sm rounded-3 h-100 text-center">
                <div class="card-header bg-warning fw-bold">
                    <i class="fas fa-tasks me-2"></i> Research Status
                </div>
                <div class="card-body d-flex flex-column justify-content-center">
                    <h6 class="mb-3">Research Title Status</h6>
                    <span class="badge px-3 py-2 fs-6 
                        @if($submissionStatus === 'APPROVED') bg-success
                        @elseif($submissionStatus === 'REJECTED') bg-danger
                        @else bg-secondary
                        @endif">
                        {{ strtoupper($submissionStatus ?? 'PENDING') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Research Progress -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm rounded-3">
                <div class="card-header bg-dark text-white fw-bold">
                    <i class="fas fa-chart-line me-2"></i> Research Progress
                </div>
                <div class="card-body text-center">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        @for($i = 1; $i <= 6; $i++)
                            <div class="flex-fill mx-1">
                                <div class="progress-step {{ $progress >= $i ? 'completed' : '' }}" 
                                     style="height: 20px; border-radius: 10px; background-color: {{ $progress >= $i ? '#28a745' : '#dee2e6' }};">
                                </div>
                                <small class="d-block mt-1">
                                    @switch($i)
                                        @case(1) Proposal @break
                                        @case(2) Research Forum @break
                                        @case(3) Clearance @break
                                        @case(4) Pre-Oral @break
                                        @case(5) Clearance @break
                                        @case(6) Final Defense @break
                                    @endswitch
                                </small>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
