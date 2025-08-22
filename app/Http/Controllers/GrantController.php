<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GrantController extends Controller
{
    public function create()
    {
        // Pass any data needed to the view
          return view('apply-grants', [
            'pageTitle' => 'Apply for Grant'
        ]);

          return view('grant-status', [
            'pageTitle' => 'Grant Status'
        ]);

          return view('fund-alloc', [
            'pageTitle' => 'Fund Allocation'
        ]);

          return view('disburse', [
            'pageTitle' => 'Disbursement Schedule'
        ]);
         
          return view('fund-reports', [
            'pageTitle' => 'Funding Reports'
        ]);
    }
}
