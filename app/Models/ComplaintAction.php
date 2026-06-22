<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Complaint;
use App\Models\Employee;

class ComplaintAction extends Model
{
    use HasFactory;

    protected $table = 'complaint_action';

    protected $primaryKey = 'actionID';

    public $timestamps = true;

    protected $fillable = [
        'actionDescription',
        'actionStatus',
        'actionDate',
        'complaintID',
        'supervisorID',
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class, 'complaintID', 'complaintID');
    }

    public function supervisor()
    {
        return $this->belongsTo(Employee::class, 'supervisorID', 'employeeID');
    }

    // Relation dengan ActionApproval
    public function approval()
    {
        return $this->hasOne(
            \App\Models\ActionApproval::class,
            'actionID',
            'actionID'
        );
    }
}
