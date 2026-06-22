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
        padding: 0;
    }

    .profile-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    .page-header {
        margin-bottom: 28px;
    }
    .page-header h1 {
        font-size: 1.8rem;
        font-weight: 600;
        background: linear-gradient(135deg, #1a3a48, #2c7a5e);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    .page-header p {
        color: #5a6e7c;
        font-size: 0.9rem;
        margin-top: 6px;
    }

    .profile-grid {
        display: flex;
        gap: 28px;
        flex-wrap: wrap;
    }
    .left-column {
        flex: 1.2;
        min-width: 300px;
    }
    .right-column {
        flex: 2;
        min-width: 400px;
    }

    .card {
        background: white;
        padding: 28px;
        border: 1px solid #e6edf2;
        margin-bottom: 28px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
    }
    .card-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #1a3a48;
        border-bottom: 2px solid #eef3f7;
        padding-bottom: 12px;
    }
    .card-title i {
        color: #2c7a5e;
    }

    /* Profile Picture */
    .profile-pic-section {
        text-align: center;
    }
    .avatar-large {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #2c7a5e, #1e5a48);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }
    .avatar-large i {
        font-size: 3.5rem;
        color: white;
    }
    .avatar-large img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: none;
    }
    .upload-btn {
        background: #eef3f7;
        border: none;
        padding: 8px 20px;
        border-radius: 30px;
        font-size: 0.8rem;
        font-weight: 500;
        cursor: pointer;
        margin-top: 12px;
        transition: 0.2s;
    }
    .upload-btn:hover {
        background: #e2edf2;
    }
    .profile-pic-note {
        font-size: 0.7rem;
        color: #8aa0ae;
        margin-top: 8px;
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-size: 0.7rem;
        font-weight: 600;
        color: #3a6f86;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .form-group input, .form-group select {
        width: 100%;
        padding: 12px 14px;
        border-radius: 16px;
        border: 1.5px solid #e2edf2;
        font-size: 0.9rem;
        background: white;
        transition: 0.2s;
    }
    .form-group input:focus, .form-group select:focus {
        outline: none;
        border-color: #2c7a5e;
        box-shadow: 0 0 0 3px rgba(44,122,94,0.1);
    }
    .form-group input:disabled {
        background: #f8fafc;
        color: #5f7f8c;
    }
    .row-2cols {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    .btn-save {
        background: #2c7a5e;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 40px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
        width: 100%;
    }
    .btn-save:hover {
        background: #1e5e48;
        transform: scale(0.98);
    }
    .btn-secondary {
        background: white;
        border: 1.5px solid #cbdde6;
        padding: 10px 20px;
        border-radius: 40px;
        font-weight: 500;
        cursor: pointer;
        transition: 0.2s;
    }
    .btn-secondary:hover {
        background: #f0f7fa;
    }

    /* Password Section */
    .password-section {
        background: #fafeff;
        border-radius: 20px;
        padding: 31px;
        border: 1px solid #e6edf2;
    }
    .password-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }
    .btn-change-pw {
        background: #4a6f8a;
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 40px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
    }
    .btn-change-pw:hover {
        background: #345e7a;
    }

    /* Complaint Summary */
    .stats-mini-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-top: 8px;
    }
    .stat-mini {
        background: #f8fafc;
        padding: 16px;
        text-align: center;
        border: 1px solid #eef3f7;
        cursor: pointer;
        transition: 0.2s;
    }
    .stat-mini:hover {
        background: #eef3f7;
        transform: translateY(-2px);
    }
    .stat-mini .number {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1a3a48;
    }
    .stat-mini .label {
        font-size: 0.7rem;
        color: #5f8ba0;
        margin-top: 4px;
    }
    .stat-mini i {
        color: #2c7a5e;
        margin-right: 6px;
    }

    .role-badge {
        background: #e0f2e9;
        color: #1e6f4c;
        padding: 4px 12px;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-block;
    }

    /* Modal */
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
        padding: 32px;
        max-width: 450px;
        width: 90%;
    }
    .modal-content h3 {
        margin-bottom: 20px;
    }
    .modal-buttons {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 24px;
    }
    .hidden-file {
        display: none;
    }
    .toast-message {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: #1a3a48;
        color: white;
        padding: 12px 24px;
        border-radius: 40px;
        font-size: 0.85rem;
        z-index: 1100;
        animation: fadeInOut 2.5s ease;
    }
    @keyframes fadeInOut {
        0% { opacity: 0; transform: translateY(20px); }
        15% { opacity: 1; transform: translateY(0); }
        85% { opacity: 1; transform: translateY(0); }
        100% { opacity: 0; transform: translateY(20px); }
    }

    @media (max-width: 780px) {
        body { padding: 20px; }
        .right-column { min-width: auto; }
        .row-2cols { grid-template-columns: 1fr; }
    }
