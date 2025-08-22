<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefenseSchedController extends Controller
{
    public function create()
    {
        
          // Pass any data needed to the view
             return view('set-sched', [
            'pageTitle' => 'Set Schedule'
        ]);
             return view('re-sched', [
            'pageTitle' => 'Reschedule'
        ]);

              return view('defense-calendar', [
            'pageTitle' => 'Defense Calendar'
        ]);

         
        
    }
}
