<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Admin\Database\Factories\EmployeeFactory;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'admin_id',
        'name',
        'userid',
        'uid',
        'role',
        'cardno',
        'phone',
        'address',
    ];

    
}
