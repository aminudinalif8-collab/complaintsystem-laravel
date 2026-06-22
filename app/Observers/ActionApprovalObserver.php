<?php

namespace App\Observers;

use App\Models\ActionApproval;
use App\Models\Complaint;

class ActionApprovalObserver
{
    /**
     * Handle the ActionApproval "created" event.
     */
    public function created(ActionApproval $approval): void
    {
        // Get the related complaint action
        $action = $approval->action;

        if (!$action) {
            return;
        }

        // Get the related complaint
        $complaint = $action->complaint;

        if (!$complaint) {
            return;
        }

        // Update complaint status based on approval decision
        if ($approval->decision === 'Approved') {
            // Update action status to Approved
            $action->actionStatus = 'Approved';
            $action->save();

            // Update complaint status to Resolved
            $complaint->complaintStatus = 'Resolved';
            $complaint->save();
        } elseif ($approval->decision === 'Rejected') {
            // Update action status to Rejected
            $action->actionStatus = 'Rejected';
            $action->save();

            // Keep complaint status as In Progress for resubmission or closure
            // This allows supervisors to take another action if needed
            if ($complaint->complaintStatus !== 'Closed') {
                $complaint->complaintStatus = 'In Progress';
                $complaint->save();
            }
        }
    }

    /**
     * Handle the ActionApproval "updated" event.
     */
    public function updated(ActionApproval $approval): void
    {
        // Handle if approval decision is changed (optional)
        // You may want to add logic here if approvals can be modified
    }
}
