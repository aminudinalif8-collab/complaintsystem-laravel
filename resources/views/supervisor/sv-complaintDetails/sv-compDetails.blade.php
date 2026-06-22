@extends('supervisor.sidebar')

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
        gap: 20px;
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
        padding: 28px 32px;
        color: white;
    }

    .complaint-meta {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 16px;
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
        font-size: 1.6rem;
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

    .info-item .value .badge {
        font-size: 0.7rem;
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

    /* Attachment Section */
    .attachment-section {
        margin-bottom: 28px;
    }

    .attachment-section .label {
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-500);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .attachment-preview {
        background: var(--gray-50);
        border-radius: var(--radius-lg);
        padding: 16px 20px;
        border: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .attachment-preview img {
        max-width: 200px;
        max-height: 150px;
        border-radius: var(--radius-md);
        border: 1px solid var(--gray-200);
        object-fit: cover;
        box-shadow: var(--shadow-sm);
    }

    .attachment-preview img:hover {
        transform: scale(1.02);
        transition: transform 0.2s;
    }

    .file-info {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.85rem;
        color: var(--gray-600);
    }

    .file-info a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
    }

    .file-info a:hover {
        text-decoration: underline;
    }

    .no-attachment {
        color: var(--gray-400);
        font-style: italic;
        font-size: 0.85rem;
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

    .timeline-content .description em {
        font-style: italic;
        color: var(--gray-700);
    }

    .timeline-content .date {
        font-size: 0.7rem;
        color: var(--gray-400);
        margin-top: 4px;
    }

    .timeline-content .note-box {
        margin-top: 6px;
        background: var(--gray-100);
        padding: 8px 12px;
        border-radius: var(--radius-md);
        font-size: 0.85rem;
        color: var(--gray-700);
        border-left: 3px solid var(--primary);
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
            font-size: 1.3rem;
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
        .attachment-preview {
            flex-direction: column;
            align-items: flex-start;
        }
        .attachment-preview img {
            max-width: 100%;
        }
    }

    @media (max-width: 480px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .page-header h1 {
            font-size: 1.3rem;
        }
    }
</style>

<div class="main-content">
    <!-- Page Header -->
    <div class="page-header">
        <a href="{{ route('supervisor.viewComplaints') }}" class="back-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Back to Complaints
        </a>
        <h1><i class="fas fa-file-alt"></i> Complaint Details</h1>
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
                    <div class="value">{{ $complaint->employee->employeeName }} (EMP-{{ str_pad($complaint->employee->employeeID, 3, '0', STR_PAD_LEFT) }})</div>
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
                            {{ $complaint->employee->supervisor->employeeName }}
                            ({{ $complaint->employee->supervisor->formatted_employee_id ?? 'EMP-' . $complaint->employee->supervisor->employeeID }})
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

            <!-- Attachment -->
            <div class="attachment-section">
                <div class="label"><i class="fas fa-paperclip"></i> Attachments</div>
                <div class="attachment-preview">
                    @if($complaint->complaintEvidence)
                        @php
                            $file = $complaint->complaintEvidence;
                            $isImage = preg_match('/\.(jpg|jpeg|png|gif|webp)(\?.*)?$/i', $file);
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
                                <a href="{{ $complaint->complaintEvidence }}" target="_blank">Download Attachment</a>
                            </div>
                        @endif
                    @else
                        <span class="no-attachment">No attachment uploaded</span>
                    @endif
                </div>
            </div>

            <!-- Timeline -->
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
                                <div class="note-box">
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
                <a href="{{ route('supervisor.editComplaint', ['id' => $complaint->complaintID]) }}" class="btn-primary-custom">
                    <i class="fas fa-edit"></i> Edit Complaint
                </a>
                @if($complaint->complaintStatus == 'Pending')
                <form action="{{ route('supervisor.cancelComplaint', ['id' => $complaint->complaintID]) }}"
                    method="POST"
                    style="display:inline;">
                    @csrf
                    <button type="submit"
                            class="btn-danger-custom"
                            onclick="return confirm('Are you sure you want to cancel this complaint?')">
                        <i class="fas fa-times-circle"></i> Cancel Complaint
                    </button>
                </form>
                @endif
                <a href="{{ route('supervisor.viewComplaints') }}" class="btn-secondary-custom">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // ==================== ESCAPE KEY ====================
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            window.location.href = "{{ route('supervisor.viewComplaints') }}";
        }
    });
</script>

<!-- Include priority badge styles if not already defined -->
<style>
    .priority-high { background: #FEF2F2; color: #DC2626; padding: 2px 10px; border-radius: 40px; font-size: 0.7rem; font-weight: 600; }
    .priority-medium { background: #FFFBEB; color: #D97706; padding: 2px 10px; border-radius: 40px; font-size: 0.7rem; font-weight: 600; }
    .priority-low { background: #ECFDF5; color: #059669; padding: 2px 10px; border-radius: 40px; font-size: 0.7rem; font-weight: 600; }
    .status-badge { padding: 2px 10px; border-radius: 40px; font-size: 0.7rem; font-weight: 600; display: inline-block; }
</style>

@endsection