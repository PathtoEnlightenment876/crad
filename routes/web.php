<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OtpAuthController;
use App\Http\Controllers\AdminSubmissionController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentSubmissionController;
use App\Http\Controllers\AdminController;
use App\Models\File;
use App\Http\Controllers\PanelAdviserController;



// Login Page is now the Homepage
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Login & Authentication Routes
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// One-Time Password (OTP) Routes
Route::get('/otp-verify', [OtpAuthController::class, 'showVerifyForm'])->name('otp.verify.form');
Route::post('/otp-verify', [OtpAuthController::class, 'verifyOtp'])->name('otp.verify.submit');

// Dashboard
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth'])
    ->name('dashboard');

    
// Proposals
Route::get('/track-proposal', fn() => view('track-proposal'));

// Adviser & Panel Assignment
Route::get('/panel-adviser', fn() => view('panel-adviser'));
Route::get('/view-panel-adviser', fn() => view('view-panel-adviser'));



// Analytics & Reporting
Route::get('/analytics', fn() => view('analytics'));



//Submission for Student Portal


// Student routes
Route::middleware(['auth'])->group(function () {
    Route::get('/std-dashboard', [StudentController::class, 'dashboard'])->name('std-dashboard');
    Route::get('/submission', [StudentController::class, 'submission'])->name('submission');
    Route::post('/files', [StudentController::class, 'store'])->name('student.files.store');
    Route::get('/notifications', [StudentController::class, 'notifications'])->name('student.notifications');
});

// Admin routes
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');

    Route::get('/track-proposal', [AdminSubmissionController::class, 'index'])->name('admin.track-proposal');
    Route::post('/submissions/{id}/update-status', [AdminSubmissionController::class, 'updateStatus'])->name('admin.submissions.updateStatus');
    Route::post('/submission/{id}/approve', [AdminSubmissionController::class, 'approve'])->name('admin.submission.approve');
    Route::post('/submission/{id}/reject', [AdminSubmissionController::class, 'reject'])->name('admin.submission.reject');
    Route::post('/submission/{id}/feedback', [AdminSubmissionController::class, 'feedback'])->name('admin.submission.feedback');
});

// Track proposal page
Route::get('/track-proposal', [AdminSubmissionController::class, 'index'])
    ->name('admin.track-proposal')
    ->middleware('auth');

// Update submission status
Route::post('/submissions/{id}/update-status', [AdminSubmissionController::class, 'updateStatus'])
    ->name('admin.submissions.updateStatus')
    ->middleware('auth');

    Route::prefix('student')->middleware(['auth'])->group(function () {
        Route::get('/submission', [StudentSubmissionController::class, 'index'])->name('student.submissions.index');
    
        // Route for viewing a single submission file
        Route::get('/submission/file/{submission}', [StudentSubmissionController::class, 'viewFile'])->name('submission.file');

    });

// For admins
Route::get('/admin/track-proposal/view/{submission}', [AdminSubmissionController::class, 'viewFile'])
->middleware('auth')
->name('admin.track-proposal.view');

Route::get('/panel-adviser', [PanelAdviserController::class, 'index'])->name('panel-adviser.index');
Route::post('/panel-adviser', [PanelAdviserController::class, 'store'])->name('panel-adviser.store');


// Committee Management
Route::post('/committee/store', [CommitteeController::class, 'store'])->name('committee.store');
Route::put('/committee/{id}/update', [CommitteeController::class, 'update'])->name('committee.update');
Route::delete('/committee/{id}/delete', [CommitteeController::class, 'destroy'])->name('committee.destroy');

//route-std
Route::get('/view-panel-adviser', [StudentSubmissionController::class, 'viewPanelAdviser'])
    ->name('student.view-panel-adviser')
    ->middleware('auth');

// Panel-Adviser page (admin)
Route::get('/panel-adviser', [AdminSubmissionController::class, 'panelAdviser'])
    ->name('panel-adviser');
//resubmit
Route::put('/student/files/{id}/resubmit', [StudentSubmissionController::class, 'resubmit'])
    ->name('student.files.resubmit');
