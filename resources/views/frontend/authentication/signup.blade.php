@extends('frontend.layouts.app')

@section('content')
<!-- Premium E-Commerce UX Styling Module -->
<style>
    :root {
        /* User-Defined Brand Color Token Definitions */
        --brand-blue: #0B4FA3;
        --brand-navy: #011226;
        --brand-green: #25D366;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        --transition: all 0.2s ease-in-out;
        
        --surface-bg: #ffffff;
        --input-neutral: #f8fafc;

        /* Perfect Mapping to Core Presentation Structural Architecture */
        --text-main: var(--text-dark);
        --border-subtle: var(--border-color);
        --brand-primary: var(--brand-blue);
        --brand-accent: var(--brand-blue);
        --brand-success: var(--brand-green);
    }

    .auth-wrapper {
        max-width: 1100px;
        margin: 4rem auto;
        padding: 0 1.5rem;
    }

    .auth-card {
        background: var(--surface-bg);
        border: 1px solid var(--border-subtle);
        border-radius: 20px;
        box-shadow: var(--shadow-md);
        overflow: hidden;
    }

    /* Left Sidebar: Retail Focused Brand Experience */
    .auth-sidebar {
        background: linear-gradient(135deg, var(--brand-navy) 0%, #000710 100%);
        padding: 4rem 2.5rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
    }

    /* Soft modern background texture */
    .auth-sidebar::before {
        content: '';
        position: absolute;
        inset: 0;
        opacity: 0.05;
        background-image: radial-gradient(#ffffff 2px, transparent 2px);
        background-size: 24px 24px;
    }

    .sidebar-content {
        position: relative;
        z-index: 2;
    }

    .auth-title {
        color: #ffffff;
        font-weight: 800;
        font-size: 2rem;
        letter-spacing: -0.03em;
        margin-bottom: 1rem;
    }

    .auth-subtitle {
        color: #cbd5e1;
        font-size: 1rem;
        line-height: 1.6;
    }

    /* Elegant Step Indicator */
    .step-timeline {
        display: flex;
        flex-direction: column;
        gap: 1.75rem;
        margin-top: 5rem;
        position: relative;
        z-index: 2;
    }

    .timeline-item {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        opacity: 0.35;
        transition: var(--transition);
    }

    .timeline-item.active { opacity: 1; }
    .timeline-item.completed { opacity: 0.9; }

    .timeline-marker {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 2px solid #475569;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        font-weight: 700;
        color: #cbd5e1;
        background: var(--brand-navy);
        transition: var(--transition);
    }

    .timeline-item.active .timeline-marker {
        border-color: #ffffff;
        color: var(--brand-blue);
        background: #ffffff;
        box-shadow: 0 0 15px rgba(255,255,255,0.2);
    }

    .timeline-item.completed .timeline-marker {
        border-color: var(--brand-success);
        color: #ffffff;
        background: var(--brand-success);
    }

    .timeline-label {
        font-size: 0.9rem;
        font-weight: 600;
        letter-spacing: 0.03em;
        color: #94a3b8;
    }

    .timeline-item.active .timeline-label { color: #ffffff; }
    .timeline-item.completed .timeline-label { color: #cbd5e1; text-decoration: line-through; opacity: 0.7; }

    /* Right Main Content Layer */
    .auth-main-body {
        padding: 4.5rem 4rem !important;
    }

    /* Clean, Modern Form Layouts */
    .form-segment-header {
        color: var(--text-main);
        font-weight: 700;
        font-size: 1.1rem;
        letter-spacing: -0.01em;
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 2.5rem 0 1.5rem 0;
    }

    .form-segment-header::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--border-subtle);
    }

    .form-segment-header:first-of-type {
        margin-top: 0;
    }

    .custom-input-group {
        margin-bottom: 1.5rem;
    }

    .custom-input-group label {
        font-weight: 600;
        color: var(--text-main);
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
        display: block;
    }

    .custom-input-group .form-control, 
    .custom-input-group .form-select {
        border: 1px solid var(--border-subtle);
        background-color: var(--input-neutral);
        border-radius: 10px;
        padding: 0.85rem 1.1rem;
        color: var(--text-main);
        font-size: 0.95rem;
        transition: var(--transition);
    }

    .custom-input-group .form-control:focus,
    .custom-input-group .form-select:focus {
        background-color: #ffffff;
        border-color: var(--brand-accent);
        box-shadow: 0 0 0 4px rgba(11, 79, 163, 0.1);
        outline: none;
    }

    /* Toggle UI Switch Component */
    .address-checkbox-card {
        background: var(--input-neutral);
        border: 1px solid var(--border-subtle);
        border-radius: 10px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
    }

    /* High-Conversion CTA Design */
    .btn-action {
        font-weight: 600;
        font-size: 1rem;
        padding: 0.95rem 2rem;
        border-radius: 10px;
        transition: var(--transition);
        border: none;
    }

    .btn-flat-primary {
        background-color: var(--brand-accent);
        color: #ffffff;
    }

    .btn-flat-primary:hover {
        background-color: #093f82;
        box-shadow: 0 8px 20px rgba(11, 79, 163, 0.25);
        transform: translateY(-1px);
    }

    .btn-flat-success {
        background-color: var(--brand-success);
        color: #ffffff;
    }

    .btn-flat-success:hover {
        background-color: #1ebd54;
        box-shadow: 0 8px 20px rgba(37, 211, 102, 0.25);
        transform: translateY(-1px);
    }

    /* =========================
    PROFESSIONAL OTP SECTION
    ========================= */

    .otp-wrapper {
        width: 100%;
        max-width: 420px;
        margin: 0 auto;
    }

    .otp-display-icon {
        width: 72px;
        height: 72px;
        background: rgba(11, 79, 163, 0.08);
        color: var(--brand-accent);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin: 0 auto 1.5rem auto;
    }

    .otp-grid {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        width: 100%;
        margin: 2rem auto;
    }

    .otp-box {
        width: 56px;
        height: 62px;
        border-radius: 14px !important;
        border: 1px solid var(--border-subtle) !important;
        background: var(--input-neutral) !important;

        font-size: 1.6rem !important;
        font-weight: 700 !important;
        text-align: center;

        transition: all 0.2s ease;
    }

    .otp-box:focus {
        background-color: #ffffff !important;
        border-color: var(--brand-accent) !important;
        box-shadow: 0 0 0 4px rgba(11, 79, 163, 0.12) !important;
        transform: translateY(-2px);
        outline: none;
    }

    /* =========================
    TABLET RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .auth-main-body {
            padding: 2.5rem 1.5rem !important;
        }

        .otp-grid {
            gap: 10px;
        }

        .otp-box {
            width: 50px;
            height: 56px;
            font-size: 1.45rem !important;
        }
    }

    /* =========================
    MOBILE RESPONSIVE
    ========================= */

    @media (max-width: 576px) {

        .otp-wrapper {
            max-width: 100%;
        }

        .otp-grid {
            gap: 8px;
            justify-content: center;
        }

        .otp-box {
            width: 44px;
            height: 50px;
            font-size: 1.2rem !important;
            border-radius: 12px !important;
        }

        .otp-display-icon {
            width: 60px;
            height: 60px;
            font-size: 1.6rem;
        }
    }

    /* =========================
    VERY SMALL DEVICES
    ========================= */

    @media (max-width: 380px) {

        .otp-grid {
            gap: 6px;
        }

        .otp-box {
            width: 40px;
            height: 46px;
            font-size: 1rem !important;
        }
    }
    @media (max-width: 991.98px) {
        .auth-wrapper { margin: 2rem auto; }
        .auth-main-body { padding: 3rem 2rem !important; }
        .auth-sidebar { padding: 3rem 2rem; gap: 3rem; }
        .step-timeline { display: flex; flex-direction: row; justify-content: space-between; gap: 0.5rem; margin-top: 2rem; }
        .timeline-label { display: none; }
    }
</style>

<div class="auth-wrapper">
    <div class="auth-card">
        <div class="row g-0">
            
            <!-- LEFT PANEL: Dynamic E-Commerce Sidebar Showcase -->
            <div class="col-lg-4 auth-sidebar">
                <div class="sidebar-content">
                    <h3 class="auth-title">Join Our Community</h3>
                    <p class="auth-subtitle mb-0">Create an account today to track orders seamlessly, build wishlists, and gain faster checkouts.</p>
                </div>
                
                <!-- STABLE TIMELINE ENGINE -->
                <div class="step-timeline">
                    <div class="timeline-item {{ $currentStage === 1 ? 'active' : 'completed' }}">
                        <div class="timeline-marker">
                            @if($currentStage > 1) <i class="fas fa-check"></i> @else 1 @endif
                        </div>
                        <span class="timeline-label">Account Details</span>
                    </div>
                    <div class="timeline-item {{ $currentStage === 2 ? 'active' : ($currentStage > 2 ? 'completed' : '') }}">
                        <div class="timeline-marker">
                            @if($currentStage > 2) <i class="fas fa-check"></i> @else 2 @endif
                        </div>
                        <span class="timeline-label">Delivery Address</span>
                    </div>
                    <div class="timeline-item {{ $currentStage === 3 ? 'active' : '' }}">
                        <div class="timeline-marker">3</div>
                        <span class="timeline-label">Verify Account</span>
                    </div>
                </div>
            </div>

            <!-- RIGHT PANEL: Main Presentation Forms Layer -->
            <div class="col-lg-8 auth-main-body">
                
                <!-- Validation System Feedback System -->
                @if ($errors->any())
                    <div class="alert alert-danger border-0 rounded-3 p-3 mb-4 small fw-medium" style="background-color: #fef2f2; color: #991b1b;">
                        <ul class="mb-0 px-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('info'))
                    <div class="alert alert-info border-0 rounded-3 p-3 mb-4 text-center small fw-medium" style="background-color: #f0fdfa; color: #115e59;">
                        <i class="fas fa-paper-plane me-2"></i> {{ session('info') }}
                    </div>
                @endif

                <!-- STAGE 1: ACCOUNT DETAIL SCHEMA -->
                @if($currentStage === 1)
                    <form action="{{ route('signup.stage') }}" method="POST">
                        @csrf
                        <input type="hidden" name="stage" value="1">

                        <div class="custom-input-group">
                            <label for="name">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name', $signupData['first_name'] ?? '') }}" placeholder="e.g. John" required autocomplete="name">
                        </div>

                        <div class="custom-input-group">
                            <label for="name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name', $signupData['last_name'] ?? '') }}" placeholder="e.g. Doe" required autocomplete="name">
                        </div>
                        
                        <div class="custom-input-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $signupData['email'] ?? '') }}" placeholder="example@gmail.com" required autocomplete="email">
                        </div>
                        
                        <div class="custom-input-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="e.g. 0712345678" value="{{ old('phone', $signupData['phone'] ?? '') }}" required autocomplete="tel">
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6 custom-input-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control"  required autocomplete="new-password">
                            </div>
                            <div class="col-sm-6 custom-input-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"  required autocomplete="new-password">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-action btn-flat-primary w-100 mt-4 d-flex align-items-center justify-content-center gap-2">
                            Next: Delivery Details <i class="fas fa-arrow-right" style="font-size: 0.8rem;"></i>
                        </button>
                    </form>

                <!-- STAGE 2: SHIPPING SCHEMA (Optimized UX) -->
                @elseif($currentStage === 2)
                    <form action="{{ route('signup.stage') }}" method="POST" id="addressForm">
                        @csrf
                        <input type="hidden" name="stage" value="2">

                        <h5 class="form-segment-header">Your Details</h5>
                        <p class="text-muted small mb-3">
                            This is your primary address and contact information.
                        </p>
                        <div class="custom-input-group">
                            <label for="address">Street / Apartment / House No.</label>
                            <input type="text" id="address" name="address" class="form-control" placeholder="Garden Estate, Apartment B12" value="{{ old('address', $signupData['address'] ?? '') }}" required>
                        </div>
                        <div class="row">
                            <div class="col-6 custom-input-group">
                                <label for="town">City / Town</label>
                                <input type="text" id="town" name="town" class="form-control" placeholder="Nyeri Town" value="{{ old('town', $signupData['town'] ?? '') }}" required>
                            </div>
                            <div class="col-6 custom-input-group">
                                <label for="county">County</label>
                                <input type="text" id="county" name="county" class="form-control" placeholder="Nyeri" value="{{ old('county', $signupData['county'] ?? '') }}" required>
                            </div>
                        </div>

                        <!-- Dynamic Target Wrappers for advanced configurations -->
                        <div id="billingShippingSections" style="display: block;">

                            <h5 class="form-segment-header">Where should we deliver your order?</h5>

                            <p class="text-muted small mb-3">
                                Please provide a location where you can easily receive your order.
                            </p>
                            <div class="custom-input-group">
                                <label for="shipping_name">Recipient Full Name</label>
                                <input type="text" id="shipping_name" name="shipping_name" class="form-control" placeholder="John Doe" value="{{ old('shipping_name', $signupData['shipping_name'] ?? '') }}">
                            </div>
                            <div class="row">
                                <div class="col-6 custom-input-group">
                                    <label for="shipping_phone">Contact Phone</label>
                                    <input type="text" id="shipping_phone" name="shipping_phone" class="form-control" placeholder="0712345678" value="{{ old('shipping_phone', $signupData['shipping_phone'] ?? '') }}">
                                </div>
                                <div class="col-6 custom-input-group">
                                    <label for="shipping_email">Contact Email</label>
                                    <input type="email" id="shipping_email" name="shipping_email" class="form-control" placeholder="customer@gmail.com" value="{{ old('shipping_email', $signupData['shipping_email'] ?? '') }}">
                                </div>
                            </div>
                            <div class="custom-input-group">
                                <label for="shipping_address">Shipping Address</label>
                                <input type="text" id="shipping_address" name="shipping_address" class="form-control" placeholder="Kimathi Estate, House 24" value="{{ old('shipping_address', $signupData['shipping_address'] ?? '') }}">
                            </div>
                            <div class="row">
                                <div class="col-6 custom-input-group">
                                    <label for="shipping_town">Shipping Town</label>
                                    <input type="text" id="shipping_town" name="shipping_town" class="form-control" placeholder="Nyeri Town" value="{{ old('shipping_town', $signupData['shipping_town'] ?? '') }}">
                                </div>
                                <div class="col-6 custom-input-group">
                                    <label for="shipping_county">Shipping County</label>

                                    <select id="shipping_county" name="shipping_county" class="form-control" required>
                                        <option value="">Select County</option>

                                        @foreach([
                                            'baringo' => 'Baringo',
                                            'bomet' => 'Bomet',
                                            'bungoma' => 'Bungoma',
                                            'busia' => 'Busia',
                                            'elgeyo-marakwet' => 'Elgeyo Marakwet',
                                            'embu' => 'Embu',
                                            'garissa' => 'Garissa',
                                            'homa-bay' => 'Homa Bay',
                                            'isiolo' => 'Isiolo',
                                            'kajiado' => 'Kajiado',
                                            'kakamega' => 'Kakamega',
                                            'kericho' => 'Kericho',
                                            'kiambu' => 'Kiambu',
                                            'kilifi' => 'Kilifi',
                                            'kirinyaga' => 'Kirinyaga',
                                            'kisii' => 'Kisii',
                                            'kisumu' => 'Kisumu',
                                            'kitui' => 'Kitui',
                                            'kwale' => 'Kwale',
                                            'laikipia' => 'Laikipia',
                                            'lamu' => 'Lamu',
                                            'machakos' => 'Machakos',
                                            'makueni' => 'Makueni',
                                            'mandera' => 'Mandera',
                                            'marsabit' => 'Marsabit',
                                            'meru' => 'Meru',
                                            'migori' => 'Migori',
                                            'mombasa' => 'Mombasa',
                                            'muranga' => "Murang'a",
                                            'nairobi' => 'Nairobi',
                                            'nakuru' => 'Nakuru',
                                            'nandi' => 'Nandi',
                                            'narok' => 'Narok',
                                            'nyamira' => 'Nyamira',
                                            'nyandarua' => 'Nyandarua',
                                            'nyeri' => 'Nyeri',
                                            'samburu' => 'Samburu',
                                            'siaya' => 'Siaya',
                                            'taita-taveta' => 'Taita Taveta',
                                            'tana-river' => 'Tana River',
                                            'tharaka-nithi' => 'Tharaka-Nithi',
                                            'trans-nzoia' => 'Trans Nzoia',
                                            'turkana' => 'Turkana',
                                            'uasin-gishu' => 'Uasin Gishu',
                                            'vihiga' => 'Vihiga',
                                            'wajir' => 'Wajir',
                                            'west-pokot' => 'West Pokot',
                                        ] as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ old('shipping_county', $signupData['shipping_county'] ?? '') == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-action btn-flat-primary w-100 mt-4 d-flex align-items-center justify-content-center gap-2">
                            Next: Verify Account <i class="fas fa-shield-alt" style="font-size: 0.85rem;"></i>
                        </button>
                    </form>


                
                    <!-- STAGE 3: SECURITY AUTHENTICATION -->
                
                    @elseif($currentStage === 3)
                    <form action="{{ route('signup.verify_otp') }}" method="POST" id="otpForm" class="text-center py-2">
                        @csrf
                        
                        <div class="otp-wrapper">

                            <div class="otp-display-icon">
                                <i class="fas fa-envelope-open-text"></i>
                            </div>

                            <h4 style="color: var(--text-main); font-weight: 700; margin-bottom: 0.5rem; letter-spacing: -0.02em;">
                                Verify Your Email
                            </h4>

                            <p class="text-muted small mx-auto mb-4" style="max-width: 420px; line-height: 1.6;">
                                We've sent a 6-digit verification code to your email inbox.
                                Please enter the code below to complete your registration.
                            </p>

                            <div class="otp-grid">
                                <input type="text" class="otp-box" maxlength="1" pattern="\d*" required autocomplete="off" autofocus>
                                <input type="text" class="otp-box" maxlength="1" pattern="\d*" required autocomplete="off">
                                <input type="text" class="otp-box" maxlength="1" pattern="\d*" required autocomplete="off">
                                <input type="text" class="otp-box" maxlength="1" pattern="\d*" required autocomplete="off">
                                <input type="text" class="otp-box" maxlength="1" pattern="\d*" required autocomplete="off">
                                <input type="text" class="otp-box" maxlength="1" pattern="\d*" required autocomplete="off">
                            </div>

                        </div>

                        <input type="hidden" name="otp" id="hidden_otp_input">

                        <button 
                            type="submit" 
                            class="btn btn-action btn-flat-success w-100 mt-2 d-flex align-items-center justify-content-center gap-2"
                            style="white-space: nowrap;"
                        >
                            Complete Setup & Shop <i class="fas fa-shopping-bag"></i>
                        </button>
                    </form>

                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            const boxes = document.querySelectorAll(".otp-box");
                            const hiddenInput = document.getElementById("hidden_otp_input");

                            boxes.forEach((slot, idx) => {
                                slot.addEventListener("input", (e) => {
                                    if (slot.value.length === 1 && idx < boxes.length - 1) {
                                        boxes[idx + 1].focus();
                                    }
                                    combineValues();
                                });

                                slot.addEventListener("keydown", (e) => {
                                    if (e.key === "Backspace" && slot.value.length === 0 && idx > 0) {
                                        boxes[idx - 1].focus();
                                    }
                                });
                            });

                            function combineValues() {
                                let code = "";
                                boxes.forEach(slot => code += slot.value);
                                hiddenInput.value = code;
                            }
                        });
                    </script>
                @endif

                <!-- SYSTEM LOWER ACCESS SWITCH -->
                <div class="text-center mt-5 pt-4 border-top" style="border-color: var(--border-subtle) !important;">
                    <span class="text-muted small">Already have an account?</span> 
                    <a href="{{ route('login') }}" class="text-decoration-none small fw-bold ms-1" style="color: var(--brand-accent);">Sign In</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection