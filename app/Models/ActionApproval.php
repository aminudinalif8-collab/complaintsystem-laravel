<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ComplaintAction;
use App\Models\Employee;

class ActionApproval extends Model
{
    use HasFactory;

    protected $table = 'action_approval';

    protected $primaryKey = 'approvalID';

    public $timestamps = true;

    protected $fillable = [
        'decision',
        'managerRemarks',
        'actionID',
        'managerID',
    ];

    // relationship to complaint action
    public function action()
    {
        return $this->belongsTo(
            ComplaintAction::class,
            'actionID',
            'actionID'
        );
    }

    // relationship to complaint through action
    public function complaint()
    {
        return $this->hasOneThrough(
            Complaint::class,
            ComplaintAction::class,
            'actionID',
            'complaintID',
            'actionID',
            'complaintID'
        );
    }

    // relationship to manager
    public function manager()
    {
        return $this->belongsTo(
            Employee::class,
            'managerID',
            'employeeID'
        );
    }
}