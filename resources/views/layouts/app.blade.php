<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CRAD</title>

    <link rel="icon" href="{{ asset('img/sms.png') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @yield('styles')

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

</head>

<body>
    <div class="d-flex">
        <div id="sidebar" class="d-flex flex-column flex-shrink-0 sidebar">
            <div class="user-profile">
                <img src="{{ asset('img/sms.png') }}" alt="Logo" class="img-fluid rounded-circle mb-2"
                    style="width: 60px; height: 60px;">
                <h5 class="mb-0">CRAD</h5>
                <small>ADMIN</small>
            </div>

            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ url('/admin-dashboard') }}" class="nav-link text-white">
                        <i class="bi bi-speedometer fs-5"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/track-proposal') }}" class="nav-link">
                        <i class="bi bi-cloud-upload fs-5"></i>
                        <span>Proposal Submission & Tracking </span>
                    </a>

                </li>

                <li>
                    <a href="{{ url('/panel-adviser') }}" class="nav-link">
                        <i class="bi bi-person-plus-fill fs-5"></i>
                        <span>Adviser & Panel Assignment </span>
                    </a>

                </li>

                <li>
                    <a href="{{ url('/def-sched') }}" class="nav-link">
                        <i class="bi bi-calendar4-week fs-5"></i>
                        <span>Defense Scheduling </span>
                    </a>

                </li>


                <li>
                    <a href="{{ url('/analytics') }}" class="nav-link">
                        <i class="bi bi-bar-chart-line fs-5"></i>
                        <span>Analytics & Reporting</span>
                    </a>
                </li>


            </ul>
        </div>
        <div class="main-content-wrapper">
            <nav class="top-navbar d-flex justify-content-between align-items-center">
                <div>
                    <button id="sidebar-toggle" class="btn btn-light" aria-label="Toggle sidebar"><i class="bi bi-list"></i></button>
                </div>
                <div class="d-flex align-items-center">
                    <span id="current-time" class="me-3 d-none d-sm-inline"></span>
                    <div class="dropdown me-3">
                        <a href="#" class="text-dark position-relative" id="notificationDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell fs-5"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                3
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="notificationDropdown"
                            style="width: 300px; max-height: 400px; overflow-y: auto;">
                            <li class="dropdown-header fw-bold">Notifications</li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="dropdown-item">
                                <i class="bi bi-check-circle text-success"></i> Proposal submitted successfully
                                <br><small class="text-muted">2 mins ago</small>
                            </li>
                            <li class="dropdown-item">
                                <i class="bi bi-exclamation-circle text-warning"></i> Panel assigned to your project
                                <br><small class="text-muted">10 mins ago</small>
                            </li>
                            <li class="dropdown-item">
                                <i class="bi bi-calendar-event text-primary"></i> Defense scheduled for Sept 10
                                <br><small class="text-muted">1 hr ago</small>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a href="#" class="dropdown-item text-center">View all</a></li>
                        </ul>
                    </div>

                    <a href="#" class="text-dark me-3" aria-label="Search"><i class="bi bi-search fs-5"></i></a>

                    <div class="dropdown">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="userDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-4"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><h6 class="dropdown-header">{{ Auth::user()->name ?? 'Admin' }}</h6></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="content-area">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin-dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>

                @hasSection('content')
                    @yield('content')
                @else
                    <div class="row mb-4">
                        <div class="col-md-4 mb-3">
                            <div class="card bg-primary text-white h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Pending Proposals</h5>
                                    <h2 class="card-text">12</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card bg-success text-white h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Approved</h5>
                                    <h2 class="card-text">24</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card bg-warning text-dark h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Upcoming Defenses</h5>
                                    <h2 class="card-text">5</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </main>

            <footer class="footer">
                Center for Research And Development &copy;
            </footer>
        </div>
        <div class="sidebar-overlay"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        // Sidebar toggle
        document.getElementById('sidebar-toggle').addEventListener('click', function () {
            document.body.classList.toggle('sidebar-toggled');
        });

        // Close sidebar when overlay is clicked
        document.querySelector('.sidebar-overlay').addEventListener('click', function () {
            document.body.classList.remove('sidebar-toggled');
        });

        // Live Clock
        function updateTime() {
            const timeElement = document.getElementById('current-time');
            if (timeElement) {
                const now = new Date();
                timeElement.textContent = now.toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                });
            }
        }
        setInterval(updateTime, 1000);
        updateTime();

        // Sidebar active state logic
        document.addEventListener("DOMContentLoaded", function () {
            const path = window.location.pathname;
            const navLinks = document.querySelectorAll('.sidebar .nav-link');

            navLinks.forEach(link => {
                // Remove 'active' class from all links first
                link.classList.remove('active');

                // Find the link that matches the current page's URL
                if (link.getAttribute('href') === path) {
                    // Add 'active' class to the matching link
                    link.classList.add('active');

                    // Check if this link is inside a collapsible sub-menu
                    let parentCollapse = link.closest('.collapse');
                    if (parentCollapse) {
                        // If it is, open the sub-menu by adding the 'show' class
                        parentCollapse.classList.add('show');

                        // Add an 'active' style to the parent link as well (optional, but good for UX)
                        let parentLink = parentCollapse.previousElementSibling;
                        if (parentLink && parentLink.classList.contains('nav-link')) {
                            parentLink.classList.add('active-parent');
                        }
                    }
                }
            });
        });
    </script>
    @yield('scripts')

</body>

</html>