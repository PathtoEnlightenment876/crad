<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class OtpController extends Controller
{
    /**
     * Show the OTP verification form.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showVerifyForm()
    {
        // Check if a user is currently in the process of being verified
        if (!session('otp_user_id')) {
            return redirect()->route('login');
        }

        return view('auth.otp_verify');
    }

    /**
     * Handle the OTP verification process.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        // Retrieve the user based on the session ID
        $user = User::find(session('otp_user_id'));

        // Check if the user exists, the OTP matches, and it has not expired
        if (!$user || $user->otp !== $request->otp || $user->otp_expires_at < now()) {
            return back()->with('error', 'The OTP is invalid or has expired.');
        }

        // OTP is correct, log the user in
        Auth::login($user);

        // For security, clear the OTP from the database
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        // Clear the session variable
        session()->forget('otp_user_id');

        // Redirect to the intended page (e.g., the dashboard)
        return redirect()->intended('/dashboard');
    }
}