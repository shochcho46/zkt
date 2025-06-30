<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'logo_name',
        'matchine_ip',
        'matchine_port',
        'start_time',
        'end_time',
        'delay_time',
    ];
}
