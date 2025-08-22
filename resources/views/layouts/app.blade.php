
<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRAD</title>
    <!-- Favicon -->
    <link rel="icon" href="sms.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f6;
            overflow-x: hidden;
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .fw-bold {
            font-weight: 700 !important;
        }

        .sidebar {
            position: fixed;
            /* Ensure the sidebar stays in place */
            top: 0;
            left: 0;
            height: 100vh;
            /* Full height of the viewport */
            overflow-y: auto;
            /* Enable vertical scrolling */
            width: 280px;
            /* Sidebar width */
            background-color: #284b9a;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            /* Optional shadow for better visibility */
        }

        .sidebar .user-profile {
            padding: 1.5rem 1rem;
            text-align: center;
            color: white;
        }

        .sidebar .user-profile .initials {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #3B71CA;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 auto 0.5rem;
        }

        .sidebar .nav-link {
            color: #bdc3c7;
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            border-left: 3px solid transparent;
        }


        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            color: #ffffff;
            background-color: #284b9a;
            border-left: 3px solid #3B71CA;
        }

        .sidebar .nav-link i {
            margin-right: 0.75rem;
        }

        .main-content-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin-left: 280px;
            /* Default margin for desktop */
            width: calc(100% - 280px);
            transition: margin-left 0.3s ease-in-out, width 0.3s ease-in-out;
        }

        .top-navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
            padding: 0.5rem 1.5rem;
        }

        .content-area {
            padding: 2rem;
            flex-grow: 1;
        }

        .footer {
            padding: 1rem 2rem;
            background-color: #ffffff;
            border-top: 1px solid #dee2e6;
            font-size: 0.875rem;
            color: #6c757d;
        }

        /* New overlay style */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1029;
            /* Just below the sidebar's z-index */
        }

        /* Responsive Styles */
        @media (max-width: 991.98px) {
            .sidebar {
                margin-left: -280px;
                /* Hide sidebar by default on smaller screens */
            }

            .main-content-wrapper {
                margin-left: 0;
                width: 100%;
            }

            body.sidebar-toggled .sidebar {
                margin-left: 0;
                /* Show sidebar when toggled */
            }

            /* Show overlay when sidebar is toggled on mobile */
            body.sidebar-toggled .sidebar-overlay {
                display: block;
            }
        }

        @import url("../style.css");
    </style>

