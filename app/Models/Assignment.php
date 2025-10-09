<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['department', 'section', 'adviser_id'];

    public function panels()
    {
        return $this->hasMany(AssignmentPanel::class);
    }

    public function adviser()
    {
        return $this->belongsTo(Adviser::class);
    }

    public function assignmentPanels()
    {
        return $this->hasMany(AssignmentPanel::class);
    }

}

