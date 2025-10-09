<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    protected $fillable = [
        'submission_id',
        'role',
        'name',
        'department',
        'adviser_name',
        'panel1',
        'panel2',
        'panel3',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
