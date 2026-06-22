# Complaint System - Status Flow Documentation

## System Overview

This document describes the status management system for the Complaint Management System. The system uses a workflow-based approach with three main entities that track status:

1. **Complaints** - Overall complaint status
2. **Complaint Actions** - Individual action status
3. **Action Approvals** - Manager approval decisions

---

## Entity Relationship Flow

```
Employee files Complaint
        ↓
Complaint (Status: Pending)
        ↓
Supervisor creates ComplaintAction (Status: Pending)
        ↓
Manager creates ActionApproval (Decision: Approved/Rejected)
        ↓
Observer automatically updates statuses
```

---

## Status Definitions

### Complaint Status Values

| Status | Description | Typical Transitions |
|--------|-------------|-------------------|
| **Pending** | Complaint newly filed, awaiting action | Pending → In Progress |
| **In Progress** | Supervisor is working on resolving the complaint | In Progress → Resolved/In Progress |
| **Resolved** | Action approved by manager, complaint resolved | Resolved → Closed |
| **Closed** | Complaint formally closed (manual) | Any → Closed |

### Action Status Values

| Status | Description | Trigger |
|--------|-------------|---------|
| **Pending** | Action created, awaiting supervisor work | Initial status |
| **In Progress** | Supervisor is actively working on action | Manual update by supervisor |
| **Completed** | Action execution completed, awaiting approval | Manual update by supervisor |
| **Approved** | Manager approves the action | ActionApprovalObserver (decision='Approved') |
| **Rejected** | Manager rejects the action | ActionApprovalObserver (decision='Rejected') |

### Approval Decision Values

| Decision | Result |
|----------|--------|
| **Approved** | Complaint marked as Resolved |
| **Rejected** | Complaint returns to In Progress |

---

## Automatic Status Update Logic

### Using Laravel Observer Pattern

The system implements the **Observer Pattern** to automatically update statuses when an approval is recorded. The `ActionApprovalObserver` listens for the `created` event on the `ActionApproval` model.

#### Observer Location
- **File**: `app/Observers/ActionApprovalObserver.php`
- **Registered in**: `app/Providers/EventServiceProvider.php`

### Workflow - Action APPROVED

```
User Action: Manager approves action in ManagerActionApprovalController::approve()
            ↓
ActionApproval::create() called with decision='Approved'
            ↓
ActionApprovalObserver::created() triggered
            ↓
Updates ComplaintAction.actionStatus = 'Approved'
            ↓
Updates Complaint.complaintStatus = 'Resolved'
            ↓
Controller returns success response
```

**Status Changes:**
- `complaint_action.actionStatus`: `(any)` → `Approved`
- `complaints.complaintStatus`: `In Progress` → `Resolved`

### Workflow - Action REJECTED

```
User Action: Manager rejects action in ManagerActionApprovalController::reject()
            ↓
ActionApproval::create() called with decision='Rejected'
            ↓
ActionApprovalObserver::created() triggered
            ↓
Updates ComplaintAction.actionStatus = 'Rejected'
            ↓
Updates Complaint.complaintStatus = 'In Progress' (unless already 'Closed')
            ↓
Controller returns success response
```

**Status Changes:**
- `complaint_action.actionStatus`: `(any)` → `Rejected`
- `complaints.complaintStatus`: `(any except Closed)` → `In Progress`

---

## State Transition Diagram

```
COMPLAINT STATUS FLOW:
─────────────────────

            ┌─────────┐
            │ Pending │
            └────┬────┘
                 │
                 ├─→ [Supervisor creates action]
                 │
            ┌────▼────────────┐
            │  In Progress    │◄─────┐
            └────┬────────────┘      │
                 │                  │
     ┌───────────┴──────────┐       │
     │                      │       │
[Manager Approves]  [Manager Rejects]
     │                      │       │
     ▼                      └───────┘
┌─────────┐
│Resolved │
└────┬────┘
     │
     ├─→ [Manual Close]
     │
     ▼
┌────────┐
│ Closed │
└────────┘


ACTION STATUS FLOW (within each Complaint):
────────────────────────────────────────

┌─────────┐
│ Pending │
└────┬────┘
     │
     ├─→ [Supervisor updates]
     │
     ▼
┌──────────────┐
│ In Progress  │
└────┬─────────┘
     │
     ├─→ [Supervisor completes]
     │
     ▼
┌───────────┐
│ Completed │
└─────┬─────┘
      │
      ├────────────────────────┐
      │                        │
[Manager Approves]    [Manager Rejects]
      │                        │
      ▼                        ▼
┌──────────┐              ┌──────────┐
│ Approved │              │ Rejected │
└──────────┘              └──────────┘
```

