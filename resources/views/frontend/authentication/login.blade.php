@extends('frontend.layouts.app')

@section('content')
<!-- Premium E-Commerce UX Styling Module -->
<style>
    :root {
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
    }

    .auth-wrapper {
        max-width: 1100px;
        margin: 4rem auto;
        padding: 0 1.5rem;
    }

    .auth-card {
        background: var(--surface-bg);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        box-shadow: var(--shadow-md), 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    /* Left Sidebar: Brand Palette Experience */
    .auth-sidebar {
        background: linear-gradient(135deg, var(--brand-navy) 0%, #000814 100%);
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

    /* Quick Value Proposition List */
    .sidebar-benefits {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        margin-top: 5rem;
        position: relative;
        z-index: 2;
    }

    .benefit-item {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .benefit-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        color: var(--brand-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
    }

    .benefit-text {
        font-size: 0.9rem;
        font-weight: 500;
        color: #cbd5e1;
    }

    /* Right Main Content Layer */
    .auth-main-body {
        padding: 4.5rem 4rem !important;
    }

    .custom-input-group {
        margin-bottom: 1.5rem;
    }

    .custom-input-group label {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
        display: block;
    }

    .custom-input-group .form-control {
        border: 1px solid var(--border-color);
        background-color: var(--input-neutral);
        border-radius: 10px;
        padding: 0.85rem 1.1rem;
        color: var(--text-dark);
        font-size: 0.95rem;
        transition: var(--transition);
        box-shadow: var(--shadow-sm);
    }

    .custom-input-group .form-control:focus {
        background-color: #ffffff;
        border-color: var(--brand-blue);
        box-shadow: 0 0 0 4px rgba(11, 79, 163, 0.15);
        outline: none;
    }

    .password-container {
        position: relative;
    }

    .password-visibility-trigger {
        position: absolute;
        right: 1.1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        cursor: pointer;
        background: none;
        border: none;
        padding: 0;
        font-size: 0.95rem;
    }

    .password-visibility-trigger:hover {
        color: var(--text-dark);
    }

    .form-utilities {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .remember-me-checkbox {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .remember-me-checkbox input {
        cursor: pointer;
        border: 1px solid var(--border-color);
        border-radius: 4px;
    }

    .remember-me-checkbox input:checked {
        background-color: var(--brand-blue);
        border-color: var(--brand-blue);
    }

    .remember-me-checkbox label {
        cursor: pointer;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-muted);
        margin: 0;
        user-select: none;
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
        background-color: var(--brand-blue);
        color: #ffffff;
    }

    .btn-flat-primary:hover {
        background-color: #093f82;
        box-shadow: 0 8px 20px rgba(11, 79, 163, 0.25);
        transform: translateY(-1px);
        color: #ffffff;
    }

    .brand-link {
        color: var(--brand-blue);
        transition: var(--transition);
    }

    .brand-link:hover {
        color: var(--brand-navy);
    }

    @media (max-width: 991.98px) {
        .auth-wrapper { margin: 2rem auto; }
        .auth-main-body { padding: 3rem 2rem !important; }
        .auth-sidebar { padding: 3rem 2rem; gap: 3rem; }
        .sidebar-benefits { display: none; }
    }
</style>

<div class="auth-wrapper">
    <div class="auth-card">
        <div class="row g-0">
            
            <!-- LEFT PANEL: Dynamic E-Commerce Sidebar Showcase -->
            <div class="col-lg-4 auth-sidebar">
                <div class="sidebar-content">
                    <h3 class="auth-title">Welcome Back</h3>
                    <p class="auth-subtitle mb-0">Sign in to access your secure account dashboard, tracking logs, and curated marketplace preferences.</p>
                </div>
                
                <!-- BENEFITS CONTAINER FOR BALANCE -->
                <div class="sidebar-benefits">
                    <div class="benefit-item">
                        <div class="benefit-icon"><i class="fas fa-shipping-fast"></i></div>
                        <span class="benefit-text">Track persistent dispatches</span>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon"><i class="fas fa-percentage"></i></div>
                        <span class="benefit-text">Exclusive account pricing profiles</span>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon"><i class="fas fa-history"></i></div>
                        <span class="benefit-text">Instant 1-click re-ordering</span>
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

                @if(session('status'))
                    <div class="alert alert-success border-0 rounded-3 p-3 mb-4 text-center small fw-medium" style="background-color: #f0fdf4; color: #166534;">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- SIGN IN FORM SCHEMA -->
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="custom-input-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control w-100" value="{{ old('email') }}" placeholder="example@domain.com" required autocomplete="email" autofocus>
                    </div>
                    
                    <div class="custom-input-group">
                        <label for="password">Password</label>
                        <div class="password-container">
                            <input type="password" id="password" name="password" class="form-control w-100" style="padding-right: 3rem;" placeholder="••••••••" required autocomplete="current-password">
                            <button type="button" class="password-visibility-trigger" id="passwordToggle" aria-label="Toggle password visibility">
                                <i class="far fa-eye" id="passwordToggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-utilities">
                        <div class="remember-me-checkbox">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">Remember me</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-decoration-none small fw-bold brand-link">Forgot password?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-action btn-flat-primary w-100 mt-2 d-flex align-items-center justify-content-center gap-2">
                        Sign In to Dashboard <i class="fas fa-sign-in-alt" style="font-size: 0.9rem;"></i>
                    </button>
                </form>

                <!-- SYSTEM LOWER ACCESS SWITCH -->
                <div class="text-center mt-5 pt-4 border-top" style="border-color: var(--border-color) !important;">
                    <span class="text-muted small">New to our platform?</span> 
                    <a href="{{ route('signup') }}" class="text-decoration-none small fw-bold ms-1 brand-link">Create account</a>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const passwordInput = document.getElementById("password");
        const toggleButton = document.getElementById("passwordToggle");
        const toggleIcon = document.getElementById("passwordToggleIcon");

        if (toggleButton && passwordInput && toggleIcon) {
            toggleButton.addEventListener("click", function () {
                const isHidden = passwordInput.getAttribute("type") === "password";
                passwordInput.setAttribute("type", isHidden ? "text" : "password");
                
                toggleIcon.classList.toggle("fa-eye");
                toggleIcon.classList.toggle("fa-eye-slash");
            });
        }
    });
</script>
@endsection