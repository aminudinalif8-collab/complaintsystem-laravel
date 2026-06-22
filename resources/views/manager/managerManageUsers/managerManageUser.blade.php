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

    @media (max-width: 780px) {
        .sidebar { width: 80px; }
        .sidebar-header h2 span, .sidebar-header p, .nav-link span { display: none; }
        .nav-link { justify-content: center; padding: 12px; }
        .main-content { padding: 16px; }
    }

    // Status badge hover effect
    .status-badge {
        transition: 0.2s;
    }

    .status-badge:hover {
        opacity: 0.8;
        transform: scale(1.05);
    }
</style>

<!-- MANAGE USERS SECTION -->
<div id="usersSection">
    <div class="table-wrapper">
        <div class="section-title">
            <i class="fas fa-users"></i> Manage Employees
        </div>
        <div class="filter-bar">
            <div class="search-box"><input type="text" id="employeeSearch" placeholder="Search by name, ID, department..."></div>
            <button class="btn-sm" onclick="openDepartmentModal()"style="background:#3a7b66;">
                <i class="fas fa-building"></i> Add Department
            </button>
            <button class="btn-sm" onclick="openModal()">
                <i class="fas fa-plus"></i> Add New Employee
            </button>
        </div>
        <table class="complaint-table">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Full Name</th>
                    <th>Department</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr>
                    <td>EMP-{{ $employee->employeeID }}</td>
                    <td>{{ $employee->employeeName }}</td>
                    <td>{{ $employee->department->departmentName ?? 'N/A' }}</td>
                    <td>{{ $employee->employeeEmail }}</td>
                    <td>{{ $employee->role }}</td>
                    <td>
                        @if($employee->employeeStatus == 'Active')
                            <form id="deactivate-form-{{ $employee->employeeID }}"
                                action="{{ route('manager.employee.deactivate', $employee->employeeID) }}"
                                method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="button"
                                        class="status-badge status-resolved"
                                        style="border:none; cursor:pointer;"
                                        onclick="confirmDeactivate({{ $employee->employeeID }})">
                                    Active
                                </button>
                            </form>
                        @else
                            <form id="activate-form-{{ $employee->employeeID }}"
                                action="{{ route('manager.employee.activate', $employee->employeeID) }}"
                                method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="button"
                                        class="status-badge status-rejected"
                                        style="border:none; cursor:pointer;"
                                        onclick="confirmActivate({{ $employee->employeeID }})">
                                    Inactive
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($employees->hasPages())
        <div class="pagination-wrapper">

            {{-- PREVIOUS --}}
            @if($employees->onFirstPage())
                <span class="page-btn disabled">Previous</span>
            @else
                <a class="page-btn" href="{{ $employees->previousPageUrl() }}">
                    Previous
                </a>
            @endif

            {{-- PAGE NUMBERS --}}
            @for($i = 1; $i <= $employees->lastPage(); $i++)
                <a href="{{ $employees->url($i) }}"
                class="page-btn {{ $employees->currentPage() == $i ? 'active' : '' }}">
                    {{ $i }}
                </a>
            @endfor

            {{-- NEXT --}}
            @if($employees->hasMorePages())
                <a class="page-btn" href="{{ $employees->nextPageUrl() }}">
                    Next
                </a>
            @else
                <span class="page-btn disabled">Next</span>
            @endif

        </div>
        @endif
    </div>
</div>

<!-- Add Department Modal -->
<div class="modal" id="departmentModal">
    <div class="modal-content">

        <h2 style="margin-bottom:20px;">
            Add New Department
        </h2>

        @if ($errors->any())
            <div style="color:red; margin-bottom:15px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('manager.department.store') }}">
            @csrf

            <input type="text"
                   name="departmentName"
                   placeholder="Department Name"
                   required
                   style="width:100%; padding:10px; margin-bottom:20px;">

            <div style="display:flex; gap:10px; justify-content:flex-end;">
                <button type="button"
                        class="btn-outline"
                        onclick="closeDepartmentModal()">
                    Cancel
                </button>

                <button type="submit" class="btn-sm">
                    Save
                </button>
            </div>

        </form>

    </div>
</div>

