@extends('frontend.layouts.app')

@section('content')

<div class="auth-wrapper">
    <div class="auth-card">
        <div class="row g-0">
            
            <!-- LEFT PANEL: Dynamic E-Commerce Sidebar Showcase -->
            <div class="col-lg-4 auth-sidebar">
                <div class="sidebar-content">
                    <h3 class="auth-title">Reset Password</h3>
                    <p class="auth-subtitle mb-0">Verify your session profile variables and input your new strong security authentication password parameters below.</p>
                </div>
                
                <!-- BENEFITS CONTAINER FOR BALANCE -->
                <div class="sidebar-benefits">
                    <div class="benefit-item">
                        <div class="benefit-icon"><i class="fas fa-lock"></i></div>
                        <span class="benefit-text">Minimum 8-character token depth</span>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon"><i class="fas fa-shield-alt"></i></div>
                        <span class="benefit-text">Automatic old-session termination</span>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon"><i class="fas fa-check-double"></i></div>
                        <span class="benefit-text">Instant account authorization</span>
                    </div>
                </div>
            </div>

            <!-- RIGHT PANEL: Main Presentation Forms Layer -->
            <div class="col-lg-8 auth-main-body">
                
                <h4 class="fw-bold mb-2" style="color: var(--brand-navy); letter-spacing: -0.02em;">Setup New Password</h4>
                <p class="text-muted small mb-4" style="line-height: 1.6;">Ensure your account remains highly secure by provisioning a unique passphrase array structure.</p>

                <!-- Display Validation Errors if conditions mismatch -->
                @if ($errors->any())
                    <div class="alert alert-danger border-0 rounded-3 p-3 mb-4 small fw-medium" style="background-color: #fef2f2; color: #991b1b;">
                        <ul class="mb-0 px-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    
                    <!-- Hidden context properties requested by resetPassword Controller -->
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="custom-input-group">
                        <label for="email">Confirm Account Email</label>
                        <input type="email" id="email" name="email" class="form-control w-100" placeholder="example@domain.com" value="{{ old('email', $email ?? '') }}" required autocomplete="email">
                    </div>

                    <div class="custom-input-group">
                        <label for="password">New Strong Password</label>
                        <div class="password-container">
                            <input type="password" id="password" name="password" class="form-control w-100" style="padding-right: 3rem;" placeholder="••••••••" required autocomplete="new-password" autofocus>
                            <button type="button" class="password-visibility-trigger" id="passwordToggle" aria-label="Toggle password visibility">
                                <i class="far fa-eye" id="passwordToggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="custom-input-group">
                        <label for="password_confirmation">Confirm New Password</label>
                        <div class="password-container">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control w-100" style="padding-right: 3rem;" placeholder="••••••••" required autocomplete="new-password">
                            <button type="button" class="password-visibility-trigger" id="confirmToggle" aria-label="Toggle confirmation password visibility">
                                <i class="far fa-eye" id="confirmToggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-action btn-flat-primary w-100 mt-4 d-flex align-items-center justify-content-center gap-2">
                        Update Account Credentials <i class="fas fa-check-circle" style="font-size: 0.85rem;"></i>
                    </button>
                </form>

                <!-- SYSTEM LOWER ACCESS SWITCH -->
                <div class="text-center mt-5 pt-4 border-top" style="border-color: var(--border-color) !important;">
                    <span class="text-muted small">Need to go back?</span> 
                    <a href="{{ route('login') }}" class="text-decoration-none small fw-bold ms-1 brand-link">Return to Login</a>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Universal toggle utility function
        function setupPasswordToggle(triggerId, inputId, iconId) {
            const trigger = document.getElementById(triggerId);
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (trigger && input && icon) {
                trigger.addEventListener("click", function () {
                    const isHidden = input.getAttribute("type") === "password";
                    input.setAttribute("type", isHidden ? "text" : "password");
                    
                    icon.classList.toggle("fa-eye");
                    icon.classList.toggle("fa-eye-slash");
                });
            }
        }

        // Initialize triggers for both fields independently
        setupPasswordToggle("passwordToggle", "password", "passwordToggleIcon");
        setupPasswordToggle("confirmToggle", "password_confirmation", "confirmToggleIcon");
    });
</script>
@endsection