<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $table = 'complaints';

    protected $primaryKey = 'complaintID';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = true;

    protected $fillable = [
        'complaintTitle',
        'complaintDescription',
        'complaintCategory',
        'complaintStatus',
        'complaintPriority',
        'complaintDate',
        'complaintEvidence',
        'employeeID'
    ];

    // RELATIONSHIP
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employeeID', 'employeeID');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->complaintDate = now();
        });
    }

    public function actions()
    {
        return $this->hasMany(ComplaintAction::class, 'complaintID', 'complaintID');
    }

    // public function supervisor()
    // {
    //     return $this->belongsTo(Employee::class, 'supervisorID', 'employeeID');
    // }
}