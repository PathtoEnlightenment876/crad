@extends('layouts.student')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-5 fw-bold text-primary">
        <i class="fas fa-users"></i> Your Adviser & Panel Members
    </h2>

    @if($assignment)
        <div class="card border-0 shadow-lg mb-4 rounded-3">
            <div class="card-header bg-primary text-white rounded-top">
                <h5 class="mb-0"><i class="fas fa-graduation-cap"></i> Assignment Details</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <span class="badge bg-info text-dark me-2"><i class="fas fa-building"></i> {{ $assignment->department }}</span>
                    <span class="badge bg-secondary me-2"><i class="fas fa-layer-group"></i> Cluster: {{ $assignment->section }}</span>
                    <span class="badge bg-warning text-dark"><i class="fas fa-users"></i> Group {{ auth()->user()->group_no ?? 'N/A' }}</span>
                </div>

                <div class="mb-4">
                    <h6 class="fw-bold text-success"><i class="fas fa-user-tie"></i> Adviser</h6>
                    @if($assignment->adviser)
                        <div class="ms-3">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $assignment->adviser->name }}</h6>
                                    <small class="text-muted">{{ $assignment->adviser->expertise ?? 'No expertise specified' }}</small>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="ms-3 text-muted"><i class="fas fa-exclamation-circle"></i> Not Assigned</p>
                    @endif
                </div>

                <div>
                    <h6 class="fw-bold text-primary"><i class="fas fa-users"></i> Panel Members</h6>
                    @if($assignment->assignmentPanels && $assignment->assignmentPanels->count() > 0)
                        <div class="ms-3">
                            @foreach($assignment->assignmentPanels as $panel)
                                <div class="d-flex align-items-center mb-3 p-3 bg-light rounded">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ $panel->name }}</h6>
                                        <div class="d-flex flex-wrap gap-2">
                                            <span class="badge bg-secondary">{{ $panel->role ?? 'Panel Member' }}</span>
                                            @if($panel->expertise)
                                                <span class="badge bg-info">{{ $panel->expertise }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="ms-3 text-muted"><i class="fas fa-exclamation-circle"></i> No panel members assigned yet</p>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info text-center shadow-sm">
            <i class="fas fa-info-circle"></i> No adviser or panel assigned yet for your department and cluster.
        </div>
    @endif


</div>
@endsection
