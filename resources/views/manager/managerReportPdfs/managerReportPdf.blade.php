<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Complaint Management System Report</title>

    <style>
        /* ===== RESET & BASE ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', 'Segoe UI', Arial, sans-serif;
            font-size: 12px;
            background: #ffffff;
            color: #1a2a36;
            padding: 30px;
            line-height: 1.6;
        }

        /* ===== REPORT CONTAINER ===== */
        .report-container {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px 30px 30px 30px;
            border-radius: 8px;
        }

        /* ===== HEADER ===== */
        .report-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 3px solid #2c7a5e;
            margin-bottom: 25px;
        }

        .report-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #1a3a48;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .report-header .subtitle {
            font-size: 14px;
            color: #5a7a8a;
            font-weight: 400;
        }

        .report-header .report-date {
            font-size: 11px;
            color: #8aa0ae;
            margin-top: 6px;
        }

        /* ===== SECTION TITLE ===== */
        .section-title {
            font-size: 17px;
            font-weight: 600;
            color: #1a3a48;
            padding-bottom: 8px;
            border-bottom: 2px solid #e8edf2;
            margin: 25px 0 16px 0;
        }

        .section-title i {
            color: #2c7a5e;
            margin-right: 8px;
        }

        /* ===== SUMMARY CARDS ===== */
        .summary-grid {
            display: table;
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .summary-grid .card {
            display: table-cell;
            background: #f5f9fc;
            border: 1px solid #e2edf2;
            border-radius: 8px;
            padding: 14px 10px;
            text-align: center;
            width: 25%;
            vertical-align: middle;
        }

        .summary-grid .card:not(:last-child) {
            border-right: none;
        }

        .summary-grid .card:first-child {
            border-radius: 8px 0 0 8px;
        }

        .summary-grid .card:last-child {
            border-radius: 0 8px 8px 0;
        }

        .summary-grid .card .number {
            font-size: 22px;
            font-weight: 700;
            color: #2c7a5e;
            display: block;
            line-height: 1.2;
        }

        .summary-grid .card .label {
            font-size: 10px;
            color: #6f8a9a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 4px;
            display: block;
        }

        /* ===== TABLES ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
            font-size: 12px;
            border-radius: 8px;
            overflow: hidden;
        }

        table thead th {
            background: #1a3a48;
            color: #ffffff;
            font-weight: 600;
            padding: 10px 14px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table tbody td {
            padding: 9px 14px;
            border-bottom: 1px solid #e8edf2;
            color: #1e2e3a;
        }

        table tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        table tbody tr:hover {
            background: #eef4f8;
        }

        table tbody tr:last-child td {
            border-bottom: none;
        }

        /* ===== STATUS BADGE (PDF) ===== */
        .badge {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            color: #ffffff;
        }

        .badge-pending { background: #d97706; }
        .badge-progress { background: #2563eb; }
        .badge-resolved { background: #059669; }
        .badge-rejected { background: #dc2626; }

        /* ===== FOOTER ===== */
        .report-footer {
            margin-top: 30px;
            padding-top: 16px;
            border-top: 1px solid #e2edf2;
            font-size: 10px;
            color: #8aa0ae;
            text-align: center;
        }

        .report-footer span {
            color: #2c7a5e;
        }

        /* ===== RESPONSIVE ===== */
        @media print {
            body {
                padding: 15px;
            }
            .report-container {
                padding: 10px 15px;
            }
            .summary-grid .card {
                padding: 10px 8px;
            }
            .summary-grid .card .number {
                font-size: 18px;
            }
        }

        @media (max-width: 600px) {
            body {
                padding: 12px;
            }

            .report-container {
                width: 100%;
                max-width: 100%;
                padding: 14px;
                border-radius: 0;
            }

            .report-header h1 {
                font-size: 18px;
                line-height: 1.25;
            }

            .summary-grid {
                display: block;
            }

            .summary-grid .card {
                display: block;
                width: 100%;
                border-right: 1px solid #e2edf2 !important;
                border-radius: 8px !important;
                margin-bottom: 6px;
            }
            .summary-grid .card:last-child {
                margin-bottom: 0;
            }
            table {
                font-size: 10px;
                display: block;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                min-width: 100%;
            }
            table thead th,
            table tbody td {
                padding: 6px 10px;
            }
        }
    </style>
</head>

<body>

<div class="report-container">

    <!-- ===== HEADER ===== -->
    <div class="report-header">
        <h1>📋 Complaint Management System</h1>
        <div class="subtitle">Analytics &amp; Performance Report</div>
        <div class="report-date">
            Generated on: {{ now()->format('l, d F Y') }} at {{ now()->format('h:i A') }}
        </div>
    </div>

    <!-- ===== MONTHLY REPORT ===== -->
    @if($type == 'monthly')

        <div class="section-title">
            <i>📊</i> Monthly Report — {{ now()->format('F Y') }}
        </div>

        <!-- Summary Cards -->
        <div class="summary-grid">
            <div class="card">
                <span class="number">{{ $monthlyComplaints }}</span>
                <span class="label">Total Complaints</span>
            </div>
            <div class="card">
                <span class="number">{{ $resolvedCount }}</span>
                <span class="label">Resolved</span>
            </div>
            <div class="card">
                <span class="number">{{ $pendingCount + $inProgressCount }}</span>
                <span class="label">Active</span>
            </div>
            <div class="card">
                <span class="number">{{ $resolvedPercentage }}%</span>
                <span class="label">Resolution Rate</span>
            </div>
        </div>

        <!-- Detailed Table -->
        <table>
            <thead>
                <tr>
                    <th>Metric</th>
                    <th>Count</th>
                    <th>Percentage</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Resolved</strong> <span style="color:#059669; font-size:10px;">✓</span></td>
                    <td>{{ $resolvedCount }}</td>
                    <td>{{ $resolvedPercentage }}%</td>
                </tr>
                <tr>
                    <td><strong>Pending</strong> <span style="color:#d97706; font-size:10px;">⏳</span></td>
                    <td>{{ $pendingCount }}</td>
                    <td>{{ $pendingPercentage }}%</td>
                </tr>
                <tr>
                    <td><strong>In Progress</strong> <span style="color:#2563eb; font-size:10px;">🔄</span></td>
                    <td>{{ $inProgressCount }}</td>
                    <td>{{ $inProgressPercentage }}%</td>
                </tr>
                <tr>
                    <td><strong>Rejected</strong> <span style="color:#dc2626; font-size:10px;">✕</span></td>
                    <td>{{ $rejectedCount }}</td>
                    <td>{{ $totalComplaints > 0 ? round(($rejectedCount / $totalComplaints) * 100, 1) : 0 }}%</td>
                </tr>
                <tr style="background:#eef4f8; font-weight:600;">
                    <td><strong>Total</strong></td>
                    <td><strong>{{ $monthlyComplaints }}</strong></td>
                    <td><strong>100%</strong></td>
                </tr>
            </tbody>
        </table>

    @endif

    <!-- ===== CATEGORY REPORT ===== -->
    @if($type == 'category')

        <div class="section-title">
            <i>🏷️</i> Report by Category
        </div>

        <table>
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Total Complaints</th>
                    <th>Percentage</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categoryReport as $category)
                <tr>
                    <td><strong>{{ $category->complaintCategory }}</strong></td>
                    <td>{{ $category->total }}</td>
                    <td>
                        {{ $totalComplaints > 0 ? round(($category->total / $totalComplaints) * 100, 1) : 0 }}%
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align:center; color:#8aa0ae;">No category data available</td>
                </tr>
                @endforelse
                @if($categoryReport->count() > 0)
                <tr style="background:#eef4f8; font-weight:600;">
                    <td><strong>Total</strong></td>
                    <td><strong>{{ $totalComplaints }}</strong></td>
                    <td><strong>100%</strong></td>
                </tr>
                @endif
            </tbody>
        </table>

    @endif

    <!-- ===== DEPARTMENT REPORT ===== -->
    @if($type == 'department')

        <div class="section-title">
            <i>🏢</i> Report by Department
        </div>

        <table>
            <thead>
                <tr>
                    <th>Department</th>
                    <th>Total Complaints</th>
                    <th>Percentage</th>
                </tr>
            </thead>
            <tbody>
                @forelse($departmentReport as $department)
                <tr>
                    <td><strong>{{ $department->departmentName ?? 'N/A' }}</strong></td>
                    <td>{{ $department->complaints_count ?? 0 }}</td>
                    <td>
                        {{ $totalComplaints > 0 ? round((($department->complaints_count ?? 0) / $totalComplaints) * 100, 1) : 0 }}%
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align:center; color:#8aa0ae;">No department data available</td>
                </tr>
                @endforelse
                @if($departmentReport->count() > 0)
                <tr style="background:#eef4f8; font-weight:600;">
                    <td><strong>Total</strong></td>
                    <td><strong>{{ $totalComplaints }}</strong></td>
                    <td><strong>100%</strong></td>
                </tr>
                @endif
            </tbody>
        </table>

    @endif

    <!-- ===== STATUS REPORT ===== -->
    @if($type == 'status')

        <div class="section-title">
            <i>📈</i> Status Summary Report
        </div>

        <table>
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Total Complaints</th>
                    <th>Percentage</th>
                </tr>
            </thead>
            <tbody>
                @forelse($statusReport as $status)
                <tr>
                    <td>
                        @php
                            $badgeClass = 'badge-pending';
                            if($status->complaintStatus == 'In Progress') $badgeClass = 'badge-progress';
                            elseif($status->complaintStatus == 'Resolved') $badgeClass = 'badge-resolved';
                            elseif($status->complaintStatus == 'Rejected') $badgeClass = 'badge-rejected';
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ $status->complaintStatus }}</span>
                    </td>
                    <td><strong>{{ $status->total }}</strong></td>
                    <td>
                        {{ $totalComplaints > 0 ? round(($status->total / $totalComplaints) * 100, 1) : 0 }}%
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align:center; color:#8aa0ae;">No status data available</td>
                </tr>
                @endforelse
                @if($statusReport->count() > 0)
                <tr style="background:#eef4f8; font-weight:600;">
                    <td><strong>Total</strong></td>
                    <td><strong>{{ $totalComplaints }}</strong></td>
                    <td><strong>100%</strong></td>
                </tr>
                @endif
            </tbody>
        </table>

    @endif

    <!-- ===== FOOTER ===== -->
    <div class="report-footer">
        <span>Complaint Management System</span> &bull; Confidential &bull; Generated on {{ now()->format('d/m/Y') }}
    </div>

</div>

</body>
</html>
