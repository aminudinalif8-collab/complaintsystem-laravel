<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Employee;
use App\Models\Department;

class ManagerManageUserController extends Controller
{
        /**
        * Display a listing of the resource.
        *
        * @return \Illuminate\Http\Response
        */
        public function index()
        {
            $employees = Employee::with('department')
                    ->latest()
                    ->paginate(10);

            $departments = Department::all();

            $supervisors = Employee::whereIn('role', ['supervisor', 'manager'])
                    ->get();

            return view(
                'manager.managerManageUsers.managerManageUser',
                compact(
                    'employees',
                    'departments',
                    'supervisors'
                )
            );
        }

        /// Deactivate an employee account
        public function deactivate($id)
        {
            if(auth()->id() == $id)
            {
                return back()->with(
                    'error',
                    'You cannot deactivate your own account.'
                );
            }

            $employee = Employee::findOrFail($id);

            $employee->update([
                'employeeStatus' => 'Inactive'
            ]);

            return back()->with(
                'success',
                'Employee deactivated successfully.'
            );
        }

        // Activate an employee account
        public function activate($id)
        {
            $employee = Employee::findOrFail($id);

            $employee->update([
                'employeeStatus' => 'Active'
            ]);

            return back()->with(
                'success',
                'Employee activated successfully.'
            );
        }
    
        /**
        * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
        */
        public function create()
        {
            //
        }
    
        /**
        * Store a newly created resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return \Illuminate\Http\Response
        */
        public function store(Request $request)
        {
            //
        }
    
        /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function show($id)
        {
            //
        }
    
        /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function edit($id)
        {
            //
        }
    
        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function update(Request $request, $id)
        {
            //
        }
    
        /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function destroy($id)
        {
            //
        }
}
