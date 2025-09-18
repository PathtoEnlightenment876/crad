<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Validation\ValidationException;

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
        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(5);
        $user->save();

        Mail::to($user->email)->send(new OtpMail($otp));

        session(['otp_user_id' => $user->id]);

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
