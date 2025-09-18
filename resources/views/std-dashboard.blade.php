@extends('layouts.student')

@section('content')
<style>
    .breadcrumb-container { margin-bottom: 1.5rem; }
    .content-card { background-color: #ffffff; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
    .welcome-title { font-weight: 700; font-size: 2.5rem; color: #333; }
    .center-info { font-size: 0.9rem; color: #888; }

    .dashboard-card { background-color: #f8f9fa; border: none; border-radius: 15px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 2rem; height: 100%; }
    .dashboard-card-icon { font-size: 2.5rem; color: #5d5dff; }
    .card-title-main { font-weight: 700; color: #333; font-size: 1.5rem; }
    .card-subtitle { color: #888; margin-top: 0.5rem; }
    .list-group-item { background-color: transparent; border: none; padding: 1rem 0; font-weight: 500; }
    .progress-title { font-weight: 600; margin-bottom: 0.5rem; }
</style>

<div class="row g-4">
    <!-- Welcome Card -->
    <div class="col-lg-8">
        <div class="dashboard-card">
            <h2 class="welcome-title mb-3">Welcome Back, {{ auth()->user()->name }}!</h2>
            <p class="center-info">You have {{ $upcomingSubmissions->count() }} upcoming task{{ $upcomingSubmissions->count() > 1 ? 's' : '' }}. Keep pushing your research forward!</p>
        </div>
    </div>

    <!-- Upcoming Deadlines -->
    <div class="col-lg-4">
        <div class="dashboard-card d-flex flex-column justify-content-between">
            <div>
                <i class="fas fa-calendar-alt dashboard-card-icon mb-3"></i>
                <h5 class="card-title-main">Upcoming Deadlines</h5>
                <hr>
                <ul class="list-group list-group-flush">
                    @forelse($upcomingSubmissions as $submission)
                        <li class="list-group-item">
                            <i class="far fa-circle me-2" style="color: {{ $submission->status_color }}"></i>
                            {{ $submission->title }} due <strong>{{ $submission->due_date->format('M d') }}</strong>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">No upcoming deadlines!</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <!-- Research Progress -->
    <div class="col-12">
        <div class="dashboard-card">
            <i class="fas fa-tasks dashboard-card-icon mb-3"></i>
            <h5 class="card-title-main">My Research Progress</h5>
            <hr>
            <div class="row mt-4">
                @foreach($chapters as $name => $chapter)
                    <div class="col-md-6 mb-3">
                        <div class="progress-title d-flex justify-content-between">
                            <span>{{ $name }}</span>
                            <span>{{ $chapter?->progress ?? 0 }}%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar" role="progressbar"
                                 style="width: {{ $chapter?->progress ?? 0 }}%; background-color: {{ $chapter?->color ?? '#6c757d' }};"
                                 aria-valuenow="{{ $chapter?->progress ?? 0 }}" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection
