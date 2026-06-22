<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Complaint;

class EmployeeProfileController extends Controller
{
    public function employeeProfile()
    {
        $employee = Auth::user(); 

        $complaints = Complaint::where('employeeID', $employee->employeeID)->get();

        $total = $complaints->count();
        $pending = $complaints->where('complaintStatus', 'Pending')->count();
        $progress = $complaints->where('complaintStatus', 'In Progress')->count();

        // adjust ikut system kau
        $resolved = $complaints->whereIn('complaintStatus', ['Resolved', 'Approved'])->count();

        return view('employee.profiles.employeeProfile', compact('employee', 'total', 'pending', 'progress', 'resolved'));
    }

    //update profile
    public function updateProfile(Request $request)
    {
        try {
            $validated = $request->validate([
                'employeeName' => 'nullable|string|max:255',
                'employeeEmail' => 'nullable|email|max:255',
                'employeePhone' => 'nullable|string|max:20',
                'employeePicture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $employee = Auth::user();

            // upload image
            if ($request->hasFile('employeePicture')) {
                // Delete old picture if exists
                if ($employee->employeePicture) {
                    $oldPath = public_path('uploads/' . $employee->employeePicture);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
                
                $pictureName = time() . '.' . $request->employeePicture->extension();
                $request->employeePicture->move(public_path('uploads'), $pictureName);
                $employee->employeePicture = $pictureName;
            }

            // update data
            if ($request->filled('employeeName')) {
                $employee->employeeName = $request->employeeName;
            }
            if ($request->filled('employeeEmail')) {
                $employee->employeeEmail = $request->employeeEmail;
            }
            if ($request->filled('employeePhone')) {
                $employee->employeePhone = $request->employeePhone;
            }

            $employee->save();

            // Return JSON for AJAX requests
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Profile updated successfully!',
                    'picture' => $employee->employeePicture
                ]);
            }

            return back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 400);
            }
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Change password
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $employee = Auth::user();

        if (!Hash::check($request->current_password, $employee->employeePassword)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $employee->employeePassword = Hash::make($request->new_password);
        $employee->save();

        return back()->with('success', 'Password updated successfully!');
    }
}
