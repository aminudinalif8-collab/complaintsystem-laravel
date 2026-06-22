<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Employee Dashboard | Complaint Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* ================= GLOBAL RESET ================= */
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

        /* ================= APP LAYOUT ================= */
        .app-wrapper {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* ================= SIDEBAR ================= */
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

        /* ================= NAV ================= */
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
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
        }

        .nav-link i {
            width: 24px;
            font-size: 1.2rem;
        }

        /* hover */
        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        /* ACTIVE STATE (IMPORTANT FIX) */
        .nav-link.active {
            background: #2c7a5e !important;
            color: #ffffff !important;
            box-shadow: 0 4px 10px rgba(44, 122, 94, 0.35);
            border-radius: 14px;
        }

        /* logout */
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

        /* ================= MAIN CONTENT ================= */
        .main-content {
            flex: 1;
            padding: 24px 32px;
            overflow-x: auto;
        }

        /* ================= HEADER ================= */
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

        /* ================= PROFILE ================= */
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

        /* ================= TABLE ================= */
        .table-wrapper {
            background: white;
            border-radius: 28px;
            padding: 20px;
            border: 1px solid #e6edf2;
            margin-bottom: 32px;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .complaint-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.8rem;
        }

        .complaint-table th,
        .complaint-table td {
            text-align: left;
            padding: 12px 8px;
            border-bottom: 1px solid #ecf3f7;
        }

        /* ================= STATUS ================= */
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
        .status-cancelled { background: #f1f5f9; color: #64748b; }

        /* ================= BUTTON ================= */
        .btn-sm {
            background: #2c7a5e;
            border: none;
            padding: 6px 12px;
            border-radius: 30px;
            color: white;
            font-size: 0.7rem;
            cursor: pointer;
        }

        .btn-sm:hover {
            background: #1e5e48;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 780px) {
            .sidebar {
                width: 80px;
            }

            .sidebar-header h2 span,
            .sidebar-header p,
            .nav-link span {
                display: none;
            }

            .nav-link {
                justify-content: center;
                padding: 12px;
            }

            .main-content {
                padding: 16px;
            }
        }

        /* Extra Small Devices (< 480px) */
        @media (max-width: 479px) {
            body {
                font-size: 13px;
            }

            .main-content {
                padding: 12px 16px;
            }

            .title-section h1 {
                font-size: 1.3rem;
            }

            .header-row {
                flex-direction: column;
                gap: 12px;
                margin-bottom: 20px;
            }

            .profile-card {
                width: 100%;
                justify-content: center;
            }

            .complaint-table {
                font-size: 0.7rem;
            }

            .complaint-table th,
            .complaint-table td {
                padding: 6px 3px;
            }

            .section-title {
                font-size: 1rem;
            }
        }

        /* Small Tablets (480px - 767px) */
        @media (min-width: 480px) and (max-width: 767px) {
            .main-content {
                padding: 16px 20px;
            }

            .title-section h1 {
                font-size: 1.5rem;
            }

            .header-row {
                gap: 12px;
            }

            .complaint-table {
                font-size: 0.75rem;
            }
        }

        /* Tablets (768px - 991px) */
        @media (min-width: 768px) and (max-width: 991px) {
            .complaint-table {
                font-size: 0.8rem;
            }
        }

        /* Large Devices (1200px and above) */
        @media (min-width: 1200px) {
            .main-content {
                padding: 28px 36px;
            }
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

        /* Accessibility - Reduced Motion */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Dark Mode Support */
        @media (prefers-color-scheme: dark) {
            body {
                background: #1a1a1a;
                color: #e0e0e0;
            }

            .table-wrapper {
                background: #2a2a2a;
                border-color: #444;
            }
        }
        </style>
</head>

    <div class="app-wrapper">
    <button class="mobile-sidebar-toggle" type="button" aria-label="Open navigation" aria-controls="supervisorSidebar" aria-expanded="false">
        <i class="fas fa-bars"></i>
    </button>
    <div class="sidebar-overlay" data-sidebar-close></div>
    <!-- SIDEBAR -->
    <div class="sidebar" id="supervisorSidebar">
        <div class="sidebar-header">
            <h2><i class="fas fa-ticket-alt"></i> <span>Merchant9</span></h2>
            <p><span>Complaint Portal</span></p>
            <button class="sidebar-close" type="button" data-sidebar-close aria-label="Close navigation">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{ route('supervisor.dashboard') }}" class="nav-link {{ request()->routeIs('supervisor.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('supervisor.viewComplaints') }}" class="nav-link {{ request()->routeIs('supervisor.viewComplaints') ? 'active' : '' }}">
                    <i class="fas fa-list"></i> <span>View Complaints</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('supervisor.pendingApproval') }}" class="nav-link {{ request()->routeIs('supervisor.pendingApproval') ? 'active' : '' }}">
                    <i class="fas fa-hourglass-half"></i> <span>Pending Approval</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('supervisor.reviseActions') }}" class="nav-link {{ request()->routeIs('supervisor.reviseActions') ? 'active' : '' }}">
                    <i class="fas fa-undo-alt"></i> <span>Revise Actions</span>
                </a>
            </li>

            <!-- <li class="nav-item">
                <a href="{{ route('supervisor.profile') }}" class="nav-link {{ request()->routeIs('supervisor.profile') ? 'active' : '' }}">
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
</script>
