<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct()
    {
        // ONLY clerk and manager boleh access register employee
        $this->middleware(['auth', 'role:clerk,manager']);
    }

    /**
     * Show register employee form
     */
    public function showEmployeeRegisterForm()
    {
        $departments = Department::all();
        $supervisors = Employee::whereIn('role', ['supervisor', 'manager'])->get();

        return view('auth.registerEmployee', compact('departments'));
    }

    /**
     * Register new employee (by clerk only)
     */
    public function registerEmployee(Request $request)
    {
        // 1. VALIDATION
        $request->validate([
            'employeeName' => 'required|string|max:255',
            'employeeEmail' => 'required|email|max:255|unique:employees,employeeEmail',
            'employeePhone' => 'required|string|max:20',
            'role' => 'required|in:manager,clerk,supervisor,employee',
            'departmentID' => 'required|integer|exists:departments,departmentID',
            'supervisorID' => 'nullable|integer|exists:employees,employeeID',
            'employeePassword' => 'required|min:8|confirmed',
        ]);

        // 2. GET LOGGED IN CLERK
        $clerk = auth()->user();

        $role = $request->role;

        $supervisorID = null;

        // LOGIC IKUT ROLE
        if ($role === 'employee' || $role === 'clerk') {
            $supervisorID = $request->supervisorID; // get from form field
        } 
        elseif ($role === 'supervisor') {
            $supervisorID = null;
        } 
        elseif ($role === 'manager') {
            $supervisorID = null;
        }

        // 3. CREATE EMPLOYEE
        $employee = Employee::create([
            'employeeName' => $request->employeeName,
            'employeeEmail' => $request->employeeEmail,
            'employeePhone' => $request->employeePhone,
            'employeePicture' => null,
            'departmentID' => $request->departmentID,
            'employeePassword' => Hash::make($request->employeePassword),

            'role' => $role,
            'supervisorID' => $supervisorID,

            // SYSTEM CONTROLLED
            // 'role' => 'employee',
            // 'supervisorID' => $clerk->employeeID,
        ]);

        // 4. POST LOGIC (AFTER CREATE ONLY)
        if ($role === 'manager') {
            Department::where('departmentID', $request->departmentID)
                ->update([
                    'departmentManagerID' => $employee->employeeID
                ]);
        }

        // 4. REDIRECT BACK TO FORM (BETTER UX)
        $user = auth()->user();

        $redirectRoute = match ($user->role) {
            'manager' => 'manager.manageUsers',
            'clerk' => 'clerk.dashboard',
            default => 'employee.dashboard',
        };

        return redirect()
            ->route($redirectRoute)
            ->with('success', 'Employee berjaya didaftarkan!');
            }

    public function getSupervisors($departmentID)
    {
        $supervisors = Employee::with('department')
            ->where('role', 'supervisor')
            ->where('departmentID', $departmentID)
            ->get();

        return response()->json($supervisors);
    }
}