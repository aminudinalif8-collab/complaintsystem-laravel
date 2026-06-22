<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Complaint;
use App\Models\Employee;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';
    protected $primaryKey = 'departmentID';
    public $timestamps = true;

    protected $fillable = [
        'departmentName',
        'departmentManagerID',
    ];

    // relationship: manager department
    public function manager()
    {
        return $this->belongsTo(Employee::class, 'departmentManagerID', 'employeeID');
    }

    // relationship: semua employee dalam department
    public function employees()
    {
        return $this->hasMany(Employee::class, 'departmentID', 'departmentID');
    }

    // relationship: semua complaint dalam department melalui employee
    public function complaints()
    {
        return $this->hasManyThrough(
            Complaint::class,
            Employee::class,
            'departmentID',
            'employeeID',
            'departmentID',
            'employeeID'
        );
    }
}
