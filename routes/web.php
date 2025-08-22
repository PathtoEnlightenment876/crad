<?php

use Illuminate\Support\Facades\Route;

// Dashboard or homepage
Route::get('/', function () {
    return view('welcome');
});


// Proposal Submission Module
Route::get('/new-proposal', fn() => view('proposals.new-proposal'));
Route::get('/proposal-stats', fn() => view('proposals.proposal-stats'));
Route::get('/feedback', fn() => view('proposals.feedback'));
Route::get('/resubmit', fn() => view('proposals.resubmit'));
Route::get('/approve', fn() => view('proposals.approve'));


// Adviser & Panel Assignment
Route::get('/add-adviser', fn() => view('adviser & panel.add-adviser'));
Route::get('/add-panel', fn() => view('adviser & panel.add-panel'));
Route::get('/assign-adviser', fn() => view('adviser & panel.assign-adviser'));
Route::get('/assign-panel', fn() => view('adviser & panel.assign-panel'));
Route::get('/view-assigns', fn() => view('adviser & panel.view-assigns'));

//Grants & Funding

Route::get('/apply-grants', fn() => view('grant.apply-grants'));
Route::get('/grant-status', fn() => view('grant.grant-status'));
Route::get('/fund-alloc', fn() => view('grant.fund-alloc'));
Route::get('/disburse', fn() => view('grant.disburse'));
Route::get('/fund-reports', fn() => view('grant.fund-reports'));

//Docu & Publication

Route::get('/archive', fn() => view('docu & pub.archive'));
Route::get('/publication', fn() => view('docu & pub.publication'));
Route::get('/repo', fn() => view('docu & pub.repo'));
Route::get('/report', fn() => view('docu & pub.report'));



// Analytics & Reporting
Route::get('/analytics', fn() => view('analytics.analytics'));


// Defense Scheduling
Route::get('/set-sched', fn() => view('defense sched.set-sched'));
Route::get('/re-sched', fn() => view('defense sched.re-sched'));
Route::get('/defense-calendar', fn() => view('defense sched.defense-calendar'));

// Dashboard
Route::get('/dashboard', fn() => view('dashboard.dashboard'));

// Login Form
Route::get('/login', fn() => view('login'));