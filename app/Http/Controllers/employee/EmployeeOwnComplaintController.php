<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class EmployeeOwnComplaintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employeeID = Auth::user()->employeeID;

        // ambil semua complaint user login
        $complaints = Complaint::where('employeeID', $employeeID)
            ->orderByRaw("
                CASE
                    WHEN complaintStatus = 'Pending' THEN 1
                    WHEN complaintStatus = 'In Progress' THEN 2
                    WHEN complaintStatus = 'Resolved' THEN 3
                    WHEN complaintStatus = 'Cancelled' THEN 4
                    ELSE 5
                END
            ")
            ->orderByRaw("
                CASE
                    WHEN complaintPriority = 'High' THEN 1
                    WHEN complaintPriority = 'Medium' THEN 2
                    WHEN complaintPriority = 'Low' THEN 3
                    ELSE 4
                END
            ")
            ->orderBy('complaintDate', 'desc')
            ->paginate(12);

        // stats
        $total = Complaint::where('employeeID', $employeeID)->count();

        $pending = Complaint::where('employeeID', $employeeID)
            ->where('complaintStatus', 'Pending')
            ->count();

        $inProgress = Complaint::where('employeeID', $employeeID)
            ->where('complaintStatus', 'In Progress')
            ->count();

        $resolved = Complaint::where('employeeID', $employeeID)
            ->where('complaintStatus', 'Resolved')
            ->count();

        return view('employee.myComplaints.myComplaint', compact(
            'complaints',
            'total',
            'pending',
            'inProgress',
            'resolved'
        ));
    }
}
