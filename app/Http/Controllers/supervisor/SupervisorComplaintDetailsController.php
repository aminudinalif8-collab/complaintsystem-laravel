<?php

namespace App\Http\Controllers\supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;

class SupervisorComplaintDetailsController extends Controller
{
    public function index($id)
    {
        $complaint = Complaint::findOrFail($id);
        // Fetch complaint details using $id and pass to view
        return view('supervisor.sv-complaintDetails.sv-compDetails', compact('complaint'));
    }
}
