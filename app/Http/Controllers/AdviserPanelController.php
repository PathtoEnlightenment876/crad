<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdviserPanelController extends Controller
{
    public function create()
    {
        
          // Pass any data needed to the view
           return view('add-adviser', [
            'pageTitle' => 'Add Adviser'
        ]);
           return view('add-panel', [
            'pageTitle' => 'Add Panel'
        ]);

           return view('assign-adviser', [
            'pageTitle' => 'Assign Adviser'
        ]);

         
           return view('assign-panel', [
            'pageTitle' => 'Assign Panel'
        ]);
        
           return view('view-assigns', [
            'pageTitle' => 'Current Assignments'
        ]);
       
    }
}