---

## Database Schema

### Relevant Fields

**complaints table**
```sql
- complaintID (PK)
- complaintStatus VARCHAR (Pending, In Progress, Resolved, Closed)
- employeeID (FK)
```

**complaint_action table**
```sql
- actionID (PK)
- actionStatus VARCHAR (Pending, In Progress, Completed, Approved, Rejected)
- complaintID (FK)
- supervisorID (FK)
```

**action_approval table**
```sql
- approvalID (PK)
- decision VARCHAR (Approved, Rejected)
- actionID (FK)
- managerID (FK)
```

---

## Implementation Guide

### For Developers

#### How Status Updates Work

1. **Automatic Updates**: When `ActionApproval::create()` is called, the observer automatically:
   - Updates the related `ComplaintAction.actionStatus`
   - Updates the related `Complaint.complaintStatus`

2. **No Manual Status Updates Needed**: In controllers and other places, simply create the approval record:
   ```php
   ActionApproval::create([
       'decision' => 'Approved', // or 'Rejected'
       'managerRemarks' => $remarks,
       'actionID' => $action->actionID,
       'managerID' => auth()->user()->employeeID,
   ]);
   // Status updates happen automatically via observer!
   ```

3. **Relationships Available**:
   ```php
   $approval = ActionApproval::find($id);
   $action = $approval->action;           // Get the action
   $complaint = $approval->complaint;     // Get complaint via hasOneThrough
   $manager = $approval->manager;         // Get manager employee
   ```

#### Testing the Implementation

```php
// Test that approval updates statuses
$action = ComplaintAction::create([...]);
$complaint = Complaint::create([...]);

ActionApproval::create([
    'decision' => 'Approved',
    'actionID' => $action->actionID,
    'managerID' => 1,
]);

// Check updates
assert($action->fresh()->actionStatus === 'Approved');
assert($complaint->fresh()->complaintStatus === 'Resolved');
```

#### Modifying Status Logic

To change status update logic:
1. Edit `app/Observers/ActionApprovalObserver.php`
2. Update the `created()` method with new logic
3. No need to change controllers or other places - observer handles all cases

---

## Advantages of Observer Pattern

✅ **Centralized Logic**: All status updates in one place  
✅ **Automatic**: Works everywhere ActionApproval is created  
✅ **Maintainable**: Easy to modify or extend status rules  
✅ **Testable**: Observer can be unit tested independently  
✅ **Consistent**: Ensures business logic always applied  
✅ **Auditable**: All changes tracked in action_approval table  

---

## Future Enhancements

Possible status enhancements:

1. **Add Enum Constraints**: Use MySQL/PostgreSQL enums for database-level validation
2. **Status History**: Track status changes with timestamps
3. **Notifications**: Send notifications on status changes
4. **Workflows**: Implement complex approval workflows with multiple stages
5. **Status Callbacks**: Add hooks for actions on specific status changes

---

## Related Files

- **Observer**: `app/Observers/ActionApprovalObserver.php`
- **Models**: 
  - `app/Models/Complaint.php`
  - `app/Models/ComplaintAction.php`
  - `app/Models/ActionApproval.php`
- **Controller**: `app/Http/Controllers/manager/ManagerActionApprovalController.php`
- **Service Provider**: `app/Providers/EventServiceProvider.php`
- **Migration**: `database/migrations/2026_05_11_135647_add_enum_constraints_to_status_columns.php`

---

**Last Updated**: May 11, 2026  
**Version**: 1.0
