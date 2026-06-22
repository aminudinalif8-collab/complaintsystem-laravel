<?php

namespace App\Http\Controllers\supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupervisorViewComplaintController extends Controller
{
    public function index()
    {
        $supervisorID = auth()->user()->employeeID;

        // 1. ambil employee bawah supervisor ni
        $employeeIDs = \App\Models\Employee::where('supervisorID', $supervisorID)
            ->pluck('employeeID');

        // 2. ambil complaints dari employee tu
        $complaints = \App\Models\Complaint::with('employee', 'actions.approval')
            ->whereIn('employeeID', $employeeIDs)
            ->orderByRaw("
                CASE
                    WHEN complaintPriority = 'High' THEN 1
                    WHEN complaintPriority = 'Medium' THEN 2
                    WHEN complaintPriority = 'Low' THEN 3
                    ELSE 4
                END
            ")
            ->orderByRaw("
                CASE
                    WHEN complaintStatus = 'Pending' THEN 1
                    WHEN complaintStatus = 'In Progress' THEN 2
                    WHEN complaintStatus = 'Resolved' THEN 3
                    WHEN complaintStatus = 'Cancelled' THEN 4
                    ELSE 5
                END
            ")
            ->orderBy('complaintDate', 'desc')
            ->paginate(12);

        // 3. kira rejection count untuk setiap complaint
        foreach ($complaints as $complaint) {

            $complaint->rejection_count = \App\Models\ActionApproval::whereHas('action', function ($q) use ($complaint) {
                $q->where('complaintID', $complaint->complaintID);
            })
            ->where('decision', 'Rejected')
            ->count();
        }

        return view('supervisor.viewComplaints.viewComplaint', compact('complaints'));
    }
}
