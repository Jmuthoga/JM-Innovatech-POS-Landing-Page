@extends('frontend.layouts.app')

@section('content')
<!-- ================= HERO (UNCHANGED) ================= -->
<section class="hero-section"
    style="background: url('{{ asset('assets/images/background.png') }}') no-repeat center center; background-size: cover;">
    <div class="container hero-container">
        <div class="row g-0 hero-row">

            <div class="col-lg-3 hero-categories">
                <h5 class="category-title">BROWSE CATEGORIES</h5>
                <div class="category-list">
                    <a href="#">POS Systems</a>
                    <a href="#">POS Accessories</a>
                    <a href="#">Barcode Scanners</a>
                    <a href="#">Receipt Printers</a>
                    <a href="#">Cash Drawers</a>
                    <a href="#">ETIMS Devices</a>
                    <a href="#">Starlink Setup</a>
                    <a href="#">Networking Equipment</a>
                    <a href="#">Software Licenses</a>
                </div>
            </div>

            <div class="col-lg-9 hero-slider">
                <button class="slider-btn slider-prev">&#10094;</button>
                <button class="slider-btn slider-next">&#10095;</button>

                <div class="slider-track">
                    <div class="slide active">
                        <div class="slide-text">
                            <h2>Order POS Hardware Now</h2>
                            <p>Get high-quality POS machines, printers, and accessories delivered fast across Kenya.</p>
                            <a href="#" class="btn btn-primary">Shop Now</a>
                        </div>
                        <div class="slide-image">
                            <img src="{{ asset('assets/images/poster.png') }}">
                        </div>
                    </div>

                    <div class="slide">
                        <div class="slide-text">
                            <h2>Get Starlink Internet</h2>
                            <p>Fast, reliable satellite internet for your business anywhere in Kenya.</p>
                            <a href="#" class="btn btn-primary">Get Starlink Now</a>
                        </div>
                        <div class="slide-image">
                            <img src="{{ asset('assets/images/starlink.webp') }}">
                        </div>
                    </div>

                    <div class="slide">
                        <div class="slide-text">
                            <h2>ETIMS Devices Ready</h2>
                            <p>Compliant eTIMS solutions for seamless tax integration and reporting.</p>
                            <a href="#" class="btn btn-primary">Order Now</a>
                        </div>
                        <div class="slide-image">
                            <img src="{{ asset('assets/images/etims.jpg') }}">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ================= HOT DEALS ================= -->
<section class="hot-deals-section">

    <div class="container">

        <div class="section-top">

            <div class="section-title">
                <h2>Hot Deals For You</h2>
                <p>High-performance refurbished laptops at best prices</p>
            </div>

        </div>

        <!-- GRID (8 ITEMS = 4x2) -->
        <div class="deals-grid">

            @for($i = 0; $i < 8; $i++)
            <div class="deal-card">

                <span class="discount-badge">-10%</span>

                <a href="" class="wishlist-btn">
                    <i class="far fa-heart"></i>
                </a>

                <a href="#" class="deal-image">
                    <img src="https://via.placeholder.com/500x350">
                </a>

                <div class="deal-content">

                    <div class="deal-category">Apple • Refurbished</div>

                    <h4 class="deal-name">MacBook Pro Retina</h4>

                    <div class="deal-price">
                        <span class="new-price">KSh 35,000</span>
                        <span class="old-price">KSh 39,000</span>
                    </div>

                    <div class="deal-actions">
                        <button class="btn-cart">Add To Cart</button>
                        <a href="https://wa.me/254700000000" class="btn-whatsapp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>

                </div>

            </div>
            @endfor

        </div>

    </div>

</section>

