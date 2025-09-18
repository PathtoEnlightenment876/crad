<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class OtpAuthController extends Controller
{
    /**
     * Show the OTP verification form.
     */
    public function showVerifyForm()
    {
        if (!session('otp_user_id')) {
            return redirect()->route('login');
        }

        // Optional: Pass remaining time to the view for countdown
        $expiresAt = session('otp_expires_at');
        $remainingSeconds = $expiresAt ? Carbon::now()->diffInSeconds(new Carbon($expiresAt)) : 0;
        
        return view('auth.otp_verify', ['remainingSeconds' => $remainingSeconds]);
    }

    /**
     * Generate and send a new OTP to the user.
     */
    public function sendOtp(Request $request)
    {
        // Find the user. In a real-world scenario, you'd find this user based on their login attempt.
        // For this example, let's assume the user's email is submitted.
        $request->validate(['email' => 'required|email|exists:users,email']);
        $user = User::where('email', $request->email)->first();

        // 1. Generate the OTP
        $otp = rand(100000, 999999);

        // 2. Set the expiration time (e.g., 2 minutes from now)
        $expiresAt = now()->addMinutes(2);

        // 3. Update the user record with the new OTP and its expiration
        $user->otp = $otp;
        $user->otp_expires_at = $expiresAt;
        $user->save();
        
        // 4. Store user ID and expiration time in the session
        session([
            'otp_user_id' => $user->id,
            'otp_expires_at' => $expiresAt->timestamp
        ]);

        // 5. Send the OTP via email
        try {
            Mail::to($user->email)->send(new OtpMail($otp));
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Failed to send OTP email: ' . $e->getMessage());
            return back()->with('error', 'Failed to send OTP. Please try again.');
        }

        // Return a response, maybe redirect to the verification form
        return redirect()->route('otp.verify.form');
    }

    /**
     * Handle the OTP verification process.
     */
    public function verifyOtp(Request $request)
    {
        // ... (Your original verifyOtp code, which is correct for AJAX) ...
        $request->validate(['otp' => 'required|digits:6']);
        
        $user = User::find(session('otp_user_id'));

        if (!$user) {
            session()->forget('otp_user_id');
            return response()->json([
                'success' => false,
                'message' => 'User session not found. Please login again.'
            ]);
        }

        if ($user->otp_expires_at < now()) {
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();
            session()->forget('otp_user_id');
            return response()->json([
                'success' => false,
                'message' => 'OTP has expired. Please login again.'
            ]);
        }

        if ($user->otp !== $request->otp) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect OTP. Please try again.'
            ]);
        }

        // OTP is valid
        Auth::login($user);

        $user->otp = null;
        $user->otp_expires_at = null;
        $user->email_verified_at = now(); // Add this line to mark the email as verified
        $user->save();
        
        session()->forget('otp_user_id');

        $redirectUrl = $user->role === 'admin' ? route('admin.dashboard') : route('student.dashboard');
        
        return response()->json([
            'success' => true,
            'message' => 'Login successful!',
            'redirect_url' => $redirectUrl
        ]);
    }
}