use App\Models\Admin;
use App\Models\LeaveType;
<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveApply extends Model
{
    protected $fillable = [
        'admin_id',
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

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
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
