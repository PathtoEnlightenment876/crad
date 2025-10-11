<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                <img src="{{ asset('img/avatar.png') }}" alt="Logo" class="img-fluid rounded-circle mb-2"
                    style="width: 60px; height: 60px;">
                <h5 class="mb-0">Student</h5>
                <small>Juan Dela Cruz</small>
            </div>

            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ url('/std-dashboard') }}" class="nav-link text-white">
                        <i class="bi bi-speedometer fs-5"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('submission') }}" class="nav-link">
                        <i class="bi bi-cloud-upload fs-5"></i>
                        <span>Submission</span>
                    </a>

                </li>

                <li>
                    <a href="{{url('/view-panel-adviser')}}" class="nav-link">
                        <i class="bi bi-person-plus-fill fs-5"></i>
                        <span>View Assigned Adviser & Panel </span>
                    </a>

                </li>

                <li>
                    <a href="#module6drop" class="nav-link">
                        <i class="bi bi-calendar4-week fs-5"></i>
                        <span>View Schedules </span>
                    </a>

                </li>



            </ul>
        </div>
        <div class="main-content-wrapper">
            <nav class="top-navbar d-flex justify-content-between align-items-center">
                <div>
                    <button id="sidebar-toggle" class="btn btn-light"><i class="bi bi-list"></i></button>
                </div>
                <div class="d-flex align-items-center">
                    <span id="current-time" class="me-3 d-none d-sm-inline"></span>
                    <div class="me-3">
                        <a href="#" class="text-dark position-relative" data-bs-toggle="modal" data-bs-target="#notificationModal">
                            <i class="bi bi-bell fs-5"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $notifications->where('read', false)->count() }}
                            </span>
                        </a>
                    </div>
                    

                    <a href="#" class="text-dark me-3"><i class="bi bi-search fs-5"></i></a>

                    <div class="dropdown">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="userDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-4"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <h6 class="dropdown-header">{{ Auth::user()->name ?? 'Juan Dela Cruz' }}</h6>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
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
                        <li class="breadcrumb-item"><a href="{{ url('std-dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
              
                <div class="container-fluid">
                    @yield('content')
              
                </div>
            <footer class="footer">
                Center for Research And Development &copy;
            </footer>
        </div>
        <div class="sidebar-overlay"></div>
    </div>
    
<!-- Profile Modal Trigger -->
<li>
    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
        Profile
    </a>
</li>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Student Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <img src="{{ asset('img/avatar.png') }}" alt="Profile Picture"
                         class="rounded-circle" width="100" height="100">
                </div>
                <p><strong>Name:</strong> {{ Auth::user()->name ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email ?? 'N/A' }}</p>
                <p><strong>Department:</strong> {{ Auth::user()->department ?? 'N/A' }}</p>
                <p><strong>Section/Cluster:</strong> {{ Auth::user()->section_cluster ?? 'N/A' }}</p>
                <p><strong>Group No:</strong> {{ Auth::user()->group_no ?? 'N/A' }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Notification Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="notificationModalLabel">
                    <i class="bi bi-bell me-2"></i>Notifications
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0" style="max-height: 500px; overflow-y: auto;">
                @forelse($notifications ?? collect() as $notification)
                    <div class="notification-item p-3 border-bottom {{ $notification->read ? '' : 'bg-light' }}">
                        <div class="d-flex align-items-start">
                            <div class="notification-icon me-3">
                                @if($notification->type == 'Approved')
                                    <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="bi bi-check-circle text-white"></i>
                                    </div>
                                @elseif($notification->type == 'Rejected')
                                    <div class="bg-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="bi bi-x-circle text-white"></i>
                                    </div>
                                @else
                                    <div class="bg-info rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="bi bi-chat-left-text text-white"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="notification-content flex-grow-1">
                                <div class="notification-message fw-semibold mb-1">
                                    {{ $notification->message }}
                                </div>
                                <div class="notification-meta d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ $notification->created_at->diffForHumans() }}
                                    </small>
                                    @if(!$notification->read)
                                        <span class="badge bg-primary">New</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="bi bi-bell-slash text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-3">No notifications yet</p>
                    </div>
                @endforelse
            </div>
            <div class="modal-footer">
                <a href="{{ route('student.notifications') }}" class="btn btn-success">
                    <i class="bi bi-check-all me-1"></i>Mark All as Read
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
        .notification-item:hover {
            background-color: #f8f9fa !important;
        }
        
        .notification-item:last-child {
            border-bottom: none !important;
        }
        
        .notification-icon {
            flex-shrink: 0;
        }
    </style>


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