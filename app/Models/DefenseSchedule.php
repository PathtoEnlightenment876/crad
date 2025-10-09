<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DefenseSchedule extends Model
{
    protected $fillable = [
        'department',
        'cluster',
        'group_id',
        'defense_type',
        'schedule_date',
        'start_time',
        'end_time',
        'set_letter',
        'adviser',
        'chairperson',
        'members',
        'status'
    ];

    protected $casts = [
        'schedule_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i'
    ];
}