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

    /* Main Card */
    .details-card {
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
    }

    .status-pending { background: rgba(217, 119, 6, 0.2); color: #FDE68A; }
    .status-progress { background: rgba(37, 99, 235, 0.2); color: #93C5FD; }
    .status-resolved { background: rgba(5, 150, 105, 0.2); color: #6EE7B7; }
    .status-rejected { background: rgba(220, 38, 38, 0.2); color: #FCA5A5; }
    .status-cancelled { background: rgba(100, 116, 139, 0.2); color: #CBD5E1; }

    .complaint-title {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 4px;
        line-height: 1.3;
        letter-spacing: -0.01em;
    }

    /* Content Section */
    .content-section {
        padding: 32px;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px 32px;
        margin-bottom: 28px;
    }

    .info-item {
        padding: 10px 0;
        border-bottom: 1px solid var(--gray-100);
    }

    .info-item .label {
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-500);
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .info-item .value {
        font-size: 0.95rem;
        font-weight: 500;
        color: var(--gray-800);
    }

    /* Description Box */
    .description-box {
        background: var(--gray-50);
        border-radius: var(--radius-lg);
        padding: 20px 24px;
        margin-bottom: 24px;
        border: 1px solid var(--gray-200);
    }

    .description-box .label {
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-500);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .description-box p {
        line-height: 1.6;
        color: var(--gray-700);
        font-size: 0.95rem;
    }

    /* ================================================================
       REDESIGNED ATTACHMENT SECTION
    ================================================================ */
    .attachment-section {
        background: var(--gray-50);
        border-radius: var(--radius-lg);
        padding: 24px;
        border: 1px solid var(--gray-200);
        margin-bottom: 28px;
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

    .attachment-badge.no-file {
        background: var(--gray-100);
        color: var(--gray-500);
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

    /* Timeline Section */
    .timeline-section {
        margin-bottom: 28px;
    }

    .timeline-section .label {
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-500);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .timeline-item {
        display: flex;
        gap: 16px;
        padding: 14px 0;
        border-bottom: 1px solid var(--gray-100);
        position: relative;
    }

    .timeline-item:last-child {
        border-bottom: none;
    }

    .timeline-icon {
        width: 40px;
        height: 40px;
        background: var(--primary-light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        flex-shrink: 0;
    }

    .timeline-content {
        flex: 1;
    }

    .timeline-content .title {
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--gray-800);
        margin-bottom: 2px;
    }

    .timeline-content .description {
        font-size: 0.85rem;
        color: var(--gray-600);
        margin-bottom: 2px;
    }

    .timeline-content .date {
        font-size: 0.7rem;
        color: var(--gray-400);
        margin-top: 4px;
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

    .btn-primary-custom {
        background: var(--primary);
        color: white;
        border: none;
        padding: 10px 28px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: inherit;
    }

    .btn-primary-custom:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
        text-decoration: none;
    }

    .btn-danger-custom {
        background: white;
        border: 1.5px solid var(--red);
        color: var(--red);
        padding: 10px 28px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: inherit;
    }

    .btn-danger-custom:hover {
        background: var(--red-soft);
        border-color: var(--red);
        transform: translateY(-1px);
    }

    .btn-secondary-custom {
        background: var(--gray-100);
        border: 1.5px solid var(--gray-200);
        padding: 10px 28px;
        border-radius: 40px;
        font-weight: 500;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        color: var(--gray-600);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: inherit;
    }

    .btn-secondary-custom:hover {
        background: var(--gray-200);
        transform: translateX(-2px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .main-content {
            padding: 20px;
        }
        .info-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        .complaint-hero {
            padding: 20px;
        }
        .complaint-title {
            font-size: 1.2rem;
        }
        .content-section {
            padding: 20px;
        }
        .action-buttons {
            flex-direction: column;
            align-items: stretch;
        }
        .action-buttons .btn-primary-custom,
        .action-buttons .btn-danger-custom,
        .action-buttons .btn-secondary-custom {
            justify-content: center;
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
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .page-header h1 {
            font-size: 1.3rem;
        }
    }

    @media (max-width: 480px) {
        .attachment-info {
            flex-wrap: wrap;
        }
        .attachment-preview img {
            max-width: 100%;
        }
    }
</style>

<div class="main-content">
    <!-- Page Header -->
    <div class="page-header">
        <h1><i class="fas fa-file-alt"></i> Complaint Details</h1>
        <button type="button" class="back-btn" id="backBtn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Back to Complaints
        </button>
    </div>

    <!-- Main Details Card -->
    <div class="details-card">
        <!-- Hero Header -->
        <div class="complaint-hero">
            <div class="complaint-meta">
                <span class="complaint-id">
                    <i class="fas fa-hashtag"></i> Complaint ID: C{{ str_pad($complaint->complaintID, 3, '0', STR_PAD_LEFT) }}
                </span>
                @php
                    $statusClass = match($complaint->complaintStatus) {
                        'Pending' => 'status-pending',
                        'In Progress' => 'status-progress',
                        'Resolved' => 'status-resolved',
                        'Rejected' => 'status-rejected',
                        'Cancelled' => 'status-cancelled',
                        default => ''
                    };
                @endphp
                <span class="status-pill {{ $statusClass }}">
                    <i class="fas fa-circle" style="font-size: 0.5rem;"></i>
                    {{ $complaint->complaintStatus }}
                </span>
            </div>
            <div class="complaint-title">
                {{ $complaint->complaintTitle }}
            </div>
        </div>

        <!-- Content Section -->
        <div class="content-section">
            <!-- Info Grid -->
            <div class="info-grid">
                <div class="info-item">
                    <div class="label"><i class="fas fa-tag"></i> Category</div>
                    <div class="value">{{ $complaint->complaintCategory }}</div>
                </div>
                <div class="info-item">
                    <div class="label"><i class="fas fa-calendar-alt"></i> Date Submitted</div>
                    <div class="value">{{ \Carbon\Carbon::parse($complaint->complaintDate)->format('d M Y') }}</div>
                </div>
                <div class="info-item">
                    <div class="label"><i class="fas fa-user"></i> Submitted By</div>
                    <div class="value">{{ $complaint->employee->employeeName ?? 'N/A' }} ({{ $complaint->employee->formatted_employee_id ?? 'N/A' }})</div>
                </div>
                <div class="info-item">
                    <div class="label"><i class="fas fa-building"></i> Department</div>
                    <div class="value">{{ $complaint->employee->department?->departmentName ?? 'N/A' }}</div>
                </div>
                <div class="info-item">
                    <div class="label"><i class="fas fa-flag-checkered"></i> Priority</div>
                    <div class="value">
                        @if($complaint->complaintPriority == 'High')
                            <span class="status-badge priority-high">High</span>
                        @elseif($complaint->complaintPriority == 'Medium')
                            <span class="status-badge priority-medium">Medium</span>
                        @elseif($complaint->complaintPriority == 'Urgent')
                            <span class="status-badge priority-high">Urgent</span>
                        @else
                            <span class="status-badge priority-low">Low</span>
                        @endif
                    </div>
                </div>
                <div class="info-item">
                    <div class="label"><i class="fas fa-user-check"></i> Assigned To</div>
                    <div class="value">
                        @if($complaint->employee && $complaint->employee->supervisor)
                            {{ $complaint->employee->supervisor->employeeName ?? 'N/A' }}
                            ({{ $complaint->employee->supervisor->formatted_employee_id }})
                        @else
                            <span style="color: var(--gray-400);">Not Assigned</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="description-box">
                <div class="label"><i class="fas fa-align-left"></i> Description</div>
                <p>{{ $complaint->complaintDescription }}</p>
            </div>

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
                            <span class="attachment-badge no-file">No file</span>
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
                            @endif
                            <a href="{{ $complaint->complaintEvidence }}" download class="btn-download">
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
            </div>

            <!-- Timeline Section -->
            <div class="timeline-section">
                <div class="label"><i class="fas fa-history"></i> Activity Timeline</div>

                <!-- Submitted -->
                <div class="timeline-item">
                    <div class="timeline-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 12V8H4V12M20 12L12 5L4 12M20 12V20H4V12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="timeline-content">
                        <div class="title">Complaint Submitted</div>
                        <div class="description">Complaint was successfully submitted and registered in the system.</div>
                        <div class="date">{{ $complaint->created_at->format('F d, Y - h:i A') }}</div>
                    </div>
                </div>

                <!-- Reviewed -->
                @if($complaint->actions->count() > 0)
                <div class="timeline-item">
                    <div class="timeline-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 12C1 12 4 4 12 4C20 4 23 12 23 12C23 12 20 20 12 20C4 20 1 12 1 12Z" stroke="currentColor" stroke-width="2"/>
                            <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <div class="timeline-content">
                        <div class="title">Complaint Reviewed</div>
                        <div class="description">The support team has reviewed this complaint and initiated the process.</div>
                        <div class="date">{{ $complaint->actions->first()->created_at->format('F d, Y - h:i A') }}</div>
                    </div>
                </div>
                @endif

                <!-- Actions with Approval -->
                @foreach($complaint->actions as $action)
                    @if($action->approval)
                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 8V12L15 15M21 12C21 16.97 16.97 21 12 21C7.03 21 3 16.97 3 12C3 7.03 7.03 3 12 3C16.97 21 21 16.97 21 12Z" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="timeline-content">
                            <div class="title">Status Updated to "In Progress"</div>
                            <div class="description">
                                Supervisor <strong>{{ $action->supervisor->employeeName }}</strong> has been assigned to handle this complaint.
                            </div>
                            @if($action->actionDescription)
                                <div class="description" style="margin-top: 6px; background: var(--gray-100); padding: 8px 12px; border-radius: var(--radius-md);">
                                    <em>"{{ $action->actionDescription }}"</em>
                                </div>
                            @endif
                            <div class="date">{{ $action->created_at->format('F d, Y - h:i A') }}</div>
                        </div>
                    </div>
                    @endif
                @endforeach

                <!-- Resolved -->
                @if($complaint->complaintStatus == 'Resolved')
                <div class="timeline-item">
                    <div class="timeline-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="timeline-content">
                        <div class="title">Complaint Resolved</div>
                        <div class="description">This complaint has been resolved. Thank you for your patience.</div>
                        <div class="date">{{ $complaint->updated_at->format('F d, Y - h:i A') }}</div>
                    </div>
                </div>
                @endif

                <!-- Cancelled -->
                @if($complaint->complaintStatus == 'Cancelled')
                <div class="timeline-item">
                    <div class="timeline-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="timeline-content">
                        <div class="title">Complaint Cancelled</div>
                        <div class="description">This complaint has been cancelled.</div>
                        <div class="date">{{ $complaint->updated_at->format('F d, Y - h:i A') }}</div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('manager.editComplaint', ['id' => $complaint->complaintID]) }}" class="btn-primary-custom">
                    <i class="fas fa-edit"></i> Edit Complaint
                </a>
                <a href="{{ route('manager.viewComplaints') }}" class="btn-secondary-custom">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ==================== DELETE BUTTON ====================
        const deleteBtn = document.getElementById('deleteBtn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function() {
                Swal.fire({
                    title: 'Delete Complaint?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#DC2626',
                    cancelButtonColor: '#94A3B8',
                    confirmButtonText: 'Yes, delete it',
                    cancelButtonText: 'Cancel',
                    borderRadius: '16px'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Complaint has been deleted successfully.',
                            confirmButtonColor: '#2C6E5C',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = "{{ route('manager.viewComplaints') }}";
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
                    confirmButtonColor: '#2C6E5C',
                    cancelButtonColor: '#94A3B8',
                    confirmButtonText: 'Yes, go back',
                    cancelButtonText: 'Stay',
                    borderRadius: '16px'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('manager.viewComplaints') }}";
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

<!-- Priority Badge Styles -->
<style>
    .priority-high { background: #FEF2F2; color: #DC2626; padding: 2px 10px; border-radius: 40px; font-size: 0.7rem; font-weight: 600; }
    .priority-medium { background: #FFFBEB; color: #D97706; padding: 2px 10px; border-radius: 40px; font-size: 0.7rem; font-weight: 600; }
    .priority-low { background: #ECFDF5; color: #059669; padding: 2px 10px; border-radius: 40px; font-size: 0.7rem; font-weight: 600; }
    .status-badge { padding: 2px 10px; border-radius: 40px; font-size: 0.7rem; font-weight: 600; display: inline-block; }
</style>

@endsection