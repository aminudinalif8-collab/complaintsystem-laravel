@extends('supervisor.sidebar')

@section('content')

<!-- Locked Alert -->
@if(!$isEditable)
    <div class="alert alert-warning" style="background:#FFF9E6; border-left:4px solid #FFB800; padding:14px 20px; border-radius:10px; margin-bottom:24px; color:#8A6E00; display:flex; align-items:center; gap:10px;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 8V12M12 16H12.01M3 12C3 13.1819 3.23279 14.3522 3.68508 15.4442C4.13738 16.5361 4.80031 17.5282 5.63604 18.364C6.47177 19.1997 7.46392 19.8626 8.55585 20.3149C9.64778 20.7672 10.8181 21 12 21C13.1819 21 14.3522 20.7672 15.4442 20.3149C16.5361 19.8626 17.5282 19.1997 18.364 18.364C19.1997 17.5282 19.8626 16.5361 20.3149 15.4442C20.7672 14.3522 21 13.1819 21 12C21 9.61305 20.0518 7.32387 18.364 5.63604C16.6761 3.94821 14.3869 3 12 3C9.61305 3 7.32387 3.94821 5.63604 5.63604C3.94821 7.32387 3 9.61305 3 12Z" stroke="#8A6E00" stroke-width="2" stroke-linecap="round"/>
        </svg>
        <span><strong>Read-Only Mode:</strong> This complaint can no longer be edited because it is already In Progress, Resolved, or Cancelled.</span>
    </div>
