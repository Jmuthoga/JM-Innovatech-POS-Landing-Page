<footer class="footer-section pt-5 pb-4">
    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-4">
                <h4 class="footer-title">
                    Newsletter
                </h4>
                <p class="footer-text">
                    Subscribe to get updates on new products,
                    offers and business solutions.
                </p>
                <form class="newsletter-form">
                    <input type="email"
                           placeholder="Your email address"
                           required>
                    <button type="submit">
                        Subscribe
                    </button>
                </form>
                <div class="app-download mt-4">
                    <h5>
                        Download App Now
                    </h5>
                    <div class="d-flex gap-3 mt-3 flex-wrap">
                        <a href="#"
                        class="store-btn-img">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                                alt="Google Play"
                                class="store-img">
                        </a>
                        <a href="#"
                        class="store-btn-img">
                            <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                                alt="App Store"
                                class="store-img">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-heading">
                    Our Company
                </h5>
                <ul class="footer-links">
                    <li>
                        <a href="{{ route('pos.about') }}">
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="https://jminnovatechsolution.co.ke/careers" target="_blank">
                            Careers
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Our Stores
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Contact Us
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Sitemap
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading">
                    Our Policies
                </h5>
                <ul class="footer-links">
                    <li>
                        <a href="#">
                            Privacy Hub
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Privacy Policy
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Terms & Conditions
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Payment Terms
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Corporate & Bulk Purchases
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3">
                <div class="reward-box">
                    <h4>
                        Earn Rewards Everytime
                        You Shop
                    </h4>
                </div>
                <div class="footer-contact mt-4">
                    <p>
                        <i class="fas fa-phone-alt"></i>
                        +254791446968
                    </p>
                    <p>
                        <i class="fas fa-map-marker-alt"></i>
                        P.O. BOX 61600 - 00200,
                        Nairobi, Kenya
                    </p>
                    <p>
                        <i class="fas fa-envelope"></i>
                       info@jpos.africa
                    </p>
                </div>
                <div class="social-area mt-4">
                    <h6>
                        Connect with us on all our
                        social media pages
                    </h6>
                    <div class="social-icons mt-3">
                        <a href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-x-twitter"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom mt-5 pt-4">
            <div class="row align-items-center gy-3">
                <div class="col-lg-6">
                    <h6 class="payment-title">
                        Payment Methods
                    </h6>
                    <div class="payment-icons d-flex gap-3 flex-wrap">
                        <div class="payment-box">
                            <img src="{{ asset('assets/payments/visa-logo.svg') }}" alt="Visa">
                        </div>
                        <div class="payment-box">
                            <img src="{{ asset('assets/payments/mastercard-logo.svg') }}" alt="Mastercard">
                        </div>
                        <div class="payment-box">
                            <img src="{{ asset('assets/payments/mpesa-logo.svg') }}" alt="Mpesa">
                        </div>
                        <div class="payment-box">
                            <img src="{{ asset('assets/payments/airtel-logo.svg') }}" alt="Airtel">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <p class="copyright-text">
                        Copyright
                        <a href="{{ route('admin.login') }}" target="_blank" style="color: inherit; text-decoration: none; cursor: default;">©</a>
                        {{ now()->year }} JPOS. All Rights Reserved.

                        <span class="mx-2">|</span>

                        Powered by
                        <a href="https://jminnovatechsolution.co.ke"
                        target="_blank"
                        rel="noopener noreferrer"
                        style="text-decoration: none;">
                            JM Innovatech Solutions
                        </a>
                    </p>
                </div>
            </div>
        </div>
        
    </div>
</footer>