<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id',
        'expertise',
        'is_adviser',
    ];

    // A professor can be an adviser in many final assignments
    public function assignmentsAsAdviser()
    {
        return $this->hasMany(FinalAssignment::class, 'adviser_id');
    }

    // A professor can be a panel member in many final assignments
    public function assignmentsAsPanel()
    {
        return $this->belongsToMany(FinalAssignment::class, 'assignment_panel_member');
    }

    // Panel availability slots
    public function slots()
    {
        return $this->hasMany(PanelSlot::class, 'panel_id');
    }

    public function department()
{
    return $this->belongsTo(Department::class);
}

}
