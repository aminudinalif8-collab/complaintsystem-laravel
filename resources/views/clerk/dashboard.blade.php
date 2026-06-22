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

    .header-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    /* Buttons */
    .btn-primary {
        background: var(--primary);
        border: none;
        padding: 10px 20px;
        border-radius: 40px;
        color: white;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: inherit;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-secondary {
        background: #3a7b66;
        border: none;
        padding: 10px 20px;
        border-radius: 40px;
        color: white;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: inherit;
    }

    .btn-secondary:hover {
        background: #2d6654;
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    /* Cards Grid */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: white;
        border-radius: var(--radius-sm);
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
        font-size: 2.4rem;
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

    .action-icons i {
        font-size: 1rem;
        cursor: pointer;
        color: var(--gray-400);
        transition: all 0.2s;
    }

    .action-icons i:hover {
        color: var(--primary);
    }

    .action-icons .fa-trash-alt:hover {
        color: var(--red);
    }

    /* Chart Card */
    .chart-card {
        background: white;
        border-radius: var(--radius-sm);
        padding: 24px;
        border: 1px solid var(--gray-200);
        box-shadow: var(--shadow-sm);
        flex: 1;
        min-width: 300px;
    }

    .chart-container {
        position: relative;
        height: 280px;
        margin-top: 10px;
    }

    canvas {
        max-height: 280px;
        width: 100%;
    }

    .two-columns {
        display: flex;
        gap: 28px;
        flex-wrap: wrap;
        margin-bottom: 32px;
    }

    .no-data {
        text-align: center;
        padding: 40px;
        color: var(--gray-400);
    }

    .no-data i {
        font-size: 2rem;
        display: block;
        margin-bottom: 8px;
        opacity: 0.5;
    }

    /* Modal Styles */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .modal-box {
        background: white;
        padding: 28px;
        width: 460px;
        max-width: 90%;
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-lg);
        font-family: inherit;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-header {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: var(--gray-800);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .modal-box input,
    .modal-box select {
        width: 100%;
        padding: 12px 14px;
        margin-bottom: 14px;
        border: 1.5px solid var(--gray-200);
        border-radius: var(--radius-md);
        font-size: 0.85rem;
        transition: all 0.2s;
    }

    .modal-box input:focus,
    .modal-box select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(44,110,92,0.1);
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 20px;
    }

    .btn-cancel {
        background: var(--gray-100);
        border: 1.5px solid var(--gray-200);
        padding: 10px 20px;
        border-radius: 40px;
        cursor: pointer;
        font-weight: 500;
        color: var(--gray-600);
        transition: all 0.2s;
        font-family: inherit;
    }

    .btn-cancel:hover {
        background: var(--gray-200);
    }

    .btn-save {
        background: var(--primary);
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 40px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.2s;
        font-family: inherit;
    }

    .btn-save:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
    }

    .error-text {
        color: var(--red);
        font-size: 0.8rem;
        margin-bottom: 12px;
        padding: 8px 12px;
        background: var(--red-soft);
        border-radius: var(--radius-md);
    }

    .error-text ul {
        margin: 0;
        padding-left: 20px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .main-content {
            padding: 20px;
        }
        .cards-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        .stat-card {
            padding: 16px;
        }
        .stat-number {
            font-size: 1.8rem;
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
        .header-actions {
            flex-direction: column;
            align-items: stretch;
        }
        .header-actions .btn-primary,
        .header-actions .btn-secondary {
            justify-content: center;
        }
        .profile-card .profile-info .meta-info .email {
            display: none;
        }
        .chart-container {
            height: 220px;
        }
    }

    @media (max-width: 480px) {
        .cards-grid {
            grid-template-columns: 1fr;
        }
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

<!-- MAIN CONTENT -->
<div class="main-content">
    <!-- Header Row -->
    <div class="header-row">
        <div class="title-section">
            <h1><i class="fas fa-tachometer-alt" style="color: var(--primary);"></i> Clerk Dashboard</h1>
            <p>Manage complaints, employees, and departments efficiently</p>
        </div>

        <div class="header-actions">
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

            <button class="btn-primary" id="btnAddEmployee">
                <i class="fas fa-user-plus"></i> Add Employee
            </button>

            <button class="btn-secondary" id="btnAddDepartment">
                <i class="fas fa-building"></i> Add Department
            </button>
        </div>
    </div>

    <!-- Dashboard Section -->
    <div id="dashboardSection">
        <!-- Summary Cards -->
        <div class="cards-grid">
            <div class="stat-card">
                <h3><i class="fas fa-folder-open"></i> Total Complaints</h3>
                <div class="stat-number">{{ $total ?? 0 }}</div>
            </div>
            <div class="stat-card">
                <h3><i class="fas fa-clock"></i> Pending</h3>
                <div class="stat-number">{{ $pending ?? 0 }}</div>
            </div>
            <div class="stat-card">
                <h3><i class="fas fa-sync-alt"></i> In Progress</h3>
                <div class="stat-number">{{ $inProgress ?? 0 }}</div>
            </div>
            <div class="stat-card">
                <h3><i class="fas fa-check-circle"></i> Resolved</h3>
                <div class="stat-number">{{ $resolved ?? 0 }}</div>
            </div>
        </div>

        <!-- Complaints Table -->
        <div class="table-wrapper">
            <div class="section-title">
                <i class="fas fa-list-ul" style="color: var(--primary);"></i> Recent Complaints
            </div>

            <!-- Tabs -->
            <div class="tabs-container">
                <ul class="tabs">
                    <li><button class="tab-btn active" data-status="all">All Complaints</button></li>
                    <li><button class="tab-btn" data-status="Pending">Pending</button></li>
                    <li><button class="tab-btn" data-status="In Progress">In Progress</button></li>
                    <li><button class="tab-btn" data-status="Resolved">Resolved</button></li>
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
                            data-id="C{{ str_pad($complaint->complaintID, 3, '0', STR_PAD_LEFT) }}"
                            data-title="{{ strtolower($complaint->complaintTitle) }}"
                            data-category="{{ strtolower($complaint->complaintCategory ?? 'N/A') }}">
                            <td>C{{ str_pad($complaint->complaintID, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $complaint->complaintTitle }}</td>
                            <td>{{ $complaint->complaintCategory ?? 'N/A' }}</td>
                            <td>{{ $complaint->created_at?->format('d M Y') ?? 'N/A' }}</td>
                            <td>
                                @php
                                    $status = $complaint->complaintStatus;
                                    $class = match($status) {
                                        'Pending' => 'status-pending',
                                        'In Progress' => 'status-in-progress',
                                        'Resolved' => 'status-resolved',
                                        default => 'status-pending'
                                    };
                                @endphp
                                <span class="status-badge {{ $class }}">{{ $status }}</span>
                            </td>
                            <td class="action-icons">
                                <a href="{{ route('clerk.complaintDetails', ['id' => $complaint->complaintID]) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($complaint->complaintStatus == 'Pending')
                                <a href="{{ route('clerk.editComplaint', ['id' => $complaint->complaintID]) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <div class="no-data">
                                    <i class="fas fa-inbox"></i>
                                    No complaints found
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="two-columns">
            <div class="chart-card" style="flex: 1;">
                <div class="section-title">
                    <i class="fas fa-chart-pie" style="color: var(--primary);"></i> Complaints by Status
                </div>
                <div class="chart-container">
                    <canvas id="complaintChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Employee Modal -->
<div class="modal-overlay" id="employeeModal">
    <div class="modal-box">
        <div class="modal-header">
            <i class="fas fa-user-plus" style="color: var(--primary);"></i> Add New Employee
        </div>

        @if ($errors->any())
        <div class="error-text">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('clerk.register.employee.post') }}">
            @csrf
            <input type="text" name="employeeName" placeholder="Employee Name" required>
            <input type="email" name="employeeEmail" placeholder="Email Address" required>
            <input type="text" name="employeePhone" placeholder="Phone Number" required>

            <select name="role" id="roleSelect" required>
                <option value="">Select Role</option>
                <option value="manager">Manager</option>
                <option value="supervisor">Supervisor</option>
                <option value="employee">Employee</option>
            </select>

            <select name="departmentID" id="departmentSelect" required>
                <option value="">Select Department</option>
                @foreach($departments ?? [] as $dept)
                    <option value="{{ $dept->departmentID }}">{{ $dept->departmentName }}</option>
                @endforeach
            </select>

            <select name="supervisorID" id="supervisorSelect">
                <option value="">Select Supervisor</option>
            </select>

            <input type="password" name="employeePassword" placeholder="Password" required>
            <input type="password" name="employeePassword_confirmation" placeholder="Confirm Password" required>

            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal('employeeModal')">Cancel</button>
                <button type="submit" class="btn-save"><i class="fas fa-save"></i> Save Employee</button>
            </div>
        </form>
    </div>
</div>

<!-- Add Department Modal -->
<div class="modal-overlay" id="departmentModal">
    <div class="modal-box">
        <div class="modal-header">
            <i class="fas fa-building" style="color: var(--primary);"></i> Add New Department
        </div>

        <form method="POST" action="{{ route('clerk.store.department') }}">
            @csrf
            <input type="text" name="departmentName" placeholder="Department Name" required>

            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal('departmentModal')">Cancel</button>
                <button type="submit" class="btn-save"><i class="fas fa-save"></i> Save Department</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // ==================== SUCCESS/ERROR ALERTS ====================

    @if(session('login_success'))
    Swal.fire({
        icon: 'success',
        title: 'Login Successful',
        text: '{{ session('login_success') }}',
        confirmButtonColor: '#2C6E5C',
        timer: 2000,
        showConfirmButton: false
    });
    @endif

    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#2C6E5C',
        timer: 2000,
        showConfirmButton: false
    });
    @endif

    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '{{ session('error') }}',
        confirmButtonColor: '#DC2626'
    });
    @endif

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
        dashboard: document.getElementById("dashboardSection"),
        mycomplaints: document.getElementById("mycomplaintsSection"),
        submit: document.getElementById("submitSection")
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
        link.addEventListener("click", () => {
            const page = link.getAttribute("data-page");
            if (page) showSection(page);
        });
    });

    // ==================== MODAL HANDLING ====================
    const btnAddEmployee = document.getElementById("btnAddEmployee");
    const btnAddDepartment = document.getElementById("btnAddDepartment");
    const employeeModal = document.getElementById("employeeModal");
    const departmentModal = document.getElementById("departmentModal");

    if (btnAddEmployee && employeeModal) {
        btnAddEmployee.addEventListener("click", () => {
            employeeModal.style.display = "flex";
            const dept = document.getElementById("departmentSelect");
            if (dept) dept.dispatchEvent(new Event("change"));
        });
    }

    if (btnAddDepartment && departmentModal) {
        btnAddDepartment.addEventListener("click", () => {
            departmentModal.style.display = "flex";
        });
    }

    function closeModal(id) {
        const el = document.getElementById(id);
        if (el) el.style.display = "none";
    }

    document.querySelectorAll(".modal-overlay").forEach(modal => {
        modal.addEventListener("click", (e) => {
            if (e.target === modal) {
                modal.style.display = "none";
            }
        });
    });

    // ==================== ROLE → SUPERVISOR TOGGLE ====================
    const roleSelect = document.getElementById("roleSelect");
    const supervisorSelect = document.getElementById("supervisorSelect");

    function toggleSupervisor() {
        if (!roleSelect || !supervisorSelect) return;
        const role = roleSelect.value;
        if (role === "supervisor" || role === "manager") {
            supervisorSelect.disabled = true;
            supervisorSelect.value = "";
        } else {
            supervisorSelect.disabled = false;
        }
    }

    if (roleSelect) {
        roleSelect.addEventListener("change", toggleSupervisor);
        toggleSupervisor();
    }

    // ==================== AJAX LOAD SUPERVISORS ====================
    const departmentSelect = document.getElementById("departmentSelect");

    if (departmentSelect && supervisorSelect) {
        departmentSelect.addEventListener("change", function() {
            const deptID = this.value;
            supervisorSelect.innerHTML = '<option value="">Loading...</option>';

            if (!deptID) {
                supervisorSelect.innerHTML = '<option value="">Select Supervisor</option>';
                return;
            }

            fetch(`/get-supervisors/${deptID}`)
                .then(res => res.json())
                .then(data => {
                    supervisorSelect.innerHTML = '<option value="">Select Supervisor</option>';
                    if (!data.length) {
                        supervisorSelect.innerHTML += '<option value="">No Supervisor Available</option>';
                        return;
                    }
                    data.forEach(sup => {
                        const option = document.createElement("option");
                        option.value = sup.employeeID;
                        option.textContent = `${sup.employeeName} (${sup.department.departmentName})`;
                        supervisorSelect.appendChild(option);
                    });
                })
                .catch(err => {
                    console.error(err);
                    supervisorSelect.innerHTML = '<option value="">Error loading data</option>';
                });
        });
    }

    // ==================== CHART.JS - COMPLAINT STATUS ====================
    const chartCanvas = document.getElementById('complaintChart');

    if (chartCanvas) {
        const centerTextPlugin = {
            id: 'centerText',
            beforeDraw(chart) {
                const { ctx, chartArea } = chart;
                const centerX = (chartArea.left + chartArea.right) / 2;
                const centerY = (chartArea.top + chartArea.bottom) / 2;
                ctx.save();
                ctx.font = 'bold 32px Arial';
                ctx.fillStyle = '#1A3A3F';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText('{{ $total ?? 0 }}', centerX, centerY - 8);
                ctx.font = '12px Arial';
                ctx.fillStyle = '#94A3B8';
                ctx.fillText('Total Complaints', centerX, centerY + 20);
                ctx.restore();
            }
        };

        new Chart(chartCanvas, {
            type: 'doughnut',
            plugins: [centerTextPlugin],
            data: {
                labels: ['Pending', 'In Progress', 'Resolved', 'Rejected'],
                datasets: [{
                    data: [
                        {{ $pending ?? 0 }},
                        {{ $inProgress ?? 0 }},
                        {{ $resolved ?? 0 }},
                        {{ $rejected ?? 0 }}
                    ],
                    backgroundColor: ['#D97706', '#2563EB', '#059669', '#DC2626'],
                    borderWidth: 0,
                    hoverOffset: 15,
                    cutout: '70%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 16,
                            font: { size: 12 },
                            color: '#64748B'
                        }
                    }
                }
            }
        });
    }

    // ==================== INITIAL LOAD ====================
    document.addEventListener("DOMContentLoaded", function() {
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

    // ==================== DEFAULT PAGE ====================
    showSection("dashboard");
</script>

@endsection