<!-- ================= POS BANNER ================= -->
<section class="pos-banner">
    <div class="container">
        <div class="pos-banner-wrapper">

            <!-- LEFT CONTENT -->
            <div class="pos-banner-text">
                <div class="banner-badge">RELIABLE • POWERFUL</div>
                
                <h1>
                    <span class="text-bold-white">ALL-IN-ONE</span> <br> 
                    <span class="highlight">POS</span> 
                    <span class="text-bold-white">SOLUTION</span>
                </h1>
                
                <div class="line-decorator"></div>

                <h3 class="text-bold-white">ABOUT OUR POS SYSTEM</h3>

                <p class="description">
                    Deploy your favourite ALL-IN-ONE point of sale software on a stylish platform that integrates a touch screen, 
                    barcode reader, cash drawer, receipt printer, and <span class="highlight-green">SO MUCH MORE.</span>
                </p>

                <div class="pos-banner-buttons">
                    <a href="#" class="btn-read">READ MORE <i class="fas fa-arrow-right"></i></a>
                    <a href="#" class="btn-contact"><i class="fas fa-phone-alt"></i> CONTACT US</a>
                </div>

                <!-- SUB-ICONS (HIDDEN ON SMALL MOBILE TO SAVE HEIGHT) -->
                <div class="pos-features-icons">
                    <div class="icon-item">
                        <i class="fas fa-hand-pointer"></i>
                        <span>TOUCH SCREEN</span>
                    </div>
                    <div class="icon-item">
                        <i class="fas fa-barcode"></i>
                        <span>BARCODE READER</span>
                    </div>
                    <div class="icon-item">
                        <i class="fas fa-print"></i>
                        <span>RECEIPT PRINTER</span>
                    </div>
                    <div class="icon-item">
                        <i class="fas fa-cash-register"></i>
                        <span>CASH DRAWER</span>
                    </div>
                </div>
            </div>

            <!-- RIGHT IMAGE -->
            <div class="pos-banner-image">
                <img src="{{ asset('assets/images/pos.png') }}" alt="POS System">
            </div>

        </div>
    </div>
</section>

<!-- ================= POS EQUIPMENT================= -->
<section class="hot-deals-section">

    <div class="container">

        <!-- HEADER -->
        <div class="section-top">

            <div class="section-title">
                <h2>Point of Sale Equipment</h2>
                <p>Complete hardware for just KSh 50,000 POS Bundle</p>
            </div>

        </div>

        <!-- GRID 6 × 2 = 12 ITEMS -->
        <div class="pos-grid">

            @for($i = 0; $i < 12; $i++)
            <div class="deal-card">

                <span class="discount-badge">-10%</span>

                <a href="#" class="deal-image">
                    <img src="https://via.placeholder.com/500x350">
                </a>

                <div class="deal-content">

                    <div class="deal-category">POS Equipment</div>

                    <h4 class="deal-name">POS Item {{ $i + 1 }}</h4>

                    <div class="deal-price">
                        <span class="new-price">KSh 10,000</span>
                        <span class="old-price">KSh 12,000</span>
                    </div>

                </div>

            </div>
            @endfor

        </div>

    </div>

</section>

<!-- ================= PRINTERS ON SALE ================= -->
<section class="hot-deals-section">

    <div class="container">

        <div class="section-top">

            <div class="section-title">
                <h2>Quality Printers On Sale</h2>
                <p>Print, Copy, Scan & Wireless Printers at Affordable Prices</p>
            </div>

        </div>

        <!-- GRID -->
        <div class="deals-grid">

            @for($i = 0; $i < 8; $i++)
            <div class="deal-card">

                <span class="discount-badge">-15%</span>

                <a href="" class="wishlist-btn">
                    <i class="far fa-heart"></i>
                </a>

                <a href="#" class="deal-image">
                    <img src="https://via.placeholder.com/500x350" alt="Printer">
                </a>

                <div class="deal-content">

                    <div class="deal-category">
                        HP • Wireless Printer
                    </div>

                    <h4 class="deal-name">
                        HP Smart Tank Printer
                    </h4>

                    <div class="deal-features">
                        PRINT • COPY • SCAN • WIFI
                    </div>

                    <div class="deal-price">
                        <span class="new-price">KSh 18,500</span>
                        <span class="old-price">KSh 22,000</span>
                    </div>

                    <div class="deal-actions">

                        <button class="btn-cart">
                            Buy Now
                        </button>

                        <a href="https://wa.me/254700000000" class="btn-whatsapp">
                            <i class="fab fa-whatsapp"></i>
                        </a>

                    </div>

                </div>

            </div>
            @endfor

        </div>

    </div>

