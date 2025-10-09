<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'section_id',
        'adviser_id',
    ];

    public function adviser()
    {
        return $this->belongsTo(Professor::class, 'adviser_id');
    }

    public function panelMembers()
    {
        return $this->belongsToMany(Professor::class, 'assignment_panel_member');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}