<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class EmployeeComplaintDetailsController extends Controller
{
    public function index($id)
    {
        // ambil complaint ikut ID + pastikan milik user login
        $complaint = Complaint::with([
                'employee.department',
                'employee.supervisor',

                // load complaint actions
                'actions.supervisor',

                // load approval
                'actions.approval'
            ])
            ->where('complaintID', $id)
            ->where('employeeID', Auth::user()->employeeID)
            ->firstOrFail();

        return view('employee.complaintDetails.compDetail', compact('complaint'));
    }
}
