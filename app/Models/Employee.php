<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Department;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'employees';

    protected $primaryKey = 'employeeID';

    protected $fillable = [
        'employeeName',
        'employeeEmail',
        'employeePassword',
        'employeePhone',
        'employeePicture',
        'role',
        'employeeStatus',
        'departmentID',
        'supervisorID',
    ];

    protected $hidden = [
        'employeePassword',
    ];

    public function getAuthPassword()
    {
        return $this->employeePassword;
    }

    public function getAuthIdentifierName()
    {
        return 'employeeEmail';
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'departmentID', 'departmentID');
    }

    public function supervisor()
    {
        return $this->belongsTo(Employee::class, 'supervisorID');
    }

    public function subordinates()
    {
        return $this->hasMany(Employee::class, 'supervisorID');
    }

    public function getFormattedEmployeeIdAttribute()
    {
        $prefix = match($this->role) {
            'employee' => 'EMP',
            'clerk' => 'CLK',
            'manager' => 'MGR',
            'supervisor' => 'SUP',
            default => 'EMP'
        };

        return $prefix . str_pad($this->employeeID, 4, '0', STR_PAD_LEFT);
    }

    public function departmentEmployees()
    {
        return $this->hasMany(Employee::class, 'departmentID', 'departmentID');
    }

    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['employeePassword'] = bcrypt($value);
    // }
}