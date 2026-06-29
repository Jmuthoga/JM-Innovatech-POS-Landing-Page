<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JPOS Systems - Admin Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --jpos-blue: #0b4fa3;
            --jpos-blue-dark: #073570;
            --jpos-green-light: #4caf50;
            --bg-dark: #0f172a;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 900px;
        }

        .login-sidebar {
            background: linear-gradient(135deg, var(--bg-dark) 0%, var(--jpos-blue-dark) 100%);
            color: #ffffff;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .login-form {
            padding: 3.5rem 3rem;
        }

        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: var(--jpos-blue);
            box-shadow: 0 0 0 0.25rem rgba(11, 79, 163, 0.15);
        }

        .btn-admin {
            background-color: var(--jpos-blue);
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            width: 100%;
        }

        .btn-admin:hover {
            background-color: #083c7d;
            color: white;
        }

        /* Logo Sizing Control - Made Larger */
        .login-brand-logo {
            max-height: 100px;
            width: auto;
            object-fit: contain;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="row login-card g-0">
        
        <div class="col-md-5 d-none d-md-flex login-sidebar">
            <div>
                <div class="mb-3">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="login-brand-logo">
                </div>
                <h3 class="fw-bold text-white mb-1">
                    <span style="color: var(--jpos-green-light);">J</span>POS Systems
                </h3>
                <p class="text-white-50 small text-uppercase">Admin Portal</p>
            </div>
            
            <div>
                <h4 class="fw-semibold text-white mb-2">Management Panel</h4>
                <p class="text-white-50 small mb-0">
                    Log in here to manage products, view sales, track orders, and configure your store settings.
                </p>
            </div>

            <div>
                <small class="text-white-50">&copy; {{ date('Y') }} JPOS Systems.</small>
            </div>
        </div>

        <div class="col-md-7 login-form d-flex flex-column justify-content-center">
            
            <div class="d-md-none text-center mb-4">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="login-brand-logo mb-2">
                <h4 class="fw-bold text-dark m-0">JPOS Systems</h4>
                <p class="text-muted small text-uppercase m-0">Admin Portal</p>
            </div>

            <div class="mb-4 text-center text-md-start">
                <h3 class="fw-bold text-dark mb-1">Welcome Back</h3>
                <p class="text-muted small">Please enter your admin credentials to log in.</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center rounded-3 mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label fw-medium text-secondary small">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted"><i class="bi bi-envelope"></i></span>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email') }}" 
                               placeholder="admin@jpos.com" 
                               required 
                               autofocus>
                    </div>
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-medium text-secondary small">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted"><i class="bi bi-lock"></i></span>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               placeholder="Enter your password" 
                               required>
                    </div>
                    @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    <label class="form-check-label text-muted small" for="remember">
                        Remember me on this computer
                    </label>
                </div>

                <button type="submit" class="btn btn-admin">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Log In to Dashboard
                </button>
            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>