</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div id="sidebar" class="d-flex flex-column flex-shrink-0 sidebar">
            <div class="user-profile">
                <img src="sms.jpg" alt="User Profile" class="img-fluid rounded-circle mb-2" style="width: 60px; height: 60px;">
                <h5 class="mb-0">CRAD</h5>
            </div>

            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <!-- dashboard -->
                    <a href="index.php" class="nav-link d-flex align-items-center justify-content-center text-white active gap-2">
                        <i class="bi bi-speedometer fs-5"></i>
                        <span class="description">Dashboard</span>
                    </a>


                </li>

                <li>
                    <a href="#" class="nav-link text-center active" data-bs-toggle="collapse" data-bs-target="#module1drop" aria-expanded="false" aria-controls="module1drop">
                        <i class="bi bi-cloud-upload fs-5"></i>
                        <span class="description">Proposal Submission & Tracking
                            <i class="bi bi-caret-down-fill"></i>
                        </span>
                    </a>

                    <!-- submodules 1 -->
                    <div class="sub-menu collapse" id="module1drop">
                        <a href="new_proposal.php" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">Submit New Proposal</span></a>
                        <a href="proposals/track-status.php" class="nav-link"><i class="bi bi-list-ul"></i><span class="description">Proposal Status Tracking</span></a>
                        <a href="proposals/feedback.php" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description"> Feedback</span></a>
                        <a href="proposals/resubmit.php" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">Revision Submission</span></a>
                        <a href="proposals/approval.php" class="nav-link"><i class="bi bi-list-ul"></i><span class="description">Approved List</span></a>
                    </div>
                </li>
                <li>
                    <!-- module 2 -->
                    <a href="#" class="nav-link text-center" data-bs-toggle="collapse" data-bs-target="#module2drop" aria-expanded="false" aria-controls="module2drop">
                        <i class="bi bi-person-plus-fill fs-5"></i>
                        <span class="description">Adviser & Panel Assignment System
                            <i class="bi bi-caret-down-fill"></i>
                        </span>
                    </a>
                    <!-- submodules 2 -->
                    <div class="sub-menu collapse" id="module2drop">
                        <a href="add-adviser.php" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">Add Adviser</span></a>
                        <a href="add-panel.php" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">Add Panel</span></a>
                        <a href="assign-adviser.php" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">Assign Adviser</span></a>
                        <a href="assign-panel.php" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">Assign Panel</span></a>
                        <a href="view-assigns.php" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">View Assignments</span></a>
                    </div>
                </li>
                <li>
                    <!-- module 3 -->
                    <a href="#" class="nav-link text-center" data-bs-toggle="collapse" data-bs-target="#module3drop" aria-expanded="false" aria-controls="module3drop">
                        <i class="bi bi-cash-stack fs-5"></i>
                        <span class="description">Grants & Funding Assistance
                            <i class="bi bi-caret-down-fill"></i>
                        </span>
                    </a>
                    <!-- submodules 3 -->
                    <div class="sub-menu collapse" id="module3drop">
                        <a href="#" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">sub module 1</span></a>
                        <a href="#" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">sub module 2</span></a>
                        <a href="#" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">sub module 3</span></a>
                        <a href="#" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">sub module 4</span></a>
                        <a href="#" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">sub module 5</span></a>
                    </div>
                </li>

                <!-- module 4 -->
                <a href="#" class="nav-link text-center active" data-bs-toggle="collapse" data-bs-target="#module4drop" aria-expanded="false" aria-controls="module4drop">
                    <i class="bi bi-book fs-5"></i>
                    <span class="description">Documentation & Publication Management
                        <i class="bi bi-caret-down-fill"></i>
                    </span>
                </a>
                <!-- submodules 4 -->
                <div class="sub-menu collapse" id="module4drop">
                    <a href="#" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">sub module 1</span></a>
                    <a href="#" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">sub module 2</span></a>
                    <a href="#" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">sub module 3</span></a>
                    <a href="#" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">sub module 4</span></a>
                    <a href="#" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">sub module 5</span></a>
                </div>
                </li>

                <!-- module 5-->
                <a href="analytics.php" class="nav-link text-center">
                    <i class="bi bi-bar-chart-line fs-5"></i>
                    <span class="description">Analytics & Reporting</span>
                </a>

                <!-- module 6 -->
                <a href="#" class="nav-link text-center active" data-bs-toggle="collapse" data-bs-target="#module6drop" aria-expanded="false" aria-controls="module6drop">
                    <i class="bi bi-calendar4-week fs-5"></i>
                    <span class="description">Defense Scheduling
                        <i class="bi bi-caret-down-fill"></i>
                    </span>
                </a>

                <!-- submodules 6 -->
                <div class="sub-menu collapse" id="module6drop">
                    <a href="#" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">sub module 1</span></a>
                    <a href="#" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">sub module 2</span></a>
                    <a href="#" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">sub module 3</span></a>
                    <a href="#" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">sub module 4</span></a>
                    <a href="#" class="nav-link"><i class="bi bi-list-ul"></i> <span class="description">sub module 5</span></a>
                </div>


            </ul>
            <div class="p-3">
                <!-- This space is intentionally left blank after removing the logout button -->
            </div>
        </div>

        <!-- Main Content Wrapper -->
        <div class="main-content-wrapper">
            <!-- Top Navbar -->
            <nav class="top-navbar d-flex justify-content-between align-items-center">
                <div>
                    <button id="sidebar-toggle" class="btn btn-light"><i class="bi bi-list"></i></button>
                </div>
                <div class="d-flex align-items-center">
                    <span id="current-time" class="me-3 d-none d-sm-inline"></span>
                    <a href="#" class="text-dark me-3"><i class="bi bi-bell fs-5"></i></a>
                    <a href="#" class="text-dark me-3"><i class="bi bi-search fs-5"></i></a>

                    <!-- User Dropdown -->
                    <div class="dropdown">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-4"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <h6 class="dropdown-header"></h6>
                            </li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" style="margin: 0;">
                                    <button type="submit" name="logout" class="dropdown-item">Logout</button>
                                </form>

                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Content Area -->
            <main class="content-area">
               <!-- Stats Cards -->
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
            </main>

            <!-- Footer -->
            <footer class="footer">
                Center for Research And Development &copy;
            </footer>
        </div>
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay"></div>
    </div>

    <script>
        // Ensure the sidebar toggle functionality is initialized
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            document.body.classList.toggle('sidebar-toggled');
        });

        // New: Close sidebar when overlay is clicked
        document.querySelector('.sidebar-overlay').addEventListener('click', function() {
            document.body.classList.remove('sidebar-toggled');
        });

        // Clock Functionality
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
    </script>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</html>