<?php

namespace App\Http\Controllers\department;

use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentAddController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        // ALLOW CLERK AND MANAGER ROLES ONLY
        if (!in_array($user->role, ['clerk', 'manager'])) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        // VALIDATION
        $request->validate([
            'departmentName' => 'required|unique:departments,departmentName',
        ]);

        // INSERT DATA
        Department::create([
            'departmentName' => $request->departmentName,
            // 'departmentManagerID' => null, // default null, nanti boleh assign manager kat department
        ]);

        return redirect()->back()->with('success', 'Department added successfully');
    }
}
