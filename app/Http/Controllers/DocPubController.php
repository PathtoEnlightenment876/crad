<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocPubController extends Controller
{
    public function create()
    {
        
          // Pass any data needed to the view
            return view('archive', [
            'pageTitle' => 'Repository'
        ]);
            return view('publication', [
            'pageTitle' => 'Publications'
        ]);

             return view('repo', [
            'pageTitle' => 'Repository'
        ]);

         
             return view('report', [
            'pageTitle' => 'Report'
        ]);
        
    }
}
