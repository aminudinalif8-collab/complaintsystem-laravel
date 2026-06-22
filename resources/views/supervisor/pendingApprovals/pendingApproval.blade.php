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

    .table-wrapper {
        background: white;
        border-radius: var(--radius-sm);
        padding: 24px;
        border: 1px solid var(--gray-200);
        box-shadow: var(--shadow-sm);
        margin-bottom: 32px;
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

    .priority-high { background: #FEF2F2; color: #DC2626; }
    .priority-medium { background: #FFFBEB; color: #D97706; }
    .priority-low { background: #ECFDF5; color: #059669; }

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
        font-family: inherit;
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
        font-family: inherit;
    }

    .btn-outline:hover {
        background: var(--primary-light);
    }

    /* ================================================================
       PROFESSIONAL MODAL STYLES
    ================================================================ */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.55);
        backdrop-filter: blur(4px);
        align-items: center;
        justify-content: center;
        z-index: 1000;
        padding: 20px;
    }

    .modal-content {
        background: white;
        border-radius: var(--radius-xl);
        padding: 0;
        max-width: 580px;
        width: 100%;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);
        max-height: 90vh;
        overflow-y: auto;
        animation: modalFadeIn 0.3s ease;
    }

    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: scale(0.95) translateY(10px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    /* Modal Header */
    .modal-header-custom {
        background: linear-gradient(135deg, var(--primary-dark) 0%, #1F4E4A 100%);
        padding: 20px 28px;
        border-radius: var(--radius-xl) var(--radius-xl) 0 0;
        color: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .modal-header-custom h3 {
        font-size: 1.2rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .modal-header-custom h3 i {
        color: #5fbc9a;
    }

    .modal-close-btn {
        background: rgba(255, 255, 255, 0.15);
        border: none;
        color: white;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 1.1rem;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-close-btn:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: rotate(90deg);
    }

    /* Modal Body */
    .modal-body {
        padding: 24px 28px 28px;
    }

    /* Complaint ID Badge */
    .complaint-id-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--primary-light);
        color: var(--primary);
        padding: 4px 16px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.8rem;
        margin-bottom: 16px;
    }

    .complaint-id-badge i {
        font-size: 0.7rem;
    }

    /* Detail Grid */
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px 24px;
        margin-bottom: 16px;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 2px;
        padding: 8px 0;
        border-bottom: 1px solid var(--gray-100);
    }

    .detail-item .label {
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-500);
    }

    .detail-item .value {
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--gray-800);
        word-break: break-word;
    }

    .detail-item .value .status-badge {
        font-size: 0.7rem;
    }

    .detail-item.full-width {
        grid-column: 1 / -1;
    }

    /* Divider */
    .modal-divider {
        border: none;
        border-top: 1px solid var(--gray-200);
        margin: 16px 0 20px;
    }

    /* Submitter Section */
    .submitter-section {
        background: var(--gray-50);
        border-radius: var(--radius-lg);
        padding: 16px 20px;
        margin-bottom: 16px;
    }

    .submitter-section h4 {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-500);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .submitter-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 6px 16px;
    }

    .submitter-item {
        display: flex;
        flex-direction: column;
        gap: 1px;
    }

    .submitter-item .label {
        font-size: 0.6rem;
        font-weight: 500;
        color: var(--gray-400);
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .submitter-item .value {
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--gray-700);
    }

    /* Evidence Section */
    .evidence-section {
        margin-top: 4px;
    }

    .evidence-section .label {
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-500);
        display: block;
        margin-bottom: 8px;
    }

    .evidence-box {
        background: var(--gray-50);
        border-radius: var(--radius-lg);
        padding: 16px;
        text-align: center;
        border: 1px dashed var(--gray-300);
        min-height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .evidence-box img {
        max-width: 100%;
        max-height: 240px;
        border-radius: var(--radius-md);
        border: 1px solid var(--gray-200);
        box-shadow: var(--shadow-sm);
    }

    .evidence-box a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .evidence-box a:hover {
        text-decoration: underline;
        color: var(--primary-dark);
    }

    .evidence-box .no-evidence {
        color: var(--gray-400);
        font-size: 0.85rem;
    }

    .evidence-box .no-evidence i {
        font-size: 1.5rem;
        display: block;
        margin-bottom: 6px;
        opacity: 0.5;
    }

    /* Modal Footer */
    .modal-footer-custom {
        padding: 16px 28px 24px;
        border-top: 1px solid var(--gray-200);
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .modal-footer-custom .btn-close-modal {
        background: var(--gray-100);
        border: 1px solid var(--gray-200);
        padding: 8px 24px;
        border-radius: 40px;
        font-weight: 500;
        font-size: 0.85rem;
        color: var(--gray-600);
        cursor: pointer;
        transition: all 0.2s;
        font-family: inherit;
    }

    .modal-footer-custom .btn-close-modal:hover {
        background: var(--gray-200);
    }

    /* Scrollbar Styling */
    .modal-content::-webkit-scrollbar {
        width: 6px;
    }

    .modal-content::-webkit-scrollbar-track {
        background: var(--gray-100);
        border-radius: 10px;
    }

    .modal-content::-webkit-scrollbar-thumb {
        background: var(--gray-300);
        border-radius: 10px;
    }

    .modal-content::-webkit-scrollbar-thumb:hover {
        background: var(--gray-400);
    }

    .complaint-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        cursor: pointer;
        transition: color 0.2s;
    }

    .complaint-link:hover {
        color: var(--primary-dark);
        text-decoration: underline;
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
    @media (max-width: 640px) {
        .detail-grid {
            grid-template-columns: 1fr;
            gap: 6px;
        }

        .submitter-grid {
            grid-template-columns: 1fr;
        }

        .modal-body {
            padding: 16px 18px 20px;
        }

        .modal-header-custom {
            padding: 16px 18px;
        }

        .modal-footer-custom {
            padding: 12px 18px 18px;
            flex-direction: column;
        }

        .modal-footer-custom .btn-close-modal {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="main-content">
    <!-- Header Row -->
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

    <!-- PENDING APPROVAL SECTION -->
    <div id="pendingApprovalSection">
        <div class="table-wrapper">
            <div class="section-title"><i class="fas fa-hourglass-half" style="color: var(--primary);"></i> Actions Submitted for Approval</div>
            <table class="complaint-table">
                <thead>
                    <tr>
                        <th>Complaint ID</th>
                        <th>Complaint Title</th>
                        <th>Action Description</th>
                        <th>Submitted Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingActions as $action)
                    <tr>
                        <td>C{{ str_pad($action->complaint->complaintID, 3, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <a href="javascript:void(0)" class="complaint-link" onclick="openComplaintModal({{ $action->actionID }})">
                                {{ $action->complaint->complaintTitle }}
                            </a>
                        </td>
                        <td>{{ Str::limit($action->actionDescription, 60) }}</td>
                        <td>{{ \Carbon\Carbon::parse($action->actionDate)->format('d M Y') }}</td>
                        <td>
                            <span class="status-badge status-pending-approval">
                                {{ $action->actionStatus }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:20px;">
                            No pending approvals found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <p style="margin-top: 16px; font-size: 0.75rem; color: #8aa0ae;">
                <i class="fas fa-info-circle"></i> Actions submitted to Manager for approval. Once approved, status will update automatically.
            </p>
        </div>
        @if($pendingActions->hasPages())
        <div class="pagination-wrapper">

            {{-- PREVIOUS --}}
            @if($pendingActions->onFirstPage())
                <span class="page-btn disabled">Previous</span>
            @else
                <a class="page-btn" href="{{ $pendingActions->previousPageUrl() }}">
                    Previous
                </a>
            @endif

            {{-- PAGE NUMBERS --}}
            @for($i = 1; $i <= $pendingActions->lastPage(); $i++)
                <a href="{{ $pendingActions->url($i) }}"
                class="page-btn {{ $pendingActions->currentPage() == $i ? 'active' : '' }}">
                    {{ $i }}
                </a>
            @endfor

            {{-- NEXT --}}
            @if($pendingActions->hasMorePages())
                <a class="page-btn" href="{{ $pendingActions->nextPageUrl() }}">
                    Next
                </a>
            @else
                <span class="page-btn disabled">Next</span>
            @endif

        </div>
        @endif
    </div>
</div>

<!-- ================================================================
     PROFESSIONAL COMPLAINT DETAILS MODAL
================================================================ -->
<div id="complaintModal" class="modal">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header-custom">
            <h3>
                <i class="fas fa-file-alt"></i> Complaint Details
            </h3>
            <button class="modal-close-btn" onclick="closeComplaintModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
            <!-- Complaint ID Badge -->
            <div class="complaint-id-badge">
                <i class="fas fa-hashtag"></i>
                <span id="m_id">-</span>
            </div>
            <!-- Detail Grid -->
            <div class="detail-grid">
                <div class="detail-item full-width">
                    <span class="label">Title</span>
                    <span class="value" id="m_title">-</span>
                </div>
                <div class="detail-item full-width">
                    <span class="label">Description</span>
                    <span class="value" id="m_desc">-</span>
                </div>
                <div class="detail-item">
                    <span class="label">Category</span>
                    <span class="value" id="m_cat">-</span>
                </div>
                <div class="detail-item">
                    <span class="label">Status</span>
                    <span class="value" id="m_status">-</span>
                </div>
                <div class="detail-item">
                    <span class="label">Date Submitted</span>
                    <span class="value" id="m_date">-</span>
                </div>
            </div>
            <hr class="modal-divider">

            <!-- Submitter Information -->
            <div class="submitter-section">
                <h4><i class="fas fa-user-circle"></i> Submitted By</h4>
                <div class="submitter-grid">
                    <div class="submitter-item">
                        <span class="label">Name</span>
                        <span class="value" id="m_name">-</span>
                    </div>
                    <div class="submitter-item">
                        <span class="label">Email</span>
                        <span class="value" id="m_email">-</span>
                    </div>
                    <div class="submitter-item">
                        <span class="label">Phone</span>
                        <span class="value" id="m_phone">-</span>
                    </div>
                    <div class="submitter-item">
                        <span class="label">Department</span>
                        <span class="value" id="m_dept">-</span>
                    </div>
                </div>
            </div>

            <!-- Evidence Section -->
            <div class="evidence-section">
                <span class="label"><i class="fas fa-paperclip"></i> Evidence</span>
                <div class="evidence-box" id="m_evidence">
                    <span class="no-evidence">
                        <i class="fas fa-file-image"></i>
                        No evidence uploaded
                    </span>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer-custom">
            <button class="btn-close-modal" onclick="closeComplaintModal()">
                <i class="fas fa-times"></i> Close
            </button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // ==================== MODAL FUNCTIONS ====================
    // Get only the items from the paginated collection
    const complaintData = @json($pendingActions->items());

    function openComplaintModal(actionID) {
        console.log('Opening modal for actionID:', actionID);
        console.log('Available actions:', complaintData);
        
        const action = complaintData.find(a => a.actionID == actionID);
        console.log('Found action:', action);
        
        if (!action) {
            console.error('Action not found for ID:', actionID);
            // Fallback: try to find by complaint ID instead
            // You might need to adjust this based on your data structure
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Complaint not found. Please refresh the page and try again.'
            });
            return;
        }

        const c = action.complaint;
        if (!c) {
            console.error('Complaint not found for action:', action);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Complaint data not available.'
            });
            return;
        }
        
        const e = c.employee;

        // Populate complaint details
        document.getElementById('m_id').innerText = 'C' + String(c.complaintID).padStart(3, '0');
        document.getElementById('m_title').innerText = c.complaintTitle || 'No title';
        document.getElementById('m_desc').innerText = c.complaintDescription || 'No description provided.';
        document.getElementById('m_cat').innerText = c.complaintCategory || 'N/A';

        // Status with badge
        const statusMap = {
            'Pending': '<span class="status-badge status-pending">Pending</span>',
            'In Progress': '<span class="status-badge status-in-progress">In Progress</span>',
            'Pending Approval': '<span class="status-badge status-pending-approval">Pending Approval</span>',
            'Resolved': '<span class="status-badge status-resolved">Resolved</span>',
            'Rejected': '<span class="status-badge status-rejected">Rejected</span>'
        };
        document.getElementById('m_status').innerHTML = statusMap[c.complaintStatus] || c.complaintStatus;
        document.getElementById('m_date').innerText = c.complaintDate || 'N/A';

        // Populate submitter details
        document.getElementById('m_name').innerText = e?.employeeName || 'N/A';
        document.getElementById('m_email').innerText = e?.employeeEmail || 'N/A';
        document.getElementById('m_phone').innerText = e?.employeePhone || 'N/A';
        document.getElementById('m_dept').innerText = e?.department?.departmentName ?? 'N/A';

        // Evidence handling
        const evidenceContainer = document.getElementById('m_evidence');
        let evidenceHTML = '';

        if (c.complaintEvidence) {
            const url = c.complaintEvidence;
            const ext = url.split('.').pop().toLowerCase();

            if (['jpg', 'jpeg', 'png', 'webp', 'gif'].includes(ext)) {
                evidenceHTML = `<img src="${url}" alt="Evidence">`;
            } else if (ext === 'pdf') {
                evidenceHTML = `<a href="${url}" target="_blank"><i class="fas fa-file-pdf"></i> View PDF</a>`;
            } else {
                evidenceHTML = `<a href="${url}" target="_blank"><i class="fas fa-file-download"></i> Download File</a>`;
            }
        } else {
            evidenceHTML = `
                <span class="no-evidence">
                    <i class="fas fa-file-image"></i>
                    No evidence uploaded
                </span>
            `;
        }

        evidenceContainer.innerHTML = evidenceHTML;

        // Show modal
        const modal = document.getElementById('complaintModal');
        if (modal) {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        } else {
            console.error('Modal element not found');
        }
    }

    function closeComplaintModal() {
        const modal = document.getElementById('complaintModal');
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = '';
        }
    }

    // Close modal on backdrop click
    window.onclick = function(event) {
        const modal = document.getElementById('complaintModal');
        if (event.target === modal) {
            closeComplaintModal();
        }
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeComplaintModal();
        }
    });

    // ==================== NAVIGATION ====================
    const sections = {
        dashboard: 'dashboardSection',
        complaints: 'complaintsSection',
        pendingApproval: 'pendingApprovalSection',
        reviseActions: 'reviseActionsSection'
    };

    function showSection(sectionId) {
        Object.keys(sections).forEach(key => {
            const el = document.getElementById(sections[key]);
            if (el) el.style.display = 'none';
        });
        const active = document.getElementById(sectionId);
        if (active) active.style.display = 'block';
        document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
        document.querySelector(`[data-page="${Object.keys(sections).find(k => sections[k] === sectionId)}"]`)?.classList.add('active');
    }

    document.querySelectorAll('.nav-link[data-page]').forEach(link => {
        link.addEventListener('click', () => {
            const page = link.getAttribute('data-page');
            if (sections[page]) showSection(sections[page]);
        });
    });

    showSection('pendingApprovalSection');

    // Debug: Log the data on page load
    console.log('Complaint data loaded:', complaintData);
</script>

@endsection