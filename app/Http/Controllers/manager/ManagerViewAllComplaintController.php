<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Complaint;

class ManagerViewAllComplaintController extends Controller
{
    public function index(Request $request)
    {
        $manager = Auth::user();

        // Get filter parameters from request
        $status = $request->get('status', 'all');
        $search = $request->get('search', '');

        $query = Complaint::with([
            'employee',
            'actions.supervisor'
        ]);

        // Apply status filter
        if ($status !== 'all') {
            $query->where('complaintStatus', $status);
        }

        // Apply search filter
        if (!empty($search)) {
            $searchTerm = trim($search);
            $query->where(function($q) use ($searchTerm) {
                $q->where('complaintID', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('complaintTitle', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('complaintCategory', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('complaintStatus', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('complaintDescription', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('employee', function($emp) use ($searchTerm) {
                      $emp->where('employeeName', 'LIKE', "%{$searchTerm}%")
                          ->orWhere('employeeEmail', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }

        // Order by latest and paginate
        $complaints = $query->latest()->paginate(10);

        // Preserve filter parameters in pagination links
        $complaints->appends([
            'status' => $status,
            'search' => $search
        ]);

        return view(
            'manager.managerViewAllComplaints.managerViewAllComplaint', 
            compact('complaints', 'manager', 'status', 'search')
        );
    }

    // Optional: Method to handle AJAX filtering without page reload
    public function filter(Request $request)
    {
        $status = $request->get('status', 'all');
        $search = $request->get('search', '');

        $query = Complaint::with([
            'employee',
            'actions.supervisor'
        ]);

        if ($status !== 'all') {
            $query->where('complaintStatus', $status);
        }

        if (!empty($search)) {
            $searchTerm = trim($search);
            $query->where(function($q) use ($searchTerm) {
                $q->where('complaintID', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('complaintTitle', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('complaintCategory', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('complaintStatus', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('complaintDescription', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('employee', function($emp) use ($searchTerm) {
                      $emp->where('employeeName', 'LIKE', "%{$searchTerm}%")
                          ->orWhere('employeeEmail', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }

        $complaints = $query->latest()->paginate(10);
        $complaints->appends([
            'status' => $status,
            'search' => $search
        ]);

        // Return JSON response for AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'html' => view('manager.managerViewAllComplaints.partials.complaint_table', compact('complaints'))->render(),
                'pagination' => view('manager.managerViewAllComplaints.partials.pagination', compact('complaints'))->render(),
                'count' => $complaints->total()
            ]);
        }

        return view(
            'manager.managerViewAllComplaints.managerViewAllComplaint', 
            compact('complaints', 'status', 'search')
        );
    }
}