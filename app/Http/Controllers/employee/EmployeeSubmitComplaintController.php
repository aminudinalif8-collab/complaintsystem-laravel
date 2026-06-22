<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Cloudinary\Cloudinary;

use App\Services\PriorityService;
use App\Models\Complaint;  

class EmployeeSubmitComplaintController extends Controller
{
    // SHOW SUBMIT COMPLAINT FORM
    public function index()
    {
        $categories = [

            // IT / TECHNICAL
            'IT & System Issues',
            'System Access & Security',

            // FINANCE / PROCUREMENT
            'Finance & Billing',
            'Payroll & Salary',
            'Procurement & Purchasing',

            // HR / EMPLOYEE
            'Human Resource',
            'Workplace Conduct & Harassment',
            'Attendance & Leave',

            // FACILITY / OFFICE
            'Facility & Maintenance',
            'Office Equipment & Environment',
            'Transportation & Parking',

            // OPERATIONS / MANAGEMENT
            'Management & Communication',
            'Policy & Compliance',
            'Customer Service',

            // PEOPLE DEVELOPMENT
            'Training & Performance',

            // OTHER
            'Other'
        ];

        return view(
            'employee.submitComplaints.submitComplaint',
            compact('categories')
        );
    }

    // STORE COMPLAINT
    public function store(Request $request)
    {
        $request->validate([
            'complaintTitle' => 'required',
            'complaintDescription' => 'required',
            'complaintCategory' => 'required',
            'complaintEvidence' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $priorityService = new PriorityService();

        $filePath = null;

        if ($request->hasFile('complaintEvidence')) {

            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => config('services.cloudinary.cloud_name'),
                    'api_key'    => config('services.cloudinary.api_key'),
                    'api_secret' => config('services.cloudinary.api_secret'),
                ],
            ]);

            $uploadedFile = $cloudinary->uploadApi()->upload(
                $request->file('complaintEvidence')->getRealPath(),
                [
                    'folder' => 'complaints_evidence',
                    'resource_type' => 'raw'
                ]
            );

            $filePath = $uploadedFile['secure_url'];
        }

        $priority = $priorityService->calculatePriority(
            $request->complaintTitle,
            $request->complaintDescription,
            $request->complaintCategory,
            $request->hasFile('complaintEvidence')
        );

        Complaint::create([
            'complaintTitle' => $request->complaintTitle,
            'complaintDescription' => $request->complaintDescription,
            'complaintCategory' => $request->complaintCategory,
            'complaintPriority' => $priority,
            'complaintStatus' => 'Pending',
            'complaintDate' => now(),
            'complaintEvidence' => $filePath,
            'employeeID' => Auth::user()->employeeID,
        ]);

        return redirect()->route('employee.myComplaints')->with('success', 'Complaint submitted successfully!');
    }
}
