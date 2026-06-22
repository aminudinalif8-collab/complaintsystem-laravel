<?php

namespace App\Http\Controllers\clerk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Complaint;

class ClerkDashboardController extends Controller
{
    public function index()
    {
        $employee = auth()->user()->load('department');
        $employeeID = auth()->user()->employeeID;

        $total = Complaint::where('employeeID', $employeeID)->count();
        $pending = Complaint::where('employeeID', $employeeID)->where('complaintStatus', 'Pending')->count();
        $inProgress = Complaint::where('employeeID', $employeeID)->where('complaintStatus', 'In Progress')->count();
        $resolved = Complaint::where('employeeID', $employeeID)->where('complaintStatus', 'Resolved')->count();
        $rejected = Complaint::where('employeeID', $employeeID)->where('complaintStatus', 'Rejected')->count();

        $complaints = Complaint::with('employee')
            ->where('employeeID', $employeeID)
            ->orderBy('created_at', 'desc')
            ->get();

        $departments = Department::all();
        // $supervisors = Employee::whereIn('role', ['supervisor'])->get();

        $pendingCount = Complaint::where('complaintStatus', 'Pending')->count();
        $inProgressCount = Complaint::where('complaintStatus', 'In Progress')->count();
        $resolvedCount = Complaint::where('complaintStatus', 'Resolved')->count();
        $rejectedCount = Complaint::where('complaintStatus', 'Rejected')->count();

        return view('clerk.dashboard', compact(
            'employee',
            'total',
            'pending',
            'inProgress',
            'resolved',
            'rejected',
            'complaints',
            'pendingCount',
            'inProgressCount',
            'resolvedCount',
            'rejectedCount',
            'departments'
            // 'supervisors'
        ));
    }

    public function storeDepartment(Request $request)
    {
        $validated = $request->validate([
            'departmentName' => 'required|string|max:255',
        ]);

        Department::create([
            'departmentName' => $validated['departmentName'],
        ]);

        return redirect()->route('clerk.dashboard')->with('success', 'Department added successfully!');
    }
}
