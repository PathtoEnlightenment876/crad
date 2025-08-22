<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function create()
    {
        // Pass any data needed to the view
          return view('analytics', [
            'pageTitle' => 'Analytics Dashboard'
        ]);


    }
}