<!-- Add Employee Modal -->
<div class="modal" id="employeeModal">
    <div class="modal-content">
        <h2 style="margin-bottom:20px;">
            Add New Employee
        </h2>
        @if ($errors->any())
            <div style="color:red; margin-bottom:15px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('clerk.register.employee.post') }}">
            @csrf
            <input type="text"
                   name="employeeName"
                   placeholder="Employee Name"
                   required
                   style="width:100%; padding:10px; margin-bottom:12px;">
            <input type="email"
                   name="employeeEmail"
                   placeholder="Email"
                   required
                   style="width:100%; padding:10px; margin-bottom:12px;">
            <input type="text"
                   name="employeePhone"
                   placeholder="Phone"
                   required
                   style="width:100%; padding:10px; margin-bottom:12px;">
            <select name="role"
                    id="roleSelect"
                    required
                    style="width:100%; padding:10px; margin-bottom:12px;">
                <option value="">Select Role</option>
                <option value="manager">Manager</option>
                <option value="supervisor">Supervisor</option>
                <option value="clerk">Clerk</option>
                <option value="employee">Employee</option>
            </select>
            <select name="departmentID"
                    id="departmentSelect"
                    required
                    style="width:100%; padding:10px; margin-bottom:12px;">
                <option value="">Select Department</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->departmentID }}">
                        {{ $dept->departmentName }}
                    </option>
                @endforeach
            </select>
            <div id="supervisorWrapper" style="display:none;">
                <select name="supervisorID"
                        id="supervisorSelect"
                        disabled
                        style="width:100%; padding:10px; margin-bottom:12px;">

                    <option value="">Select Supervisor</option>
                </select>
            </div>
            <input type="password"
                   name="employeePassword"
                   placeholder="Password"
                   required
                   style="width:100%; padding:10px; margin-bottom:12px;">
            <input type="password"
                   name="employeePassword_confirmation"
                   placeholder="Confirm Password"
                   required
                   style="width:100%; padding:10px; margin-bottom:20px;">
            <div style="display:flex; gap:10px; justify-content:flex-end;">
                <button type="button"
                        class="btn-outline"
                        onclick="closeModal()">
                    Cancel
                </button>
                <button type="submit"
                        class="btn-sm">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    /* =========================
    DEPARTMENT MODAL
    ========================= */
    function openDepartmentModal()
    {
        document.getElementById('departmentModal').style.display = 'flex';
    }

    function closeDepartmentModal()
    {
        document.getElementById('departmentModal').style.display = 'none';
    }

    /* close modal bila click background */
    document.querySelectorAll(".modal").forEach(modal => {
        modal.addEventListener("click", function(e) {
            if (e.target === modal) {
                modal.style.display = "none";
            }
        });
    });

    /* =========================
    EMPLOYEE MODAL
    ========================= */
    function openModal()
    {
        document.getElementById('employeeModal').style.display = 'flex';
    }

    function closeModal()
    {
        document.getElementById('employeeModal').style.display = 'none';
    }


    /* =========================
    ELEMENTS
    ========================= */
    const roleSelect = document.getElementById("roleSelect");
    const departmentSelect = document.getElementById("departmentSelect");
    const supervisorSelect = document.getElementById("supervisorSelect");
    const supervisorWrapper = document.getElementById("supervisorWrapper");


    /* =========================
    ROLE CONTROL (CLERK STYLE)
    ========================= */
    function toggleSupervisor()
    {
        const role = roleSelect.value;

        if (role === "employee" || role === "clerk")
        {
            supervisorWrapper.style.display = "block";
            supervisorSelect.disabled = false;
        }
        else
        {
            supervisorWrapper.style.display = "none";
            supervisorSelect.value = "";
            supervisorSelect.innerHTML = '<option value="">Select Supervisor</option>';
            supervisorSelect.disabled = true;
        }
    }

    if (roleSelect)
    {
        roleSelect.addEventListener("change", toggleSupervisor);
    }


    /* =========================
    AJAX LOAD SUPERVISOR (CLERK STYLE)
    ========================= */
    if (departmentSelect)
    {
        departmentSelect.addEventListener("change", function ()
        {
            const deptID = this.value;

            // reset
            supervisorSelect.innerHTML = '<option value="">Loading...</option>';

            if (!deptID)
            {
                supervisorSelect.innerHTML = '<option value="">Select Supervisor</option>';
                return;
            }

            fetch(`/manager/get-supervisors/${deptID}`)
                .then(res => res.json())
                .then(data =>
                {
                    supervisorSelect.innerHTML = '<option value="">Select Supervisor</option>';

                    if (!data.length)
                    {
                        supervisorSelect.innerHTML += '<option value="">No Supervisor Available</option>';
                        return;
                    }

                    data.forEach(sup =>
                    {
                        const option = document.createElement("option");
                        option.value = sup.employeeID;
                        option.textContent = `${sup.employeeName} (${sup.department.departmentName})`;
                        supervisorSelect.appendChild(option);
                    });
                })
                .catch(err =>
                {
                    console.error(err);
                    supervisorSelect.innerHTML = '<option value="">Error loading data</option>';
                });
        });
    }


    /* =========================
    BUTTON HOOK
    ========================= */
    document.addEventListener("DOMContentLoaded", function ()
    {
        const btn = document.getElementById("btnAddEmployee");

        if (btn)
        {
            btn.addEventListener("click", openModal);
        }

        toggleSupervisor(); // init state
    });

    // =========================
    // DEACTIVATE CONFIRMATION
    // =========================
    function confirmDeactivate(employeeID)
    {
        Swal.fire({
            title: 'Deactivate Employee?',
            text: 'This employee will no longer be able to access the system.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#bc3f33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, Deactivate',
            cancelButtonText: 'Cancel'
        }).then((result) => {

            if (result.isConfirmed)
            {
                document.getElementById(
                    'deactivate-form-' + employeeID
                ).submit();
            }

        });
    }

    // =========================
    // ACTIVATE CONFIRMATION
    // =========================
    function confirmActivate(employeeID)
    {
        Swal.fire({
            title: 'Activate Employee?',
            text: 'This employee will be able to access the system again.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2c7a5e',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, Activate',
            cancelButtonText: 'Cancel'
        }).then((result) => {

            if (result.isConfirmed)
            {
                document.getElementById(
                    'activate-form-' + employeeID
                ).submit();
            }

        });
    }

</script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session("success") }}',
        confirmButtonColor: '#2c7a5e'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '{{ session("error") }}',
        confirmButtonColor: '#bc3f33'
    });
</script>
@endif

@endsection