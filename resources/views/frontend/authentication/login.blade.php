@extends('frontend.layouts.app')

@section('content')

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