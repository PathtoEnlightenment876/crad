@extends('layouts.student')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-5 fw-bold text-primary">
        <i class="fas fa-calendar-alt"></i> Your Defense Schedules
    </h2>

    @if($schedules && $schedules->count() > 0)
        @foreach($schedules as $schedule)
            <div class="card border-0 shadow-lg mb-4 rounded-3">
                <div class="card-header bg-primary text-white rounded-top">
                    <h5 class="mb-0">
                        <i class="fas fa-graduation-cap"></i> 
                        {{ $schedule->defense_type }}
                        @if($schedule->defense_type === 'REDEFENSE')
                            ({{ $schedule->original_defense_type }})
                        @endif
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="badge bg-info text-dark me-2">
                                    <i class="fas fa-building"></i> {{ $schedule->department }}
                                </span>
                                <span class="badge bg-secondary me-2">
                                    <i class="fas fa-layer-group"></i> Cluster: {{ $schedule->section }}
                                </span>
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-users"></i> Group {{ $schedule->group_id }}
                                </span>
                            </div>

                            @if($schedule->defense_date)
                                <div class="mb-3">
                                    <h6 class="fw-bold text-success">
                                        <i class="fas fa-calendar"></i> Schedule Details
                                    </h6>
                                    <p class="ms-3 mb-1">
                                        <strong>Date:</strong> {{ \Carbon\Carbon::parse($schedule->defense_date)->format('F d, Y') }}
                                    </p>
                                    <p class="ms-3 mb-1">
                                        <strong>Time:</strong> 
                                        @if($schedule->start_time && $schedule->end_time)
                                            {{ $schedule->start_time }} - {{ $schedule->end_time }}
                                        @elseif($schedule->start_time)
                                            {{ $schedule->start_time }}
                                        @else
                                            Not specified
                                        @endif
                                    </p>
                                    <p class="ms-3 mb-0">
                                        <strong>Venue:</strong> {{ $schedule->venue ?? 'Not specified' }}
                                    </p>
                                </div>
                            @endif

                            <div class="mb-3">
                                <h6 class="fw-bold text-primary">
                                    <i class="fas fa-info-circle"></i> Status
                                </h6>
                                <span class="ms-3 badge bg-{{ 
                                    $schedule->status === 'Passed' ? 'success' : 
                                    ($schedule->status === 'Failed' ? 'danger' : 
                                    ($schedule->status === 'Re-defense' ? 'warning' : 'secondary')) 
                                }} fs-6">
                                    {{ $schedule->status }}
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            @if($schedule->panel_data)
                                @php
                                    $panelData = is_string($schedule->panel_data) ? json_decode($schedule->panel_data, true) : $schedule->panel_data;
                                @endphp
                                
                                <div class="mb-3">
                                    <h6 class="fw-bold text-success">
                                        <i class="fas fa-user-tie"></i> Adviser
                                    </h6>
                                    <p class="ms-3">{{ $panelData['adviser'] ?? 'Not assigned' }}</p>
                                </div>

                                <div>
                                    <h6 class="fw-bold text-primary">
                                        <i class="fas fa-users"></i> Panel Members
                                    </h6>
                                    <div class="ms-3">
                                        <p class="mb-1">
                                            <strong>Chairperson:</strong> {{ $panelData['chairperson'] ?? 'Not assigned' }}
                                        </p>
                                        <p class="mb-0">
                                            <strong>Members:</strong> {{ $panelData['members'] ?? 'Not assigned' }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-info text-center shadow-sm">
            <i class="fas fa-info-circle"></i> No defense schedules found for your group.
        </div>
    @endif
</div>
@endsection