<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Clerk Dashboard | Complaint Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #f0f4f8;
            color: #1e293b;
            overflow-x: hidden;
        }

        /* ========= SIDEBAR STYLES ========= */
        .app-wrapper {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #1a3a48 0%, #0f2c38 100%);
            color: white;
            flex-shrink: 0;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        body.sidebar-open {
            overflow: hidden;
        }

        .mobile-sidebar-toggle,
        .sidebar-close {
            border: none;
            cursor: pointer;
            align-items: center;
            justify-content: center;
        }

        .mobile-sidebar-toggle {
            display: none;
            position: fixed;
            top: 16px;
            left: 16px;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: #1a3a48;
            color: #ffffff;
            box-shadow: 0 8px 24px rgba(15, 44, 56, 0.2);
            z-index: 1002;
        }

        .sidebar-close {
            display: none;
            position: absolute;
            top: 22px;
            right: 18px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.52);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
            z-index: 999;
        }

        .sidebar-header {
            padding: 28px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 24px;
        }

        .sidebar-header h2 {
            font-size: 1.4rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-header h2 i {
            color: #5fbc9a;
            font-size: 1.6rem;
        }

        .sidebar-header p {
            font-size: 0.7rem;
            opacity: 0.7;
            margin-top: 8px;
        }

        .nav-menu {
            list-style: none;
            padding: 0 16px;
        }

        .nav-item {
            margin-bottom: 8px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 18px;
            color: #e2edf2;
            text-decoration: none;
            border-radius: 14px;
            transition: all 0.2s;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
        }

        .nav-link i {
            width: 24px;
            font-size: 1.2rem;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .nav-link.active {
            background: #2c7a5e;
            color: white;
            box-shadow: 0 4px 10px rgba(44, 122, 94, 0.3);
        }

        .logout-link {
            margin-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
        }

        .logout-link .nav-link {
            color: #ffb5a7;
        }

        .logout-link .nav-link:hover {
            background: rgba(220, 53, 69, 0.2);
            color: #ffc2b5;
        }

        /* Main content */
        .main-content {
            flex: 1;
            padding: 24px 32px;
            overflow-x: auto;
        }

        /* Header row */
        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 28px;
            gap: 20px;
        }

        .title-section h1 {
            font-size: 1.8rem;
            font-weight: 600;
            background: linear-gradient(135deg, #1a3a48, #2c7a5e);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .title-section p {
            color: #5a6e7c;
            font-size: 0.9rem;
            margin-top: 6px;
        }

        /* Profile card */
        .profile-card {
            background: white;
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 8px 20px 8px 16px;
            border-radius: 60px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border: 1px solid #e2edf2;
        }

        .avatar {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #2c7a5e, #1e5a48);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .profile-info h4 {
            font-size: 1rem;
            font-weight: 600;
        }

        .profile-info p {
            font-size: 0.75rem;
            color: #5f7f8c;
        }

        /* Notification bell */
        .notif-bell {
            position: relative;
            cursor: pointer;
            background: white;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: 1px solid #e0edf2;
            transition: all 0.2s;
        }
        .notif-bell:hover { background: #eef3f7; }
        .bell-icon { font-size: 1.3rem; color: #2c5a6e; }
        .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #e53e3e;
            color: white;
            font-size: 0.7rem;
            font-weight: bold;
            border-radius: 30px;
            padding: 2px 7px;
            min-width: 20px;
            text-align: center;
        }

        /* Summary cards */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            border-radius: 24px;
            padding: 20px 18px;
            border: 1px solid #e6edf2;
            transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.05); }
        .stat-card h3 {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            color: #5f8ba0;
            margin-bottom: 12px;
        }
        .stat-number { font-size: 2.6rem; font-weight: 700; color: #1a3a48; }

        /* Quick section */
        .quick-section {
            background: white;
            border-radius: 28px;
            padding: 20px 26px;
            margin-bottom: 32px;
            border: 1px solid #e6edf2;
        }
        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .btn-primary {
            background: #2c7a5e;
            border: none;
            padding: 10px 20px;
            border-radius: 40px;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-primary:hover { background: #1e5e48; transform: scale(0.98); }
        .btn-primary i { margin-right: 0px; }

        .btn-secondary {
            background: #f0f4f7;
            border: none;
            padding: 10px 20px;
            border-radius: 40px;
            color: #1a3a48;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-left: 8px;
        }
        .btn-secondary:hover { background: #e2edf2; }

        .shortcut-form {
            margin-top: 20px;
            background: #fafeff;
            border-radius: 20px;
            padding: 16px;
            border: 1px dashed #bdd9e4;
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            align-items: flex-end;
        }
        .form-group { flex: 1; min-width: 160px; }
        .form-group label {
            font-size: 0.75rem;
            font-weight: 500;
            color: #3a6f86;
            display: block;
            margin-bottom: 4px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px 12px;
            border-radius: 14px;
            border: 1px solid #cbdde6;
            background: white;
            font-size: 0.85rem;
        }
        .btn-sm {
            background: #2c7a5e;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
        }

        /* Complaints table */
        .complaints-table-wrapper {
            background: white;
            border-radius: 28px;
            padding: 20px;
            border: 1px solid #e6edf2;
            margin-bottom: 32px;
        }
        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 20px;
            justify-content: space-between;
            align-items: center;
        }
        .search-box {
            display: flex;
            gap: 6px;
            flex: 2;
        }
        .search-box input {
            flex: 1;
            padding: 8px 12px;
            border-radius: 40px;
            border: 1px solid #cbdde6;
        }
        .filter-select {
            padding: 8px 12px;
            border-radius: 40px;
            border: 1px solid #cbdde6;
            background: white;
        }
        .complaint-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.8rem;
        }
        .complaint-table th, .complaint-table td {
            text-align: left;
            padding: 12px 6px;
            border-bottom: 1px solid #ecf3f7;
        }
        .status-badge {
            padding: 4px 10px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
            display: inline-block;
        }
        .status-pending { background: #fff3e0; color: #c47b2e; }
        .status-progress { background: #e3f0fd; color: #2c6e9e; }
        .status-resolved { background: #e0f2e9; color: #1e6f4c; }
        .status-rejected { background: #ffe6e5; color: #bc3f33; }
        .action-icons i {
            margin: 0 5px;
            cursor: pointer;
            color: #6f9eb3;
            transition: 0.1s;
        }
        .action-icons i:hover { color: #1f3b4c; }

        .two-columns {
            display: flex;
            gap: 28px;
            flex-wrap: wrap;
            margin-bottom: 32px;
        }
        .recent-card, .chart-card {
            background: white;
            border-radius: 28px;
            padding: 20px;
            border: 1px solid #e6edf2;
            flex: 1;
        }
        .recent-activity-list { list-style: none; }
        .recent-activity-list li {
            padding: 12px 0;
            border-bottom: 1px solid #edf4f8;
            font-size: 0.8rem;
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .recent-activity-list i { color: #2c7a5e; width: 24px; }
        .activity-time { font-size: 0.7rem; color: #8aa0ae; margin-top: 4px; }

        /* Simple chart */
        .simple-chart {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 180px;
            background: #f8fafc;
            border-radius: 16px;
            margin-top: 10px;
        }
        .pie-legend {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-top: 16px;
            flex-wrap: wrap;
        }
        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.7rem;
        }
        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .no-data { text-align: center; padding: 30px; color: #8aaec0; }

        /* Submit page specific */
        .submit-form-large {
            background: white;
            border-radius: 28px;
            padding: 32px;
            border: 1px solid #e6edf2;
        }
        .form-row { margin-bottom: 24px; }
        .form-row label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #1a3a48;
        }
        .form-row input, .form-row select, .form-row textarea {
            width: 100%;
            padding: 12px 16px;
            border-radius: 16px;
            border: 1px solid #cbdde6;
            font-size: 0.9rem;
        }

        @media (max-width: 780px) {
            .sidebar { width: 80px; }
            .sidebar-header h2 span, .sidebar-header p, .nav-link span { display: none; }
            .nav-link { justify-content: center; padding: 12px; }
            .main-content { padding: 16px; }
        }

        /* Extra Small Devices (< 480px) */
        @media (max-width: 479px) {
            body { font-size: 13px; }
            .main-content { padding: 12px 16px; }
            .title-section h1 { font-size: 1.3rem; }
            .header-row { flex-direction: column; gap: 12px; }
            .profile-card { width: 100%; justify-content: center; }
            .complaint-table { font-size: 0.7rem; }
            .complaint-table th, .complaint-table td { padding: 6px 3px; }
        }

        /* Small Tablets (480px - 767px) */
        @media (min-width: 480px) and (max-width: 767px) {
            .main-content { padding: 16px 20px; }
            .title-section h1 { font-size: 1.5rem; }
            .complaint-table { font-size: 0.75rem; }
        }

        /* Large Devices (1200px and above) */
        @media (min-width: 1200px) {
            .main-content { padding: 28px 36px; }
        }

        @media (max-width: 991px) {
            .app-wrapper {
                display: block !important;
            }

            .mobile-sidebar-toggle {
                display: inline-flex !important;
            }

            .sidebar {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                width: min(280px, 86vw) !important;
                max-width: 86vw !important;
                height: 100vh !important;
                transform: translateX(-105%) !important;
            }

            .sidebar.mobile-open {
                transform: translateX(0) !important;
            }

            .sidebar-header {
                position: relative;
                padding-right: 64px;
            }

            .sidebar-close {
                display: inline-flex !important;
            }

            .sidebar-header h2 span,
            .nav-link span {
                display: inline !important;
            }

            .sidebar-header p {
                display: block !important;
            }

            .nav-link {
                justify-content: flex-start !important;
                padding: 12px 18px !important;
            }

            .sidebar-overlay {
                display: block !important;
            }

            .app-wrapper.menu-open .sidebar-overlay {
                opacity: 1 !important;
                pointer-events: auto !important;
            }

            .main-content {
                width: 100% !important;
                padding: 76px 20px 20px !important;
                overflow-x: hidden !important;
            }
        }

        @media (min-width: 992px) {
            .mobile-sidebar-toggle,
            .sidebar-close,
            .sidebar-overlay {
                display: none !important;
            }
        }

        @media (max-width: 479px) {
            .mobile-sidebar-toggle {
                top: 12px;
                left: 12px;
                width: 42px;
                height: 42px;
            }

            .sidebar {
                width: min(280px, 88vw) !important;
                max-width: 88vw !important;
            }

            .main-content {
                padding: 72px 12px 16px !important;
            }
        }

        /* Accessibility */
        @media (prefers-reduced-motion: reduce) {
            * { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; }
        }
    </style>
</head>

    <div class="app-wrapper">
    <button class="mobile-sidebar-toggle" type="button" aria-label="Open navigation" aria-controls="clerkSidebar" aria-expanded="false">
        <i class="fas fa-bars"></i>
    </button>
    <div class="sidebar-overlay" data-sidebar-close></div>
    <div class="sidebar" id="clerkSidebar">
        <div class="sidebar-header">
            <h2><i class="fas fa-ticket-alt"></i> <span>Complaint System</span></h2>
            <p><span>Complaint Portal</span></p>
            <button class="sidebar-close" type="button" data-sidebar-close aria-label="Close navigation">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{ route('clerk.dashboard') }}" class="nav-link {{ request()->routeIs('clerk.dashboard') ? 'active' : '' }}" data-page="dashboard">
                    <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('clerk.myComplaintsClerk') }}" class="nav-link {{ request()->routeIs('clerk.myComplaintsClerk') ? 'active' : '' }}" data-page="mycomplaints">
                    <i class="fas fa-list-ul"></i> <span>My Complaints</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('clerk.submitComplaintClerk') }}" class="nav-link {{ request()->routeIs('clerk.submitComplaintClerk') ? 'active' : '' }}" data-page="submit">
                    <i class="fas fa-plus-circle"></i> <span>Submit Complaint</span>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a href="{{ route('clerk.profileClerk') }}" class="nav-link {{ request()->routeIs('clerk.profileClerk') ? 'active' : '' }}">
                    <i class="fas fa-user-circle"></i> <span>Profile</span>
                </a>
            </li> -->
            <li class="nav-item logout-link">
                <a href="#" class="nav-link"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                </a>
            </li>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        </ul>
    </div>

    <div class = "main-content">
        <!-- Header -->

        <!-- yield -->
        @yield('content')
    </div>
    @include('partials.responsive-overrides')
</div>

<script>
    (function () {
        const wrapper = document.querySelector(".app-wrapper");
        const sidebar = document.querySelector(".sidebar");
        const toggleButton = document.querySelector(".mobile-sidebar-toggle");
        const closeButtons = document.querySelectorAll("[data-sidebar-close]");

        if (!wrapper || !sidebar || !toggleButton) {
            return;
        }

        function closeSidebar() {
            sidebar.classList.remove("mobile-open");
            wrapper.classList.remove("menu-open");
            document.body.classList.remove("sidebar-open");
            toggleButton.setAttribute("aria-expanded", "false");
        }

        function openSidebar() {
            sidebar.classList.add("mobile-open");
            wrapper.classList.add("menu-open");
            document.body.classList.add("sidebar-open");
            toggleButton.setAttribute("aria-expanded", "true");
        }

        toggleButton.addEventListener("click", () => {
            if (sidebar.classList.contains("mobile-open")) {
                closeSidebar();
                return;
            }

            openSidebar();
        });

        closeButtons.forEach((button) => button.addEventListener("click", closeSidebar));
        sidebar.querySelectorAll(".nav-link").forEach((link) => {
            link.addEventListener("click", () => {
                if (window.innerWidth < 992) {
                    closeSidebar();
                }
            });
        });
        document.addEventListener("keydown", (event) => {
            if (event.key === "Escape") {
                closeSidebar();
            }
        });
        window.addEventListener("resize", () => {
            if (window.innerWidth >= 992) {
                closeSidebar();
            }
        });
    })();

    document.getElementById("notificationBell")?.addEventListener("click", () => {
        alert("🔔 Notifications: You have 3 new updates on your complaints.");
    });
    document.getElementById("logoutBtn")?.addEventListener("click", () => {
        alert("🚪 Logged out successfully.");
    });
</script>

