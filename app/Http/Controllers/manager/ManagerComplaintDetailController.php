<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Complaint;

class ManagerComplaintDetailController extends Controller
{
    public function index($id)
    {
        // ambil complaint ikut ID + pastikan milik user login
        $complaint = Complaint::with(['employee.department', 'employee.supervisor'])
            ->where('complaintID', $id)
            ->firstOrFail();

        return view('manager.managerComplaintDetails.managerComplaintDetail', compact('complaint'));
    }
}
