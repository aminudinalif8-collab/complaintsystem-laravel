<style>
    html,
    body {
        max-width: 100%;
        overflow-x: hidden;
    }

    img,
    svg,
    video,
    canvas {
        max-width: 100%;
    }

    .main-content,
    main,
    .container,
    .container-fluid {
        min-width: 0;
    }

    @media (min-width: 992px) {
        .app-wrapper {
            display: block !important;
            min-height: 100vh !important;
        }

        #employeeSidebar.sidebar,
        #clerkSidebar.sidebar,
        #managerSidebar.sidebar,
        #supervisorSidebar.sidebar {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            bottom: 0 !important;
            width: 280px !important;
            height: 100dvh !important;
            z-index: 1000 !important;
            overflow-y: auto !important;
        }

        .app-wrapper > .main-content {
            width: calc(100% - 280px) !important;
            min-height: 100vh !important;
            margin-left: 280px !important;
        }
    }

    @media (max-width: 991px) {
        .app-wrapper {
            display: block !important;
        }

        .mobile-sidebar-toggle {
            display: inline-flex !important;
            z-index: 1002 !important;
        }

        #employeeSidebar.sidebar,
        #clerkSidebar.sidebar,
        #managerSidebar.sidebar,
        #supervisorSidebar.sidebar {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: min(280px, 86vw) !important;
            max-width: 86vw !important;
            height: 100vh !important;
            z-index: 1000 !important;
            transform: translateX(-105%) !important;
        }

        #employeeSidebar.mobile-open,
        #clerkSidebar.mobile-open,
        #managerSidebar.mobile-open,
        #supervisorSidebar.mobile-open {
            transform: translateX(0) !important;
        }

        .sidebar-close {
            display: inline-flex !important;
        }

        .sidebar-overlay {
            display: block !important;
            z-index: 999 !important;
        }

        .app-wrapper.menu-open .sidebar-overlay {
            opacity: 1 !important;
            pointer-events: auto !important;
        }

        .main-content {
            width: 100% !important;
            max-width: 100vw !important;
            padding: 76px 20px 20px !important;
            overflow-x: hidden !important;
        }

        .header-row,
        .page-header,
        .filter-bar,
        .search-filter,
        .filters-row,
        .report-actions,
        .modal-actions,
        .modal-buttons,
        .form-actions,
        .action-buttons,
        .button-group {
            flex-wrap: wrap !important;
            gap: 12px !important;
        }

        .stats-grid,
        .cards-grid,
        .dashboard-grid,
        .metrics-grid,
        .summary-grid,
        .info-grid,
        .details-grid,
        .content-grid,
        .reports-grid,
        .quick-grid,
        .profile-grid,
        .two-columns {
            display: grid !important;
            grid-template-columns: repeat(auto-fit, minmax(min(100%, 220px), 1fr)) !important;
            gap: 16px !important;
        }

        .profile-card,
        .user-card,
        .stat-card,
        .info-card,
        .detail-card,
        .report-card,
        .chart-card,
        .recent-card,
        .quick-section,
        .table-wrapper,
        .complaints-table-wrapper,
        .submit-form-large,
        .form-card,
        .card {
            max-width: 100% !important;
        }

        .profile-container,
        .profile-grid,
        .left-column,
        .right-column,
        .main-column,
        .side-column,
        .content-column,
        .profile-column {
            width: 100% !important;
            max-width: 100% !important;
            min-width: 0 !important;
        }

        .profile-card {
            min-width: 0 !important;
            overflow: hidden !important;
        }

        .profile-info,
        .title-section,
        .header-title,
        .meta-info {
            min-width: 0 !important;
        }

        .profile-info h4,
        .profile-info p,
        .title-section h1,
        .title-section p,
        .header-title h1,
        .header-title p,
        .meta-info,
        .meta-info span {
            overflow-wrap: anywhere !important;
        }

        .table-wrapper,
        .complaints-table-wrapper,
        .table-responsive,
        .table-container,
        .report-table,
        .data-table-wrapper {
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch;
            width: 100% !important;
        }

        table,
        .complaint-table,
        .data-table,
        .users-table {
            min-width: 640px;
        }

        .chart-container,
        .simple-chart {
            overflow-x: auto !important;
            min-width: 0 !important;
        }

        .modal,
        .modal-overlay,
        .modal-backdrop,
        .password-modal,
        .custom-modal {
            padding: 12px !important;
        }

        .modal-content,
        .modal-box,
        .modal-card,
        .modal-content-responsive,
        .password-modal-content,
        .approval-modal-content {
            width: min(100%, 560px) !important;
            max-width: calc(100vw - 24px) !important;
            max-height: calc(100dvh - 24px) !important;
            overflow-y: auto !important;
        }

        input,
        select,
        textarea,
        .form-control {
            max-width: 100% !important;
            font-size: 16px !important;
        }
    }

    @media (max-width: 768px) {
        .main-content {
            padding: 72px 16px 18px !important;
        }

        .header-row,
        .page-header,
        .filter-bar,
        .search-box,
        .search-filter,
        .filters-row,
        .shortcut-form,
        .form-actions,
        .action-buttons,
        .modal-actions,
        .modal-buttons,
        .options-row {
            flex-direction: column !important;
            align-items: stretch !important;
        }

        .header-row > *,
        .page-header > *,
        .filter-bar > *,
        .search-box > *,
        .search-filter > *,
        .filters-row > *,
        .form-actions > *,
        .action-buttons > *,
        .modal-actions > *,
        .modal-buttons > *,
        .options-row > * {
            width: 100%;
            min-width: 0 !important;
        }

        .stats-grid,
        .cards-grid,
        .dashboard-grid,
        .metrics-grid,
        .summary-grid,
        .info-grid,
        .details-grid,
        .content-grid,
        .reports-grid,
        .quick-grid,
        .profile-grid,
        .two-columns,
        .form-row,
        .form-grid,
        .attachments-grid,
        .history-grid {
            grid-template-columns: 1fr !important;
        }

        .profile-card {
            width: 100% !important;
            justify-content: flex-start !important;
        }

        .btn,
        .btn-primary,
        .btn-secondary,
        .btn-sm,
        .btn-report,
        .btn-register,
        .login-btn,
        button[type="submit"] {
            max-width: 100%;
            white-space: normal !important;
        }

        .pagination,
        .pagination-wrapper {
            overflow-x: auto !important;
            justify-content: flex-start !important;
            -webkit-overflow-scrolling: touch;
        }
    }

    @media (max-width: 480px) {
        .main-content {
            padding: 68px 12px 16px !important;
        }

        .card,
        .stat-card,
        .quick-section,
        .table-wrapper,
        .complaints-table-wrapper,
        .submit-form-large,
        .form-card,
        .recent-card,
        .chart-card,
        .modal-content,
        .modal-box {
            border-radius: 14px !important;
            padding: 16px !important;
        }

        .title-section h1,
        .page-header h1,
        .header-title h1 {
            font-size: 1.35rem !important;
            line-height: 1.25 !important;
        }

        .profile-card {
            padding: 10px 12px !important;
            gap: 10px !important;
        }

        .avatar {
            width: 42px !important;
            height: 42px !important;
            flex: 0 0 42px !important;
        }

        table,
        .complaint-table,
        .data-table,
        .users-table {
            min-width: 560px;
        }
    }
</style>
