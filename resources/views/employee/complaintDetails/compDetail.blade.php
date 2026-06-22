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

    .details-container {
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
        cursor: pointer;
    }

    .back-btn:hover {
        background: var(--gray-50);
        border-color: var(--gray-400);
        transform: translateX(-2px);
    }

    /* Main Card */
    .details-card {
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
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 500;
        backdrop-filter: blur(4px);
    }

    .status-pending {
        background: rgba(217, 119, 6, 0.2);
        color: #FDE68A;
    }
    .status-progress {
        background: rgba(37, 99, 235, 0.2);
        color: #93C5FD;
    }
    .status-resolved {
        background: rgba(5, 150, 105, 0.2);
        color: #6EE7B7;
    }
    .status-rejected {
        background: rgba(220, 38, 38, 0.2);
        color: #FCA5A5;
    }
    .status-cancelled {
        background: rgba(100, 116, 139, 0.2);
        color: #CBD5E1;
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

    /* Content Sections */
    .content-section {
        padding: 32px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-bottom: 32px;
    }

    .info-card {
        background: var(--gray-50);
        border-radius: var(--radius-lg);
        padding: 20px;
        border: 1px solid var(--gray-200);
        transition: all 0.2s;
    }

    .info-card:hover {
        border-color: var(--gray-300);
        box-shadow: var(--shadow-sm);
    }

    .info-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        color: var(--gray-500);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .info-value {
        font-size: 1rem;
        font-weight: 500;
        color: var(--gray-800);
        word-break: break-word;
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

    /* Description Box */
    .description-box {
        background: var(--gray-50);
        border-radius: var(--radius-lg);
        padding: 24px;
        margin: 24px 0;
        border: 1px solid var(--gray-200);
    }

    .section-title {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--gray-700);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .description-box p {
        line-height: 1.6;
        color: var(--gray-700);
        font-size: 0.95rem;
    }

    /* Attachment Section */
    .attachment-section {
        margin: 24px 0;
    }

    .attachment-preview {
        background: var(--gray-50);
        border-radius: var(--radius-lg);
        padding: 20px;
        border: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .attachment-preview img {
        max-width: 240px;
        border-radius: var(--radius-md);
        border: 1px solid var(--gray-200);
        box-shadow: var(--shadow-sm);
        transition: transform 0.2s;
    }

    .attachment-preview img:hover {
        transform: scale(1.02);
    }

    .file-info {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        color: var(--gray-600);
    }

    .no-attachment {
        color: var(--gray-400);
        font-style: italic;
    }

    /* Timeline Section */
    .timeline-section {
        margin: 32px 0;
    }

    .timeline-item {
        display: flex;
        gap: 16px;
        padding: 16px 0;
        border-bottom: 1px solid var(--gray-200);
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

    .timeline-title {
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--gray-800);
        margin-bottom: 4px;
    }

    .timeline-description {
        font-size: 0.85rem;
        color: var(--gray-600);
        margin-top: 4px;
    }

    .timeline-date {
        font-size: 0.7rem;
        color: var(--gray-400);
        margin-top: 6px;
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
        text-decoration: none;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
        box-shadow: var(--shadow-sm);
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-danger {
        background: white;
        border: 1.5px solid var(--red);
        color: var(--red);
    }

    .btn-danger:hover {
        background: var(--red-soft);
        border-color: var(--red);
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

    /* Responsive */
    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .complaint-hero {
            padding: 20px;
        }

        .content-section {
            padding: 20px;
        }

        .complaint-title {
            font-size: 1.3rem;
        }

        .action-buttons {
            flex-direction: column;
            align-items: stretch;
        }

        .btn {
            justify-content: center;
        }
    }
</style>

<div class="details-container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="header-title">
            <h1>Complaint Details</h1>
            <p>View complete information and activity history</p>
        </div>
        <button type="button" class="back-btn" id="backBtn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Back to Complaints
        </button>
    </div>

    <!-- Main Card -->
    <div class="details-card">
        <!-- Hero Header -->
        <div class="complaint-hero">
            <div class="complaint-meta">
                <span class="complaint-id">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: inline; margin-right: 4px;">
                        <path d="M7 20L4 17M4 17L7 14M4 17H16M17 4L20 7M20 7L17 10M20 7H8" stroke="white" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Complaint ID: C{{ str_pad($complaint->complaintID, 3, '0', STR_PAD_LEFT) }}
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
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                        <path d="M12 8V12L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    {{ $complaint->complaintStatus }}
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
                    By: {{ $complaint->employee->employeeName }}
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-section">
            <!-- Information Grid -->
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-label">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 8H10M14 8H17M7 12H10M14 12H17M7 16H10M14 16H17M5 20H19C20.1 20 21 19.1 21 18V6C21 4.9 20.1 4 19 4H5C3.9 4 3 4.9 3 6V18C3 19.1 3.9 20 5 20Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        Category
                    </div>
                    <div class="info-value">{{ $complaint->complaintCategory }}</div>
                </div>

                <div class="info-card">
                    <div class="info-label">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L15 8.5L22 9.5L17 14L18.5 21L12 17.5L5.5 21L7 14L2 9.5L9 8.5L12 2Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        Priority Level
                    </div>
                    <div class="info-value">
                        @if($complaint->complaintPriority == 'High')
                            <span class="priority-badge" style="background:#FEF2F2; color:#DC2626;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2V8M12 8L8 4M12 8L16 4" stroke="currentColor" stroke-width="2"/>
                                </svg>
                                High
                            </span>
                        @elseif($complaint->complaintPriority == 'Medium')
                            <span class="priority-badge" style="background:#FFFBEB; color:#D97706;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2V12M12 12L8 8M12 12L16 8" stroke="currentColor" stroke-width="2"/>
                                </svg>
                                Medium
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
                                Low
                            </span>
                        @endif
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-label">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12ZM12 14C9.33 14 4 15.34 4 18V20H20V18C20 15.34 14.67 14 12 14Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        Assigned To
                    </div>
                    <div class="info-value">
                        @if($complaint->employee && $complaint->employee->supervisor)
                            {{ $complaint->employee->supervisor->employeeName }}
                            <span style="font-size: 0.75rem; color: var(--gray-400);">
                                ({{ $complaint->employee->supervisor->formatted_employee_id ?? 'EMP-' . $complaint->employee->supervisor->employeeID }})
                            </span>
                        @else
                            <span class="no-attachment">Not Assigned</span>
                        @endif
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-label">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 6H21M6 6V4M18 6V4M8 12H16M10 16H14M4 20H20C21.1 20 22 19.1 22 18V8C22 6.9 21.1 6 20 6H4C2.9 6 2 6.9 2 8V18C2 19.1 2.9 20 4 20Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        Department
                    </div>
                    <div class="info-value">{{ $complaint->employee->department?->departmentName ?? 'N/A' }}</div>
                </div>
            </div>

            <!-- Description Box -->
            <div class="description-box">
                <div class="section-title">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M22 6L12 13L2 6" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    Description
                </div>
                <p>{{ $complaint->complaintDescription }}</p>
            </div>

            <!-- Attachment Section -->
            <div class="attachment-section">
                <div class="section-title">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V9L13 2Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M13 2V9H20" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    Attachments
                </div>
                <div class="attachment-preview">
                    @if($complaint->complaintEvidence)
                        @php
                            $ext = pathinfo($complaint->complaintEvidence, PATHINFO_EXTENSION);
                            $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                        @endphp
                        @if($isImage)
                            <a href="{{ $complaint->complaintEvidence }}" target="_blank">
                                <img src="{{ $complaint->complaintEvidence }}" alt="Complaint Attachment">
                            </a>
                        @else
                            <div class="file-info">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="2"/>
                                    <path d="M14 2V8H20" stroke="currentColor" stroke-width="2"/>
                                </svg>
                                <a href="{{ $complaint->complaintEvidence }}" target="_blank" style="color: var(--primary); text-decoration: none;">
                                    Download Attachment
                                </a>
                            </div>
                        @endif
                    @else
                        <span class="no-attachment">No attachment uploaded</span>
                    @endif
                </div>
            </div>

            <!-- Timeline Section -->
            <div class="timeline-section">
                <div class="section-title">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 8V12L15 15M12 2V4M4 12H2M6.3 6.3L4.9 4.9M17.7 6.3L19.1 4.9M22 12H20M6.3 17.7L4.9 19.1M17.7 17.7L19.1 19.1" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Activity Timeline
                </div>

                <!-- Complaint Submitted -->
                <div class="timeline-item">
                    <div class="timeline-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 12V8H4V12M20 12L12 5L4 12M20 12V20H4V12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-title">Complaint Submitted</div>
                        <div class="timeline-description">Your complaint has been successfully submitted and registered in the system.</div>
                        <div class="timeline-date">{{ $complaint->created_at->format('F d, Y - h:i A') }}</div>
                    </div>
                </div>

                <!-- Complaint Reviewed -->
                @if($complaint->actions->count() > 0)
                <div class="timeline-item">
                    <div class="timeline-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 12C1 12 4 4 12 4C20 4 23 12 23 12C23 12 20 20 12 20C4 20 1 12 1 12Z" stroke="currentColor" stroke-width="2"/>
                            <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-title">Complaint Reviewed</div>
                        <div class="timeline-description">The support team has reviewed your complaint and initiated the process.</div>
                        <div class="timeline-date">{{ $complaint->actions->first()->created_at->format('F d, Y - h:i A') }}</div>
                    </div>
                </div>
                @endif

                <!-- Actions with Approval -->
                @foreach($complaint->actions as $action)
                    @if($action->approval)
                        <div class="timeline-item">
                            <div class="timeline-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 8V12L15 15M21 12C21 16.97 16.97 21 12 21C7.03 21 3 16.97 3 12C3 7.03 7.03 3 12 3C16.97 3 21 7.03 21 12Z" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-title">Status Updated to "In Progress"</div>
                                <div class="timeline-description">
                                    Supervisor <strong>{{ $action->supervisor->employeeName }}</strong> has been assigned to handle this complaint.
                                </div>
                                @if($action->actionDescription)
                                    <div class="timeline-description" style="margin-top: 6px; background: var(--gray-100); padding: 8px 12px; border-radius: var(--radius-md);">
                                        <em>"{{ $action->actionDescription }}"</em>
                                    </div>
                                @endif
                                <div class="timeline-date">{{ $action->created_at->format('F d, Y - h:i A') }}</div>
                            </div>
                        </div>
                    @endif
                @endforeach

                <!-- Complaint Resolved -->
                @if($complaint->complaintStatus == 'Resolved')
                <div class="timeline-item">
                    <div class="timeline-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-title">Complaint Resolved</div>
                        <div class="timeline-description">Your complaint has been resolved. Thank you for your patience.</div>
                        <div class="timeline-date">{{ $complaint->updated_at->format('F d, Y - h:i A') }}</div>
                    </div>
                </div>
                @endif

                <!-- Complaint Cancelled -->
                @if($complaint->complaintStatus == 'Cancelled')
                <div class="timeline-item">
                    <div class="timeline-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-title">Complaint Cancelled</div>
                        <div class="timeline-description">This complaint has been cancelled.</div>
                        <div class="timeline-date">{{ $complaint->updated_at->format('F d, Y - h:i A') }}</div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('employee.editComplaint', ['id' => $complaint->complaintID]) }}" class="btn btn-primary" id="editBtn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 3L21 7L7 21H3V17L17 3Z" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    Edit Complaint
                </a>
                <button class="btn btn-danger" id="deleteBtn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 6H5H21" stroke="currentColor" stroke-width="2"/>
                        <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    Cancel Complaint
                </button>
                <button type="button" class="btn btn-secondary" id="backBottomBtn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Back to List
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Hidden Delete Form -->
<form id="cancelComplaintForm" action="{{ route('employee.cancelComplaint', $complaint->complaintID) }}" method="POST" style="display:none;">
    @csrf
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Navigation helper
    function goBack() {
        window.location.href = "{{ route('employee.myComplaints') }}";
    }

    // Back button handlers
    const backBtn = document.getElementById('backBtn');
    const backBottomBtn = document.getElementById('backBottomBtn');

    const handleBackClick = (e) => {
        e.preventDefault();
        goBack();
    };

    if (backBtn) backBtn.addEventListener('click', handleBackClick);
    if (backBottomBtn) backBottomBtn.addEventListener('click', handleBackClick);

    // Cancel / Delete Complaint Handler
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
                borderRadius: '16px',
                customClass: {
                    popup: 'swal-popup'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cancelComplaintForm').submit();
                }
            });
        });
    }

    // ESC key handler
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            Swal.fire({
                title: 'Go Back?',
                text: 'You will be redirected to your complaints list.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2C6E5C',
                cancelButtonColor: '#94A3B8',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Stay',
                borderRadius: '16px'
            }).then((result) => {
                if (result.isConfirmed) {
                    goBack();
                }
            });
        }
    });
</script>

@if($complaint->complaintStatus == 'Pending')
<script>
    document.addEventListener("DOMContentLoaded", function () {

        const priority = "{{ $complaint->complaintPriority }}";

        const slaMap = {
            "High": "We will take action within 24 hours.",
            "Medium": "We will take action within 2–3 days.",
            "Low": "We will take action within 5–7 days."
        };

        Swal.fire({
            title: "Complaint Response Time",
            html: `
                <div style="font-size:14px; line-height:1.6;">
                    <strong>Priority:</strong> ${priority} <br><br>
                    ${slaMap[priority] ?? 'We will review your complaint soon.'}
                </div>
            `,
            icon: "info",
            confirmButtonColor: "#2C6E5C",
            confirmButtonText: "Got it"
        });

    });
</script>
@endif

@endsection