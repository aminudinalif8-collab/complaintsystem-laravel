<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Complaint;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ManagerGenerateReportController extends Controller
{
    public function index()
    {
        $manager = Auth::user();

        // MONTHLY REPORT
        $monthlyComplaints = Complaint::whereMonth('complaintDate', now()->month)
                                ->count();

        $resolvedCount = Complaint::where('complaintStatus', 'Resolved')->count();

        $pendingCount = Complaint::where('complaintStatus', 'Pending')->count();

        $inProgressCount = Complaint::where('complaintStatus', 'In Progress')->count();

        $rejectedCount = Complaint::where('complaintStatus', 'Rejected')->count();


        // CATEGORY REPORT
        $categoryReport = Complaint::select(
                                'complaintCategory',
                                DB::raw('count(*) as total')
                            )
                            ->groupBy('complaintCategory')
                            ->get();


        // DEPARTMENT REPORT
        $departmentReport = Department::withCount('complaints')
                                ->get();


        // STATUS REPORT
        $statusReport = Complaint::select(
                            'complaintStatus',
                            DB::raw('count(*) as total')
                        )
                        ->groupBy('complaintStatus')
                        ->get();


        // TOTAL COMPLAINTS
        $totalComplaints = Complaint::count();


        // PERCENTAGE
        $resolvedPercentage = $totalComplaints > 0
            ? round(($resolvedCount / $totalComplaints) * 100, 1)
            : 0;

        $pendingPercentage = $totalComplaints > 0
            ? round(($pendingCount / $totalComplaints) * 100, 1)
            : 0;

        $inProgressPercentage = $totalComplaints > 0
            ? round(($inProgressCount / $totalComplaints) * 100, 1)
            : 0;

        return view(
            'manager.managerGenerateReports.managerGenerateReport',
            compact(
                'manager',
                'monthlyComplaints',
                'resolvedCount',
                'pendingCount',
                'inProgressCount',
                'rejectedCount',
                'categoryReport',
                'departmentReport',
                'statusReport',
                'totalComplaints',
                'resolvedPercentage',
                'pendingPercentage',
                'inProgressPercentage'
            )
        );
    }

    // DOWNLOAD PDF
    public function downloadPdf($type)
    {
        $monthlyComplaints = Complaint::whereMonth('complaintDate', now()->month)
                                ->count();

        $resolvedCount = Complaint::where('complaintStatus', 'Resolved')->count();

        $pendingCount = Complaint::where('complaintStatus', 'Pending')->count();

        $inProgressCount = Complaint::where('complaintStatus', 'In Progress')->count();

        $rejectedCount = Complaint::where('complaintStatus', 'Rejected')->count();

        $categoryReport = Complaint::select(
                                'complaintCategory',
                                DB::raw('count(*) as total')
                            )
                            ->groupBy('complaintCategory')
                            ->get();

        $departmentReport = Department::withCount('complaints')
                                ->get();

        $statusReport = Complaint::select(
                            'complaintStatus',
                            DB::raw('count(*) as total')
                        )
                        ->groupBy('complaintStatus')
                        ->get();

        $totalComplaints = Complaint::count();

        $resolvedPercentage = $totalComplaints > 0
            ? round(($resolvedCount / $totalComplaints) * 100, 1)
            : 0;

        $pendingPercentage = $totalComplaints > 0
            ? round(($pendingCount / $totalComplaints) * 100, 1)
            : 0;

        $inProgressPercentage = $totalComplaints > 0
            ? round(($inProgressCount / $totalComplaints) * 100, 1)
            : 0;

        $pdf = Pdf::loadView(
            'manager.managerReportPdfs.managerReportPdf',
            compact(
                'type',
                'monthlyComplaints',
                'resolvedCount',
                'pendingCount',
                'inProgressCount',
                'rejectedCount',
                'categoryReport',
                'departmentReport',
                'statusReport',
                'totalComplaints',
                'resolvedPercentage',
                'pendingPercentage',
                'inProgressPercentage'
            )
        );

        return $pdf->download(
            $type . '_report_' . now()->format('Ymd_His') . '.pdf'
        );
    }
}