@endif

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

    /* Page Header */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .page-header h1 {
        font-size: 1.6rem;
        font-weight: 600;
        color: var(--gray-800);
        letter-spacing: -0.02em;
        margin: 0;
        line-height: 1.3;
    }

    .page-header h1 i {
        color: var(--primary);
        margin-right: 6px;
    }

    .back-btn {
        background: white;
        border: 1.5px solid var(--gray-200);
        padding: 10px 20px;
        border-radius: 40px;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        color: var(--gray-600);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: inherit;
    }

    .back-btn:hover {
        background: var(--gray-50);
        border-color: var(--gray-300);
        transform: translateX(-2px);
    }

    /* Main Card */
    .edit-card {
        background: white;
        border-radius: var(--radius-xl);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    /* Hero Header */
    .complaint-hero {
        background: linear-gradient(135deg, var(--primary-dark) 0%, #1F4E4A 100%);
        padding: 24px 32px;
        color: white;
    }

    .complaint-meta {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 12px;
    }

    .complaint-id {
        font-size: 0.8rem;
        font-weight: 500;
        background: rgba(255, 255, 255, 0.12);
        padding: 4px 12px;
        border-radius: 30px;
        letter-spacing: 0.3px;
        backdrop-filter: blur(4px);
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 500;
        backdrop-filter: blur(4px);
        background: rgba(255, 255, 255, 0.12);
    }

    .complaint-title {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 4px;
        line-height: 1.3;
        letter-spacing: -0.01em;
    }

    /* Form Section */
    .form-section {
        padding: 32px;
    }

    .form-grid {
        display: flex;
        flex-direction: column;
        gap: 24px;
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

    .form-row label i {
        opacity: 0.7;
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

    .form-control:disabled {
        background: var(--gray-50);
        border-color: var(--gray-200);
        color: var(--gray-600);
        cursor: not-allowed;
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2364748B' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .row-2cols {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    /* Locked Alert */
    .locked-alert {
        background: var(--blue-soft);
        border-left: 4px solid var(--blue);
        padding: 16px 20px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .locked-alert i {
        color: var(--blue);
        font-size: 1.2rem;
    }

    .locked-alert p {
        color: var(--gray-700);
        font-weight: 500;
        margin: 0;
        font-size: 0.9rem;
    }

    /* Action History */
    .history-section {
        background: var(--gray-50);
        border-radius: var(--radius-lg);
        padding: 20px;
        border: 1px solid var(--gray-200);
    }

    .history-section .title {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--gray-800);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .history-item {
        background: white;
        padding: 16px;
        border-radius: var(--radius-md);
        margin-bottom: 12px;
        border-left: 4px solid var(--primary);
        box-shadow: var(--shadow-sm);
    }

    .history-item:last-child {
        margin-bottom: 0;
    }

    .history-item .header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 6px;
        flex-wrap: wrap;
        gap: 8px;
    }

    .history-item .header .status {
        font-weight: 600;
        color: var(--gray-800);
        font-size: 0.9rem;
    }

    .history-item .header .date {
        font-size: 0.8rem;
        color: var(--gray-400);
    }

    .history-item .description {
        color: var(--gray-600);
        font-size: 0.85rem;
        margin-bottom: 4px;
        line-height: 1.5;
    }

    .history-item .by {
        font-size: 0.75rem;
        color: var(--gray-400);
        margin-top: 4px;
    }

    /* ================================================================
       REDESIGNED ATTACHMENT SECTION
    ================================================================ */
    .attachment-section {
        background: var(--gray-50);
        border-radius: var(--radius-lg);
        padding: 24px;
        border: 1px solid var(--gray-200);
        margin: 8px 0;
        transition: all 0.2s;
    }

    .attachment-section:hover {
        border-color: var(--gray-300);
    }

    .attachment-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }

    .attachment-title {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-500);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .attachment-title svg {
        color: var(--primary);
        flex-shrink: 0;
    }

    .attachment-badge {
        font-size: 0.6rem;
        background: var(--primary-light);
        color: var(--primary);
        padding: 2px 10px;
        border-radius: 30px;
        font-weight: 600;
    }

    /* Current Attachment Display */
    .current-attachment {
        background: white;
        border-radius: var(--radius-md);
        padding: 16px 20px;
        border: 1px solid var(--gray-200);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        transition: all 0.2s;
    }

    .current-attachment:hover {
        border-color: var(--gray-300);
        box-shadow: var(--shadow-sm);
    }

    .attachment-info {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .attachment-icon-wrapper {
        width: 44px;
        height: 44px;
        background: var(--primary-light);
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .attachment-icon-wrapper svg {
        width: 22px;
        height: 22px;
        color: var(--primary);
    }

    .attachment-details {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .attachment-details .filename {
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--gray-800);
    }

    .attachment-details .filesize {
        font-size: 0.7rem;
        color: var(--gray-400);
    }

    .attachment-actions {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .btn-view {
        background: var(--gray-100);
        color: var(--gray-600);
        border: 1px solid var(--gray-200);
        padding: 6px 16px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-family: inherit;
    }

    .btn-view:hover {
        background: var(--gray-200);
        border-color: var(--gray-300);
        text-decoration: none;
    }

    .btn-download {
        background: var(--primary);
        color: white;
        border: none;
        padding: 6px 16px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-family: inherit;
    }

    .btn-download:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        text-decoration: none;
    }

    .no-attachment {
        color: var(--gray-400);
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 4px 0;
    }

    .no-attachment svg {
        color: var(--gray-300);
    }

    /* Upload Area */
    .upload-area {
        border: 2px dashed var(--gray-300);
        border-radius: var(--radius-md);
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background: white;
        position: relative;
    }

    .upload-area:hover {
        border-color: var(--primary);
        background: var(--primary-light);
    }

    .upload-area.dragover {
        border-color: var(--primary);
        background: var(--primary-light);
    }

    .upload-area.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .upload-area.disabled:hover {
        border-color: var(--gray-300);
        background: white;
    }

    .upload-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }

    .upload-content .upload-icon {
        width: 48px;
        height: 48px;
        background: var(--gray-100);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray-400);
        transition: all 0.2s;
    }

    .upload-area:hover .upload-icon {
        background: var(--primary-light);
        color: var(--primary);
    }

    .upload-content .upload-text {
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--gray-600);
    }

    .upload-content .upload-hint {
        font-size: 0.7rem;
        color: var(--gray-400);
    }

    .file-input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .file-input:disabled {
        cursor: not-allowed;
    }

    .upload-area .file-preview {
        display: none;
        margin-top: 12px;
        padding: 12px 16px;
        background: var(--gray-50);
        border-radius: var(--radius-md);
        border: 1px solid var(--gray-200);
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }

    .upload-area .file-preview.show {
        display: flex;
    }

    .file-preview-info {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.85rem;
        color: var(--gray-600);
    }

    .file-preview-info .file-name {
        font-weight: 500;
        color: var(--gray-800);
    }

    .btn-remove-file {
        background: var(--red-soft);
        color: var(--red);
        border: none;
        padding: 4px 12px;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        font-family: inherit;
    }

    .btn-remove-file:hover {
        background: var(--red);
        color: white;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 16px;
        margin-top: 8px;
        padding-top: 24px;
        border-top: 1px solid var(--gray-200);
        flex-wrap: wrap;
        align-items: center;
    }

    .btn-save {
        background: var(--primary);
        color: white;
        border: none;
        padding: 10px 28px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: inherit;
    }

    .btn-save:hover:not(:disabled) {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-save:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .btn-cancel {
        background: white;
        border: 1.5px solid var(--gray-200);
        color: var(--gray-600);
        padding: 10px 28px;
        border-radius: 40px;
        font-weight: 500;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: inherit;
        text-decoration: none;
    }

    .btn-cancel:hover {
        background: var(--gray-50);
        border-color: var(--gray-300);
        transform: translateX(-2px);
    }

    .btn-delete {
        background: white;
        border: 1.5px solid var(--red);
        color: var(--red);
        padding: 10px 28px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: inherit;
        margin-left: auto;
    }

    .btn-delete:hover {
        background: var(--red-soft);
        transform: translateY(-1px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .main-content {
            padding: 20px;
        }
        .row-2cols {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        .complaint-hero {
            padding: 20px;
        }
        .complaint-title {
            font-size: 1.2rem;
        }
        .form-section {
            padding: 20px;
        }
        .action-buttons {
            flex-direction: column;
            align-items: stretch;
        }
        .btn-delete {
            margin-left: 0;
        }
        .action-buttons .btn-save,
        .action-buttons .btn-cancel,
        .action-buttons .btn-delete {
            justify-content: center;
        }
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .page-header h1 {
            font-size: 1.3rem;
        }
        .attachment-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }
        .current-attachment {
            flex-direction: column;
            align-items: flex-start;
        }
        .attachment-actions {
            width: 100%;
            justify-content: flex-start;
        }
    }

    @media (max-width: 480px) {
        .history-item .header {
            flex-direction: column;
        }
        .attachment-info {
            flex-wrap: wrap;
        }
    }
</style>

<div class="main-content">
    <!-- Page Header -->
    <div class="page-header">
        <h1><i class="fas fa-edit"></i> Edit Complaint</h1>
        <a href="{{ route('supervisor.viewComplaints') }}" class="back-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Back to Complaints
        </a>
    </div>

    <!-- Main Edit Card -->
    <div class="edit-card">
        <!-- Hero Header -->
        <div class="complaint-hero">
            <div class="complaint-meta">
                <span class="complaint-id">
                    <i class="fas fa-hashtag"></i> Complaint ID: C{{ str_pad($complaint->complaintID, 3, '0', STR_PAD_LEFT) }}
                </span>
                <span class="status-pill">
                    <i class="fas fa-circle" style="font-size: 0.5rem;"></i>
                    {{ $complaint->complaintStatus }}
                </span>
            </div>
            <div class="complaint-title">
                {{ $complaint->complaintTitle }}
            </div>
        </div>

        <!-- Form Section -->
        <div class="form-section">
            <form id="complaintForm" action="{{ route('supervisor.updateComplaint', $complaint->complaintID) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-grid">
                    <!-- Title -->
                    <div class="form-row">
                        <label><i class="fas fa-heading"></i> Complaint Title</label>
                        <input type="text" name="complaintTitle" value="{{ $complaint->complaintTitle }}" class="form-control" disabled>
                    </div>

                    <!-- Category & Priority -->
                    <div class="row-2cols">
                        <div class="form-row">
                            <label><i class="fas fa-tag"></i> Category</label>
                            <select name="complaintCategory" class="form-control" disabled>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ $complaint->complaintCategory == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-row">
                            <label><i class="fas fa-flag-checkered"></i> Priority Level</label>
                            <select class="form-control" disabled>
                                <option value="Low" {{ $complaint->complaintPriority == 'Low' ? 'selected' : '' }}>Low</option>
                                <option value="Medium" {{ $complaint->complaintPriority == 'Medium' ? 'selected' : '' }}>Medium</option>
                                <option value="High" {{ $complaint->complaintPriority == 'High' ? 'selected' : '' }}>High</option>
                                <option value="Urgent" {{ $complaint->complaintPriority == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                            </select>
                            <input type="hidden" name="complaintPriority" value="{{ $complaint->complaintPriority }}">
                        </div>
                    </div>

                    <!-- Status & Remark -->
                    <div class="row-2cols">
                        <div class="form-row">
                            <label><i class="fas fa-chart-line"></i> Status</label>
                            <select name="complaintStatus" class="form-control" {{ !$isEditable ? 'disabled' : '' }}>
                                <option value="Pending" {{ $complaint->complaintStatus == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="In Progress" {{ $complaint->complaintStatus == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            </select>
                        </div>

                        <div class="form-row">
                            <label><i class="fas fa-comment"></i> Remark / Action <span style="color: var(--red);">*</span></label>
                            <textarea name="actionDescription" class="form-control" placeholder="Write your remark here..." {{ !$isEditable ? 'disabled' : '' }} required></textarea>
                        </div>
                    </div>

                    <!-- Assigned To -->
                    <div class="form-row">
                        <label><i class="fas fa-user-check"></i> Assigned To</label>
                        <div style="padding: 12px 16px; border-radius: var(--radius-md); border: 1.5px solid var(--gray-300); background: var(--gray-50); font-size: 0.9rem; color: var(--gray-600);">
                            @if($supervisor)
                                {{ $supervisor->employeeName }}
                                <span style="font-size: 0.75rem; color: var(--gray-400);">
                                    ({{ auth()->user()->formatted_employee_id }})
                                </span>
                            @else
                                <span style="color: var(--gray-400);">Unassigned</span>
                            @endif
                        </div>
                        <input type="hidden" name="assignedTo" value="{{ $supervisor->employeeID ?? '' }}">
                    </div>

                    <!-- Date Submitted & Submitted By -->
                    <div class="row-2cols">
                        <div class="form-row">
                            <label><i class="fas fa-calendar-alt"></i> Date Submitted</label>
                            <input type="text" value="{{ \Carbon\Carbon::parse($complaint->complaintDate)->format('F d, Y') }}" class="form-control" disabled>
                        </div>
                        <div class="form-row">
                            <label><i class="fas fa-user"></i> Submitted By</label>
                            <input type="text" value="{{ $employee->employeeName }} ({{ $employee->formatted_employee_id }})" class="form-control" disabled>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="form-row">
                        <label><i class="fas fa-align-left"></i> Description</label>
                        <textarea name="complaintDescription" class="form-control" disabled>{{ $complaint->complaintDescription }}</textarea>
                    </div>

                    <!-- Action History -->
                    @if($actions->count() > 0)
                    <div class="history-section">
                        <div class="title"><i class="fas fa-history"></i> Action History</div>
                        @foreach($actions as $action)
                            <div class="history-item">
                                <div class="header">
                                    <span class="status">Status: {{ $action->actionStatus }}</span>
                                    <span class="date">{{ \Carbon\Carbon::parse($action->actionDate)->format('M d, Y H:i') }}</span>
                                </div>
                                <div class="description">{{ $action->actionDescription }}</div>
                                @if($action->supervisor)
                                    <div class="by">By: {{ $action->supervisor->employeeName }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- ============================================================
                    REDESIGNED ATTACHMENT SECTION
                    ============================================================ -->
                    <div class="attachment-section">
                        <div class="attachment-header">
                            <div class="attachment-title">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V9L13 2Z" stroke="currentColor" stroke-width="2"/>
                                    <path d="M13 2V9H20" stroke="currentColor" stroke-width="2"/>
                                </svg>
                                Attachments
                                @if($complaint->complaintEvidence)
                                    <span class="attachment-badge">1 file</span>
                                @else
                                    <span class="attachment-badge" style="background: var(--gray-100); color: var(--gray-500);">No file</span>
                                @endif
                            </div>
                            @if($complaint->complaintEvidence)
                                <span style="font-size: 0.7rem; color: var(--gray-400);">Uploaded on {{ $complaint->created_at->format('d M Y') }}</span>
                            @endif
                        </div>

                        <!-- Current Attachment Display -->
                        <div class="current-attachment">
                            @if($complaint->complaintEvidence)
                                @php
                                    $ext = pathinfo($complaint->complaintEvidence, PATHINFO_EXTENSION);
                                    $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
                                    $fileSize = file_exists(public_path('uploads/complaints/'.$complaint->complaintEvidence)) 
                                        ? number_format(filesize(public_path('uploads/complaints/'.$complaint->complaintEvidence)) / 1024, 1) . ' KB' 
                                        : 'Unknown size';
                                @endphp

                                <div class="attachment-info">
                                    <div class="attachment-icon-wrapper">
                                        @if($isImage)
                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect x="2" y="2" width="20" height="20" rx="4" stroke="currentColor" stroke-width="2"/>
                                                <circle cx="8.5" cy="8.5" r="2.5" stroke="currentColor" stroke-width="2"/>
                                                <path d="M21 15L16 10L5 21" stroke="currentColor" stroke-width="2"/>
                                            </svg>
                                        @else
                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="2"/>
                                                <path d="M14 2V8H20" stroke="currentColor" stroke-width="2"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="attachment-details">
                                        <span class="filename">{{ basename($complaint->complaintEvidence) }}</span>
                                        <span class="filesize">{{ $fileSize }}</span>
                                    </div>
                                </div>

                                <div class="attachment-actions">
                                    @if($isImage)
                                        <a href="{{ $complaint->complaintEvidence }}" target="_blank" class="btn-view">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 12C1 12 4 4 12 4C20 4 23 12 23 12C23 12 20 20 12 20C4 20 1 12 1 12Z" stroke="currentColor" stroke-width="2"/>
                                                <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                                            </svg>
                                            Preview
                                        </a>
                                    @endif                                    <a href="{{ $complaint->complaintEvidence }}" download class="btn-download">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 16V4M12 4L8 8M12 4L16 8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            <path d="M4 16V18C4 19.1 4.9 20 6 20H18C19.1 20 20 19.1 20 20V16" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                        Download
                                    </a>
                                </div>
                            @else
                                <div class="no-attachment">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V9L13 2Z" stroke="currentColor" stroke-width="2"/>
                                        <path d="M13 2V9H20" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                    <span>No attachment has been uploaded for this complaint.</span>
                                </div>
                            @endif
                        </div>

                        <!-- Upload Area -->
                        @if($isEditable)
                            <div class="upload-area" id="uploadArea">
                                <div class="upload-content">
                                    <div class="upload-icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 16V4M12 4L8 8M12 4L16 8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            <path d="M4 16V18C4 19.1 4.9 20 6 20H18C19.1 20 20 19.1 20 20V16" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                    </div>
                                    <span class="upload-text">
                                        <strong>Click to upload</strong> or drag and drop
                                    </span>
                                    <span class="upload-hint">JPG or PNG image only (Max 5MB)</span>
                                </div>
                                <input type="file" name="complaintEvidence" id="fileInput" class="file-input" accept="image/jpeg,image/png,.jpg,.jpeg,.png">

                                <!-- File Preview (appears after selection) -->
                                <div class="file-preview" id="filePreview">
                                    <div class="file-preview-info">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V9L13 2Z" stroke="currentColor" stroke-width="2"/>
                                            <path d="M13 2V9H20" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                        <span class="file-name" id="fileName">document.pdf</span>
                                        <span id="fileSize">(0 KB)</span>
                                    </div>
                                    <button type="button" class="btn-remove-file" id="removeFileBtn">Remove</button>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        @if($isEditable)
                            <button type="submit" class="btn-save">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                            <button type="button" class="btn-cancel" id="cancelBtn">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('complaintForm');
        const fileInput = document.getElementById('fileInput');
        const filePreview = document.getElementById('filePreview');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const removeFileBtn = document.getElementById('removeFileBtn');
        const uploadArea = document.getElementById('uploadArea');

        // ==================== FILE UPLOAD HANDLER ====================
        if (fileInput && uploadArea) {
            // Click to upload
            uploadArea.addEventListener('click', function(e) {
                if (e.target.closest('.btn-remove-file')) return;
                if (!this.classList.contains('disabled')) {
                    fileInput.click();
                }
            });

            // Drag and drop
            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                if (!this.classList.contains('disabled')) {
                    this.classList.add('dragover');
                }
            });

            uploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
            });

            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
                if (this.classList.contains('disabled')) return;
                
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    handleFilePreview(files[0]);
                }
            });

            // File input change
            fileInput.addEventListener('change', function(e) {
                if (this.files.length > 0) {
                    handleFilePreview(this.files[0]);
                } else {
                    resetFilePreview();
                }
            });

            // Remove file button
            if (removeFileBtn) {
                removeFileBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    fileInput.value = '';
                    resetFilePreview();
                });
            }
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
                resetFilePreview();
                return;
            }

            const maxSize = 5 * 1024 * 1024; // 5MB
            if (file.size > maxSize) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: 'Maximum file size is 5MB.',
                    confirmButtonColor: '#2C6E5C',
                    borderRadius: '16px'
                });
                fileInput.value = '';
                resetFilePreview();
                return;
            }

            const sizeKB = (file.size / 1024).toFixed(1);
            const sizeStr = sizeKB < 1024 ? sizeKB + ' KB' : (file.size / (1024 * 1024)).toFixed(2) + ' MB';
            
            fileName.textContent = file.name;
            fileSize.textContent = '(' + sizeStr + ')';
            filePreview.classList.add('show');
            
            // Change upload area style
            const uploadContent = uploadArea.querySelector('.upload-content');
            if (uploadContent) {
                uploadContent.style.display = 'none';
            }
            filePreview.style.display = 'flex';
        }

        function resetFilePreview() {
            filePreview.classList.remove('show');
            filePreview.style.display = 'none';
            const uploadContent = uploadArea.querySelector('.upload-content');
            if (uploadContent) {
                uploadContent.style.display = 'flex';
            }
            fileName.textContent = 'image.jpg';
            fileSize.textContent = '(0 KB)';
        }

        // ==================== FORM SUBMIT ====================
        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const isEditable = {{ $isEditable ? 'true' : 'false' }};
                if (!isEditable) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Form Locked',
                        text: 'This complaint has already been acted upon and cannot be edited.',
                        confirmButtonColor: '#e4685b'
                    });
                    return;
                }

                const remark = document.querySelector('textarea[name="actionDescription"]').value.trim();
                if (remark.length < 5) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Invalid Remark',
                        text: 'Please enter a remark with at least 5 characters.',
                        confirmButtonColor: '#f59e0b'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Confirm Update?',
                    text: "Are you sure you want to update this complaint status and save your remark?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#2c7a5e',
                    cancelButtonColor: '#e4685b',
                    confirmButtonText: 'Yes, update it',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        }

        // ==================== CANCEL BUTTON ====================
        const cancelBtn = document.getElementById('cancelBtn');
        if (cancelBtn) {
            cancelBtn.addEventListener('click', () => {
                Swal.fire({
                    title: 'Go back?',
                    text: 'Return to complaints list?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#2c7a5e',
                    cancelButtonColor: '#8aa0ae',
                    confirmButtonText: 'Yes, go back',
                    cancelButtonText: 'Stay'
                }).then((r) => {
                    if (r.isConfirmed) {
                        window.location.href = "{{ route('supervisor.viewComplaints') }}";
                    }
                });
            });
        }

        // ==================== DELETE BUTTON ====================
        const deleteBtn = document.getElementById('deleteBtn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', () => {
                Swal.fire({
                    title: 'Delete Complaint?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e4685b',
                    cancelButtonColor: '#8aa0ae',
                    confirmButtonText: 'Yes, delete it',
                    cancelButtonText: 'Cancel'
                }).then((r) => {
                    if (r.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Complaint has been deleted.',
                            confirmButtonColor: '#2c7a5e',
                            timer: 2000
                        }).then(() => {
                            window.location.href = "{{ route('supervisor.viewComplaints') }}";
                        });
                    }
                });
            });
        }

        // ==================== ESCAPE KEY ====================
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                Swal.fire({
                    title: 'Go back?',
                    text: 'Return to complaints list?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#2c7a5e',
                    cancelButtonColor: '#8aa0ae',
                    confirmButtonText: 'Yes, go back',
                    cancelButtonText: 'Stay'
                }).then((r) => {
                    if (r.isConfirmed) {
                        window.location.href = "{{ route('supervisor.viewComplaints') }}";
                    }
                });
            }
        });

        // ==================== SUCCESS/ERROR ALERTS ====================
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#2c7a5e',
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#e4685b'
            });
        @endif
    });
</script>

@endsection