</style>

<div class="profile-container">
    
    <div class="page-header">
        <h1><i class="fas fa-user-circle"></i> Employee's Profile</h1>
        <p>View and update your personal information</p>
    </div>

    <div class="profile-grid">
        <!-- LEFT COLUMN -->
        <div class="left-column">
            <!-- Profile Picture Card -->
            <div class="card">
                <div class="card-title">
                    <i class="fas fa-camera"></i> Profile Picture
                </div>
                <div class="profile-pic-section">
                    <div class="avatar-large" id="avatarContainer">
                        <i class="fas fa-user-circle" id="profileIcon"></i>
                        <img id="profileImg" 
                            src="{{ $employee->employeePicture ? asset('uploads/'.$employee->employeePicture) : '' }}" 
                            alt="Profile"
                            style="{{ $employee->employeePicture ? '' : 'display:none;' }}">
                    </div>
                    <button class="upload-btn" id="uploadBtn"><i class="fas fa-upload"></i> Upload Photo</button>
                    <input type="file" id="fileInput" class="hidden-file" accept="image/jpeg,image/png,image/gif">
                    <p class="profile-pic-note">Click the avatar or upload button (JPG, PNG)</p>
                </div>
            </div>

            <!-- Complaint Summary Card -->
            <div class="card">
                <div class="card-title">
                    <i class="fas fa-chart-line"></i> My Complaint Summary
                </div>
                <div class="stats-mini-grid">
                    <div class="stat-mini" data-type="total">
                        <div class="number">{{ $total }}</div>
                        <div class="label"><i class="fas fa-folder-open"></i> Total Complaints</div>
                    </div>
                    <div class="stat-mini" data-type="pending">
                        <div class="number">{{ $pending }}</div>
                        <div class="label"><i class="fas fa-clock"></i> Pending</div>
                    </div>
                    <div class="stat-mini" data-type="progress">
                        <div class="number">{{ $progress }}</div>
                        <div class="label"><i class="fas fa-sync-alt"></i> In Progress</div>
                    </div>
                    <div class="stat-mini" data-type="resolved">
                        <div class="number">{{ $resolved }}</div>
                        <div class="label"><i class="fas fa-check-circle"></i> Resolved </div>
                    </div>
                </div>
                <!-- <div style="margin-top: 16px; text-align: center; font-size: 0.7rem; color: #8aa0ae;">
                    <i class="fas fa-chart-simple"></i> Last updated: March 2026
                </div> -->
            </div>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="right-column">
            <!-- Basic Information Card -->
            <div class="card">
                <div class="card-title">
                    <i class="fas fa-id-card"></i> Basic Information
                </div>
                <form action="{{ route('manager.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row-2cols">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" id="fullName" name="employeeName" value="{{ $employee->employeeName }}">
                        </div>
                        <div class="form-group">
                            <label>Employee ID</label>
                            <input type="text" id="employeeId" value="{{ auth()->user()->formatted_employee_id }}" disabled>
                        </div>
                    </div>
                    <div class="row-2cols">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" id="email" name="employeeEmail" value="{{ $employee->employeeEmail }}">
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" id="phone" name="employeePhone" value="{{ $employee->employeePhone }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Department</label>
                        <input type="text"
                            value="{{ $employee->department->departmentName }}"
                            disabled>
                    </div>
                    <button type="submit" class="btn-save" id="saveBasicBtn"><i class="fas fa-save"></i> Update Information</button>
                </form>
            </div>

            <!-- Account Information Card -->
            <!-- <div class="card">
                <div class="card-title">
                    <i class="fas fa-user-lock"></i> Account Information
                </div>
                <div class="row-2cols">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" id="username" value="{{ $employee->name }}">
                    </div>
                    <div class="form-group">
                        <label>Department</label>
                        <input type="text" id="department" value="{{ $employee->departmentName }}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label>Account Status</label>
                    <select id="accountStatus">
                        <option value="Active" selected>Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <button class="btn-save" id="saveAccountBtn"><i class="fas fa-save"></i> Update Account</button>
            </div> -->

            <!-- Password Section -->
            <div class="card">
                <div class="card-title">
                    <i class="fas fa-key"></i> Security
                </div>
                <div class="password-section">
                    <div class="password-row">
                        <div>
                            <i class="fas fa-lock" style="color:#2c7a5e;"></i> <strong>Password</strong>
                            <!-- <p style="font-size:0.7rem; color:#8aa0ae; margin-top:4px;">Last changed: 30 days ago</p> -->
                        </div>
                        <button type="button" class="btn-change-pw" id="changePwBtn">
                            <i class="fas fa-redo-alt"></i> Change Password
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div id="passwordModal" class="modal">
    <div class="modal-content">
        <h3><i class="fas fa-key"></i> Change Password</h3>
        <form action="{{ route('manager.password.update') }}" method="POST">
            @csrf
                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" name="current_password" required placeholder="Enter current password">
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="new_password" required placeholder="Enter new password">
                </div>
                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" required placeholder="Confirm new password">
                </div>
                <div class="modal-buttons">
                    <button type="button" class="btn-secondary" id="cancelModalBtn">Cancel</button>
                    <button type="submit" class="btn-save" style="width: auto;">
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'toast-message';
            toast.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 2500);
        }

        // ================= PROFILE PICTURE =================
        const avatarContainer = document.getElementById('avatarContainer');
        const profileIcon = document.getElementById('profileIcon');
        const profileImg = document.getElementById('profileImg');
        const uploadBtn = document.getElementById('uploadBtn');
        const fileInput = document.getElementById('fileInput');

        const existingPicture = '{{ $employee->employeePicture }}';
        if (existingPicture && existingPicture !== 'null') {
            profileIcon.style.display = 'none';
            profileImg.style.display = 'block';
            profileImg.src = '/uploads/' + existingPicture;
            avatarContainer.style.background = 'transparent';
        }

        uploadBtn.addEventListener('click', () => fileInput.click());
        avatarContainer.addEventListener('click', () => fileInput.click());

        fileInput.addEventListener('change', (e) => {
            if (!e.target.files.length) return;

            const file = e.target.files[0];

            const reader = new FileReader();
            reader.onload = function(e) {
                profileIcon.style.display = 'none';
                profileImg.style.display = 'block';
                profileImg.src = e.target.result;
                avatarContainer.style.background = 'transparent';
            };
            reader.readAsDataURL(file);

            const formData = new FormData();
            formData.append('employeePicture', file);
            formData.append('_token', '{{ csrf_token() }}');

            fetch('{{ route("manager.profile.update") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(res => res.text())
            .then(() => showToast('Profile picture updated!'))
            .catch(() => alert('Upload failed'));
        });

        // ================= PASSWORD MODAL =================
        const modal = document.getElementById('passwordModal');
        const cancelModalBtn = document.getElementById('cancelModalBtn');
        const confirmPwBtn = document.getElementById('confirmPwBtn');

        changePwBtn.addEventListener('click', function () {
            modal.style.display = 'flex';
        });

        cancelModalBtn.addEventListener('click', function () {
            modal.style.display = 'none';
        });

        window.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });

        // ================= EXTRA =================
        setTimeout(() => {
            showToast('Welcome back, {{ auth()->user()->employeeName }}! 👋');
        }, 500);

    });
</script>
@endsection