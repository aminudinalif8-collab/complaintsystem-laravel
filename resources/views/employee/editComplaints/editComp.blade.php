@extends('employee.sidebar')
@section('content')

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
    }

    .edit-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 4px;
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

    .header-title h1 {
        font-size: 1.75rem;
        font-weight: 600;
        color: var(--gray-800);
        letter-spacing: -0.02em;
        margin: 0;
        line-height: 1.3;
    }

    .header-title p {
        font-size: 0.875rem;
        color: var(--gray-500);
        margin-top: 4px;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: white;
        padding: 8px 18px;
        border-radius: 40px;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--gray-600);
        text-decoration: none;
        border: 1px solid var(--gray-300);
        transition: all 0.2s ease;
        box-shadow: var(--shadow-sm);
    }

    .back-btn:hover {
        background: var(--gray-50);
        border-color: var(--gray-400);
        transform: translateX(-2px);
    }

    /* Main Card */
    .edit-card {
        background: white;
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        border: 1px solid var(--gray-200);
    }

    /* Hero Section */
    .complaint-hero {
        background: linear-gradient(135deg, var(--primary-dark) 0%, #1F4E4A 100%);
        padding: 28px 32px;
        color: white;
    }

    .complaint-meta {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 20px;
    }

    .complaint-id {
        font-size: 0.8rem;
        font-weight: 500;
        background: rgba(255,255,255,0.12);
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
        background: rgba(255,255,255,0.12);
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 500;
        backdrop-filter: blur(4px);
    }

    .complaint-title {
        font-size: 1.6rem;
        font-weight: 600;
        margin-bottom: 12px;
        line-height: 1.3;
        letter-spacing: -0.01em;
    }

    .complaint-brief {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 16px;
        font-size: 0.85rem;
        opacity: 0.85;
    }

    .brief-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Form Sections */
    .form-section {
        padding: 32px;
    }

    .form-grid {
        display: flex;
        flex-direction: column;
        gap: 28px;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
    }

    .form-row-3 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group label {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-500);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .form-group label i, .form-group label svg {
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

    .form-control:disabled, .form-control[readonly] {
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

    /* Static Display (for non-editable fields) */
    .static-value {
        background: var(--gray-50);
        border: 1.5px solid var(--gray-200);
        border-radius: var(--radius-md);
        padding: 12px 16px;
        font-size: 0.9rem;
        color: var(--gray-700);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 8px;
    }

    .priority-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* Attachment Section */
    .attachment-section {
        background: var(--gray-50);
        border-radius: var(--radius-lg);
        padding: 24px;
        margin-top: 8px;
        border: 1px solid var(--gray-200);
    }

    .attachment-title {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        color: var(--gray-500);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .current-attachment {
        background: white;
        border-radius: var(--radius-md);
        padding: 16px;
        margin-bottom: 20px;
        border: 1px solid var(--gray-200);
    }

    .attachment-preview {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .attachment-preview img {
        max-width: 200px;
        border-radius: var(--radius-md);
        border: 1px solid var(--gray-200);
        box-shadow: var(--shadow-sm);
    }

    .file-info {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        color: var(--gray-600);
    }

    .upload-area {
        margin-top: 16px;
    }

    .upload-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: white;
        border: 1px dashed var(--gray-400);
        border-radius: 40px;
        padding: 8px 20px;
        font-size: 0.8rem;
        font-weight: 500;
        color: var(--gray-600);
        cursor: pointer;
        transition: all 0.2s;
    }

    .upload-label:hover {
        background: var(--gray-100);
        border-color: var(--primary);
        color: var(--primary);
    }

    .file-input {
        display: none;
    }

    .helper-text {
        font-size: 0.7rem;
        color: var(--gray-400);
        margin-top: 8px;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 16px;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid var(--gray-200);
        align-items: center;
        flex-wrap: wrap;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 28px;
        border-radius: 40px;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
        font-family: inherit;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
        box-shadow: var(--shadow-sm);
    }

    .btn-primary:hover:not(:disabled) {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-primary:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .btn-secondary {
        background: white;
        border: 1.5px solid var(--gray-300);
        color: var(--gray-600);
    }

    .btn-secondary:hover {
        background: var(--gray-50);
        border-color: var(--gray-400);
    }

    .btn-danger {
        background: white;
        border: 1.5px solid var(--red);
        color: var(--red);
        margin-left: auto;
    }

    .btn-danger:hover:not(:disabled) {
        background: var(--red-soft);
        border-color: var(--red);
    }

    .btn-danger:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background: var(--gray-100);
        border-color: var(--gray-300);
        color: var(--gray-400);
    }

    /* Divider */
    .section-divider {
        height: 1px;
        background: var(--gray-200);
        margin: 8px 0 20px 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-row, .form-row-3 {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .complaint-hero {
            padding: 20px;
        }
        
        .form-section {
            padding: 20px;
        }
        
        .action-buttons {
            flex-direction: column;
            align-items: stretch;
        }
        
        .btn-danger {
            margin-left: 0;
        }
        
        .btn {
            justify-content: center;
        }
    }
</style>

<div class="edit-container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="header-title">
            <h1>Edit Complaint</h1>
            <p>Update complaint details and track changes</p>
        </div>
        <button type="button" class="back-btn" id="cancelBtn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Back to Complaints
        </button>
    </div>

    <!-- Main Card -->
    <div class="edit-card">
        <!-- Hero Header -->
        <div class="complaint-hero">
            <div class="complaint-meta">
                <span class="complaint-id">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: inline; margin-right: 4px;">
                        <path d="M7 20L4 17M4 17L7 14M4 17H16M17 4L20 7M20 7L17 10M20 7H8" stroke="white" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Complaint ID: C{{ str_pad($complaint->complaintID, 3, '0', STR_PAD_LEFT) }}
                </span>
                <span class="status-pill">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="10" stroke="white" stroke-width="2"/>
                        <path d="M12 8V12L15 15" stroke="white" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Current Status: {{ $complaint->complaintStatus }}
                </span>
            </div>
            <div class="complaint-title">
                {{ $complaint->complaintTitle }}
            </div>
            <div class="complaint-brief">
                <div class="brief-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="3" y="4" width="18" height="18" rx="2" stroke="white" stroke-width="2"/>
                        <line x1="8" y1="2" x2="8" y2="6" stroke="white" stroke-width="2"/>
                        <line x1="16" y1="2" x2="16" y2="6" stroke="white" stroke-width="2"/>
                        <path d="M3 10H21" stroke="white" stroke-width="2"/>
                    </svg>
                    Submitted: {{ \Carbon\Carbon::parse($complaint->complaintDate)->format('F d, Y') }}
                </div>
                <div class="brief-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 21V19C20 16.8 18.2 15 16 15H8C5.8 15 4 16.8 4 19V21" stroke="white" stroke-width="2"/>
                        <circle cx="12" cy="7" r="4" stroke="white" stroke-width="2"/>
                    </svg>
                    Submitted By: {{ $employee->employeeName }}
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="form-section">
            <form action="{{ route('employee.updateComplaint', $complaint->complaintID) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">
                    <!-- Title -->
                    <div class="form-group">
                        <label>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 6H21M6 6V4M18 6V4M8 12H16M10 16H14M4 20H20C21.1 20 22 19.1 22 18V8C22 6.9 21.1 6 20 6H4C2.9 6 2 6.9 2 8V18C2 19.1 2.9 20 4 20Z" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            Complaint Title
                        </label>
                        <input type="text" name="complaintTitle" value="{{ $complaint->complaintTitle }}" class="form-control" {{ !$isEditable ? 'disabled' : '' }}>
                    </div>

                    <!-- Category & Priority Row -->
                    <div class="form-row">
                        <div class="form-group">
                            <label>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 8H10M14 8H17M7 12H10M14 12H17M7 16H10M14 16H17M5 20H19C20.1 20 21 19.1 21 18V6C21 4.9 20.1 4 19 4H5C3.9 4 3 4.9 3 6V18C3 19.1 3.9 20 5 20Z" stroke="currentColor" stroke-width="2"/>
                                </svg>
                                Category
                            </label>
                            <select name="complaintCategory" class="form-control" {{ !$isEditable ? 'disabled' : '' }}>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ $complaint->complaintCategory == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2L15 8.5L22 9.5L17 14L18.5 21L12 17.5L5.5 21L7 14L2 9.5L9 8.5L12 2Z" stroke="currentColor" stroke-width="2"/>
                                </svg>
                                Priority
                            </label>
                            <div class="static-value">
                                @if($complaint->complaintPriority == 'High')
                                    <span class="priority-badge" style="background:#FEF2F2; color:#DC2626;">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 2V8M12 8L8 4M12 8L16 4" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                        High Priority
                                    </span>
                                @elseif($complaint->complaintPriority == 'Medium')
                                    <span class="priority-badge" style="background:#FFFBEB; color:#D97706;">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 2V12M12 12L8 8M12 12L16 8" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                        Medium Priority
                                    </span>
                                @elseif($complaint->complaintPriority == 'Urgent')
                                    <span class="priority-badge" style="background:#FEF2F2; color:#DC2626;">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 2V2.5M12 2.5L8 6.5M12 2.5L16 6.5" stroke="currentColor" stroke-width="2"/>
                                            <circle cx="12" cy="16" r="6" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                        Urgent
                                    </span>
                                @else
                                    <span class="priority-badge" style="background:#ECFDF5; color:#059669;">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 2V6M12 6L9 3M12 6L15 3" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                        Low Priority
                                    </span>
                                @endif
                                <input type="hidden" name="complaintPriority" value="{{ $complaint->complaintPriority }}">
                            </div>
                        </div>
                    </div>

                    <!-- Status & Assigned To -->
                    <div class="form-row">
                        <div class="form-group">
                            <label>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                    <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2"/>
                                </svg>
                                Status
                            </label>
                            <div class="static-value">
                                <span>{{ $complaint->complaintStatus }}</span>
                                <input type="hidden" name="complaintStatus" value="{{ $complaint->complaintStatus }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12ZM12 14C9.33 14 4 15.34 4 18V20H20V18C20 15.34 14.67 14 12 14Z" stroke="currentColor" stroke-width="2"/>
                                </svg>
                                Assigned To
                            </label>
                            <div class="static-value">
                                @if($supervisor)
                                    {{ $supervisor->employeeName }}
                                @else
                                    <span style="color: var(--gray-400);">Unassigned</span>
                                @endif
                                <input type="hidden" name="assignedTo" value="{{ $supervisor->employeeID ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2"/>
                                <path d="M22 6L12 13L2 6" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            Description
                        </label>
                        <textarea name="complaintDescription" class="form-control" id="description" {{ !$isEditable ? 'disabled' : '' }}>{{ $complaint->complaintDescription }}</textarea>
                    </div>

                    <!-- Attachment Section -->
                    <div class="attachment-section">
                        <div class="attachment-title">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V9L13 2Z" stroke="currentColor" stroke-width="2"/>
                                <path d="M13 2V9H20" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            Supporting Documents
                        </div>

                        <div id="attachmentsList" class="current-attachment">
                            @if($complaint->complaintEvidence)
                                <div class="attachment-preview">
                                    @php
                                        $ext = pathinfo($complaint->complaintEvidence, PATHINFO_EXTENSION);
                                        $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                    @endphp
                                    @if($isImage)
                                        <a href="{{ $complaint->complaintEvidence }}" target="_blank">
                                            <img src="{{ $complaint->complaintEvidence }}" alt="Attachment">
                                        </a>
                                    @else
                                        <div class="file-info">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="2"/>
                                                <path d="M14 2V8H20" stroke="currentColor" stroke-width="2"/>
                                            </svg>
                                            <a href="{{ $complaint->complaintEvidence }}" target="_blank" style="color: var(--primary); text-decoration: none;">
                                                View Attachment
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div class="file-info">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V9L13 2Z" stroke="currentColor" stroke-width="2"/>
                                        <path d="M13 2V9H20" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                    <span>No attachment uploaded</span>
                                </div>
                            @endif
                        </div>

                        @if($isEditable)
                            <div class="upload-area">
                                <label class="upload-label" for="fileInput">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 16V4M12 4L8 8M12 4L16 8" stroke="currentColor" stroke-width="2"/>
                                        <path d="M4 16V18C4 19.1 4.9 20 6 20H18C19.1 20 20 19.1 20 18V16" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                    Replace or Add Attachment
                                </label>
                                <input type="file" name="complaintEvidence" id="fileInput" class="file-input" accept="image/jpeg,image/png,.jpg,.jpeg,.png">
                                <div class="helper-text">Supported formats: JPG or PNG image only (Max 5MB)</div>
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <button type="submit" class="btn btn-primary" {{ !$isEditable ? 'disabled' : '' }}>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 21H5C3.9 21 3 20.1 3 19V5C3 3.9 3.9 3 5 3H16L21 8V19C21 20.1 20.1 21 19 21Z" stroke="currentColor" stroke-width="2"/>
                                <path d="M12 21V15H8V21M16 3V8H21" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            Save Changes
                        </button>
                        <button type="button" class="btn btn-secondary" id="cancelBtn2">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            Cancel
                        </button>
                        <button type="button" class="btn btn-danger" id="deleteBtn"
                            {{ $complaint->complaintStatus !== 'Pending' ? 'disabled' : '' }}>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 6H5H21" stroke="currentColor" stroke-width="2"/>
                                <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            Cancel Complaint
                        </button>
                    </div>
                </div>
            </form>

            <!-- Hidden Delete Form -->
            <form id="cancelComplaintForm" action="{{ route('employee.cancelComplaint', $complaint->complaintID) }}" method="POST" style="display:none;">
                @csrf
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Helper function to navigate back
    function goBack() {
        window.location.href = "{{ route('employee.myComplaints') }}";
    }

    // Back button handlers
    const cancelBtn = document.getElementById('cancelBtn');
    const cancelBtn2 = document.getElementById('cancelBtn2');

    const handleCancelClick = () => {
        Swal.fire({
            title: 'Discard Changes?',
            text: 'Any unsaved changes will be lost.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2C6E5C',
            cancelButtonColor: '#94A3B8',
            confirmButtonText: 'Yes, go back',
            cancelButtonText: 'Stay',
            borderRadius: '16px',
            customClass: {
                popup: 'swal-popup'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                goBack();
            }
        });
    };

    if (cancelBtn) cancelBtn.addEventListener('click', handleCancelClick);
    if (cancelBtn2) cancelBtn2.addEventListener('click', handleCancelClick);

    // Cancel Complaint handler
    const deleteBtn = document.getElementById('deleteBtn');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', () => {
            Swal.fire({
                title: 'Cancel Complaint?',
                text: 'This complaint will be marked as Cancelled. This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DC2626',
                cancelButtonColor: '#94A3B8',
                confirmButtonText: 'Yes, cancel it',
                cancelButtonText: 'No, keep it',
                borderRadius: '16px'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cancelComplaintForm').submit();
                }
            });
        });
    }

    // Character counter for description
    const descriptionField = document.getElementById('description');
    if (descriptionField) {
        const charCounter = document.createElement('div');
        charCounter.style.fontSize = '0.7rem';
        charCounter.style.color = '#94A3B8';
        charCounter.style.marginTop = '6px';
        charCounter.style.textAlign = 'right';
        descriptionField.parentNode.appendChild(charCounter);

        function updateCharCount() {
            const len = descriptionField.value.length;
            charCounter.innerHTML = `${len} characters`;
        }

        updateCharCount();
        descriptionField.addEventListener('input', updateCharCount);
    }

    // File preview handler
    const fileInput = document.getElementById('fileInput');
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

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
                return;
            }

            const maxSize = 5 * 1024 * 1024;
            if (file.size > maxSize) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: 'Maximum file size is 5MB.',
                    confirmButtonColor: '#2C6E5C',
                    borderRadius: '16px'
                });
                fileInput.value = '';
                return;
            }

            const attachmentsList = document.getElementById('attachmentsList');
            attachmentsList.innerHTML = '';

            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    attachmentsList.innerHTML = `
                        <div class="attachment-preview">
                            <img src="${event.target.result}" alt="Preview">
                            <div class="file-info">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V9L13 2Z" stroke="currentColor" stroke-width="2"/>
                                    <path d="M13 2V9H20" stroke="currentColor" stroke-width="2"/>
                                </svg>
                                <span>${file.name}</span>
                            </div>
                        </div>
                    `;
                };
                reader.readAsDataURL(file);
            } else {
                attachmentsList.innerHTML = `
                    <div class="attachment-preview">
                        <div class="file-info">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="2"/>
                                <path d="M14 2V8H20" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span>${file.name}</span>
                        </div>
                    </div>
                `;
            }
        });
    }

    // ESC key handler
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            Swal.fire({
                title: 'Discard Changes?',
                text: 'Any unsaved changes will be lost.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2C6E5C',
                cancelButtonColor: '#94A3B8',
                confirmButtonText: 'Yes',
                borderRadius: '16px'
            }).then((result) => {
                if (result.isConfirmed) {
                    goBack();
                }
            });
        }
    });
</script>

@endsection