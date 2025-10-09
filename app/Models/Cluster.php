<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    protected $fillable = ['name','section'];

    public function advisers()
    {
        return $this->hasMany(Adviser::class);
    }

    public function panels()
    {
        return $this->hasMany(Panel::class);
    }
}