<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'department', 'section', 'adviser_id', 'panel_ids'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function adviser()
    {
        return $this->belongsTo(\App\Models\Adviser::class, 'adviser_id');
    }
}
