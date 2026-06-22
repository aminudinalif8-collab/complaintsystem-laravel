@extends('employee.sidebar')

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
    }

    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .profile-card {
        color: var(--gray-800);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 16px;
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

    .profile-info h4 {
        font-size: 0.95rem;
        font-weight: 600;
        margin: 0 0 2px 0;
    }

    .profile-info .meta-info {
        font-size: 0.7rem;
        color: var(--gray-500);
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
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
    }

    .btn-save:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
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
        margin: 0 6px;
        font-size: 1rem;
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

    /* Complaints Table Wrapper */
    .complaints-table-wrapper {
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

    /* Filter Bar */
    .filter-bar {
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
    .status-resolved { background: var(--green-soft); color: var(--green); }
    .status-rejected { background: var(--red-soft); color: var(--red); }
    .status-cancelled { background: var(--gray-100); color: var(--gray-500); }

    /* Chart Card */
    .chart-card {
        background: white;
        border-radius: var(--radius-sm);
        padding: 24px;
        border: 1px solid var(--gray-200);
        box-shadow: var(--shadow-sm);
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
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .empty-state {
        text-align: center;
        padding: 40px;
        color: var(--gray-400);
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
        .filter-bar {
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
        .chart-container {
            height: 240px;
        }
    }

    @media (max-width: 480px) {
        .cards-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Responsive Main Content Padding */
    .main-content {
        padding: 32px;
        transition: all 0.3s ease;
    }

    @media (max-width: 768px) {
        .main-content {
            padding: 16px;
        }
    }
</style>

<!-- MAIN CONTENT -->
<div class="main-content">
    <!-- Header Row -->
    <div class="header-row">
        <div class="title-section">
            <h1><i class="fas fa-tachometer-alt" style="color: var(--primary);"></i> Employee Dashboard</h1>
            <p>Manage and track your complaints efficiently</p>
        </div>
        <div style="display: flex; gap: 16px; align-items: center;">
            <a href="{{ route('employee.profile') }}" class="profile-card">
                <div class="avatar">
                    @if(Auth::user()->employeePicture)
                        <img src="{{ asset('uploads/'.Auth::user()->employeePicture) }}" alt="Avatar">
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
            @auth
                @if(Auth::user()->role === 'clerk')
                    <div style="display: flex; gap: 10px;">
                        <button class="btn-primary" id="btnAddEmployee" style="background: var(--primary);">
                            <i class="fas fa-user-plus"></i> Add Employee
                        </button>
                        <button class="btn-primary" id="btnAddDepartment" style="background: #3a7b66;">
                            <i class="fas fa-building"></i> Add Department
                        </button>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    <!-- Add Employee Modal -->
    <div class="modal-overlay" id="employeeModal">
        <div class="modal-box">
            <div class="modal-header">
                <i class="fas fa-user-plus" style="color: var(--primary);"></i> Add New Employee
            </div>
            <form method="POST" action="{{ route('clerk.register.employee.post') }}">
                @csrf
                <input type="text" name="employeeName" placeholder="Employee Name" required>
                <input type="email" name="employeeEmail" placeholder="Email" required>
                <input type="text" name="employeePhone" placeholder="Phone" required>
                <select name="departmentID" required>
                    <option value="">Select Department</option>
                    @foreach($departments ?? [] as $dept)
                        <option value="{{ $dept->departmentID }}">{{ $dept->departmentName }}</option>
                    @endforeach
                </select>
                <input type="password" name="employeePassword" placeholder="Password" required>
                <input type="password" name="employeePassword_confirmation" placeholder="Confirm Password" required>
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeModal('employeeModal')">Cancel</button>
                    <button type="submit" class="btn-save">Save</button>
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
            <form method="POST" action="#">
                @csrf
                <input type="text" name="departmentName" placeholder="Department Name" required>
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeModal('departmentModal')">Cancel</button>
                    <button type="submit" class="btn-save">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ========= DASHBOARD SECTION ========= -->
    <div id="dashboardSection">
        <!-- Summary Cards -->
        <div class="cards-grid">
            <div class="stat-card">
                <h3><i class="fas fa-folder-open"></i> Total Complaints</h3>
                <div class="stat-number">{{ $total ?? 0 }}</div>
            </div>
            <div class="stat-card">
                <h3><i class="fas fa-clock"></i> Pendings</h3>
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

        <!-- My Complaints Preview Table -->
        <div class="complaints-table-wrapper">
            <div class="section-title">
                <i class="fas fa-list-ul" style="color: var(--primary);"></i> My Recent Complaints
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
            <div class="filter-bar">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Search by ID or Title...">
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
                            data-title="{{ strtolower($complaint->complaintTitle) }}">
                            <td>C{{ str_pad($complaint->complaintID, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $complaint->complaintTitle }}</td>
                            <td>{{ $complaint->complaintCategory }}</td>
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
                                <a href="{{ route('employee.complaintDetails', ['id' => $complaint->complaintID]) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($complaint->complaintStatus == 'Pending')
                                <a href="{{ route('employee.editComplaint', ['id' => $complaint->complaintID]) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-inbox" style="font-size: 2rem;"></i>
                                    <p>No complaints found</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="chart-card">
            <div class="section-title">
                <i class="fas fa-chart-pie" style="color: var(--primary);"></i> Complaints by Status
            </div>
            <div class="chart-container">
                <canvas id="complaintChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

            const matchesStatus = currentFilterStatus === 'all' || rowStatus === currentFilterStatus;
            const matchesSearch = searchTerm === '' || 
                rowId.toLowerCase().includes(searchTerm) ||
                rowTitle.toLowerCase().includes(searchTerm);

            if (matchesStatus && matchesSearch) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        resultCount.innerHTML = visibleCount === 0 ? 'No complaints found' : `Showing ${visibleCount} complaint${visibleCount !== 1 ? 's' : ''}`;
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

    // ==================== INITIALIZE CHART ====================
    const chartCanvas = document.getElementById('complaintChart');
    
    if (chartCanvas) {
        // Custom plugin to show total in center
        const centerTextPlugin = {
            id: 'centerText',
            beforeDraw(chart) {
                const { ctx, chartArea } = chart;
                const centerX = (chartArea.left + chartArea.right) / 2;
                const centerY = (chartArea.top + chartArea.bottom) / 2;
                
                ctx.save();
                ctx.font = 'bold 32px "Inter", sans-serif';
                ctx.fillStyle = '#1A3A3F';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText('{{ $total ?? 0 }}', centerX, centerY - 8);
                
                ctx.font = '12px "Inter", sans-serif';
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
                            font: { size: 12, family: "'Inter', sans-serif" },
                            color: '#64748B'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1E293B',
                        titleColor: '#F1F5F9',
                        bodyColor: '#CBD5E1',
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const value = context.raw;
                                const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                return `${context.label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                },
                animation: {
                    animateRotate: true,
                    animateScale: true,
                    duration: 1000
                }
            }
        });
    }

    // ==================== NAVIGATION ====================
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
        link.addEventListener("click", (e) => {
            const page = link.getAttribute("data-page");
            if (page && sections[page]) showSection(page);
        });
    });

    // ==================== MODAL FUNCTIONS ====================
    document.getElementById("btnAddEmployee")?.addEventListener("click", () => {
        document.getElementById("employeeModal").style.display = "flex";
    });

    document.getElementById("btnAddDepartment")?.addEventListener("click", () => {
        document.getElementById("departmentModal").style.display = "flex";
    });

    function closeModal(id) {
        document.getElementById(id).style.display = "none";
    }

    // Close modal when clicking outside
    document.querySelectorAll(".modal-overlay").forEach(modal => {
        modal.addEventListener("click", function(e) {
            if (e.target === this) {
                this.style.display = "none";
            }
        });
    });

    // ==================== INITIAL LOAD ====================
    document.addEventListener("DOMContentLoaded", function() {
        showSection("dashboard");
        // Initialize table rows with data attributes
        tableRows.forEach(row => {
            const cells = row.cells;
            if (cells[0]) {
                row.setAttribute('data-id', cells[0]?.innerText?.toLowerCase() || '');
                row.setAttribute('data-title', cells[1]?.innerText?.toLowerCase() || '');
            }
        });
        filterTable();
    });

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
</script>

@endsection