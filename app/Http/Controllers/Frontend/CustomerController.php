<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class CustomerController extends Controller
{
    /**
     * SHOW LOGIN FORM
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('customer.account');
        }
        return view('frontend.authentication.login');
    }

    /**
     * PROCESS LOGIN
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('customer.account'))
                ->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * SHOW MULTI-STAGE SIGNUP FORM
     */
    public function showSignup()
    {
        if (Auth::check()) {
            return redirect()->route('customer.account');
        }

        $currentStage = session('signup_stage', 1);
        $signupData = session('signup_data', []);

        return view('frontend.authentication.signup', compact('currentStage', 'signupData'));
    }

    /**
     * PROCESS SIGNUP STAGES
     */
    public function processSignupStage(Request $request)
    {
        $stage = (int) $request->input('stage');
        $signupData = session('signup_data', []);

        // =========================
        // STAGE 1: BASIC DETAILS
        // =========================
        if ($stage === 1) {

            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name'  => 'required|string|max:255',
                'email'      => 'required|email|unique:users,email',
                'phone'      => 'required|string|max:15',
                'password'   => ['required', 'string', 'min:6', 'confirmed'],
            ]);

            $signupData = array_merge($signupData, $validated);

            session([
                'signup_data'  => $signupData,
                'signup_stage' => 2
            ]);

            return redirect()->route('signup');
        }

        // =========================
        // STAGE 2: ADDRESS DETAILS
        // =========================
        elseif ($stage === 2) {

            $validated = $request->validate([
                'address'          => 'required|string',
                'town'             => 'required|string',
                'county'           => 'required|string',

                'shipping_name'    => 'required|string',
                'shipping_phone'   => 'required|string',
                'shipping_email'   => 'required|email',
                'shipping_address' => 'required|string',
                'shipping_town'    => 'required|string',
                'shipping_county'  => 'required|string',
            ]);

            $signupData = array_merge($signupData, $validated);

            // =========================
            // OTP GENERATION
            // =========================
            $realOtp = (string) rand(100000, 999999);

            session([
                'signup_data'  => $signupData,
                'signup_stage' => 3,
                'active_otp'   => $realOtp
            ]);

            logger("Verification OTP Code for {$signupData['email']}: {$realOtp}");

            return redirect()->route('signup')
                ->with('info', "A verification code has been sent! (Simulation: {$realOtp})");
        }

        return redirect()->route('signup');
    }

    /**
     * VERIFY OTP & COMPLETE REGISTRATION
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string',
        ]);

        if ($request->otp !== session('active_otp')) {
            return back()->withErrors(['otp' => 'The system cannot match this verification token.']);
        }

        $data = session('signup_data');

        if (!$data) {
            return redirect()->route('signup')->with('error', 'Session expired. Please restart registration.');
        }

        // Encrypt the password and persist user
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        // Wipe out the progress tracking sessions
        session()->forget(['signup_data', 'signup_stage', 'active_otp']);

        Auth::login($user);

        return redirect()->route('customer.account')->with('success', 'Account registration complete! Welcome aboard.');
    }

    /**
     * LOGOUT METHOD
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully!');
    }

    /**
     * CUSTOMER ACCOUNT DASHBOARD
     */
    public function account()
    {
        $user = Auth::user();

        // REAL orders from database
        $orders = $user->orders()->with('items')->latest()->get();

        // Latest order snapshot (for dashboard shipping display)
        $latestOrder = $user->orders()->latest()->first();

        $customer = [
            'id' => $user->id,
            'name' => $user->first_name . ' ' . $user->last_name,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,

            // fallback profile info
            'address' => $user->address,
            'town' => $user->town,
            'county' => $user->county,

            // IMPORTANT: shipping comes from latest order (NOT user table)
            'shipping_name' => $latestOrder->shipping_name ?? null,
            'shipping_phone' => $latestOrder->shipping_phone ?? null,
            'shipping_email' => $latestOrder->shipping_email ?? null,
            'shipping_address' => $latestOrder->shipping_address ?? null,
            'shipping_town' => $latestOrder->shipping_town ?? null,
            'shipping_county' => $latestOrder->shipping_county ?? null,
        ];

        return view('frontend.pages.customer', compact('customer', 'orders'));
    }

    /**
     * UPDATE PROFILE
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'phone'      => 'required|string|max:20',

            'shipping_name'    => 'nullable|string|max:255',
            'shipping_phone'   => 'nullable|string|max:20',
            'shipping_email'   => 'nullable|email|max:255',
            'shipping_address' => 'nullable|string|max:255',
            'shipping_town'    => 'nullable|string|max:255',
            'shipping_county'  => 'nullable|string|max:255',
        ]);

        $user->fill($validated);
        $user->save();

        // force fresh data from DB
        $user->refresh();

        return back()
            ->with('success', 'Profile and shipping information updated successfully.')
            ->with('customer', $user);
    }

    /**
     * CHANGE PASSWORD
     */
    public function updatePassword(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|string',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided current password does not match your record.']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Security configurations updated! Password has changed successfully.');
    }

    /**
     * FORGOT PASSWORD: SHOW LINK REQUEST FORM
     */
    public function showLinkRequestForm()
    {
        return view('frontend.authentication.forgot-password');
    }

    /**
     * FORGOT PASSWORD: SEND RESET LINK EMAIL (REAL DATABASE WRITE)
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $token = bin2hex(random_bytes(32));

        // Insert or update token into the native password_reset_tokens table
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($token), // It's standard practice to hash it in DB
                'created_at' => Carbon::now()
            ]
        );

        $resetUrl = route('password.reset', ['token' => $token]) . '?email=' . urlencode($request->email);

        return back()->with('status', 'We have simulated your password reset link execution route! Link: ' . $resetUrl);
    }

    /**
     * FORGOT PASSWORD: SHOW RESET FORM
     */
    public function showResetForm(Request $request, $token)
    {
        $email = $request->query('email');

        $resetRecord = DB::table('password_reset_tokens')->where('email', $email)->first();

        // Check if token exists and isn't older than 60 minutes
        if (!$resetRecord || !Hash::check($token, $resetRecord->token) || Carbon::parse($resetRecord->created_at)->addMinutes(60)->isPast()) {
            return redirect()->route('password.request')->withErrors(['email' => 'This password reset token is invalid or expired.']);
        }

        return view('frontend.authentication.reset-password', ['token' => $token, 'email' => $email]);
    }

    /**
     * FORGOT PASSWORD: COMPLETE RESET PASSWORD ACTION
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $resetRecord = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$resetRecord || !Hash::check($request->token, $resetRecord->token)) {
            return back()->withErrors(['email' => 'Verification values mismatched. Please restart recovery sequence.']);
        }

        // Update the password
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        // Delete used token from your database table
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Your password credentials have been updated! Please sign in using your new password.');
    }
}
