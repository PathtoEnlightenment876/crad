<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DefenseEvaluation extends Model
{
    protected $fillable = [
        'department',
        'cluster', 
        'group_id',
        'defense_type',
        'redefense_type',
        'result',
        'feedback'
    ];
    
    public static function getGroupStatus($department, $cluster, $groupId)
    {
        return self::where('department', $department)
                  ->where('cluster', $cluster)
                  ->where('group_id', $groupId)
                  ->get()
                  ->keyBy(function($item) {
                      return $item->defense_type . ($item->redefense_type ? '_' . $item->redefense_type : '');
                  });
    }
}
