<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//employee
use App\Http\Controllers\employee\EmployeeDashboardController;
use App\Http\Controllers\employee\EmployeeProfileController;
use App\Http\Controllers\employee\EmployeeOwnComplaintController;
use App\Http\Controllers\employee\EmployeeSubmitComplaintController;
use App\Http\Controllers\employee\EmployeeComplaintDetailsController;
use App\Http\Controllers\employee\EmployeeEditComplaintController;
use App\Http\Controllers\Auth\RegisterController;

//manager
use App\Http\Controllers\manager\ManagerDashboardController;
use App\Http\Controllers\manager\ManagerViewAllComplaintController;
use App\Http\Controllers\manager\ManagerPendingApprovalController;
use App\Http\Controllers\manager\ManagerManageUserController;
use App\Http\Controllers\manager\ManagerGenerateReportController;
use App\Http\Controllers\manager\ManagerComplaintDetailController;
use App\Http\Controllers\manager\ManagerEditComplaintController;
use App\Http\Controllers\manager\ManagerActionApprovalController;
use App\Http\Controllers\manager\ManagerProfileController;

//supervisor
use App\Http\Controllers\supervisor\SupervisorDashboardController;
use App\Http\Controllers\supervisor\SupervisorViewComplaintController;
use App\Http\Controllers\supervisor\SupervisorPendingApprovalController;
use App\Http\Controllers\supervisor\SupervisorReviseActionController;
use App\Http\Controllers\supervisor\SupervisorComplaintDetailsController;
use App\Http\Controllers\supervisor\SupervisorEditComplaintController;
use App\Http\Controllers\supervisor\SupervisorProfileController;

//clerk
use App\Http\Controllers\clerk\ClerkDashboardController;
use App\Http\Controllers\clerk\ClerkOwnComplaintController;
use App\Http\Controllers\clerk\ClerkSubmitComplaintController;
use App\Http\Controllers\clerk\ClerkProfileController;
use App\Http\Controllers\department\DepartmentAddController;
use App\Http\Controllers\clerk\ClerkComplaintDetailsController;
use App\Http\Controllers\clerk\ClerkEditComplaintController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes(['register' => false]);

/* PUBLIC */
Route::get('/', function () {
    return view('auth.login');
});

/* REGISTER */
Route::middleware(['auth', 'role:clerk,manager'])->group(function () {

    Route::get('/clerk/registerEmployee', [RegisterController::class, 'showEmployeeRegisterForm'])->name('clerk.register.employee');

    Route::post('/clerk/registerEmployee', [RegisterController::class, 'registerEmployee'])->name('clerk.register.employee.post');

});

/* CLERK */
Route::middleware(['auth', 'checkEmployeeStatus', 'role:clerk', 'preventBackHistory'])->group(function () {
    Route::get('/clerk/dashboard', [ClerkDashboardController::class, 'index'])->name('clerk.dashboard');
    // Route::post('/clerk/department/store', [ClerkDashboardController::class, 'storeDepartment'])->name('clerk.store.department');
    Route::get('/clerk/myComplaintsClerk', [ClerkOwnComplaintController::class, 'index'])->name('clerk.myComplaintsClerk');
    Route::get('/clerk/submitComplaintsClerk', [ClerkSubmitComplaintController::class, 'index'])->name('clerk.submitComplaintClerk');
    Route::get('/clerk/profiles', [ClerkProfileController::class, 'index'])->name('clerk.profileClerk');
    Route::post('/clerk/profile/update', [ClerkProfileController::class, 'update'])->name('clerk.profile.update');
    Route::post('/clerk/change-password', [ClerkProfileController::class, 'changePassword'])->name('clerk.password.update');
    Route::get('/clerk/submit-complaint', [ClerkSubmitComplaintController::class, 'index']);
    Route::post('/clerk/submit-complaint', [ClerkSubmitComplaintController::class, 'store'])->name('clerk.submitComplaint.store');
    Route::post('/clerk/add-department', [DepartmentAddController::class, 'store'])->name('clerk.store.department');
    Route::get('/get-supervisors/{departmentID}', [RegisterController::class, 'getSupervisors']);
    Route::get('/clerk/complaint/{id}', [ClerkComplaintDetailsController::class, 'index'])->name('clerk.complaintDetails');
    Route::get('/clerk/complaint/{id}/edit', [ClerkEditComplaintController::class, 'index'])->name('clerk.editComplaint');
    Route::post('/clerk/complaint/{id}/update', [ClerkEditComplaintController::class, 'update'])->name('clerk.updateComplaint');
    Route::post('/clerk/complaint/{id}/cancel', [ClerkEditComplaintController::class, 'cancelComplaint'])->name('clerk.cancelComplaint');
});

