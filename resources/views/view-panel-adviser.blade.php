@extends('layouts.student')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-5 fw-bold text-primary">
        <i class="fas fa-users"></i> Your Adviser & Panel Members
    </h2>

    @forelse($files as $file)
        <div class="card border-0 shadow-lg mb-4 rounded-3">
            <div class="card-header bg-primary text-white rounded-top">
                <h5 class="mb-0"><i class="fas fa-book"></i> {{ $file->documents }}</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <span class="badge bg-info text-dark me-2"><i class="fas fa-building"></i> {{ $file->department }}</span>
                    <span class="badge bg-secondary me-2"><i class="fas fa-layer-group"></i> Cluster: {{ $file->cluster }}</span>
                    <span class="badge bg-warning text-dark"><i class="fas fa-users"></i> Group {{ $file->group_no }}</span>
                </div>

                <div class="mb-4">
                    <h6 class="fw-bold text-success"><i class="fas fa-user-tie"></i> Adviser</h6>
                    <p class="ms-3">Not Assigned</p>
                </div>

                <div>
                    <h6 class="fw-bold text-primary"><i class="fas fa-users"></i> Panel Members</h6>
                    <ul class="list-group list-group-flush ms-3">
                        <li class="list-group-item"><i class="fas fa-user"></i> Not Assigned</li>
                        <li class="list-group-item"><i class="fas fa-user"></i> Not Assigned</li>
                        <li class="list-group-item"><i class="fas fa-user"></i> Not Assigned</li>
                    </ul>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center shadow-sm">
            <i class="fas fa-info-circle"></i> No adviser or panel assigned yet.
        </div>
    @endforelse
</div>
@endsection
