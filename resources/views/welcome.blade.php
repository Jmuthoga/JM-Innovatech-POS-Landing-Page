@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="hero">
    <div class="container">

        <div class="row align-items-center">

            <div class="col-md-6" data-aos="fade-right">

                <h1 class="display-3 fw-bold">
                    Smart POS System for Modern Businesses
                </h1>

                <p class="lead mt-4">
                    Manage sales, stock, branches, MPESA payments,
                    reports, expenses and employees from one powerful system.
                </p>

                <div class="mt-4">
                    <a href="https://pos.jminnovatechsolution.co.ke"
                       target="_blank"
                       class="btn btn-light btn-lg me-3">
                        Try Demo
                    </a>

                    <a href="#pricing"
                       class="btn btn-outline-light btn-lg">
                        View Pricing
                    </a>
                </div>

            </div>

            <div class="col-md-6 text-center" data-aos="fade-left">

                <img src="{{ asset('images/dashboard.png') }}"
                     class="img-fluid rounded shadow">

            </div>

        </div>

    </div>
</section>

<!-- FEATURES -->
<section class="py-5" id="features">

    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Powerful Features</h2>
        </div>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card p-4 feature-card shadow-sm h-100">
                    <i class="bi bi-shop fs-1 text-primary"></i>
                    <h4 class="mt-3">Multi Branch</h4>
                    <p>
                        Manage multiple branches with HQ Admin control.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-4 feature-card shadow-sm h-100">
                    <i class="bi bi-credit-card fs-1 text-success"></i>
                    <h4 class="mt-3">MPESA Integration</h4>
                    <p>
                        STK Push and direct payment confirmations.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-4 feature-card shadow-sm h-100">
                    <i class="bi bi-graph-up fs-1 text-danger"></i>
                    <h4 class="mt-3">Advanced Reports</h4>
                    <p>
                        Sales, expenses, stock and profit reports instantly.
                    </p>
                </div>
            </div>

        </div>

    </div>

</section>

<!-- PRICING -->
<section class="py-5 bg-light" id="pricing">

    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Subscription Packages</h2>
        </div>

        <div class="row g-4 justify-content-center">

            <div class="col-md-4">

                <div class="card pricing-card shadow border-0 p-4 text-center">

                    <h3>Monthly</h3>

                    <h1 class="display-4 fw-bold text-primary">
                        KES 2,000
                    </h1>

                    <ul class="list-unstyled mt-4">
                        <li>Unlimited Sales</li>
                        <li>Inventory Management</li>
                        <li>MPESA Integration</li>
                        <li>Reports</li>
                    </ul>

                    <a href="#" class="btn btn-primary mt-3">
                        Get Started
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- SCREENSHOTS -->
<section class="py-5" id="screenshots">

    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">System Screenshots</h2>
        </div>

        <div class="row g-4 screenshot">

            <div class="col-md-4">
                <img src="{{ asset('images/dashboard.png') }}"
                     class="img-fluid">
            </div>

            <div class="col-md-4">
                <img src="{{ asset('images/sales.png') }}"
                     class="img-fluid">
            </div>

            <div class="col-md-4">
                <img src="{{ asset('images/reports.png') }}"
                     class="img-fluid">
            </div>

        </div>

    </div>

</section>

@endsection