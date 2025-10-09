<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'panel_id',
        'date',
        'start_time',
        'end_time',
    ];

    public function professor()
    {
        return $this->belongsTo(Professor::class, 'panel_id');
    }
}