/* EMPLOYEE */
Route::middleware(['auth', 'checkEmployeeStatus', 'role:employee', 'preventBackHistory'])->group(function () {
    Route::get('/employee/dashboard', [EmployeeDashboardController::class, 'index'])->name('employee.dashboard');
    Route::get('/employee/profiles', [EmployeeProfileController::class, 'employeeProfile'])->name('employee.profile');
    Route::get('/employee/myComplaints', [EmployeeOwnComplaintController::class, 'index'])->name('employee.myComplaints');
    Route::get('/employee/submitComplaint', [EmployeeSubmitComplaintController::class, 'index'])->name('employee.submitComplaint');
    Route::post('/employee/submitComplaint', [EmployeeSubmitComplaintController::class, 'store'])->name('employee.submitComplaint.post');
    Route::post('/employee/profile/update', [EmployeeProfileController::class, 'updateProfile'])->name('employee.profile.update');
    Route::post('/employee/change-password', [EmployeeProfileController::class, 'changePassword'])->name('employee.password.update');
    Route::get('/employee/complaint/{id}', [EmployeeComplaintDetailsController::class, 'index'])->name('employee.complaintDetails');
    Route::get('/employee/complaint/{id}/edit', [EmployeeEditComplaintController::class, 'index'])->name('employee.editComplaint');
    Route::post('/employee/complaint/{id}/update', [EmployeeEditComplaintController::class, 'update'])->name('employee.updateComplaint');
    Route::post('/employee/complaint/{id}/cancel', [EmployeeEditComplaintController::class, 'cancelComplaint'])->name('employee.cancelComplaint');
});

/* MANAGER */
Route::middleware(['auth', 'checkEmployeeStatus', 'role:manager', 'preventBackHistory'])->group(function () {
    Route::get('/manager/dashboard', [ManagerDashboardController::class, 'index'])->name('manager.dashboard');
    Route::get('/manager/viewComplaints', [ManagerViewAllComplaintController::class, 'index'])->name('manager.viewComplaints');
    Route::get('/manager/pendingApproval', [ManagerPendingApprovalController::class, 'index'])->name('manager.pendingApproval');
    Route::get('/manager/manageUsers', [ManagerManageUserController::class, 'index'])->name('manager.manageUsers');
    Route::get('/manager/generateReport', [ManagerGenerateReportController::class, 'index'])->name('manager.generateReport');
    Route::get('/manager/managerReportPdfs/managerReportPdf/{type}', [ManagerGenerateReportController::class, 'downloadPdf'])->name('manager.report.pdf.custom');
    Route::get('/manager/complaint/{id}', [ManagerComplaintDetailController::class, 'index'])->name('manager.complaintDetails');
    Route::get('/manager/complaint/{id}/edit', [ManagerEditComplaintController::class, 'edit'])->name('manager.editComplaint');
    Route::post('/manager/complaint/{id}/update', [ManagerEditComplaintController::class, 'update'])->name('manager.updateComplaint');
    Route::post('/manager/action/{id}/approve', [ManagerActionApprovalController::class, 'approve'])->name('manager.action.approve');
    Route::post('/manager/action/{id}/reject', [ManagerActionApprovalController::class, 'reject'])->name('manager.action.reject');
    Route::get('/manager/get-supervisors/{departmentID}', [RegisterController::class, 'getSupervisors'])->name('manager.get.supervisors');
    Route::post('/manager/add-department', [DepartmentAddController::class, 'store'])->name('manager.department.store');
    Route::post('/manager/employee/{id}/deactivate', [ManagerManageUserController::class, 'deactivate'])->name('manager.employee.deactivate');
    Route::post('/manager/employee/{id}/activate', [ManagerManageUserController::class, 'activate'])->name('manager.employee.activate');
    Route::get('/manager/profiles', [ManagerProfileController::class, 'index'])->name('manager.profile');
    Route::post('/manager/profile/update', [ManagerProfileController::class, 'update'])->name('manager.profile.update');
    Route::post('/manager/change-password', [ManagerProfileController::class, 'changePassword'])->name('manager.password.update');
    Route::post('/manager/complaint/{id}/cancel', [ManagerEditComplaintController::class, 'cancel'])->name('manager.cancelComplaint');
});

/* SUPERVISOR */
Route::middleware(['auth', 'checkEmployeeStatus', 'role:supervisor', 'preventBackHistory'])->group(function () {
    Route::get('/supervisor/dashboard', [SupervisorDashboardController::class, 'index'])->name('supervisor.dashboard');
    Route::get('/supervisor/viewComplaints', [SupervisorViewComplaintController::class, 'index'])->name('supervisor.viewComplaints');
    Route::get('/supervisor/pendingApproval', [SupervisorPendingApprovalController::class, 'index'])->name('supervisor.pendingApproval');
    Route::get('/supervisor/reviseActions', [SupervisorReviseActionController::class, 'index'])->name('supervisor.reviseActions');
    Route::get('/supervisor/complaint/{id}', [SupervisorComplaintDetailsController::class, 'index'])->name('supervisor.complaintDetails');
    Route::get('/supervisor/complaint/{id}/edit', [SupervisorEditComplaintController::class, 'edit'])->name('supervisor.editComplaint');
    Route::post('/supervisor/complaint/{id}/update', [SupervisorEditComplaintController::class, 'update'])->name('supervisor.updateComplaint');
    Route::post('/supervisor/complaint/{id}/cancel', [SupervisorEditComplaintController::class, 'cancel'])->name('supervisor.cancelComplaint');
    Route::get('/supervisor/profile', [SupervisorProfileController::class, 'index'])->name('supervisor.profile');
    Route::post('/supervisor/profile/update', [SupervisorProfileController::class, 'update'])->name('supervisor.profile.update');
    Route::post('/supervisor/change-password', [SupervisorProfileController::class, 'changePassword'])->name('supervisor.password.update');
    Route::post('/supervisor/action/{id}/revise', [SupervisorReviseActionController::class, 'reviseSubmit'])->name('supervisor.reviseAction.submit');});
