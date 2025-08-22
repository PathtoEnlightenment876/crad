<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function create()
    {
        // Pass any data needed to the view
        return view('new-proposal', [
            'pageTitle' => 'Submit New Proposal'
        ]);

        return view('proposal-stats', [
            'pageTitle' => 'Proposal Status Tracking'
        ]);

        return view('feedback', [
            'pageTitle' => 'Reviewer Feedback'
        ]);

        return view('resubmit', [
            'pageTitle' => 'Resubmit Proposal'
        ]);

        return view('approve', [
            'pageTitle' => 'Approved Proposals'
        ]);
    }
}
