@extends('clerk.sidebar')

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

    /* Header Row */
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
        background: white;
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 8px 24px 8px 18px;
        border-radius: 60px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
        transition: all 0.2s;
        text-decoration: none;
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

    /* Table Wrapper */
    .table-wrapper {
        background: white;
        border-radius: var(--radius-sm);
        padding: 24px;
        border: 1px solid var(--gray-200);
        margin-bottom: 32px;
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

    /* pagination */
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
        background: var(--gray-100);
        cursor: not-allowed;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .main-content {
            padding: 20px;
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
        .profile-card .profile-info .meta-info .email {
            display: none;
        }
    }

    @media (max-width: 480px) {
        .profile-card .profile-info .meta-info .dept {
            display: none;
        }
        .profile-card {
            padding: 6px 12px 6px 10px;
        }
        .avatar {
            width: 36px;
            height: 36px;
            font-size: 0.8rem;
        }
        .profile-info h4 {
            font-size: 0.8rem;
        }
    }
</style>

<div class="main-content">
    <!-- Header Row -->
    <div class="header-row">
        <div class="title-section">
            <h1><i class="fas fa-ticket-alt" style="color: var(--primary);"></i> My Complaints</h1>
            <p>Manage and track all your submitted complaints</p>
        </div>

        <a href="{{ route('clerk.profileClerk') }}" class="profile-card">
            <div class="avatar">
                @if($employee->employeePicture)
                    <img src="{{ asset('uploads/' . $employee->employeePicture) }}" alt="Profile Picture">
                @else
                    {{ strtoupper(substr($employee->employeeName, 0, 2)) }}
                @endif
            </div>
            <div class="profile-info">
                <h4>{{ $employee->employeeName }}</h4>
                <div class="meta-info">
                    <span class="dept">{{ $employee->department->departmentName ?? 'N/A' }}</span>
                    <span class="dot">•</span>
                    <span class="email">{{ $employee->employeeEmail }}</span>
                </div>
            </div>
        </a>
    </div>

    <!-- My Complaints Section -->
    <div id="mycomplaintsSection">
        <div class="table-wrapper">
            <div class="section-title">
                <i class="fas fa-folder-open" style="color: var(--primary);"></i> List of My Complaints
            </div>

            <!-- Tabs -->
            <div class="tabs-container">
                <ul class="tabs">
                    <li><button class="tab-btn active" data-status="all">All Complaints</button></li>
                    <li><button class="tab-btn" data-status="Pending">Pending</button></li>
                    <li><button class="tab-btn" data-status="In Progress">In Progress</button></li>
                    <li><button class="tab-btn" data-status="Resolved">Resolved</button></li>
                    <li><button class="tab-btn" data-status="Cancelled">Cancelled</button></li>
                </ul>
            </div>

            <!-- Search Bar -->
            <div class="search-bar">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Search by ID, title, or category...">
                </div>
                <div class="result-count" id="resultCount">Showing all complaints</div>
            </div>

            <!-- Complaints Table -->
            <div style="overflow-x: auto;">
                <table class="complaint-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($complaints as $complaint)
                        <tr data-status="{{ $complaint->complaintStatus }}"
                            data-id="{{ $complaint->complaintID }}"
                            data-title="{{ strtolower($complaint->complaintTitle) }}"
                            data-category="{{ strtolower($complaint->complaintCategory ?? 'N/A') }}">
                            <td>C{{ str_pad($complaint->complaintID, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $complaint->complaintTitle }}</td>
                            <td>{{ $complaint->complaintCategory ?? 'N/A' }}</td>
                            <td>{{ $complaint->created_at->format('d M Y') }}</td>
                            <td>
                                @php
                                    $status = $complaint->complaintStatus;
                                    $class = match($status) {
                                        'Pending' => 'status-pending',
                                        'In Progress' => 'status-in-progress',
                                        'Resolved' => 'status-resolved',
                                        'Rejected' => 'status-rejected',
                                        'Cancelled' => 'status-cancelled',
                                        default => 'status-pending'
                                    };
                                @endphp
                                <span class="status-badge {{ $class }}">{{ $status }}</span>
                            </td>
                            <td class="action-icons">
                                <a href="{{ route('clerk.complaintDetails', ['id' => $complaint->complaintID]) }}" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($complaint->complaintStatus == 'Pending')
                                <a href="{{ route('clerk.editComplaint', ['id' => $complaint->complaintID]) }}" title="Edit Complaint">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <p>No complaints found</p>
                                    <!-- <a href="{{ route('clerk.submitComplaintClerk') }}" class="btn-primary" style="display: inline-block; margin-top: 16px; text-decoration: none; background: var(--primary); color: white; padding: 10px 24px; border-radius: 40px; font-weight: 600;">
                                        <i class="fas fa-plus-circle"></i> Submit Your First Complaint
                                    </a> -->
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($complaints->hasPages())
            <div class="pagination-wrapper">

                @if($complaints->onFirstPage())
                    <span class="page-btn disabled">Previous</span>
                @else
                    <a class="page-btn" href="{{ $complaints->previousPageUrl() }}">
                        Previous
                    </a>
                @endif

                @for($i = 1; $i <= $complaints->lastPage(); $i++)
                    <a href="{{ $complaints->url($i) }}"
                    class="page-btn {{ $complaints->currentPage() == $i ? 'active' : '' }}">
                        {{ $i }}
                    </a>
                @endfor

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
    let currentFilterStatus = 'all';
    let currentSearchTerm = '';

    // ==================== TAB FILTERING ====================
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tableRows = document.querySelectorAll('#tableBody tr');
    const searchInput = document.getElementById('searchInput');
    const resultCount = document.getElementById('resultCount');

    function filterTable() {
        const searchTerm = currentSearchTerm.toLowerCase();
        let visibleCount = 0;

        tableRows.forEach(row => {
            const rowStatus = row.getAttribute('data-status') || '';
            const rowId = row.getAttribute('data-id') || '';
            const rowTitle = row.getAttribute('data-title') || '';
            const rowCategory = row.getAttribute('data-category') || '';

            const matchesStatus = currentFilterStatus === 'all' || rowStatus === currentFilterStatus;
            const matchesSearch = searchTerm === '' ||
                rowId.toLowerCase().includes(searchTerm) ||
                rowTitle.toLowerCase().includes(searchTerm) ||
                rowCategory.toLowerCase().includes(searchTerm);

            if (matchesStatus && matchesSearch) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        if (visibleCount === 0) {
            resultCount.innerHTML = 'No complaints found';
        } else {
            resultCount.innerHTML = `Showing ${visibleCount} complaint${visibleCount !== 1 ? 's' : ''}`;
        }
    }

    // Tab click handlers
    tabButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            tabButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentFilterStatus = btn.getAttribute('data-status');
            filterTable();
        });
    });

    // Search input handler
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            currentSearchTerm = e.target.value;
            filterTable();
        });
    }

    // ==================== SECTION SWITCHING ====================
    const sections = {
        mycomplaints: document.getElementById("mycomplaintsSection")
    };
    const navLinks = document.querySelectorAll(".nav-link[data-page]");

    function showSection(sectionId) {
        Object.keys(sections).forEach(key => {
            if (sections[key]) sections[key].style.display = "none";
        });
        if (sections[sectionId]) sections[sectionId].style.display = "block";
        navLinks.forEach(link => link.classList.remove("active"));
        const activeLink = document.querySelector(`.nav-link[data-page="${sectionId}"]`);
        if (activeLink) activeLink.classList.add("active");
    }

    navLinks.forEach(link => {
        link.addEventListener("click", (e) => {
            const page = link.getAttribute("data-page");
            if (page) showSection(page);
        });
    });

    // ==================== SUCCESS/ERROR ALERTS ====================
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

    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '{{ session('error') }}',
        confirmButtonColor: '#e4685b'
    });
    @endif

    // ==================== INITIAL LOAD ====================
    document.addEventListener("DOMContentLoaded", function() {
        showSection("mycomplaints");
        // Initialize table rows with data attributes
        tableRows.forEach(row => {
            const cells = row.cells;
            if (cells[0]) {
                row.setAttribute('data-id', cells[0]?.innerText?.toLowerCase() || '');
                row.setAttribute('data-title', cells[1]?.innerText?.toLowerCase() || '');
                row.setAttribute('data-category', cells[2]?.innerText?.toLowerCase() || '');
            }
        });
        filterTable();
    });
</script>

@endsection