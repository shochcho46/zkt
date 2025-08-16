<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;
use App\Models\LeaveType;

class LeaveApply extends Model
{
    protected $fillable = [
        'employee_id',
        'leave_type_id',
        'from_date',
        'to_date',
        'total_date',
        'note',
        'status',
        'apply_by',
        'approve_by',
        'approved_date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id');
    }

    public function appliedBy()
    {
        return $this->belongsTo(Admin::class, 'apply_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(Admin::class, 'approve_by');
    }
}
