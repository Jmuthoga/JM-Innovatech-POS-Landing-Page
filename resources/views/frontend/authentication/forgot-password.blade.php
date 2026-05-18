@extends('frontend.layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="row g-0">
            
            <!-- LEFT PANEL: Dynamic E-Commerce Sidebar Showcase -->
            <div class="col-lg-4 auth-sidebar">
                <div class="sidebar-content">
                    <h3 class="auth-title">Access Security</h3>
                    <p class="auth-subtitle mb-0">Protecting your personal data records, configuration parameters, and ecosystem preferences remains our core absolute metric.</p>
                </div>
                
                <!-- BENEFITS CONTAINER FOR BALANCE -->
                <div class="sidebar-benefits">
                    <div class="benefit-item">
                        <div class="benefit-icon"><i class="fas fa-shield-alt"></i></div>
                        <span class="benefit-text">Secure identity orchestration</span>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon"><i class="fas fa-user-lock"></i></div>
                        <span class="benefit-text">Encrypted tokenization flows</span>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon"><i class="fas fa-user-check"></i></div>
                        <span class="benefit-text">Verified account monitoring</span>
                    </div>
                </div>
            </div>

            <!-- RIGHT PANEL: Main Presentation Forms Layer -->
            <div class="col-lg-8 auth-main-body">
                
                <h4 class="fw-bold mb-2" style="color: var(--brand-navy); letter-spacing: -0.02em;">Recover Credentials</h4>
                <p class="text-muted small mb-4" style="line-height: 1.6;">No worries. Enter your registered account email below and we will dispatch a secure validation link right to your inbox mapping sequence.</p>

                <!-- Validation System Feedback System -->
                @if (session('status'))
                    <div class="simulation-alert mb-4">
                        <div class="d-flex gap-2">
                            <i class="fas fa-info-circle mt-1" style="color: #22c55e;"></i>
                            <div>
                                <span class="fw-bold d-block mb-1">Simulation Pipeline Triggered</span>
                                {{ session('status') }}
                            </div>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger border-0 rounded-3 p-3 mb-4 small fw-medium" style="background-color: #fef2f2; color: #991b1b;">
                        <ul class="mb-0 px-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- PASSWORD EMAIL FORWARD SCHEMA -->
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf

                    <div class="custom-input-group">
                        <label for="email">Account Email Address</label>
                        <input type="email" id="email" name="email" class="form-control w-100" value="{{ old('email') }}" placeholder="example@domain.com" required autocomplete="email" autofocus>
                    </div>

                    <button type="submit" class="btn btn-action btn-flat-primary w-100 mt-4 d-flex align-items-center justify-content-center gap-2">
                        Send Recovery Reset Link <i class="fas fa-paper-plane" style="font-size: 0.85rem;"></i>
                    </button>
                </form>

                <!-- SYSTEM LOWER ACCESS SWITCH -->
                <div class="text-center mt-5 pt-4 border-top" style="border-color: var(--border-color) !important;">
                    <span class="text-muted small">Remembered your credentials?</span> 
                    <a href="{{ route('login') }}" class="text-decoration-none small fw-bold ms-1 brand-link">Sign In to Dashboard</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection