<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ComplaintAction;
use App\Models\ActionApproval;

class ManagerActionApprovalController extends Controller
{
    //Approve action
    public function approve(Request $request, $id)
    {
        $request->validate([
            'managerRemarks' => 'required|string'
        ]);

        $action = ComplaintAction::with('complaint')->findOrFail($id);

        ActionApproval::create([
            'decision' => 'Approved',
            'managerRemarks' => $request->managerRemarks,
            'actionID' => $action->actionID,
            'managerID' => auth()->user()->employeeID,
        ]);

        $action->update([
            'actionStatus' => 'Approved'
        ]);

        if ($action->complaint) {
            $action->complaint->update([
                'complaintStatus' => 'Resolved'
            ]);
        }

        return redirect()->back()->with(
            'success',
            'Action Approved Successfully'
        );
    }

    //Reject action
    public function reject(Request $request, $id)
    {
        $request->validate([
            'managerRemarks' => 'required|string'
        ]);

        $action = ComplaintAction::with('complaint')->findOrFail($id);

        ActionApproval::create([
            'decision' => 'Rejected',
            'managerRemarks' => $request->managerRemarks,
            'actionID' => $action->actionID,
            'managerID' => auth()->user()->employeeID,
        ]);

        $action->update([
            'actionStatus' => 'Rejected'
        ]);

        if ($action->complaint) {
            $action->complaint->update([
                'complaintStatus' => 'In Progress'
            ]);
        }

        return redirect()->back()->with(
            'success',
            'Action Rejected Successfully'
        );
    }
}