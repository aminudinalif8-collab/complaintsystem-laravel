@extends('supervisor.sidebar')

@section('content')

<style>
    :root {
        --primary-dark: #1A3A3F;
        --primary: #2C6E5C;
        --primary-light: #EAF6F2;
        --accent: #D9B48B;
        --gray-50: #F8FAFC;
        --gray-100: #F1F5F9;
        --gray-200: #E9EDF2;
        --gray-300: #DFE5EA;
        --gray-400: #C2CDD6;
        --gray-500: #94A3B8;
        --gray-600: #64748B;
        --gray-700: #475569;
        --gray-800: #1E293B;
        --red-soft: #FEF2F2;
        --red: #DC2626;
        --yellow-soft: #FFFBEB;
        --yellow: #D97706;
        --green-soft: #ECFDF5;
        --green: #059669;
        --blue-soft: #EFF6FF;
        --blue: #2563EB;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.05);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.08);
        --radius-md: 10px;
        --radius-lg: 16px;
        --radius-xl: 24px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: var(--gray-100);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        color: var(--gray-800);
        line-height: 1.5;
        overflow-x: hidden;
    }

    /* Main content */
    .main-content {
        padding: 28px 36px;
        overflow-x: auto;
        min-height: 100vh;
    }

    .header-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 32px;
        gap: 20px;
    }

    .title-section h1 {
        font-size: 1.75rem;
        font-weight: 600;
        color: var(--gray-800);
        letter-spacing: -0.02em;
        margin: 0;
        line-height: 1.3;
    }

    .title-section p {
        font-size: 0.875rem;
        color: var(--gray-500);
        margin-top: 4px;
    }

    /* Profile Card */
    .profile-card {
        display: flex;
        align-items: center;
        gap: 16px;
        text-decoration: none;
        background: white;
        padding: 8px 24px 8px 18px;
        border-radius: 60px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
        transition: all 0.2s;
    }

    .profile-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        border-color: var(--gray-300);
    }

    .avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        font-weight: 600;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-info h4 {
        margin: 0;
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--gray-800);
    }

    .meta-info {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.7rem;
        color: var(--gray-500);
        flex-wrap: wrap;
    }

    .dot {
        font-size: 10px;
        color: var(--gray-400);
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: white;
        border-radius: var(--radius-xl);
        padding: 20px;
        border: 1px solid var(--gray-200);
        transition: all 0.2s;
        box-shadow: var(--shadow-sm);
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
        border-color: var(--gray-300);
    }

    .stat-card h3 {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        color: var(--gray-500);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--gray-800);
        line-height: 1.2;
    }

    /* Table Wrapper */
    .table-wrapper {
        background: white;
        border-radius: var(--radius-sm);
        padding: 24px;
        border: 1px solid var(--gray-200);
        box-shadow: var(--shadow-sm);
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--gray-800);
    }

    /* Tab Styles */
    .tabs-container {
        margin-bottom: 24px;
        border-bottom: 1px solid var(--gray-200);
    }

    .tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        list-style: none;
    }

    .tab-btn {
        padding: 10px 24px;
        background: transparent;
        border: none;
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--gray-600);
        cursor: pointer;
        transition: all 0.2s;
        border-radius: 40px;
        font-family: inherit;
    }

    .tab-btn:hover {
        background: var(--gray-100);
        color: var(--primary);
    }

    .tab-btn.active {
        background: var(--primary);
        color: white;
        box-shadow: var(--shadow-sm);
    }

    /* Search Bar */
    .search-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 24px;
        align-items: center;
        justify-content: space-between;
    }

    .search-box {
        display: flex;
        gap: 8px;
        flex: 2;
        min-width: 250px;
    }

    .search-box input {
        flex: 1;
        padding: 10px 16px;
        border-radius: 40px;
        border: 1.5px solid var(--gray-200);
        font-size: 0.85rem;
        transition: all 0.2s;
    }

    .search-box input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(44,110,92,0.1);
    }

    .search-box i {
        align-self: center;
        color: var(--gray-400);
    }

    .result-count {
        font-size: 0.8rem;
        color: var(--gray-500);
    }

    /* Complaint Table */
    .complaint-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.85rem;
    }

    .complaint-table th {
        text-align: left;
        padding: 14px 12px;
        border-bottom: 1px solid var(--gray-200);
        font-weight: 600;
        color: var(--gray-600);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .complaint-table td {
        padding: 14px 12px;
        border-bottom: 1px solid var(--gray-100);
        color: var(--gray-700);
        vertical-align: middle;
    }

    .complaint-table tr:hover td {
        background: var(--gray-50);
    }

    /* Status Badges */
    .status-badge {
        padding: 4px 12px;
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-block;
    }

    .status-pending { background: var(--yellow-soft); color: var(--yellow); }
    .status-in-progress { background: var(--blue-soft); color: var(--blue); }
    .status-pending-approval { background: #FFF0DB; color: #C47B2E; }
    .status-resolved { background: var(--green-soft); color: var(--green); }
    .status-rejected { background: var(--red-soft); color: var(--red); }
    .status-cancelled { background: var(--gray-100); color: var(--gray-500); }

    /* Priority Badges */
    .priority-high { background: #FEF2F2; color: #DC2626; }
    .priority-medium { background: #FFFBEB; color: #D97706; }
    .priority-low { background: #ECFDF5; color: #059669; }

    /* Rejection Count */
    .rejection-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 28px;
        height: 28px;
        background: var(--red-soft);
        color: var(--red);
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0 8px;
    }

    .no-rejection {
        color: var(--gray-400);
        font-size: 0.7rem;
    }

    /* Action Icons */
    .action-icons {
        display: flex;
        gap: 12px;
    }

    .action-icons a {
        text-decoration: none;
        color: var(--gray-500);
        display: inline-flex;
        align-items: center;
        transition: all 0.2s;
    }

    .action-icons a:hover {
        color: var(--primary);
    }

    .action-icons i {
        font-size: 1rem;
        cursor: pointer;
    }

    /* REDESIGNED BUTTON */
    .btn-revise {
        background: linear-gradient(135deg, #F59E0B, #D97706);
        border: none;
        padding: 8px 20px;
        border-radius: 30px;
        color: white;
        font-size: 0.75rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 8px rgba(217, 119, 6, 0.3);
        letter-spacing: 0.3px;
    }

    .btn-revise:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(217, 119, 6, 0.4);
        background: linear-gradient(135deg, #F59E0B, #B45309);
    }

    .btn-revise:active {
        transform: translateY(0px);
        box-shadow: 0 2px 8px rgba(217, 119, 6, 0.2);
    }

    .btn-revise i {
        font-size: 0.85rem;
    }

    /* MODAL REDESIGN */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        align-items: center;
        justify-content: center;
        z-index: 1000;
        backdrop-filter: blur(4px);
        animation: fadeIn 0.2s ease;
    }

    .modal-content {
        background: white;
        border-radius: var(--radius-xl);
        padding: 0;
        max-width: 580px;
        width: 92%;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        animation: slideUp 0.3s ease;
        overflow: hidden;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Modal Header */
    .modal-header {
        padding: 24px 28px 20px;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        align-items: flex-start;
        gap: 16px;
        background: linear-gradient(135deg, #FFFBEB, #FEF3C7);
    }

    .modal-header-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #F59E0B, #D97706);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(217, 119, 6, 0.3);
    }

    .modal-header h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--gray-800);
        margin: 0 0 4px 0;
        letter-spacing: -0.3px;
    }

    .modal-subtitle {
        font-size: 0.8rem;
        color: var(--gray-500);
        margin: 0;
    }

    .modal-close {
        margin-left: auto;
        background: none;
        border: none;
        color: var(--gray-400);
        font-size: 1.2rem;
        cursor: pointer;
        padding: 4px 8px;
        border-radius: 8px;
        transition: all 0.2s;
    }

    .modal-close:hover {
        background: var(--gray-100);
        color: var(--gray-600);
    }

    /* Complaint Reference */
    .complaint-reference {
        padding: 16px 28px;
        background: #F8FAFC;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .reference-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .reference-id {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--primary);
        background: var(--primary-light);
        padding: 2px 14px;
        border-radius: 40px;
        font-family: monospace;
    }

    /* Info Card */
    .info-card {
        margin: 20px 28px 12px;
        background: #F8FAFC;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-md);
        overflow: hidden;
    }

    .info-card-header {
        padding: 10px 16px;
        background: #F1F5F9;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--gray-600);
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .info-card-header i {
        color: var(--primary);
        font-size: 0.8rem;
    }

    .info-card-content {
        padding: 12px 16px;
        font-size: 0.85rem;
        color: var(--gray-700);
        line-height: 1.6;
    }

    /* Rejection Card */
    .rejection-card {
        margin: 0 28px 20px;
        background: #FEF2F2;
        border: 1px solid #FECACA;
        border-radius: var(--radius-md);
        overflow: hidden;
    }

    .rejection-card-header {
        padding: 10px 16px;
        background: #FEE2E2;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.7rem;
        font-weight: 600;
        color: #B91C1C;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .rejection-card-header i {
        color: #DC2626;
    }

    .rejection-card-content {
        padding: 12px 16px;
        font-size: 0.85rem;
        color: #991B1B;
        line-height: 1.6;
    }

    /* Form Group */
    .form-group {
        padding: 0 28px 20px;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--gray-700);
        margin-bottom: 8px;
    }

    .form-label i {
        color: var(--primary);
    }

    .required-star {
        color: #DC2626;
        font-weight: 700;
    }

    .form-textarea {
        width: 100%;
        padding: 12px 16px;
        border-radius: var(--radius-md);
        border: 1.5px solid var(--gray-200);
        font-size: 0.85rem;
        font-family: inherit;
        transition: all 0.2s;
        resize: vertical;
        min-height: 100px;
        background: #FAFBFC;
    }

    .form-textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(44, 110, 92, 0.1);
        background: white;
    }

    .form-hint {
        display: block;
        margin-top: 6px;
        font-size: 0.7rem;
        color: var(--gray-400);
    }

    /* Form Actions */
    .form-actions {
        padding: 16px 28px 24px;
        border-top: 1px solid var(--gray-200);
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        background: #FAFBFC;
    }

    .btn-cancel {
        background: white;
        border: 1.5px solid var(--gray-300);
        color: var(--gray-600);
        padding: 10px 24px;
        border-radius: 30px;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-cancel:hover {
        background: var(--gray-50);
        border-color: var(--gray-400);
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border: none;
        padding: 10px 28px;
        border-radius: 30px;
        color: white;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 12px rgba(44, 110, 92, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(44, 110, 92, 0.4);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    /* Responsive adjustments */
    @media (max-width: 640px) {
        .modal-content {
            width: 95%;
            margin: 10px;
            max-height: 95vh;
            overflow-y: auto;
        }

        .modal-header {
            padding: 20px 20px 16px;
            flex-wrap: wrap;
        }

        .modal-header-icon {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .modal-header h3 {
            font-size: 1rem;
        }

        .modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
        }

        .complaint-reference {
            padding: 12px 20px;
        }

        .info-card,
        .rejection-card {
            margin-left: 20px;
            margin-right: 20px;
        }

        .form-group {
            padding: 0 20px 16px;
        }

        .form-actions {
            padding: 16px 20px 20px;
            flex-direction: column-reverse;
        }

        .btn-cancel,
        .btn-submit {
            width: 100%;
            justify-content: center;
        }
    }

    /* Buttons */
    .btn-sm {
        background: var(--primary);
        border: none;
        padding: 8px 20px;
        border-radius: 30px;
        color: white;
        font-size: 0.75rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-sm:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
    }

    .btn-outline {
        background: white;
        border: 1.5px solid var(--primary);
        color: var(--primary);
        padding: 7px 19px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-outline:hover {
        background: var(--primary-light);
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .modal-content {
        background: white;
        border-radius: var(--radius-xl);
        padding: 28px;
        max-width: 500px;
        width: 90%;
        box-shadow: var(--shadow-lg);
    }

    .modal-content h3 {
        margin-bottom: 20px;
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--gray-800);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .modal-content select,
    .modal-content textarea {
        width: 100%;
        padding: 12px 14px;
        border-radius: var(--radius-md);
        border: 1.5px solid var(--gray-200);
        font-size: 0.85rem;
        margin: 8px 0 16px;
        font-family: inherit;
    }

    .modal-content select:focus,
    .modal-content textarea:focus {
        outline: none;
        border-color: var(--primary);
    }

    .modal-content textarea {
        min-height: 100px;
        resize: vertical;
    }

    .modal-buttons {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 20px;
    }

    .complaint-id-highlight {
        background: var(--primary-light);
        padding: 2px 8px;
        border-radius: 20px;
        font-family: monospace;
        font-size: 0.9rem;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px;
        color: var(--gray-400);
    }

    .empty-state i {
        font-size: 2rem;
        margin-bottom: 12px;
        opacity: 0.5;
    }

    /* Pagination Styles */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-top: 24px;
        flex-wrap: wrap;
    }

    .page-btn {
        padding: 8px 14px;
        border-radius: 8px;
        text-decoration: none;
        border: 1px solid var(--gray-300);
        color: var(--primary);
        background: white;
        transition: 0.2s;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .page-btn:hover {
        background: var(--primary-light);
    }

    .page-btn.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .page-btn.disabled {
        color: var(--gray-400);
        cursor: not-allowed;
        background: var(--gray-100);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .main-content {
            padding: 20px;
        }
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        .stat-card {
            padding: 16px;
        }
        .stat-number {
            font-size: 1.6rem;
        }
        .tabs {
            flex-wrap: wrap;
        }
        .tab-btn {
            padding: 6px 16px;
            font-size: 0.75rem;
        }
        .search-bar {
            flex-direction: column;
            align-items: stretch;
        }
        .complaint-table {
            font-size: 0.75rem;
        }
        .complaint-table th,
        .complaint-table td {
            padding: 10px 6px;
        }
        .action-icons {
            gap: 6px;
        }
    }

    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="header-row">
    <div class="title-section">
        <h1><i class="fas fa-tasks" style="color: var(--primary);"></i> Supervisor Dashboard</h1>
        <p>Manage complaints, update status, add actions, and submit for approval</p>
    </div>
    <a href="{{ route('supervisor.profile') }}" class="profile-card">
        <div class="avatar">
            @if(Auth::user()->employeePicture)
                <img src="{{ asset('uploads/' . Auth::user()->employeePicture) }}" alt="Avatar">
            @else
                {{ strtoupper(substr(Auth::user()->employeeName, 0, 2)) }}
            @endif
        </div>
        <div class="profile-info">
            <h4>{{ Auth::user()->employeeName }}</h4>
            <div class="meta-info">
                <span class="dept">{{ Auth::user()->department?->departmentName ?? 'N/A' }} Dept</span>
                <span class="dot">•</span>
                <span class="email">{{ Auth::user()->employeeEmail }}</span>
            </div>
        </div>
    </a>
</div>

<!-- REVISE TABLE -->
<div id="reviseActionsSection">
    <div class="table-wrapper">

        <div class="section-title">
            <i class="fas fa-undo-alt"></i>
            Actions Requiring Revision (Rejected by Manager)
        </div>

        <table id="complaintTable" class="complaint-table">

            <thead>
                <tr>
                    <th>Complaint ID</th>
                    <th>Employee</th>
                    <th>Complaint Title</th>
                    <th>Proposed Action</th>
                    <th>Rejection Reason</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($rejectedActions as $action)
                <tr>
                    <td>
                        C{{ str_pad($action->complaint->complaintID, 3, '0', STR_PAD_LEFT) }}
                    </td>

                    <td>
                        {{ $action->complaint->employee->employeeName }}
                    </td>

                    <td>
                        {{ $action->complaint->complaintTitle }}
                    </td>

                    <td>
                        {{ $action->actionDescription }}
                    </td>

                    <td>
                        {{ $action->approval->managerRemarks ?? 'No remarks' }}
                    </td>

                    <td>
                        <button class="btn-revise"
                            onclick="reviseAction('{{ $action->actionID }}', this)">
                            <i class="fas fa-edit"></i> Revise
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;">
                        No rejected actions found
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

<!-- REVISE MODAL -->
<div id="reviseModal" class="modal">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <div class="modal-header-icon">
                <i class="fas fa-pen-fancy"></i>
            </div>
            <div>
                <h3>Revise Action Plan</h3>
                <p class="modal-subtitle">Update your action based on manager's feedback</p>
            </div>
            <button class="modal-close" onclick="closeReviseModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Complaint Reference -->
        <div class="complaint-reference">
            <span class="reference-label">Complaint</span>
            <span class="reference-id" id="reviseComplaintId">#C001</span>
        </div>

        <!-- Previous Action Card -->
        <div class="info-card">
            <div class="info-card-header">
                <i class="fas fa-history"></i>
                <span>Previous Proposed Action</span>
            </div>
            <div id="previousActionText" class="info-card-content"></div>
        </div>

        <!-- Rejection Card -->
        <div class="rejection-card">
            <div class="rejection-card-header">
                <i class="fas fa-exclamation-circle"></i>
                <span>Manager's Rejection Reason</span>
            </div>
            <div id="rejectionReasonText" class="rejection-card-content"></div>
        </div>

        <!-- Form -->
        <form id="reviseForm" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-edit"></i>
                    Revised Action Plan
                    <span class="required-star">*</span>
                </label>
                <textarea
                    id="revisedActionDesc"
                    name="actionDescription"
                    class="form-textarea"
                    placeholder="Describe your revised action plan addressing the manager's feedback..."
                    rows="4"
                    required
                ></textarea>
                <span class="form-hint">Be specific and address all points raised by the manager</span>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="button" class="btn-cancel" onclick="closeReviseModal()">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane"></i> Submit Revision
                </button>
            </div>

        </form>

    </div>
</div>

<script>
    let currentActionId = '';

    // OPEN MODAL with improved data fetching
    window.reviseAction = (id, btnElement) => {
        currentActionId = id;

        const row = btnElement.closest('tr');

        const complaintId = row.cells[0]?.innerText || '';
        const previousAction = row.cells[3]?.innerText || '';
        const rejectionReason = row.cells[4]?.innerText || '';

        document.getElementById('reviseComplaintId').innerText = complaintId;
        document.getElementById('previousActionText').innerText = previousAction;
        document.getElementById('rejectionReasonText').innerText = rejectionReason;

        document.getElementById('revisedActionDesc').value = '';

        document.getElementById('reviseForm').action =
            `/supervisor/action/${id}/revise`;

        document.getElementById('reviseModal').style.display = 'flex';
    };

    // CLOSE MODAL
    window.closeReviseModal = () => {
        document.getElementById('reviseModal').style.display = 'none';
    };

    // Close modal when clicking outside
    window.onclick = (event) => {
        const modal = document.getElementById('reviseModal');
        if (event.target === modal) {
            closeReviseModal();
        }
    };

    // SEARCH FUNCTIONALITY (preserved)
    // document.getElementById('complaintSearch')?.addEventListener('keyup', function () {
    //     const filter = this.value.toLowerCase();

    //     document.querySelectorAll('#complaintTable tbody tr').forEach(row => {
    //         const text =
    //             row.cells[0]?.innerText.toLowerCase() +
    //             row.cells[1]?.innerText.toLowerCase() +
    //             row.cells[2]?.innerText.toLowerCase();

    //         row.style.display = text.includes(filter) ? '' : 'none';
    //     });
    // });

</script>

@endsection