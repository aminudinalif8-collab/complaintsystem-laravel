<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Employee;
use App\Models\Complaint;
use App\Models\ComplaintAction;

class ManagerEditComplaintController extends Controller
{
    public function edit($id)
    {
        $complaint = Complaint::findOrFail($id);

        $categories = ['Technical', 'Service', 'Billing', 'Other'];

        // employee (submitter)
        $employee = Employee::find($complaint->employeeID);
 
        // supervisor based on employee supervisorID
        $supervisor = null;

        if ($employee && $employee->supervisorID) {
            $supervisor = Employee::find($employee->supervisorID);
        }

        // action history
        $actions = ComplaintAction::where('complaintID', $id)->get();

        // 🔥 ONLY editable if complaint status is Pending
        $isEditable = $complaint->complaintStatus == 'Pending';

        return view(
            'manager.managerEditComplaints.managerEditComplaint',
            compact(
                'complaint',
                'categories',
                'employee',
                'supervisor',
                'actions',
                'isEditable'
            )
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'complaintStatus' => 'required|in:Pending,In Progress',
            'actionDescription' => 'required|string|min:5'
        ]);

        $complaint = Complaint::findOrFail($id);

        // 🔥 prevent editing if not Pending
        if ($complaint->complaintStatus != 'Pending') {

            return redirect()
                ->route('manager.editComplaint', $complaint->complaintID)
                ->with('error', 'Only pending complaints can be edited.');
        }

        // update complaint status
        $complaint->complaintStatus = 'In Progress';
        $complaint->save();

        // save action history
        ComplaintAction::create([
            'actionDescription' => $request->actionDescription,

            // manager action status
            'actionStatus' => 'Waiting Approval',

            'actionDate' => Carbon::now(),
            'complaintID' => $complaint->complaintID,
            'supervisorID' => auth()->user()->employeeID,
        ]);

        return redirect()
            ->route('manager.editComplaint', $complaint->complaintID)
            ->with('success', 'Complaint updated successfully! The form is now locked.');
    }

    // Cancel complaint
    public function cancel($id)
    {
        $complaint = Complaint::findOrFail($id);

        if ($complaint->complaintStatus != 'Pending') {
            return redirect()
                ->back()
                ->with('error', 'Only pending complaints can be cancelled.');
        }

        $complaint->complaintStatus = 'Cancelled';
        $complaint->save();

        return redirect()
            ->route('manager.editComplaint', $complaint->complaintID)
            ->with('success', 'Complaint cancelled successfully.');
    }
}