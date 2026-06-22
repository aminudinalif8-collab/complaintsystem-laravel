<?php

namespace App\Http\Controllers\clerk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Models\Complaint;

class ClerkProfileController extends Controller
{
    public function index()
    {
        $employee = Auth::user(); 

        $complaints = Complaint::where('employeeID', $employee->employeeID)->get();

        $total = $complaints->count();
        $pending = $complaints->where('complaintStatus', 'Pending')->count();
        $inProgress = $complaints->where('complaintStatus', 'In Progress')->count();
        $resolved = $complaints->whereIn('complaintStatus', ['Resolved', 'Approved'])->count();

        return view('clerk.profilesClerk.profileClerk', compact('employee', 'total', 'pending', 'inProgress', 'resolved'));
    }

    // update profile
    public function update(Request $request)
    {
        $employee = Auth::user();

        $request->validate([
            'employeeName' => 'required|string|max:255',
            'employeeEmail' => 'required|email|max:255|unique:employees,employeeEmail,' . $employee->employeeID . ',employeeID',
            'employeePhone' => 'required|string|max:20',
            'employeePicture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // ================= UPLOAD GAMBAR =================
        if ($request->hasFile('employeePicture')) {

            $file = $request->file('employeePicture');

            // generate nama unik
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            // simpan dalam public/uploads
            $file->move(public_path('uploads'), $filename);

            // optional: delete gambar lama
            if ($employee->employeePicture && file_exists(public_path('uploads/' . $employee->employeePicture))) {
                unlink(public_path('uploads/' . $employee->employeePicture));
            }

            // update nama file
            $employee->employeePicture = $filename;
        }

        // ================= UPDATE DATA =================
        $employee->update([
            'employeeName' => $request->employeeName,
            'employeeEmail' => $request->employeeEmail,
            'employeePhone' => $request->employeePhone,
            'employeePicture' => $employee->employeePicture,
        ]);

        return back()->with('success', 'Profile updated successfully!');
    }

    // change password
    public function changePassword(Request $request)
    {
        $employee = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        // 1. check current password betul atau tidak
        if (!Hash::check($request->current_password, $employee->employeePassword)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        // 2. check new password tak boleh sama dengan current password
        if (Hash::check($request->new_password, $employee->employeePassword)) {
            return back()->withErrors(['new_password' => 'New password cannot be same as current password']);
        }

        // 3. update password
        $employee->employeePassword = Hash::make($request->new_password);
        $employee->save();

        return back()->with('success', 'Password changed successfully!');
    }
}
