<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resubmission extends Model
{
    protected $fillable = [
        'submission_id',
        'title',
        'file_path',
        'user_id'
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}