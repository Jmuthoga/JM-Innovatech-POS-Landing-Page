<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'JPOS Systems Kenya | POS Systems, POS Software, Laptops, Printers & Computer Accessories')</title>
    <meta name="description" content="@yield('meta_description', 'Buy genuine POS systems, POS software, laptops, printers, receipt printers, barcode scanners, monitors, networking equipment, CCTV systems, desktop computers and computer accessories in Kenya from JPOS Systems. Powered by JM Innovatech Solutions.')">
    <meta name="keywords" content="@yield('meta_keywords', 'JPOS Systems, JPOS Systems Kenya, JPOS Kenya, JM Innovatech Solutions, JM Innovatech Solutions Kenya, JPOS POS System, JPOS Point of Sale System, JPOS Point of Sale Software, Point of Sale System Kenya, POS System Kenya, POS Software Kenya, Retail POS Kenya, Supermarket POS Kenya, Restaurant POS Kenya, Hotel POS Kenya, Pharmacy POS Kenya, Hardware Store POS Kenya, Wholesale POS Kenya, Inventory Management System Kenya, Inventory Software Kenya, ERP Software Kenya, Business Management Software Kenya, Accounting Software Kenya, Payroll Software Kenya, CRM Software Kenya, School Management System Kenya, Hospital Management System Kenya, Barcode Scanner Kenya, Barcode Scanner Price Kenya, Barcode Printer Kenya, Barcode Label Printer Kenya, Receipt Printer Kenya, Thermal Receipt Printer Kenya, POS Printer Kenya, Cash Drawer Kenya, POS Machine Kenya, POS Hardware Kenya, Touchscreen POS Kenya, Computer Shop Kenya, Laptops Kenya, Laptop Price Kenya, HP Laptops Kenya, Dell Laptops Kenya, Lenovo Laptops Kenya, Refurbished Laptops Kenya, Desktop Computers Kenya, Monitors Kenya, Gaming Monitors Kenya, Printers Kenya, Epson Printers Kenya, Canon Printers Kenya, HP Printers Kenya, Networking Equipment Kenya, Routers Kenya, Switches Kenya, CCTV Cameras Kenya, CCTV Installation Kenya, Computer Accessories Kenya, Office Equipment Kenya, Buy POS System Kenya, Buy Laptop Kenya, Buy Printer Kenya, Buy Barcode Scanner Kenya, Buy Receipt Printer Kenya, Buy Computer Accessories Kenya, Technology Solutions Kenya')">

    <meta name="author" content="JM Innovatech Solutions">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta name="language" content="English">
    <meta name="revisit-after" content="1 days">
    <meta name="theme-color" content="#0B4FA3">

    <!-- Canonical -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- =========================
        FAVICON
    ========================== -->

    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo.png') }}">

    <!-- =========================
        OPEN GRAPH
    ========================== -->

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="JPOS Systems">
    <meta property="og:title" content="@yield('og_title', 'JPOS Systems Kenya | POS Systems, Laptops, Printers & Computer Accessories')">
    <meta property="og:description" content="@yield('og_description', 'Buy POS systems, POS software, laptops, printers, monitors, barcode scanners, receipt printers and computer accessories from JPOS Systems Kenya.')">
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}">
    <meta property="og:image:alt" content="JPOS Systems Logo">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:locale" content="en_KE">

    <!-- =========================
        TWITTER
    ========================== -->

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'JPOS Systems Kenya')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Kenya\'s trusted supplier of POS systems, POS software, printers, laptops, monitors and business technology solutions.')">
    <meta name="twitter:image" content="{{ asset('assets/images/logo.png') }}">

    <!-- =========================
        GEO TAGS
    ========================== -->

    <meta name="geo.region" content="KE">
    <meta name="geo.country" content="Kenya">
    <meta name="ICBM" content="-1.286389,36.817223">

    <!-- =========================
        SCHEMA.ORG
    ========================== -->


    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <!-- Font Awesome Icons CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts for a more premium look -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/customer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/authentication.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/features.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/possystem.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/aboutus.css') }}">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }

        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg,#0d6efd,#001f3f);
            color: white;
            display: flex;
            align-items: center;
        }

        .feature-card {
            border: none;
            border-radius: 15px;
            transition: 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .pricing-card {
            border-radius: 20px;
        }

        .screenshot img {
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        footer {
            background: #001f3f;
            color: white;
        }
    </style>
</head>
<body>

    @include('frontend.partials.navbar')

    @yield('content')

    @include('frontend.partials.footer')

@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<!-- NAVBAR JS -->
<script src="{{ asset('assets/js/navbar.js') }}"></script>

<script>
    AOS.init();
</script>

</body>
</html>