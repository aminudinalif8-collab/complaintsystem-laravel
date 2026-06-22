<?php

namespace App\Http\Controllers\supervisor;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SupervisorProfileController extends Controller
{
    public function index()
    {
        $employee = auth()->user();
        $supervisorID = $employee->employeeID;

        // 1. employee bawah supervisor
        $employeeIDs = \App\Models\Employee::where('supervisorID', $supervisorID)
            ->pluck('employeeID');

        // 2. complaint ikut employee bawah supervisor
        $query = \App\Models\Complaint::whereIn('employeeID', $employeeIDs);

        $total = $query->count();
        $pending = (clone $query)->where('complaintStatus', 'Pending')->count();
        $progress = (clone $query)->where('complaintStatus', 'In Progress')->count();
        $resolved = (clone $query)->where('complaintStatus', 'Resolved')->count();

        return view('supervisor.profiles.svProfile', compact(
            'employee',
            'total',
            'pending',
            'progress',
            'resolved'
        ));
    }

    // Update profile
    public function update(Request $request)
    {
        $employee = Auth::user();

        $request->validate([
            'employeeName' => 'nullable|string|max:255',
            'employeeEmail' => 'nullable|email|max:255',
            'employeePhone' => 'nullable|string|max:20',
            'employeePicture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->filled('employeeName')) {
            $employee->employeeName = $request->employeeName;
        }
        if ($request->filled('employeeEmail')) {
            $employee->employeeEmail = $request->employeeEmail;
        }
        if ($request->filled('employeePhone')) {
            $employee->employeePhone = $request->employeePhone;
        }

        // upload image
        if ($request->hasFile('employeePicture')) {
            $file = $request->file('employeePicture');
            $filename = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('uploads'), $filename);

            $employee->employeePicture = $filename;
        }

        $employee->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    // Change password
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $employee = Auth::user();

        // check password lama
        if (!Hash::check($request->current_password, $employee->employeePassword)) {
            return back()->withErrors(['current_password' => 'Current password is wrong']);
        }

        // update password
        $employee->employeePassword = Hash::make($request->new_password);
        $employee->save();

        return back()->with('success', 'Password updated successfully!');
    }
}
