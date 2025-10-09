<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResubmissionHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id',
        'title',
        'file_path',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}