</section>

<!-- ================= POS EQUIPMENT BANNER (NEW DESIGN) ================= -->
<section class="hardware-banner">
    <div class="hw-wrapper">
        
        <!-- TEXT SIDE (Left) -->
        <div class="hw-content">
            <div class="hw-badge-box">
                <span class="hw-badge">EQUIPMENT CATALOG</span>
            </div>
            
            <h2 class="hw-main-title">
                <span class="dark-text">PROFESSIONAL</span><br>
                <span class="green-text">POS HARDWARE</span>
            </h2>
            
            <div class="hw-accent-line"></div>
            
            <p class="hw-paragraph">
                Equip your business with the latest <span class="bold-blue">Point of Sale hardware</span>. 
                From high-speed thermal printers to secure biometric scanners—built for 24/7 reliability.
            </p>
            
            <div class="hw-btn-group">
                <a href="#" class="hw-btn-blue">VIEW CATALOG</a>
                <a href="#" class="hw-btn-outline">CONTACT SALES</a>
            </div>
        </div>

        <!-- IMAGE SIDE (Right with Blue Block) -->
        <div class="hw-visual-block">
            <div class="hw-image-container">
                <img src="{{ asset('assets/images/pos.png') }}" alt="POS Hardware">
            </div>
        </div>

    </div>
</section>

<!-- ================= PAPERS, ROLLS & LABELS ================= -->
<section class="hot-deals-section">

    <div class="container">

        <!-- HEADER -->
        <div class="section-top">

            <div class="section-title" style="text-align: center;">
                <h2>Computer Papers, Rolls & Labels</h2>
                <p>Premium Quality Materials For Crisp Printing Results</p>
            </div>

        </div>

        <!-- GRID -->
        <div class="pos-grid">

            @for($i = 0; $i < 12; $i++)
            <div class="deal-card">

                <span class="discount-badge">-8%</span>

                <a href="#" class="deal-image">
                    <img src="https://via.placeholder.com/500x350" alt="">
                </a>

                <div class="deal-content">

                    <div class="deal-category">
                        Printing Supplies
                    </div>

                    <h4 class="deal-name">
                        Thermal Receipt Rolls
                    </h4>

                    <div class="deal-features">
                        HIGH QUALITY • DURABLE • CLEAR PRINT
                    </div>

                    <div class="deal-price">
                        <span class="new-price">KSh 350</span>
                        <span class="old-price">KSh 450</span>
                    </div>

                </div>

            </div>
            @endfor

        </div>

    </div>

</section>

<!-- ================= TONERS ON SALE ================= -->
<section class="hot-deals-section">

    <div class="container">

        <div class="section-top">

            <div class="section-title" style="text-align: center;">
                <h2>Original And Compatible Toners</h2>
                <p>Save 20% On Your Print Cost</p>
            </div>

        </div>

        <!-- GRID -->
        <div class="deals-grid">

            @for($i = 0; $i < 8; $i++)
            <div class="deal-card">

                <span class="discount-badge">-20%</span>

                <a href="" class="wishlist-btn">
                    <i class="far fa-heart"></i>
                </a>

                <a href="#" class="deal-image">
                    <img src="https://via.placeholder.com/500x350" alt="">
                </a>

                <div class="deal-content">

                    <div class="deal-category">
                        HP • Canon • Epson
                    </div>

                    <h4 class="deal-name">
                        Compatible Laser Toner Cartridge
                    </h4>

                    <div class="deal-features">
                        HIGH YIELD • SHARP PRINT • LONG LASTING
                    </div>

                    <div class="deal-price">
                        <span class="new-price">KSh 2,500</span>
                        <span class="old-price">KSh 3,200</span>
                    </div>

                    <div class="deal-actions">

                        <button class="btn-cart">
                            Add To Cart
                        </button>

                        <a href="https://wa.me/254700000000" class="btn-whatsapp">
                            <i class="fab fa-whatsapp"></i>
                        </a>

                    </div>

                </div>

            </div>
            @endfor

        </div>

    </div>

</section>

@endsection
