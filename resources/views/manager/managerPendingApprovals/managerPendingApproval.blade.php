@extends('manager.sidebar')
@section('content')

<style>
    /* Base & Reset */
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
        color: #1a3a48;
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
        transition: all 0.2s;
    }
    .btn-sm:hover { background: #1e5e48; transform: translateY(-1px); }
    .btn-outline {
        background: white;
        border: 1px solid #2c7a5e;
        color: #2c7a5e;
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 0.7rem;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-outline:hover { background: #e6f4ef; }
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

    /* Enhanced MODAL - matching color theme */
    .custom-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(26, 58, 72, 0.75);
        backdrop-filter: blur(3px);
        z-index: 9999;
        justify-content: center;
        align-items: center;
        animation: fadeIn 0.2s ease;
    }

    .custom-modal-content {
        background: #ffffff;
        width: 520px;
        max-width: 92%;
        border-radius: 32px;
        padding: 28px 30px;
        animation: modalSlide 0.25s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        box-shadow: 0 25px 40px -12px rgba(0, 0, 0, 0.35);
        border: 1px solid rgba(44, 122, 94, 0.2);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
        padding-bottom: 12px;
        border-bottom: 2px solid #eaf0f5;
    }

    .modal-header h3 {
        font-size: 1.55rem;
        font-weight: 700;
        background: linear-gradient(135deg, #1a3a48, #2c7a5e);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        letter-spacing: -0.3px;
    }

    .close-modal {
        font-size: 2rem;
        font-weight: 300;
        cursor: pointer;
        color: #8aaec0;
        transition: all 0.2s;
        line-height: 1;
    }

    .close-modal:hover {
        color: #bc3f33;
        transform: scale(1.1);
    }

    /* form inside modal */
    .form-group {
        margin: 20px 0 12px 0;
    }

    .form-group label {
        font-weight: 600;
        font-size: 0.85rem;
        color: #1a3a48;
        display: block;
        margin-bottom: 8px;
        letter-spacing: 0.3px;
    }

    .form-group textarea {
        width: 100%;
        padding: 14px 16px;
        border-radius: 20px;
        border: 1.5px solid #dfe9ef;
        font-family: 'Inter', monospace;
        font-size: 0.9rem;
        transition: all 0.2s;
        resize: vertical;
        background: #fefefe;
    }

    .form-group textarea:focus {
        outline: none;
        border-color: #2c7a5e;
        box-shadow: 0 0 0 3px rgba(44, 122, 94, 0.2);
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 16px;
        margin-top: 28px;
    }

    .btn-save {
        background: linear-gradient(95deg, #1a3a48, #2c7a5e);
        border: none;
        padding: 12px 28px;
        border-radius: 40px;
        color: white;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }

    .btn-save:hover {
        transform: translateY(-2px);
        background: linear-gradient(95deg, #0f2c38, #1e5e48);
        box-shadow: 0 10px 18px rgba(26, 58, 72, 0.25);
    }

    .btn-cancel {
        background: #f0f4f8;
        border: 1px solid #cbdde6;
        padding: 12px 24px;
        border-radius: 40px;
        color: #3c6e8c;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-cancel:hover {
        background: #e3eef5;
        color: #1a3a48;
        border-color: #9bb7c8;
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

    /* PAGINATION */
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
        border: 1px solid #cbdde6;
        color: #2c7a5e;
        background: white;
        transition: 0.2s;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .page-btn:hover {
        background: #e6f4ef;
    }

    .page-btn.active {
        background: #2c7a5e;
        color: white;
        border-color: #2c7a5e;
    }

    .page-btn.disabled {
        color: #94a3b8;
        cursor: not-allowed;
        background: #f1f5f9;
    }

    @keyframes modalSlide {
        from {
            opacity: 0;
            transform: scale(0.96) translateY(-12px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @keyframes fadeIn {
        from { background: rgba(26, 58, 72, 0); backdrop-filter: blur(0px);}
        to { background: rgba(26, 58, 72, 0.75); backdrop-filter: blur(3px);}
    }

    /* responsive sidebar adjustments */
    @media (max-width: 780px) {
        .sidebar { width: 80px; }
        .sidebar-header h2 span, .sidebar-header p, .nav-link span { display: none; }
        .nav-link { justify-content: center; padding: 12px; }
        .main-content { padding: 16px; }
        .custom-modal-content { padding: 22px; }
    }
</style>

<!-- HEADER ROW -->
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

<!-- PENDING APPROVALS SECTION (Approve/Reject Action) -->
<div id="approvalsSection">
    <div class="table-wrapper">
        <div class="section-title">
            <i class="fas fa-check-double"></i> Actions Awaiting Manager Approval
        </div>
        <table class="complaint-table">
            <thead>
                <tr>
                    <th>Complaint ID</th>
                    <th>Submitted By</th>
                    <th>Complaint Title</th>
                    <th>Proposed Action</th>
                    <th>Assigned Supervisor</th>
                    <th>Submitted Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendingActions as $action)
                    <tr>
                        <td>
                            CA{{ str_pad($action->actionID, 3, '0', STR_PAD_LEFT) }}
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
                            @if($action->supervisor)
                                {{ $action->supervisor->employeeName }}
                            @else
                                Unassigned
                            @endif
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($action->actionDate)->format('Y-m-d') }}
                        </td>
                        <td>
                            <button class="btn-sm"
                                onclick="openApprovalModal('{{ $action->actionID }}', 'Approved')">
                                Approve
                            </button>

                            <button class="btn-outline"
                                onclick="openApprovalModal('{{ $action->actionID }}', 'Rejected')">
                                Reject
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;">
                            No pending approvals found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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

<!-- Unified Approval/Rejection Modal - fully themed with dashboard colors -->
<div id="approvalModal" class="custom-modal">
    <div class="custom-modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Manager Decision</h3>
            <span class="close-modal" onclick="closeApprovalModal()">&times;</span>
        </div>
        <form id="approvalForm" method="POST">
            @csrf
            <input type="hidden" name="decision" id="decisionInput">
            <div class="form-group">
                <label><i class="fas fa-pen-alt" style="margin-right: 6px; color:#2c7a5e;"></i> Manager Remarks</label>
                <textarea name="managerRemarks" rows="4" placeholder="Write detailed remarks (reason for approval or rejection)..." required></textarea>
            </div>
            <div class="modal-actions">
                <button type="submit" class="btn-save" id="submitDecisionBtn">
                    <i class="fas fa-check-circle"></i> Submit Decision
                </button>
                <button type="button" class="btn-cancel" onclick="closeApprovalModal()">
                    <i class="fas fa-times"></i> Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // ===============================
    // UI Navigation
    // ===============================
    const sections = {
        dashboard: 'dashboardSection',
        complaints: 'complaintsSection',
        approvals: 'approvalsSection',
        users: 'usersSection',
        reports: 'reportsSection'
    };

    function showSection(sectionId)
    {
        Object.keys(sections).forEach(key => {
            const el = document.getElementById(sections[key]);
            if(el) el.style.display = 'none';
        });

        const active = document.getElementById(sectionId);
        if(active) active.style.display = 'block';

        document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));

        const activeLink = document.querySelector(
            `[data-page="${Object.keys(sections).find(k => sections[k] === sectionId)}"]`
        );

        if(activeLink) activeLink.classList.add('active');
    }

    document.querySelectorAll('.nav-link[data-page]').forEach(link => {
        link.addEventListener('click', () => {
            const page = link.getAttribute('data-page');
            if(sections[page]) showSection(sections[page]);
        });
    });

    // Logout
    let logoutBtn = document.getElementById('logoutBtn');
    if(logoutBtn) {
        logoutBtn.addEventListener('click', () => {
            alert('🚪 Logged out from Manager Panel.');
        });
    }

    // ===============================
    // APPROVAL MODAL (OPEN)
    // ===============================
    function openApprovalModal(actionID, decision)
    {
        Swal.fire({
            title: decision === 'Approved' ? 'Approve this action?' : 'Reject this action?',
            text: "Please confirm before proceeding.",
            icon: decision === 'Approved' ? 'question' : 'warning',
            showCancelButton: true,
            confirmButtonColor: decision === 'Approved' ? '#2c7a5e' : '#bc3f33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, continue'
        }).then((result) => {
            if(result.isConfirmed) {
                showApprovalModal(actionID, decision);
            }
        });
    }

    // ===============================
    // SHOW MODAL
    // ===============================
    function showApprovalModal(actionID, decision)
    {
        const modal = document.getElementById('approvalModal');
        const decisionInput = document.getElementById('decisionInput');
        const modalTitle = document.getElementById('modalTitle');
        const submitBtn = document.getElementById('submitDecisionBtn');
        const form = document.getElementById('approvalForm');

        // set hidden input
        decisionInput.value = decision;

        // UI change based on decision
        if (decision === 'Approved') {
            modalTitle.innerHTML =
                '<i class="fas fa-thumbs-up" style="margin-right:8px;color:#2c7a5e;"></i> Approve Action';

            submitBtn.style.background =
                "linear-gradient(95deg, #1a3a48, #2c7a5e)";
        } else {
            modalTitle.innerHTML =
                '<i class="fas fa-times-circle" style="margin-right:8px;color:#bc3f33;"></i> Reject Action';

            submitBtn.style.background =
                "linear-gradient(95deg, #8b3c34, #bc3f33)";
        }

        // ✅ FIX ROUTE (IMPORTANT PART)
        const route = (decision === 'Approved') ? 'approve' : 'reject';
        form.action = `/manager/action/${actionID}/${route}`;

        // show modal
        modal.style.display = 'flex';

        // reset remarks
        const remarksField = form.querySelector('textarea[name="managerRemarks"]');
        if (remarksField) remarksField.value = '';
    }

    // ===============================
    // CLOSE MODAL
    // ===============================
    function closeApprovalModal()
    {
        const modal = document.getElementById('approvalModal');
        if(modal) modal.style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('approvalModal');
        if(event.target === modal) {
            closeApprovalModal();
        }
    }

    // ===============================
    // SEARCH FILTER (optional)
    // ===============================
    const complaintSearch = document.getElementById('complaintSearch');
    if(complaintSearch) {
        complaintSearch.addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#complaintTable tbody tr');

            rows.forEach(row => {
                const text =
                    (row.cells[0]?.innerText.toLowerCase() || '') +
                    (row.cells[1]?.innerText.toLowerCase() || '') +
                    (row.cells[2]?.innerText.toLowerCase() || '');

                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    }

    const statusFilter = document.getElementById('statusFilter');
    if(statusFilter) {
        statusFilter.addEventListener('change', function() {
            const val = this.value;
            const rows = document.querySelectorAll('#complaintTable tbody tr');

            rows.forEach(row => {
                const status = row.cells[5]?.innerText;
                if(val === 'all' || status === val) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }

    // ===============================
    // DEFAULT SECTION
    // ===============================
    if(document.getElementById('dashboardSection')) {
        showSection('dashboardSection');
    } else if(document.getElementById('approvalsSection')) {
        document.getElementById('approvalsSection').style.display = 'block';
    }
</script>

{{-- SUCCESS ALERT --}}
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif

{{-- ERROR ALERT --}}
@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: "{{ session('error') }}"
    });
</script>
@endif

@endsection