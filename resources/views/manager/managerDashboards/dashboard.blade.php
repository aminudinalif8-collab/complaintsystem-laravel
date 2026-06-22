@extends('manager.sidebar')
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

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: white;
        border-radius: var(--radius-sm);
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
    .status-progress { background: var(--blue-soft); color: var(--blue); }
    .status-pending-approval { background: #FFF0DB; color: #C47B2E; }
    .status-resolved { background: var(--green-soft); color: var(--green); }
    .status-rejected { background: var(--red-soft); color: var(--red); }
    .status-cancelled { background: var(--red-soft); color: var(--red); }

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

    /* Chart Cards */
    .chart-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
        margin-top: 32px;
    }

    .chart-card {
        background: white;
        border-radius: var(--radius-sm);
        padding: 24px;
        border: 1px solid var(--gray-200);
        box-shadow: var(--shadow-sm);
        transition: all 0.2s;
    }

    .chart-card:hover {
        box-shadow: var(--shadow-md);
    }

    .chart-container {
        position: relative;
        height: 300px;
        margin-top: 10px;
    }

    canvas {
        max-height: 300px;
        width: 100% !important;
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

    .chart-legend-custom {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
        margin-top: 12px;
        font-size: 0.8rem;
        color: var(--gray-600);
    }

    .chart-legend-custom span {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .chart-legend-custom .color-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .chart-grid {
            grid-template-columns: 1fr;
        }
    }

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
        .chart-container {
            height: 250px;
        }
    }

    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        .chart-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="app-wrapper">
    <div class="main-content">
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

        <!-- DASHBOARD SECTION -->
        <div id="dashboardSection">
            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3><i class="fas fa-folder-open"></i> Total Complaints</h3>
                    <div class="stat-number">{{ $totalComplaints }}</div>
                </div>
                <div class="stat-card">
                    <h3><i class="fas fa-clock"></i> Pending</h3>
                    <div class="stat-number">{{ $pendingComplaints }}</div>
                </div>
                <div class="stat-card">
                    <h3><i class="fas fa-sync-alt"></i> In Progress</h3>
                    <div class="stat-number">{{ $inProgressComplaints }}</div>
                </div>
                <div class="stat-card">
                    <h3><i class="fas fa-check-circle"></i> Resolved</h3>
                    <div class="stat-number">{{ $resolvedComplaints }}</div>
                </div>
                <div class="stat-card">
                    <h3><i class="fas fa-users"></i> Total Employees</h3>
                    <div class="stat-number">{{ $totalEmployees }}</div>
                </div>
            </div>

            <!-- Recent Complaints Table -->
            <div class="table-wrapper">
                <div class="section-title">
                    <i class="fas fa-clock"></i> Recent Complaints
                </div>
                <table class="complaint-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employee</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Assigned Supervisor</th>
                            <th>Action Required</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($complaints as $complaint)
                            <tr>
                                <td>C{{ str_pad($complaint->complaintID, 3, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $complaint->employee->employeeName ?? 'N/A' }}</td>
                                <td>{{ $complaint->complaintTitle }}</td>
                                <td>
                                    @php
                                        $status = $complaint->complaintStatus;
                                        $class = match($status) {
                                            'Pending' => 'status-pending',
                                            'In Progress' => 'status-progress',
                                            'Pending Approval' => 'status-pending-approval',
                                            'Resolved' => 'status-resolved',
                                            'Rejected' => 'status-rejected',
                                            'Cancelled' => 'status-cancelled',
                                            default => 'status-pending'
                                        };
                                    @endphp
                                    <span class="status-badge {{ $class }}">{{ $status }}</span>
                                </td>
                                <td>
                                    @if($complaint->actions->isNotEmpty() && $complaint->actions->first()->supervisor)
                                        {{ $complaint->actions->first()->supervisor->employeeName }}
                                    @else
                                        Not Assigned
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('manager.complaintDetails', ['id' => $complaint->complaintID]) }}" class="btn-sm" style="text-decoration: none;">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Charts Section -->
            <div class="chart-grid">
                <!-- Chart 1: Complaints by Status (Horizontal Bar Chart) -->
                <div class="chart-card">
                    <div class="section-title">
                        <i class="fas fa-chart-bar" style="color: var(--primary);"></i> Complaints by Status
                    </div>
                    <div class="chart-container">
                        <canvas id="complaintChart"></canvas>
                    </div>
                    <div class="chart-legend-custom">
                        <span><span class="color-dot" style="background: #F59E0B;"></span> Pending</span>
                        <span><span class="color-dot" style="background: #3B82F6;"></span> In Progress</span>
                        <span><span class="color-dot" style="background: #10B981;"></span> Resolved</span>
                        <span><span class="color-dot" style="background: #efec44;"></span> Awaiting Approval</span>
                    </div>
                </div>

                <!-- Chart 2: Employee Distribution (Bar Chart) -->
                <div class="chart-card">
                    <div class="section-title">
                        <i class="fas fa-users" style="color: var(--primary);"></i> Employee Distribution by Department
                    </div>
                    <div class="chart-container">
                        <canvas id="employeeChart"></canvas>
                    </div>
                    <div class="chart-legend-custom">
                        <span><span class="color-dot" style="background: #2C6E5C;"></span> Total Employees</span>
                    </div>
                </div>
            </div>
        </div>
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
        text: "{{ session('login_success') }}",
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

