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
            --sidebar-collapsed-width: 70px; /* Added missing variable */
            --transition-speed: 0.25s;
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
            min-height: 100vh;
        }

        /* --- FIXED SIDEBAR CONFIGURATION --- */
        #sidebar {
            width: var(--sidebar-width); /* Controlled via a single property */
            background: var(--jpos-blue); /* Restored your correct theme brand blue */
            color: #fff;
            min-height: 100vh;
            transition: width var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* --- LARGE SCREENS: COLLAPSED OVERRIDE CONFIGURATION --- */
        @media (min-width: 992px) {
            body.sidebar-collapsed #sidebar {
                width: var(--sidebar-collapsed-width) !important;
                /* Extra insurance against conflicting partial files */
                min-width: var(--sidebar-collapsed-width) !important;
                max-width: var(--sidebar-collapsed-width) !important;
            }
        }

        #content-wrapper {
            flex: 1;
            min-width: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
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

            @yield('content')
        </main>

        @include('backend.partials.footer')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>