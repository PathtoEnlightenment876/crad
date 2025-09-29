<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // <-- make sure you have resources/views/auth/login.blade.php
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    $user = Auth::user();

    // ✅ Check role before sending OTP
    if ($user->role === 'admin') {
        // Admin → require OTP
        // Check if user already has a valid OTP
        if ($user->otp && $user->otp_expires_at && $user->otp_expires_at > now()) {
            // Use existing OTP
            $expiresAt = Carbon::parse($user->otp_expires_at);
        } else {
            // Generate new OTP
            $otp = rand(100000, 999999);
            $expiresAt = now()->addDays(3);
            
            $user->otp = $otp;
            $user->otp_expires_at = $expiresAt;
            $user->save();
            
            // Send email only for new OTP
            Mail::to($user->email)->send(new OtpMail($otp));
        }

        session([
            'otp_user_id' => $user->id,
            'otp_expires_at' => $expiresAt->timestamp
        ]);

        return redirect()->route('otp.verify.form');
    } elseif ($user->role === 'student') {
        // Student → skip OTP and go to dashboard
        return redirect()->route('std-dashboard');
    }

    // Default fallback
    return redirect('/');
}

public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/'); // back to login page
}

}
