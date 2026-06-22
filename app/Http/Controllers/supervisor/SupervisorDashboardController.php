<?php

namespace App\Http\Controllers\supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupervisorDashboardController extends Controller
{
    public function index()
    {
        $supervisorID = auth()->user()->employeeID;

        // 1. ambil employee bawah supervisor ni
        $employeeIDs = \App\Models\Employee::where('supervisorID', $supervisorID)
            ->pluck('employeeID');

        // 2. ambil complaints dari employee tu
        $complaints = \App\Models\Complaint::with('employee')
            ->whereIn('employeeID', $employeeIDs)
            ->latest()
            ->paginate(5);

        // 3. kira stats
        $total = $complaints->total();
        $pending = $complaints->where('complaintStatus', 'Pending')->count();
        $inProgress = $complaints->where('complaintStatus', 'In Progress')->count();
        $pendingApproval = $complaints->where('complaintStatus', 'Pending Approval')->count();
        $resolved = $complaints->where('complaintStatus', 'Resolved')->count();
        $rejectedActions = \App\Models\ComplaintAction::where('supervisorID', $supervisorID)->where('actionStatus', 'Rejected')->count();
        $approvedActions = \App\Models\ComplaintAction::where('supervisorID', $supervisorID)->where('actionStatus', 'Approved')->count();
        // RESOLUTION RATE
        // $resolutionRate = $total > 0
        //     ? round(($resolved / $total) * 100)
        //     : 0;

        return view('supervisor.svDashboards.dashboard', compact(
            'complaints',
            'total',
            'pending',
            'inProgress',
            'pendingApproval',
            'resolved',
            'rejectedActions',
            'approvedActions'
        ));
    }
}
