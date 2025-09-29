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
        $remainingSeconds = $expiresAt ? Carbon::createFromTimestamp($expiresAt)->diffInSeconds(Carbon::now()) : 0;
        
        return view('auth.otp_verify', ['remainingSeconds' => $remainingSeconds]);
    }

    /**
     * Generate and send a new OTP to the user.
     */
    public function sendOtp(Request $request)
    {
        
        $request->validate(['email' => 'required|email|exists:users,email']);
        $user = User::where('email', $request->email)->first();

        // Check if user already has a valid OTP
        if ($user->otp && $user->otp_expires_at && $user->otp_expires_at > now()) {
            // Use existing OTP
            $otp = $user->otp;
            $expiresAt = $user->otp_expires_at;
        } else {
            // Generate new OTP
            $otp = rand(100000, 999999);
            $expiresAt = now()->addDays(3);
            
            // Update the user record with the new OTP and its expiration
            $user->otp = $otp;
            $user->otp_expires_at = $expiresAt;
            $user->save();
            
            // Send the OTP via email only for new OTP
            try {
                Mail::to($user->email)->send(new OtpMail($otp));
            } catch (\Exception $e) {
                \Log::error('Failed to send OTP email: ' . $e->getMessage());
                return back()->with('error', 'Failed to send OTP. Please try again.');
            }
        }
        
        // Store user ID and expiration time in the session
        session([
            'otp_user_id' => $user->id,
            'otp_expires_at' => $expiresAt->timestamp
        ]);

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

        if ((string)$user->otp !== (string)$request->otp) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect OTP. Please try again.'
            ]);
        }

        // OTP is valid
        Auth::login($user);

        // Keep OTP valid for 3 days - don't clear it
        $user->email_verified_at = now();
        $user->save();
        
        session()->forget('otp_user_id');

        $redirectUrl = $user->role === 'admin' ? route('admin.dashboard') : route('std-dashboard');
        
        return response()->json([
            'success' => true,
            'message' => 'Login successful!',
            'redirect_url' => $redirectUrl
        ]);
    }
}