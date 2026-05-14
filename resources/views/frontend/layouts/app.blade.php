<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JM Innovatech POS</title>

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