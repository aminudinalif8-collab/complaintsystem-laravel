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
    }

    .dashboard-container {
        max-width: 100%;
        margin: 0 auto;
    }

    /* Header Row */
    .header-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 28px;
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
        padding: 8px 20px 8px 16px;
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
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        overflow: hidden;
        flex-shrink: 0;
    }

    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-info h4 {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--gray-800);
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

    .meta-info .dot {
        color: var(--gray-400);
    }

    /* Main Form Card */
    .form-card {
        background: white;
        border-radius: var(--radius-sm);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        border: 1px solid var(--gray-200);
    }

    .form-header {
        background: linear-gradient(135deg, var(--primary-dark) 0%, #1F4E4A 100%);
        padding: 24px 32px;
        color: white;
    }

    .form-header h2 {
        font-size: 1.4rem;
        font-weight: 600;
        margin: 0 0 6px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-header p {
        font-size: 0.85rem;
        opacity: 0.85;
        margin: 0;
    }

    .form-body {
        padding: 32px;
    }

    .form-grid {
        display: flex;
        flex-direction: column;
        gap: 28px;
    }

    .form-row {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-row label {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-500);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-row label i, .form-row label svg {
        opacity: 0.7;
    }

    .info-icon {
        cursor: pointer;
        color: var(--primary);
        transition: color 0.2s;
    }

    .info-icon:hover {
        color: var(--primary-dark);
    }

    .form-control {
        padding: 12px 16px;
        border-radius: var(--radius-md);
        border: 1.5px solid var(--gray-300);
        font-size: 0.9rem;
        transition: all 0.2s;
        background: white;
        font-family: inherit;
        width: 100%;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(44,110,92,0.1);
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2364748B' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    /* File Upload */
    .file-upload-area {
        border: 1.5px dashed var(--gray-300);
        border-radius: var(--radius-lg);
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background: var(--gray-50);
    }

    .file-upload-area:hover {
        border-color: var(--primary);
        background: var(--primary-light);
    }

    .file-upload-area.dragover {
        border-color: var(--primary);
        background: var(--primary-light);
    }

    .file-upload-icon {
        font-size: 2rem;
        color: var(--gray-400);
        margin-bottom: 8px;
    }

    .file-upload-text {
        font-size: 0.85rem;
        color: var(--gray-600);
    }

    .file-upload-hint {
        font-size: 0.7rem;
        color: var(--gray-400);
        margin-top: 8px;
    }

    .file-input {
        display: none;
    }

    .file-preview {
        margin-top: 16px;
        padding: 12px;
        background: white;
        border-radius: var(--radius-md);
        border: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        gap: 12px;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .file-preview-info {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.85rem;
        color: var(--gray-600);
    }

    .remove-file {
        color: var(--red);
        cursor: pointer;
        font-size: 0.8rem;
        padding: 4px 8px;
        border-radius: 20px;
        transition: all 0.2s;
    }

    .remove-file:hover {
        background: var(--red-soft);
    }

    /* Submit Button */
    .form-actions {
        margin-top: 16px;
        padding-top: 24px;
        border-top: 1px solid var(--gray-200);
    }

    .btn-submit {
        background: var(--primary);
        color: white;
        border: none;
        padding: 12px 32px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-submit:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    /* Helper Text */
    .helper-text {
        font-size: 0.7rem;
        color: var(--gray-400);
        margin-top: 4px;
    }

    .required-mark {
        color: var(--red);
        margin-left: 2px;
    }

    /* Responsive */
    /* Extra Small (< 480px) */
    @media (max-width: 479px) {
        .dashboard-container {
            padding: 12px;
        }

        .header-row {
            flex-direction: column;
            gap: 12px;
            margin-bottom: 20px;
        }

        .title-section h1 {
            font-size: 1.4rem;
        }

        .profile-card {
            width: 100%;
            padding: 12px;
        }

        .form-card {
            border-radius: 16px;
        }

        .form-header, .form-body {
            padding: 16px;
        }

        .form-section {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            font-size: 0.85rem;
        }

        .form-row {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .form-row .form-group {
            width: 100%;
        }

        input, select, textarea {
            font-size: 16px;
            padding: 12px;
        }

        .btn {
            width: 100%;
            padding: 12px 16px;
            font-size: 0.95rem;
        }

        .profile-card .profile-info .meta-info .email {
            display: none;
        }

        .profile-card .profile-info .meta-info {
            font-size: 0.8rem;
        }
    }

    /* Small Tablets (480px - 767px) */
    @media (min-width: 480px) and (max-width: 767px) {
        .dashboard-container {
            padding: 16px;
        }

        .form-header, .form-body {
            padding: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .title-section h1 {
            font-size: 1.6rem;
        }

        .profile-card {
            min-width: 0;
        }

        input, select, textarea {
            font-size: 16px;
        }

        .profile-card .profile-info .meta-info .email {
            display: none;
        }
    }

    /* Medium (768px - 991px) */
    @media (min-width: 768px) and (max-width: 991px) {
        .form-header, .form-body {
            padding: 24px;
        }

        .form-row {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        input, select, textarea {
            font-size: 0.95rem;
        }
    }

    /* Large Devices (992px+) */
    @media (min-width: 992px) {
        .dashboard-container {
            max-width: 1000px;
        }

        .form-header, .form-body {
            padding: 28px;
        }

        .form-row {
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
    }

    /* Accessibility */
    @media (prefers-reduced-motion: reduce) {
        * {
            animation-duration: 0.01ms !important;
            transition-duration: 0.01ms !important;
        }
    }

    /* Dark Mode */
    @media (prefers-color-scheme: dark) {
        .form-card {
            background: #2a2a2a;
            border-color: #444;
        }

        input, select, textarea {
            background: #3a3a3a;
            color: #e0e0e0;
            border-color: #555;
        }

        label {
            color: #d0d0d0;
        }
    }
</style>

<div class="dashboard-container">
    <!-- Header Row -->
    <div class="header-row">
        <div class="title-section">
            <h1>Submit Complaint</h1>
            <p>Report an issue or concern to the support team</p>
        </div>
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
    </div>

    <!-- Main Form Card -->
    <div class="form-card">
        <div class="form-header">
            <h2>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 12V8H4V12M20 12L12 5L4 12M20 12V20H4V12" stroke="white" stroke-width="2" stroke-linecap="round"/>
                    <path d="M12 15V17M8 15V17M16 15V17" stroke="white" stroke-width="2" stroke-linecap="round"/>
                </svg>
                New Complaint
            </h2>
            <p>Please provide detailed information to help us resolve your issue quickly</p>
        </div>

        <div class="form-body">
            <form action="{{ route('employee.submitComplaint.post') }}" method="POST" enctype="multipart/form-data" id="complaintForm">
                @csrf

                <div class="form-grid">
                    <!-- Complaint Title -->
                    <div class="form-row">
                        <label>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 6H21M6 6V4M18 6V4M8 12H16M10 16H14M4 20H20C21.1 20 22 19.1 22 18V8C22 6.9 21.1 6 20 6H4C2.9 6 2 6.9 2 8V18C2 19.1 2.9 20 4 20Z" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            Complaint Title
                            <span class="required-mark">*</span>
                        </label>
                        <input type="text" name="complaintTitle" class="form-control" placeholder="Enter a clear, descriptive title" required>
                    </div>

                    <!-- Category -->
                    <div class="form-row">
                        <label>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 8H10M14 8H17M7 12H10M14 12H17M7 16H10M14 16H17M5 20H19C20.1 20 21 19.1 21 18V6C21 4.9 20.1 4 19 4H5C3.9 4 3 4.9 3 6V18C3 19.1 3.9 20 5 20Z" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            Category
                            <span class="required-mark">*</span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="info-icon" id="categoryInfo">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                <path d="M12 16V12M12 8H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </label>
                        <select name="complaintCategory" class="form-control" required>
                            <option value="" disabled selected hidden>Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="form-row">
                        <label>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2"/>
                                <path d="M22 6L12 13L2 6" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            Description
                            <span class="required-mark">*</span>
                        </label>
                        <textarea name="complaintDescription" class="form-control" placeholder="Describe your issue in detail... Include any relevant information that may help us address your concern." required></textarea>
                        <div class="helper-text" id="charCounter">0 characters</div>
                    </div>

                    <!-- Attachment -->
                    <div class="form-row">
                        <label>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V9L13 2Z" stroke="currentColor" stroke-width="2"/>
                                <path d="M13 2V9H20" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            Attachment (Optional)
                        </label>
                        <div class="file-upload-area" id="fileUploadArea">
                            <div class="file-upload-icon">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 16V4M12 4L8 8M12 4L16 8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M4 16V18C4 19.1 4.9 20 6 20H18C19.1 20 20 19.1 20 20V16" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </div>
                            <div class="file-upload-text">Click or drag to upload a file</div>
                            <div class="file-upload-hint">JPG or PNG image only (Max 2MB)</div>
                            <input type="file" name="complaintEvidence" id="fileInput" class="file-input" accept="image/jpeg,image/png,.jpg,.jpeg,.png">
                        </div>
                        <div id="filePreview" class="file-preview" style="display: none;"></div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-actions">
                        <button type="submit" class="btn-submit" id="submitBtn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 2L11 13M22 2L15 22L11 13M22 2L2 9L11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            Submit Complaint
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // ==================== CHARACTER COUNTER ====================
    const descriptionField = document.querySelector('textarea[name="complaintDescription"]');
    const charCounter = document.getElementById('charCounter');

    if (descriptionField && charCounter) {
        function updateCharCount() {
            const len = descriptionField.value.length;
            charCounter.innerHTML = `${len} characters`;
        }
        updateCharCount();
        descriptionField.addEventListener('input', updateCharCount);
    }

    // ==================== FILE UPLOAD HANDLER ====================
    const fileUploadArea = document.getElementById('fileUploadArea');
    const fileInput = document.getElementById('fileInput');
    const filePreview = document.getElementById('filePreview');

    if (fileUploadArea && fileInput) {
        // Click to upload
        fileUploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        // Drag and drop
        fileUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileUploadArea.classList.add('dragover');
        });

        fileUploadArea.addEventListener('dragleave', () => {
            fileUploadArea.classList.remove('dragover');
        });

        fileUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            fileUploadArea.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                handleFilePreview(files[0]);
            }
        });

        // File input change
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFilePreview(e.target.files[0]);
            } else {
                clearFilePreview();
            }
        });
    }

    function handleFilePreview(file) {
        const allowedImageTypes = ['image/jpeg', 'image/png'];
        if (!allowedImageTypes.includes(file.type)) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid File Type',
                text: 'Only JPG and PNG image files are allowed.',
                confirmButtonColor: '#2C6E5C',
                borderRadius: '16px'
            });
            fileInput.value = '';
            clearFilePreview();
            return;
        }

        const maxSize = 2 * 1024 * 1024; // 2MB
        if (file.size > maxSize) {
            Swal.fire({
                icon: 'error',
                title: 'File Too Large',
                text: 'Maximum file size is 2MB.',
                confirmButtonColor: '#2C6E5C',
                borderRadius: '16px'
            });
            fileInput.value = '';
            clearFilePreview();
            return;
        }

        const fileSizeKB = (file.size / 1024).toFixed(1);
        const fileSizeStr = fileSizeKB < 1024 ? `${fileSizeKB} KB` : `${(file.size / (1024 * 1024)).toFixed(2)} MB`;
        
        let fileIcon = '';
        if (file.type.startsWith('image/')) {
            fileIcon = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="2" y="2" width="20" height="20" rx="4" stroke="currentColor" stroke-width="2"/><circle cx="8.5" cy="8.5" r="2.5" stroke="currentColor" stroke-width="2"/><path d="M21 15L16 10L5 21" stroke="currentColor" stroke-width="2"/></svg>';
        } else if (file.type === 'application/pdf') {
            fileIcon = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="2"/><path d="M14 2V8H20" stroke="currentColor" stroke-width="2"/></svg>';
        } else {
            fileIcon = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="2"/><path d="M14 2V8H20" stroke="currentColor" stroke-width="2"/></svg>';
        }

        filePreview.style.display = 'flex';
        filePreview.innerHTML = `
            <div class="file-preview-info">
                ${fileIcon}
                <span><strong>${file.name}</strong> (${fileSizeStr})</span>
            </div>
            <div class="remove-file" id="removeFileBtn">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2"/>
                </svg>
                Remove
            </div>
        `;

        const removeBtn = document.getElementById('removeFileBtn');
        if (removeBtn) {
            removeBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                fileInput.value = '';
                clearFilePreview();
            });
        }
    }

    function clearFilePreview() {
        filePreview.style.display = 'none';
        filePreview.innerHTML = '';
    }

    // ==================== CATEGORY INFO MODAL ====================
    const categoryInfo = document.getElementById('categoryInfo');
    if (categoryInfo) {
        categoryInfo.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Complaint Categories Guide',
                html: `
                    <div style="text-align:left; font-size:0.85rem; line-height:1.7; max-height: 500px; overflow-y: auto;">
                        <div style="margin-bottom: 12px;"><strong style="color:#2C6E5C;">IT & System Issues</strong><br>Issues related to software, hardware, and general technical system problems</div>
                        <div style="margin-bottom: 12px;"><strong style="color:#2C6E5C;">System Access & Security</strong><br>Login access, user permissions, network issues, and cybersecurity concerns</div>
                        <div style="margin-bottom: 12px;"><strong style="color:#2C6E5C;">Finance & Billing</strong><br>Billing, payment processing, and financial-related matters</div>
                        <div style="margin-bottom: 12px;"><strong style="color:#2C6E5C;">Payroll & Salary</strong><br>Salary payment, payslips, deductions, and payroll issues</div>
                        <div style="margin-bottom: 12px;"><strong style="color:#2C6E5C;">Procurement & Purchasing</strong><br>Purchase requests, supplier management, and procurement processes</div>
                        <div style="margin-bottom: 12px;"><strong style="color:#2C6E5C;">Human Resource</strong><br>HR policies, employee-related administrative matters</div>
                        <div style="margin-bottom: 12px;"><strong style="color:#2C6E5C;">Workplace Conduct & Harassment</strong><br>Employee behaviour, disciplinary issues, and harassment cases</div>
                        <div style="margin-bottom: 12px;"><strong style="color:#2C6E5C;">Attendance & Leave</strong><br>Attendance records, leave applications, and approval issues</div>
                        <div style="margin-bottom: 12px;"><strong style="color:#2C6E5C;">Facility & Maintenance</strong><br>Building facilities, repairs, and maintenance-related issues</div>
                        <div style="margin-bottom: 12px;"><strong style="color:#2C6E5C;">Office Equipment & Environment</strong><br>Office furniture, equipment, air conditioning, and workplace environment</div>
                        <div style="margin-bottom: 12px;"><strong style="color:#2C6E5C;">Transportation & Parking</strong><br>Parking arrangements and transportation-related issues</div>
                        <div style="margin-bottom: 12px;"><strong style="color:#2C6E5C;">Management & Communication</strong><br>Management decisions and internal communication issues</div>
                        <div style="margin-bottom: 12px;"><strong style="color:#2C6E5C;">Policy & Compliance</strong><br>Company policies, rule compliance, and safety regulations</div>
                        <div style="margin-bottom: 12px;"><strong style="color:#2C6E5C;">Customer Service</strong><br>Service-related complaints and customer interaction issues</div>
                        <div style="margin-bottom: 12px;"><strong style="color:#2C6E5C;">Training & Performance</strong><br>Training programs and employee performance-related matters</div>
                        <div><strong style="color:#2C6E5C;">Other</strong><br>Any issue not covered in the above categories</div>
                    </div>
                `,
                icon: 'info',
                confirmButtonColor: '#2C6E5C',
                width: '700px',
                borderRadius: '16px'
            });
        });
    }

    // ==================== SUCCESS/ERROR ALERTS ====================
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Complaint Submitted',
            text: "{{ session('success') }}",
            timer: 3000,
            showConfirmButton: true,
            confirmButtonColor: '#2C6E5C',
            timerProgressBar: true,
            borderRadius: '16px'
        }).then(() => {
            // Optional: reset form or redirect
            document.getElementById('complaintForm')?.reset();
            clearFilePreview();
            if (charCounter) charCounter.innerHTML = '0 characters';
        });
    @endif

    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Submission Error',
            html: `
                <ul style="text-align:left;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
            confirmButtonColor: '#DC2626',
            borderRadius: '16px'
        });
    @endif
</script>

@endsection