<script>
    // UI Navigation
    const sections = { dashboard: 'dashboardSection', complaints: 'complaintsSection', approvals: 'approvalsSection', users: 'usersSection', reports: 'reportsSection' };
    function showSection(sectionId) { Object.keys(sections).forEach(key => { const el = document.getElementById(sections[key]); if(el) el.style.display = 'none'; }); const active = document.getElementById(sectionId); if(active) active.style.display = 'block'; document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active')); document.querySelector(`[data-page="${Object.keys(sections).find(k => sections[k] === sectionId)}"]`)?.classList.add('active'); }
    document.querySelectorAll('.nav-link[data-page]').forEach(link => { link.addEventListener('click', () => { const page = link.getAttribute('data-page'); if(sections[page]) showSection(sections[page]); }); });

    document.addEventListener('DOMContentLoaded', function() {
        // ================ CHART 1: Complaints by Status (Horizontal Bar Chart) ================
        const ctx1 = document.getElementById('complaintChart').getContext('2d');

        const complaintData = {
            labels: ['Pending', 'In Progress', 'Resolved', 'Awaiting Approval'],
            datasets: [{
                data: [
                    {{ $pendingComplaints ?? 0 }},
                    {{ $inProgressComplaints ?? 0 }},
                    {{ $resolvedComplaints ?? 0 }},
                    {{ $awaitingApprovalComplaints ?? 0 }}
                ],
                backgroundColor: [
                    '#F59E0B', // Pending - Amber
                    '#3B82F6', // In Progress - Blue
                    '#10B981', // Resolved - Emerald
                    '#efec44'  // Awaiting Approval - Red
                ],
                borderColor: [
                    '#D97706',
                    '#2563EB',
                    '#059669',
                    '#efec44'
                ],
                borderWidth: 2,
                borderRadius: 6,
                barPercentage: 0.7
            }]
        };

        new Chart(ctx1, {
            type: 'bar',
            data: complaintData,
            options: {
                indexAxis: 'y', // This makes it horizontal
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false // We use custom legend
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                let percentage = total > 0 ? ((context.parsed.x / total) * 100).toFixed(1) : 0;
                                return context.parsed.x + ' complaints (' + percentage + '%)';
                            }
                        },
                        backgroundColor: 'rgba(30, 41, 59, 0.9)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        cornerRadius: 8,
                        padding: 12
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            stepSize: 1,
                            font: {
                                size: 11,
                                family: "'Inter', sans-serif"
                            },
                            color: '#94A3B8'
                        }
                    },
                    y: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 12,
                                family: "'Inter', sans-serif",
                                weight: '500'
                            },
                            color: '#475569'
                        }
                    }
                },
                animation: {
                    duration: 1500,
                    easing: 'easeOutQuart'
                }
            }
        });

        // ================ CHART 2: Employee Distribution by Department (Bar) ================
        const ctx2 = document.getElementById('employeeChart').getContext('2d');

        // Pass department data from controller
        const deptLabels = @json($departmentLabels ?? []);
        const deptCounts = @json($departmentCounts ?? []);

        // Generate gradient colors
        const colors = [
            '#2C6E5C', '#3A8A73', '#48A68A', '#5BBFA1', '#72D4B8',
            '#8AE0C9', '#A2EADA', '#BAF4EB', '#D2F8F5', '#EAFCFA'
        ];

        const backgroundColors = deptLabels.map((_, index) => colors[index % colors.length]);

        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: deptLabels,
                datasets: [{
                    label: 'Employees',
                    data: deptCounts,
                    backgroundColor: backgroundColors,
                    borderColor: backgroundColors.map(c => c),
                    borderWidth: 2,
                    borderRadius: 6,
                    barPercentage: 0.7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false // We use custom legend
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' employees';
                            }
                        },
                        backgroundColor: 'rgba(30, 41, 59, 0.9)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        cornerRadius: 8,
                        padding: 12
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            stepSize: 1,
                            font: {
                                size: 11,
                                family: "'Inter', sans-serif"
                            },
                            color: '#94A3B8'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11,
                                family: "'Inter', sans-serif"
                            },
                            color: '#94A3B8',
                            maxRotation: 45,
                            minRotation: 0
                        }
                    }
                },
                animation: {
                    duration: 1500,
                    easing: 'easeOutQuart'
                }
            }
        });
    });
</script>

@endsection