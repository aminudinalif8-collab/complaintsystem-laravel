<?php

namespace App\Http\Controllers\supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Employee;
use App\Models\Complaint;
use App\Models\ComplaintAction;

class SupervisorEditComplaintController extends Controller
{
    public function edit($id)
    {
        $complaint = Complaint::findOrFail($id);

        $categories = ['Technical', 'Service', 'Billing', 'Other'];

        // employee (submitter)
        $employee = Employee::find($complaint->employeeID);

        // supervisor (based on employee's supervisorID)
        $supervisor = null;

        if ($employee && $employee->supervisorID) {
            $supervisor = Employee::find($employee->supervisorID);
        }

        // Check if complaint has been acted upon
        $actions = ComplaintAction::where('complaintID', $id)->get();
        $isEditable = $complaint->complaintStatus === 'Pending' && $actions->count() === 0; // Only editable if status is Pending and no actions exist

        return view('supervisor.sv-editComplaints.sv-editComplaint',
            compact('complaint', 'categories', 'employee', 'supervisor', 'actions', 'isEditable')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'complaintStatus' => 'required|in:Pending,In Progress',
            'actionDescription' => 'required|string|min:5'
        ]);

        $complaint = Complaint::findOrFail($id);

        // Check if already has actions (prevent re-editing)
        $existingActions = ComplaintAction::where('complaintID', $id)->count();
        if ($existingActions > 0) {
            return redirect()
                ->route('supervisor.editComplaint', $complaint->complaintID)
                ->with('error', 'This complaint has already been acted upon and cannot be edited again.');
        }

        // Update complaint status
        $complaint->complaintStatus = 'In Progress';
        $complaint->save();

        // CREATE ACTION LOG - Save remark/action with new status
        ComplaintAction::create([
            'actionDescription' => $request->actionDescription,

            // tukar sini
            'actionStatus' => 'Waiting Approval',

            'actionDate' => Carbon::now(),
            'complaintID' => $complaint->complaintID,
            'supervisorID' => auth()->user()->employeeID,
        ]);

        return redirect()
            ->route('supervisor.editComplaint', $complaint->complaintID)
            ->with('success', 'Complaint updated successfully! The form is now locked for editing.');
    }

    // Cancel complaint
    public function cancel($id)
    {
        $complaint = Complaint::findOrFail($id);

        // Hanya Pending boleh cancel
        if ($complaint->complaintStatus !== 'Pending') {
            return redirect()
                ->back()
                ->with('error', 'Only pending complaints can be cancelled.');
        }

        $complaint->complaintStatus = 'Cancelled';
        $complaint->save();

        return redirect()
            ->route('supervisor.complaintDetails', $complaint->complaintID)
            ->with('success', 'Complaint cancelled successfully.');
    }
}
