<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Employee;
use App\Models\Complaint;
use App\Models\ComplaintAction;

class ManagerPendingApprovalController extends Controller
{
    public function index()
    {
        // ambik semua action yang tunggu approval
        $pendingActions = ComplaintAction::with([
            'complaint.employee',
            'supervisor'
        ])
        ->where('actionStatus', 'Waiting Approval')
        ->orderBy('actionID', 'asc')
        ->paginate(10);

        return view(
            'manager.managerPendingApprovals.managerPendingApproval',
            compact('pendingActions')
        );
    }
}