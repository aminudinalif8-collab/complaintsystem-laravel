<?php

namespace App\Http\Controllers\supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ComplaintAction;

class SupervisorPendingApprovalController extends Controller
{
    public function index()
    {
        $supervisorID = auth()->user()->employeeID;

        $pendingActions = ComplaintAction::with([
                'complaint.employee.department',
                'supervisor'
            ])
            ->where('actionStatus', 'Waiting Approval')

            ->whereHas('complaint.employee', function ($query) use ($supervisorID) {
                $query->where('supervisorID', $supervisorID);
            })

            ->latest()
            ->paginate(10);

        return view(
            'supervisor.pendingApprovals.pendingApproval',
            compact('pendingActions')
        );
    }
}
