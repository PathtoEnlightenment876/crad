<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentPanel extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'panel_id',
        'role',
        'name',
        'department',
        'section',
        'expertise',
        'availability',
    ];
    
    public function panel()
    {
        return $this->belongsTo(Panel::class);
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }
    
}

