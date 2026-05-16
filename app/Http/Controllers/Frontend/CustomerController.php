<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * SHOW LOGIN FORM
     */
    public function showLogin()
    {
        return view('frontend.authentication.login');
    }

    /**
     * PROCESS LOGIN (MOCK)
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Simulating an active mock session since no database is present
        session(['mock_logged_in' => true, 'mock_user_email' => $request->email]);

        return redirect()->route('customer.account')->with('success', 'Welcome back! (Mock Login)');
    }

    /**
     * SHOW MULTI-STAGE SIGNUP FORM
     */
    public function showSignup()
    {
        $currentStage = session('signup_stage', 1);
        $signupData = session('signup_data', []);

        return view('frontend.authentication.signup', compact('currentStage', 'signupData'));
    }

    /**
     * PROCESS SIGNUP STAGES (MOCK)
     */
    public function processSignupStage(Request $request)
    {
        $stage = (int)$request->input('stage');
        $signupData = session('signup_data', []);

        if ($stage === 1) {
            $validated = $request->validate([
                'name'  => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string|max:15',
                'password' => 'required|string|min:6|confirmed',
            ]);

            $signupData = array_merge($signupData, $validated);
            session(['signup_data' => $signupData, 'signup_stage' => 2]);
            return redirect()->route('signup');
        } elseif ($stage === 2) {
            $validated = $request->validate([
                'address'         => 'required|string',
                'town'            => 'required|string',
                'county'          => 'required|string',
                'billing_address' => 'required|string',
                'billing_town'    => 'required|string',
                'billing_county'  => 'required|string',
                'shipping_name'   => 'required|string',
                'shipping_phone'  => 'required|string',
                'shipping_email'  => 'required|email',
                'shipping_address' => 'required|string',
                'shipping_town'   => 'required|string',
                'shipping_county' => 'required|string',
            ]);

            $signupData = array_merge($signupData, $validated);

            session([
                'signup_data' => $signupData,
                'signup_stage' => 3,
                'mock_otp' => '123456'
            ]);

            return redirect()->route('signup')->with('info', 'An OTP code (123456) has been dispatched to your phone/email!');
        }

        return redirect()->route('signup');
    }

    /**
     * VERIFY OTP & COMPLETE REGISTRATION (MOCK)
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string',
        ]);

        if ($request->otp !== session('mock_otp')) {
            return back()->withErrors(['otp' => 'Invalid verification code. Try using 123456.']);
        }

        $data = session('signup_data');

        if (!$data) {
            return redirect()->route('signup')->with('error', 'Session expired. Please restart registration.');
        }

        // Save signup results straight to a temporary custom session structure
        session([
            'mock_logged_in' => true,
            'mock_user_profile' => $data
        ]);

        // Clean up operational wizard values
        session()->forget(['signup_data', 'signup_stage', 'mock_otp']);

        return redirect()->route('customer.account')->with('success', 'Account registration complete! (Mock Mode)');
    }

    /**
     * LOGOUT METHOD (MOCK)
     */
    public function logout(Request $request)
    {
        // Flush mock elements along with default core engine sessions
        session()->forget(['mock_logged_in', 'mock_user_profile', 'mock_user_email']);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully! (Mock Mode)');
    }

    /**
     * CUSTOMER ACCOUNT DASHBOARD (MOCK DATA STATE)
     */
    public function account()
    {
        // Check if an authentication instance is running, or fall back to mock signup values
        $user = Auth::user();
        $mockProfile = session('mock_user_profile', []);

        $customer = [
            'id' => $user->id ?? 1,
            'name' => $user->name ?? ($mockProfile['name'] ?? 'John Muthoga'),
            'email' => $user->email ?? ($mockProfile['email'] ?? session('mock_user_email', 'johnmuthogakanyingi@gmail.com')),
            'phone' => $user->phone ?? ($mockProfile['phone'] ?? '0712345678'),

            'address' => $user->address ?? ($mockProfile['address'] ?? 'Garden Estate Apartment B12'),
            'town' => $user->town ?? ($mockProfile['town'] ?? 'Nyeri Town'),
            'county' => $user->county ?? ($mockProfile['county'] ?? 'Nyeri'),

            'billing_address' => $user->billing_address ?? ($mockProfile['billing_address'] ?? 'Garden Estate Apartment B12'),
            'billing_town' => $user->billing_town ?? ($mockProfile['billing_town'] ?? 'Nyeri Town'),
            'billing_county' => $user->billing_county ?? ($mockProfile['billing_county'] ?? 'Nyeri'),

            'shipping_name' => $user->name ?? ($mockProfile['shipping_name'] ?? 'John Muthoga'),
            'shipping_phone' => $user->phone ?? ($mockProfile['shipping_phone'] ?? '0712345678'),
            'shipping_email' => $user->email ?? ($mockProfile['shipping_email'] ?? 'customer@gmail.com'),
            'shipping_address' => $user->address ?? ($mockProfile['shipping_address'] ?? 'Kimathi Estate House 24'),
            'shipping_town' => $user->town ?? ($mockProfile['shipping_town'] ?? 'Nyeri Town'),
            'shipping_county' => $user->county ?? ($mockProfile['shipping_county'] ?? 'Nyeri'),
        ];

        $orders = session()->get('customer_orders', []);

        return view('frontend.pages.customer', compact('customer', 'orders'));
    }

    /**
     * UPDATE PROFILE (MOCK)
     */
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);

        if (session()->has('mock_user_profile')) {
            $profile = session('mock_user_profile');
            $updatedProfile = array_merge($profile, $validated);
            session(['mock_user_profile' => $updatedProfile]);
        } else {
            session(['mock_user_email' => $request->email]);
        }

        return back()->with('success', 'Profile identity info updated successfully. (Mock Mode)');
    }

    /**
     * CHANGE PASSWORD (MOCK)
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        return back()->with('success', 'Security configurations updated! Password has changed successfully. (Mock Mode)');
    }

    /**
     * FORGOT PASSWORD: SHOW LINK REQUEST FORM
     */
    public function showLinkRequestForm()
    {
        return view('frontend.authentication.forgot-password');
    }

    /**
     * FORGOT PASSWORD: SEND RESET LINK EMAIL (MOCK)
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // Create a dummy placeholder token sequence for recovery visualization
        $mockToken = bin2hex(random_bytes(20));
        session(['password_reset_email' => $request->email, 'password_reset_token' => $mockToken]);

        // Provide standard recovery notification containing the mock link directly below it
        $resetUrl = route('password.reset', ['token' => $mockToken]);
        return back()->with('status', 'We have emailed your password reset link! Simulation URL link: ' . $resetUrl);
    }

    /**
     * FORGOT PASSWORD: SHOW RESET FORM
     */
    public function showResetForm($token)
    {
        $sessionToken = session('password_reset_token');

        if (!$sessionToken || $sessionToken !== $token) {
            return redirect()->route('password.request')->withErrors(['email' => 'This password reset link token is invalid or expired.']);
        }

        return view('frontend.authentication.reset-password', ['token' => $token]);
    }

    /**
     * FORGOT PASSWORD: COMPLETE RESET PASSWORD ACTION (MOCK)
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $sessionToken = session('password_reset_token');
        $sessionEmail = session('password_reset_email');

        if ($request->token !== $sessionToken || $request->email !== $sessionEmail) {
            return back()->withErrors(['email' => 'Verification values mismatched. Please restart link recovery sequence.']);
        }

        // Clean up recovery sequence caches
        session()->forget(['password_reset_token', 'password_reset_email']);

        return redirect()->route('login')->with('status', 'Your password credentials have been updated! Please sign in using your new password.');
    }
}
