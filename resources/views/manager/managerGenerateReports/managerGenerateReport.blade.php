@extends('manager.sidebar')
@section('content')

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

    .app-wrapper {
        display: flex;
        min-height: 100vh;
    }

    /* Sidebar */
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

    /* Main content */
    .main-content {
        flex: 1;
        padding: 24px 32px;
        overflow-x: auto;
    }

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

    .manager-card {
        background: white;
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 8px 20px 8px 16px;
        border-radius: 60px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid #e2edf2;
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
        font-weight: bold;
        font-size: 1.2rem;
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
        border-radius: 24px;
        padding: 20px;
        border: 1px solid #e6edf2;
        transition: transform 0.2s;
    }
    .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.05); }
    .stat-card h3 { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; color: #5f8ba0; margin-bottom: 12px; }
    .stat-number { font-size: 2.4rem; font-weight: 700; color: #1a3a48; }

    /* Tables */
    .table-wrapper {
        background: white;
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
    .complaint-table th, .complaint-table td {
        text-align: left;
        padding: 12px 8px;
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
    .status-approved { background: #d4f5e8; color: #1e6f4c; }
    .action-icons i {
        margin: 0 5px;
        cursor: pointer;
        color: #6f9eb3;
    }
    .action-icons i:hover { color: #1f3b4c; }
    .btn-sm {
        background: #2c7a5e;
        border: none;
        padding: 6px 14px;
        border-radius: 30px;
        color: white;
        font-size: 0.7rem;
        cursor: pointer;
        margin: 0 2px;
    }
    .btn-sm:hover { background: #1e5e48; }
    .btn-outline {
        background: white;
        border: 1px solid #2c7a5e;
        color: #2c7a5e;
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 0.7rem;
        cursor: pointer;
    }
    .filter-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 20px;
        justify-content: space-between;
    }
    .search-box input {
        padding: 8px 12px;
        border-radius: 40px;
        border: 1px solid #cbdde6;
        width: 250px;
    }
    .filter-select {
        padding: 8px 12px;
        border-radius: 40px;
        border: 1px solid #cbdde6;
    }
    .report-buttons {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .btn-report {
        background: #4a6f8a;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 40px;
        cursor: pointer;
    }
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }
    .modal-content {
        background: white;
        border-radius: 32px;
        padding: 28px;
        max-width: 500px;
        width: 90%;
    }
    .modal-content textarea {
        width: 100%;
        padding: 12px;
        border-radius: 16px;
        border: 1px solid #cbdde6;
        margin: 16px 0;
    }
    .modal-buttons {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
    }

    @media (max-width: 780px) {
        .sidebar { width: 80px; }
        .sidebar-header h2 span, .sidebar-header p, .nav-link span { display: none; }
        .nav-link { justify-content: center; padding: 12px; }
        .main-content { padding: 16px; }
    }
</style>

<!-- GENERATE REPORT SECTION -->
<div id="reportsSection">
    <div class="table-wrapper">
        <div class="section-title"><i class="fas fa-chart-bar"></i> Generate Reports</div>
        <div class="report-buttons">
            <button class="btn-report" onclick="generateReport('monthly')">
                <i class="fas fa-calendar-alt"></i> Monthly Report
            </button>
            <button class="btn-report" onclick="generateReport('category')">
                <i class="fas fa-tags"></i> By Category Report
            </button>
            <button class="btn-report" onclick="generateReport('department')">
                <i class="fas fa-building"></i> By Department Report
            </button>
            <button class="btn-report" onclick="generateReport('status')">
                <i class="fas fa-chart-pie"></i> Status Summary Report
            </button>
        </div>
        <div id="reportPreview"
            style="margin-top: 24px; padding: 20px; background: #f8fafc; border-radius: 20px;">

            <p style="text-align:center; color:#8aa0ae;">
                Select a report type above to generate
            </p>

        </div>
    </div>
</div>

<script>

    let currentReportType = '';

    function wrapper(content)
    {
        return `
            <div style="text-align:left; background:white; padding:20px; border-radius:20px;">

                ${content}

                <br><br>

                <button class="btn-sm" onclick="downloadReport()">
                    <i class="fas fa-download"></i> Download Report
                </button>

            </div>
        `;
    }

    function downloadReport()
    {
        if(!currentReportType)
        {
            alert('Please generate a report first.');
            return;
        }

        window.location.href =
        '{{ url("/manager/managerReportPdfs/managerReportPdf") }}/' + currentReportType;
    }

    window.generateReport = function(type)
    {
        currentReportType = type;

        const preview = document.getElementById('reportPreview');
        let content = '';

        // MONTHLY
        if(type === 'monthly')
        {
            content = `
                <i class="fas fa-chart-line"></i>

                <h4>Monthly Report - {{ now()->format('F Y') }}</h4>

                <p>
                    Total Complaints: {{ $monthlyComplaints }}<br><br>

                    Resolved: {{ $resolvedCount }} ({{ $resolvedPercentage }}%)<br>

                    Pending: {{ $pendingCount }} ({{ $pendingPercentage }}%)<br>

                    In Progress: {{ $inProgressCount }} ({{ $inProgressPercentage }}%)
                </p>
            `;
        }

        // CATEGORY
        else if(type === 'category')
        {
            content = `
                <i class="fas fa-tags"></i>
                <h4>Report by Category</h4>

                @forelse($categoryReport as $category)
                    <p>
                        {{ $category->complaintCategory }} :
                        {{ $category->total }}
                        ({{ $totalComplaints > 0 ? round(($category->total / $totalComplaints) * 100, 1) : 0 }}%)
                    </p>
                @empty
                    <p>No category data available</p>
                @endforelse
            `;
        }

        // DEPARTMENT
        else if(type === 'department')
        {
            content = `
                <i class="fas fa-building"></i>
                <h4>Report by Department</h4>

                @forelse($departmentReport as $department)
                    <p>
                        {{ $department->departmentName }} :
                        {{ $department->complaints_count }}
                    </p>
                @empty
                    <p>No department data available</p>
                @endforelse
            `;
        }

        // STATUS
        else if(type === 'status')
        {
            content = `
                <i class="fas fa-chart-pie"></i>
                <h4>Status Summary Report</h4>

                @forelse($statusReport as $status)
                    <p>
                        {{ $status->complaintStatus }} :
                        {{ $status->total }}
                        ({{ $totalComplaints > 0 ? round(($status->total / $totalComplaints) * 100, 1) : 0 }}%)
                    </p>
                @empty
                    <p>No status data available</p>
                @endforelse
            `;
        }

        // FINAL RENDER
        preview.innerHTML = wrapper(content);
    }

</script>

@endsection