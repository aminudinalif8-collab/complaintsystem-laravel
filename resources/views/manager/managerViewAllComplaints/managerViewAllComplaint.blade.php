@extends('manager.sidebar')

@section('content')

@php
    // Get current filter parameters from URL
    $currentStatus = request()->get('status', 'all');
    $currentSearch = request()->get('search', '');
@endphp

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

    .app-wrapper {
        display: flex;
        min-height: 100vh;
    }

    /* Sidebar */
    .sidebar {
        width: 280px;
        background: linear-gradient(180deg, var(--primary-dark) 0%, #0f2c38 100%);
        color: white;
        flex-shrink: 0;
        position: sticky;
        top: 0;
        height: 100vh;
        overflow-y: auto;
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        transition: width 0.3s ease;
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
        background: var(--primary);
        color: white;
        box-shadow: 0 4px 10px rgba(44, 122, 94, 0.3);
    }

    .logout-link {
        margin-top: 40px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 20px;
    }

    /* Main content */
    .main-content {
        flex: 1;
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

    .manager-card {
        background: white;
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 8px 24px 8px 18px;
        border-radius: 60px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
        transition: all 0.2s;
    }

    .manager-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .manager-avatar {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #c47b2e, #a05f20);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: white;
        border-radius: var(--radius-xl);
        padding: 22px 20px;
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
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        color: var(--gray-500);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .stat-number {
        font-size: 2.2rem;
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

    /* Search & Filter Bar */
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

    .action-icons i.fa-check-circle {
        color: var(--green);
    }

    .action-icons i.fa-times-circle {
        color: var(--red);
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

    .btn-danger {
        background: var(--red);
        border: none;
        padding: 8px 20px;
        border-radius: 30px;
        color: white;
        font-size: 0.75rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-danger:hover {
        background: #B91C1C;
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

    .modal-content textarea {
        width: 100%;
        padding: 12px 14px;
        border-radius: var(--radius-md);
        border: 1.5px solid var(--gray-200);
        font-size: 0.85rem;
        margin: 16px 0;
        font-family: inherit;
        resize: vertical;
        min-height: 100px;
    }

    .modal-content textarea:focus {
        outline: none;
        border-color: var(--primary);
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

    /* Report Preview */
    .report-preview {
        margin-top: 20px;
        background: var(--gray-50);
        border-radius: var(--radius-lg);
        padding: 20px;
        border: 1px solid var(--gray-200);
    }

    .report-buttons {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .btn-report {
        background: var(--gray-200);
        border: none;
        padding: 10px 20px;
        border-radius: 40px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s;
    }

    .btn-report:hover {
        background: var(--primary);
        color: white;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--gray-400);
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 16px;
        opacity: 0.5;
    }

    /* ===== HEADER ROW ===== */
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

    .title-section h1 i {
        color: var(--primary);
        margin-right: 6px;
    }

    .title-section p {
        font-size: 0.875rem;
        color: var(--gray-500);
        margin-top: 4px;
    }

    /* ===== PROFILE CARD ===== */
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
        color: var(--gray-800);
    }

    .profile-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        border-color: var(--gray-300);
    }

    .profile-card .avatar {
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

    .profile-card .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-card .profile-info h4 {
        margin: 0;
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--gray-800);
    }

    .profile-card .profile-info .meta-info {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.7rem;
        color: var(--gray-500);
        flex-wrap: wrap;
    }

    .profile-card .profile-info .meta-info .dot {
        font-size: 10px;
        color: var(--gray-400);
    }

    /* Pagination */
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

<div class="main-content">
    <!-- Header Row -->
    <div class="header-row">
        <div class="title-section">
            <h1><i class="fas fa-chart-line"></i> Manager Dashboard</h1>
            <p>Oversee complaints, approve actions, manage team, and generate reports</p>
        </div>
        <a href="{{ route('manager.profile') }}" class="profile-card">
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

    <!-- Complaints Section -->
    <div id="complaintsSection">
        <div class="table-wrapper">
            <div class="section-title">
                <i class="fas fa-list-ul" style="color: var(--primary);"></i> All Complaints
            </div>

            <!-- Tabs -->
            <div class="tabs-container">
                <ul class="tabs">
                    <li><button class="tab-btn {{ $currentStatus == 'all' ? 'active' : '' }}" data-status="all">All Complaints</button></li>
                    <li><button class="tab-btn {{ $currentStatus == 'Pending' ? 'active' : '' }}" data-status="Pending">Pending</button></li>
                    <li><button class="tab-btn {{ $currentStatus == 'In Progress' ? 'active' : '' }}" data-status="In Progress">In Progress</button></li>
                    <li><button class="tab-btn {{ $currentStatus == 'Resolved' ? 'active' : '' }}" data-status="Resolved">Resolved</button></li>
                    <li><button class="tab-btn {{ $currentStatus == 'Cancelled' ? 'active' : '' }}" data-status="Cancelled">Cancelled</button></li>
                </ul>
            </div>

            <!-- Search Bar -->
            <div class="search-bar">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="complaintSearch" placeholder="Search by ID, title, employee, or category..." value="{{ $currentSearch }}">
                </div>
                <div class="result-count" id="resultCount">Showing {{ $complaints->total() }} complaint{{ $complaints->total() != 1 ? 's' : '' }}</div>
            </div>

            <!-- Complaints Table -->
            <div style="overflow-x: auto;">
                <table class="complaint-table" id="complaintTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employee</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="complaintTableBody">
                        @forelse($complaints as $complaint)
                        <tr data-status="{{ $complaint->complaintStatus }}" 
                            data-id="C{{ str_pad($complaint->complaintID, 3, '0', STR_PAD_LEFT) }}"
                            data-title="{{ strtolower($complaint->complaintTitle) }}"
                            data-employee="{{ strtolower($complaint->employee->employeeName ?? 'N/A') }}"
                            data-category="{{ strtolower($complaint->complaintCategory) }}">
                            <td>C{{ str_pad($complaint->complaintID, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $complaint->employee->employeeName ?? 'N/A' }}</td>
                            <td>{{ $complaint->complaintTitle }}</td>
                            <td>{{ $complaint->complaintCategory }}</td>
                            <td>{{ $complaint->created_at->format('Y-m-d') }}</td>
                            <td>
                                @php
                                    $status = $complaint->complaintStatus;
                                    $class = match($status) {
                                        'Pending' => 'status-pending',
                                        'In Progress' => 'status-in-progress',
                                        'Pending Approval' => 'status-pending-approval',
                                        'Resolved' => 'status-resolved',
                                        'Cancelled' => 'status-cancelled',
                                        default => 'status-pending'
                                    };
                                @endphp
                                <span class="status-badge {{ $class }}">
                                    {{ $status }}
                                </span>
                            </td>
                            <td class="action-icons">
                                <a href="{{ route('manager.complaintDetails', ['id' => $complaint->complaintID]) }}" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('manager.editComplaint', ['id' => $complaint->complaintID]) }}" title="Edit Complaint">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($complaint->complaintStatus === 'Pending Approval')
                                    <i class="fas fa-check-circle" onclick="approveAction('{{ $complaint->complaintID }}')" title="Approve Action" style="color: var(--green); cursor: pointer;"></i>
                                    <i class="fas fa-times-circle" onclick="rejectAction('{{ $complaint->complaintID }}')" title="Reject Action" style="color: var(--red); cursor: pointer;"></i>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr class="empty-row">
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <p>No complaints found</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($complaints->hasPages())
            <div class="pagination-wrapper">
                {{-- Previous --}}
                @if($complaints->onFirstPage())
                    <span class="page-btn disabled">Previous</span>
                @else
                    <a class="page-btn" href="{{ $complaints->previousPageUrl() }}">
                        Previous
                    </a>
                @endif

                {{-- Page Numbers --}}
                @for($i = 1; $i <= $complaints->lastPage(); $i++)
                    <a href="{{ $complaints->url($i) }}"
                    class="page-btn {{ $complaints->currentPage() == $i ? 'active' : '' }}">
                        {{ $i }}
                    </a>
                @endfor

                {{-- Next --}}
                @if($complaints->hasMorePages())
                    <a class="page-btn" href="{{ $complaints->nextPageUrl() }}">
                        Next
                    </a>
                @else
                    <span class="page-btn disabled">Next</span>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // ==================== GLOBAL VARIABLES ====================
    let currentComplaintId = '';
    let currentFilterStatus = '{{ $currentStatus }}';
    let currentSearchTerm = '{{ $currentSearch }}';
    let searchTimeout;

    // ==================== NAVIGATION ====================
    const sections = {
        dashboard: 'dashboardSection',
        complaints: 'complaintsSection',
        approvals: 'approvalsSection',
        users: 'usersSection',
        reports: 'reportsSection'
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

    // ==================== URL PARAMETER HELPERS ====================
    function getUrlParams() {
        const url = new URL(window.location.href);
        return {
            status: url.searchParams.get('status') || 'all',
            search: url.searchParams.get('search') || ''
        };
    }

    function navigateWithFilters(pageUrl) {
        const url = new URL(pageUrl, window.location.origin);
        if (currentFilterStatus && currentFilterStatus !== 'all') {
            url.searchParams.set('status', currentFilterStatus);
        } else {
            url.searchParams.delete('status');
        }
        if (currentSearchTerm && currentSearchTerm.trim() !== '') {
            url.searchParams.set('search', currentSearchTerm.trim());
        } else {
            url.searchParams.delete('search');
        }
        window.location.href = url.toString();
    }

    // ==================== TAB FILTERING ====================
    const tabButtons = document.querySelectorAll('#complaintsSection .tab-btn');
    const searchInput = document.getElementById('complaintSearch');
    const resultCount = document.getElementById('resultCount');

    function getTableRows() {
        return document.querySelectorAll('#complaintTableBody tr:not(.empty-row)');
    }

    function filterTable() {
        const searchTerm = currentSearchTerm.toLowerCase().trim();
        const rows = getTableRows();
        let visibleCount = 0;

        rows.forEach(row => {
            const rowStatus = row.getAttribute('data-status') || '';
            const rowId = row.getAttribute('data-id') || '';
            const rowTitle = row.getAttribute('data-title') || '';
            const rowEmployee = row.getAttribute('data-employee') || '';
            const rowCategory = row.getAttribute('data-category') || '';

            const matchesStatus = currentFilterStatus === 'all' || rowStatus === currentFilterStatus;
            
            const matchesSearch = searchTerm === '' || 
                rowId.includes(searchTerm) ||
                rowTitle.includes(searchTerm) ||
                rowEmployee.includes(searchTerm) ||
                rowCategory.includes(searchTerm);

            if (matchesStatus && matchesSearch) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Handle empty row
        const emptyRow = document.querySelector('#complaintTableBody .empty-row');
        if (emptyRow) {
            emptyRow.style.display = visibleCount === 0 ? '' : 'none';
        }

        // Update result count
        resultCount.innerHTML = visibleCount === 0 ? 'No complaints found' : `Showing ${visibleCount} complaint${visibleCount !== 1 ? 's' : ''}`;
    }

    // Tab click handlers - navigate with filters
    tabButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const status = btn.getAttribute('data-status');
            tabButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentFilterStatus = status;
            // Navigate to page 1 with new filter
            const url = new URL(window.location.href);
            url.searchParams.delete('page');
            navigateWithFilters(url.toString());
        });
    });

    // Search input handler with debounce
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                currentSearchTerm = e.target.value;
                const url = new URL(window.location.href);
                url.searchParams.delete('page');
                navigateWithFilters(url.toString());
            }, 500);
        });
    }

    // ==================== PAGINATION HANDLING ====================
    // Override pagination links to preserve filters
    document.querySelectorAll('.page-btn:not(.disabled)').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            if (href) {
                navigateWithFilters(href);
            }
        });
    });

    // ==================== INITIAL LOAD ====================
    document.addEventListener("DOMContentLoaded", function() {
        showSection("complaintsSection");
        
        // Get filter state from URL
        const params = getUrlParams();
        currentFilterStatus = params.status;
        currentSearchTerm = params.search;
        
        // Update search input if there's a search term
        if (searchInput && currentSearchTerm) {
            searchInput.value = currentSearchTerm;
        }
        
        // Ensure all rows have proper data attributes
        const rows = document.querySelectorAll('#complaintTableBody tr:not(.empty-row)');
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length >= 5) {
                if (!row.getAttribute('data-id')) {
                    row.setAttribute('data-id', cells[0]?.textContent?.trim()?.toLowerCase() || '');
                }
                if (!row.getAttribute('data-employee')) {
                    row.setAttribute('data-employee', cells[1]?.textContent?.trim()?.toLowerCase() || '');
                }
                if (!row.getAttribute('data-title')) {
                    row.setAttribute('data-title', cells[2]?.textContent?.trim()?.toLowerCase() || '');
                }
                if (!row.getAttribute('data-category')) {
                    row.setAttribute('data-category', cells[3]?.textContent?.trim()?.toLowerCase() || '');
                }
            }
        });
        
        // Apply initial client-side filter
        filterTable();
    });

    // ==================== SUCCESS ALERT ====================
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#2c7a5e',
        timer: 2000,
        showConfirmButton: false
    });
    @endif
</script>

@endsection