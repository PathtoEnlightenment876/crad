<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class LoginController extends Controller
{

    // Max attempts before lockout
    protected $maxAttempts = 2;

    // Lockout duration (in seconds)
    protected $decaySeconds = 60;

    public function showLoginForm(Request $request)
    {
        return view('auth.login');
    }
    
    public function checkLockout(Request $request)
    {
        $email = $request->get('email');
        if (!$email) {
            return response()->json(['locked' => false]);
        }
        
        $throttleKey = Str::transliterate(Str::lower($email).'|'.$request->ip());
        
        if (RateLimiter::tooManyAttempts($throttleKey, $this->maxAttempts)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return response()->json(['locked' => true, 'seconds' => $seconds]);
        }
        
        return response()->json(['locked' => false]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $throttleKey = Str::transliterate(Str::lower($request->input('email')).'|'.$request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, $this->maxAttempts)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'email' => "Too many login attempts. Please try again in $seconds seconds."
            ])->with('lockout_seconds', $seconds);
        }

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Only require OTP for admin accounts
            if ($user->is_admin) {
                Auth::logout(); // Logout immediately, require OTP verification
                
                // Check if user already has a valid OTP
                if (!$user->otp || !$user->otp_expires_at || $user->otp_expires_at < now()) {
                    // Generate new OTP only if none exists or expired
                    $otp = rand(100000, 999999);
                    $expiresAt = now()->addDays(3);
                    
                    $user->otp = $otp;
                    $user->otp_expires_at = $expiresAt;
                    $user->save();
                    
                    // Send OTP email
                    try {
                        \Mail::to($user->email)->send(new \App\Mail\OtpMail($otp));
                    } catch (\Exception $e) {
                        \Log::error('Failed to send OTP email: ' . $e->getMessage());
                        return back()->withErrors(['email' => 'Failed to send OTP. Please try again.']);
                    }
                }
                
                $expiresAt = $user->otp_expires_at;
                
                // Store user ID in session for OTP verification
                session([
                    'otp_user_id' => $user->id,
                    'otp_expires_at' => is_string($expiresAt) ? strtotime($expiresAt) : $expiresAt->timestamp
                ]);
                
                return redirect()->route('otp.verify.form');
            } else {
                // Student accounts go directly to dashboard
                return redirect()->intended('/std-dashboard');
            }
        }

        RateLimiter::hit($throttleKey, $this->decaySeconds);
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
