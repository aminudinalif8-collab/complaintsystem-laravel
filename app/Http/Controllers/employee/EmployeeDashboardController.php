<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;

class EmployeeDashboardController extends Controller
{
    public function index()
    {
        $employeeID = Auth::user()->employeeID;

        $complaints = Complaint::where('employeeID', $employeeID)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

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

        $rejected = Complaint::where('employeeID', $employeeID)
                    ->where('complaintStatus', 'Rejected')
                    ->count();

        return view('employee.complaints.index', compact('total', 'pending', 'inProgress', 'resolved', 'rejected', 'complaints'));
    }
}
