<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JPOS Control Panel - @yield('title', 'Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;&display=swap" rel="stylesheet">

    <style>
        :root {
            --jpos-blue: #0b4fa3;
            --jpos-blue-light: #1565c0;
            --jpos-green: #2e7d32;
            --jpos-green-light: #4caf50;
            --bg-light: #f8f9fa;
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            overflow-x: hidden;
        }

        /* Layout Structure */
        #wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        #sidebar {
            min-width: var(--sidebar-width);
            max-width: var(--sidebar-width);
            background: #1e293b;
            color: #fff;
            min-height: 100vh;
            transition: all 0.3s;
        }

        #content-wrapper {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            padding: 2rem;
            flex: 1;
        }

        /* Universal Admin Card Styling */
        .admin-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            background-color: #fff;
        }
    </style>
    @stack('styles')
</head>
<body>

<div id="wrapper">
    @include('backend.partials.sidebar')

    <div id="content-wrapper">
        @include('backend.partials.navbar')

        <main class="main-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show admin-card mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2 text-success"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>

        @include('backend.partials.footer')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>