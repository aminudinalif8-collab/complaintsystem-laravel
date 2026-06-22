<?php

namespace App\Http\Controllers\clerk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class ClerkOwnComplaintController extends Controller
{
    public function index()
{
    $employeeID = Auth::user()->employeeID;

    $employee = Employee::with('department')
                    ->where('employeeID', $employeeID)
                    ->first();

    $complaints = Complaint::where('employeeID', $employeeID)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

    return view('clerk.myComplaintsClerk.myComplaintClerk', compact('employee', 'complaints'));
}

}
