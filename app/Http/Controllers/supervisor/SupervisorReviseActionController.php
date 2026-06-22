<?php

namespace App\Http\Controllers\supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ComplaintAction;
use App\Models\Complaint;

class SupervisorReviseActionController extends Controller
{
    // PAGE LIST
    public function index()
    {
        $supervisorID = auth()->user()->employeeID;

        $rejectedActions = \App\Models\ComplaintAction::with([
                'complaint.employee',
                'approval'
            ])
            ->where('supervisorID', $supervisorID)
            ->where('actionStatus', 'Rejected')
            ->latest()
            ->get();

        return view('supervisor.reviseActions.reviseAction', compact('rejectedActions'));
    }

    // SUBMIT REVISION (IMPORTANT PART)
    public function reviseSubmit(Request $request, $id)
    {
        $request->validate([
            'actionDescription' => 'required|string'
        ]);

        $action = ComplaintAction::findOrFail($id);

        $action->update([
            'actionDescription' => $request->actionDescription,
            'actionStatus' => 'Waiting Approval'
        ]);

        if ($action->complaint) {
            $action->complaint->update([
                'complaintStatus' => 'In Progress'
            ]);
        }

        return redirect()->back()->with('success', 'Action revised successfully.');
    }
}