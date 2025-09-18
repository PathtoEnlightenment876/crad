@extends('layouts.app')
@section('content')

    <div class="container py-4">
        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5>Total Proposals</h5>
                        <p class="fs-4 fw-bold text-primary">120</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5>Approved Grants</h5>
                        <p class="fs-4 fw-bold text-success">45</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5>Pending Reviews</h5>
                        <p class="fs-4 fw-bold text-warning">18</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">Proposals by Status</div>
                    <div class="card-body">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">Funding Distribution</div>
                    <div class="card-body">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reports Section -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                Report Table
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Research Title</th>
                            <th>Status</th>
                            <th>Funding</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>AI for Healthcare</td>
                            <td><span class="badge bg-success">Approved</span></td>
                            <td>₱5,000</td>
                        </tr>
                        <tr>
                            <td>Renewable Energy Study</td>
                            <td><span class="badge bg-warning">Pending</span></td>
                            <td>₱2,500</td>
                        </tr>
                        <tr>
                            <td>Smart Agriculture</td>
                            <td><span class="badge bg-warning">Pending</span></td>
                            <td>₱3,500</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Export -->
        <div class="text-end no-print">
            <button class="btn btn-outline-primary" onclick="window.print()">Print / Export Report</button>
        </div>
    </div>
    

@endsection
@section('scripts')

    <script src = "https://cdn.jsdelivr.net/npm/chart.js" ></script>
    <script>
            // Bar Chart
            new Chart(document.getElementById("barChart"), {
                type: "bar",
                data: {
                    labels: ["Approved", "Pending", "Pending"],
                    datasets: [{
                        label: "Proposals",
                        data: [45, 18, 57],
                        backgroundColor: ["#198754", "#ffc107", "#dc3545"]
                    }]
                }
            });

        // Pie Chart
        new Chart(document.getElementById("pieChart"), {
            type: "pie",
            data: {
                labels: ["AI for Healthcare", "Renewable Energy", "Smart Agriculture"],
                datasets: [{
                    data: [5000, 2500, 3500],
                    backgroundColor: ["#0d6efd", "#20c997", "#6f42c1"]
                }]
            }
        });
    </script>

@endsection