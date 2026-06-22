<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Complaint;
use App\Models\ComplaintAction;

class ManagerDashboardController extends Controller
{
    public function index()
    {
        $manager = Auth::user();

        //kira total complaints
        $totalComplaints = \App\Models\Complaint::count();
        //kira pending complaints
        $pendingComplaints = \App\Models\Complaint::where('complaintStatus', 'Pending')->count();
        //kira in progress complaints
        $inProgressComplaints = \App\Models\Complaint::where('complaintStatus', 'In Progress')->count();
        //kira pending approval complaints
        $pendingApprovalComplaints = \App\Models\Complaint::where('complaintStatus', 'Pending Approval')->count();
        //kira resolved complaints
        $resolvedComplaints = \App\Models\Complaint::where('complaintStatus', 'Resolved')->count();
        //kira awaiting approval complaints
        $awaitingApprovalComplaints = Complaint::whereHas('actions', function ($query) {$query->where('actionStatus', 'Waiting Approval');})->count();
        // kira rejected complaints
        $rejectedComplaints = \App\Models\Complaint::where('complaintStatus', 'Rejected')->count();
        //kira total employees
        $totalEmployees = \App\Models\Employee::count();

        $complaints = Complaint::with([
            'employee',
            'actions.supervisor'
        ])
        ->latest()
        ->paginate(5);

        // Data untuk chart jumlah employees per department
        $departmentData = Employee::selectRaw('departmentID, COUNT(*) as total')
            ->groupBy('departmentID')
            ->with('department')
            ->get();

        $departmentLabels = $departmentData
            ->map(fn($item) => $item->department->departmentName ?? 'Unknown')
            ->toArray();

        $departmentCounts = $departmentData
            ->pluck('total')
            ->toArray();


        return view('manager.managerDashboards.dashboard', compact('manager', 
                                                                    'totalComplaints', 
                                                                    'pendingComplaints', 
                                                                    'inProgressComplaints', 
                                                                    'pendingApprovalComplaints', 
                                                                    'resolvedComplaints', 
                                                                    'awaitingApprovalComplaints', 
                                                                    'rejectedComplaints',
                                                                    'totalEmployees', 
                                                                    'rejectedComplaints',
                                                                    'departmentLabels',
                                                                    'departmentCounts',
                                                                    'complaints'));
    }
}
