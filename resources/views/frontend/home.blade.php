@extends('frontend.layouts.app')

@section('content')

<!-- ================= HERO (DYNAMIC) ================= -->
<section class="hero-section"
    style="background: url('{{ asset('assets/images/background.png') }}') no-repeat center center; background-size: cover;">
    <div class="container hero-container">
        <div class="row g-0 hero-row">

            <!-- LEFT: Categories -->
            <div class="col-lg-3 hero-categories">
                <h5 class="category-title">BROWSE CATEGORIES</h5>
                <div class="category-list">
                    @foreach($categories as $category)
                        <a href="{{ route('shop', ['category' => is_array($category) ? $category['name'] : $category]) }}">
                            {{ is_array($category) ? $category['name'] : $category }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- RIGHT: Slider -->
            <div class="col-lg-9 hero-slider">
                <button class="slider-btn slider-prev">&#10094;</button>
                <button class="slider-btn slider-next">&#10095;</button>

                <div class="slider-track">
                    @foreach($sliders as $index => $slide)
                    <div class="slide {{ $index == 0 ? 'active' : '' }}">
                        <div class="slide-text">
                            <h2>{{ $slide['title'] }}</h2>
                            <p>{{ $slide['desc'] }}</p>
                            <a href="{{route('shop')}}" class="btn btn-primary" 
                               style="background-color: #0B4FA3; border: none;">
                               {{ $slide['btn_text'] }}
                            </a>
                        </div>
                        <div class="slide-image">
                            <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ================= HOT DEALS ================= -->
<section class="hot-deals-section">
    <div class="container">
        <div class="section-top d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <div class="section-title">
                <h2 class="h4 mb-1" style="color: var(--brand-navy); font-weight: 700;">Hot Deals</h2>
                <p class="small mb-0" style="color: var(--text-muted);">High-performance refurbished laptops</p>
            </div>
            <a href="{{ route('shop') }}" class="view-all-link">
                View All <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="deals-grid">
            @foreach($hotDeals as $deal)
            <div class="deal-card">
                @php
                    $discount = round((($deal['old_price'] - $deal['new_price']) / $deal['old_price']) * 100);
                @endphp
                
                <span class="discount-badge">-{{ $discount }}%</span>

                <form action="{{ route('wishlist.add') }}" method="POST" class="wishlist-btn m-0">
                    @csrf
                    <input type="hidden" name="id" value="{{ $deal['id'] }}">
                    <input type="hidden" name="name" value="{{ $deal['name'] }}">
                    <input type="hidden" name="price" value="{{ $deal['new_price'] }}">
                    <input type="hidden" name="old_price" value="{{ $deal['old_price'] }}">
                    <input type="hidden" name="image" value="{{ $deal['image'] }}">

                    <button type="submit" style="background:none;border:0;">
                        <i class="far fa-heart"></i>
                    </button>
                </form>

                <a href="{{ route('product.show', $deal['id']) }}" class="deal-image">
                    <img src="{{ $deal['image'] }}" alt="">
                </a>

                <div class="deal-content">
                    <div class="deal-category">{{ $deal['category'] }}</div>
                    <h4 class="deal-name">{{ $deal['name'] }}</h4>
                    <div class="deal-price">
                        <span class="new-price">KSh {{ number_format($deal['new_price']) }}</span>
                        <span class="old-price">KSh {{ number_format($deal['old_price']) }}</span>
                    </div>

                    <div class="deal-actions d-flex gap-2">
                        <!-- BUY NOW (ADD TO CART) -->
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-fill m-0 p-0">
                            @csrf
                            <input type="hidden" name="id" value="{{ $deal['id'] }}"> 
                            <input type="hidden" name="name" value="{{ $deal['name'] }}">
                            <input type="hidden" name="price" value="{{ $deal['new_price'] }}">
                            <input type="hidden" name="old_price" value="{{ $deal['old_price'] }}">
                            <input type="hidden" name="image" value="{{ $deal['image'] }}">

                            <button type="submit" class="btn-cart w-100 d-flex align-items-center justify-content-center">
                                Buy Now
                            </button>
                        </form>

                        <!-- WHATSAPP -->
                        <a href="https://wa.me/254791446968?text={{ urlencode("Hello JM Innovatech 👋 I am interested in:\n\nProduct: " . $deal['name'] . "\nPrice: KES " . number_format($deal['new_price']) . "\n\nKindly assist me with availability and ordering.") }}" target="_blank" class="btn-whatsapp flex-fill d-flex align-items-center justify-content-center">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ================= POS BANNER ================= -->
<section class="pos-banner">
    <div class="container">
        <div class="pos-banner-wrapper">
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
            <div class="pos-banner-image">
                <img src="{{ asset('assets/images/pos.png') }}" alt="POS System">
            </div>
        </div>
    </div>
</section>

<!-- ================= POS EQUIPMENT================= -->
<section class="hot-deals-section">
    <div class="container">
        <div class="section-top" style="display: flex; justify-content: space-between; align-items: center;">
            <div class="section-title">
                <h2>Point of Sale Equipment</h2>
                <p>Complete hardware for just KSh 50,000 POS Bundle</p>
            </div>
            <a href="{{ route('shop', ['category' => 'Point of Sale Equipment']) }}" style="color: #0B4FA3; font-weight: 600; text-decoration: none; white-space: nowrap;">
                View All <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="pos-grid">
            @foreach($posEquipment as $item)
            <div class="deal-card">
                @php
                    $discount = round((($item['old_price'] - $item['new_price']) / $item['old_price']) * 100);
                @endphp

                <span class="discount-badge">-{{ $discount }}%</span>
                <form action="{{ route('wishlist.add') }}" method="POST" class="wishlist-btn m-0">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item['id'] }}"> 
                    <input type="hidden" name="name" value="{{ $item['name'] }}">
                    <input type="hidden" name="price" value="{{ $item['new_price'] }}">
                    <input type="hidden" name="old_price" value="{{ $item['old_price'] }}">
                    <input type="hidden" name="image" value="{{ $item['image'] }}">

                    <button type="submit" style="background:none;border:0;">
                        <i class="far fa-heart"></i>
                    </button>
                </form>

                <a href="{{ route('product.show', $item['id']) }}" class="deal-image">
                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                </a>

                <div class="deal-content">
                    <div class="deal-category">POS Equipment</div>
                    <h4 class="deal-name">{{ $item['name'] }}</h4>
                    <div class="deal-price">
                        <span class="new-price">KSh {{ number_format($item['new_price']) }}</span>
                        <span class="old-price">KSh {{ number_format($item['old_price']) }}</span>
                    </div>

                    <div class="deal-actions d-flex gap-2 mt-3">
                        <!-- ADDED CART FORM -->
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-fill m-0 p-0">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item['id'] }}">
                            <input type="hidden" name="name" value="{{ $item['name'] }}">
                            <input type="hidden" name="price" value="{{ $item['new_price'] }}">
                            <input type="hidden" name="old_price" value="{{ $item['old_price'] }}">
                            <input type="hidden" name="image" value="{{ $item['image'] }}">

                            <button type="submit" class="btn-cart w-100 d-flex align-items-center justify-content-center">
                                Buy Now
                            </button>
                        </form>

                        <a href="https://wa.me/254791446968?text={{ urlencode("Hello JM Innovatech 👋 I want to order:\n\nProduct: " . $item['name'] . "\nPrice: KES " . number_format($item['new_price']) . "\n\nKindly confirm availability.") }}" target="_blank" class="btn-whatsapp flex-fill d-flex align-items-center justify-content-center">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ================= PRINTERS ON SALE ================= -->
<section class="hot-deals-section">
    <div class="container">
        <div class="section-top" style="display: flex; justify-content: space-between; align-items: center;">
            <div class="section-title">
                <h2>Quality Printers On Sale</h2>
                <p>Print, Copy, Scan & Wireless Printers at Affordable Prices</p>
            </div>
            <a href="{{ route('shop', ['category' => 'Printers']) }}" style="color: #0B4FA3; font-weight: 600; text-decoration: none; white-space: nowrap;">
                View All <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="deals-grid">
            @foreach($printers as $printer)
            <div class="deal-card">
                @php
                    $discount = round((($printer['old_price'] - $printer['new_price']) / $printer['old_price']) * 100);
                @endphp

                <span class="discount-badge">-{{ $discount }}%</span>

                <form action="{{ route('wishlist.add') }}" method="POST" class="wishlist-btn m-0">
                    @csrf
                    <input type="hidden" name="id" value="{{ $printer['id'] }}">
                    <input type="hidden" name="name" value="{{ $printer['name'] }}">
                    <input type="hidden" name="price" value="{{ $printer['new_price'] }}">
                    <input type="hidden" name="old_price" value="{{ $printer['old_price'] }}">
                    <input type="hidden" name="image" value="{{ $printer['image'] }}">

                    <button type="submit" style="background:none;border:0;">
                        <i class="far fa-heart"></i>
                    </button>
                </form>

                <a href="{{ route('product.show', $printer['id']) }}" class="deal-image">
                    <img src="{{ $printer['image'] }}" alt="{{ $printer['name'] }}">
                </a>

                <div class="deal-content">
                    <div class="deal-category">{{ $printer['category'] }}</div>
                    <h4 class="deal-name">{{ $printer['name'] }}</h4>
                    <div class="deal-features">{{ $printer['features'] }}</div>

                    <div class="deal-price">
                        <span class="new-price">KSh {{ number_format($printer['new_price']) }}</span>
                        <span class="old-price">KSh {{ number_format($printer['old_price']) }}</span>
                    </div>

                    <div class="deal-actions d-flex gap-2">
                        <!-- FIXED CART FORM (Using accurate $printer['id']) -->
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-fill m-0 p-0">
                            @csrf
                            <input type="hidden" name="id" value="{{ $printer['id'] }}">
                            <input type="hidden" name="name" value="{{ $printer['name'] }}">
                            <input type="hidden" name="price" value="{{ $printer['new_price'] }}">
                            <input type="hidden" name="old_price" value="{{ $printer['old_price'] }}">
                            <input type="hidden" name="image" value="{{ $printer['image'] }}">

                            <button type="submit" class="btn-cart w-100 d-flex align-items-center justify-content-center">
                                Buy Now
                            </button>
                        </form>

                        <a href="https://wa.me/254791446968?text={{ urlencode("Hello JM Innovatech 👋 I want to order:\n\nProduct: " . $printer['name'] . "\nPrice: KES " . number_format($printer['new_price']) . "\n\nKindly confirm availability and delivery.") }}" target="_blank" class="btn-whatsapp flex-fill d-flex align-items-center justify-content-center">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ================= POS EQUIPMENT BANNER ================= -->
<section class="hardware-banner">
    <div class="hw-wrapper">
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
        <div class="section-top" style="display: flex; justify-content: space-between; align-items: center;">
            <div class="section-title">
                <h2>Computer Papers, Rolls & Labels</h2>
                <p>Premium Quality Materials For Crisp Printing Results</p>
            </div>
            <a href="{{ route('shop', ['category' => 'Printing Supplies']) }}" style="color: #0B4FA3; font-weight: 600; text-decoration: none; white-space: nowrap;">
                View All <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="pos-grid">
            @foreach($supplies as $item)
            <div class="deal-card">
                @php
                    $discount = round((($item['old_price'] - $item['new_price']) / $item['old_price']) * 100);
                @endphp

                <span class="discount-badge">-{{ $discount }}%</span>

                <form action="{{ route('wishlist.add') }}" method="POST" class="wishlist-btn m-0">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                    <input type="hidden" name="name" value="{{ $item['name'] }}">
                    <input type="hidden" name="price" value="{{ $item['new_price'] }}">
                    <input type="hidden" name="old_price" value="{{ $item['old_price'] }}">
                    <input type="hidden" name="image" value="{{ $item['image'] }}">

                    <button type="submit" style="background:none;border:0;">
                        <i class="far fa-heart"></i>
                    </button>
                </form>

                <a href="{{ route('product.show', $item['id']) }}" class="deal-image">
                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                </a>

                <div class="deal-content">
                    <div class="deal-category">Printing Supplies</div>
                    <h4 class="deal-name">{{ $item['name'] }}</h4>
                    <div class="deal-features">{{ $item['features'] }}</div>

                    <div class="deal-price">
                        <span class="new-price">KSh {{ number_format($item['new_price']) }}</span>
                        <span class="old-price">KSh {{ number_format($item['old_price']) }}</span>
                    </div>

                    <div class="deal-actions d-flex gap-2 mt-3">
                        <!-- ADDED CART FORM -->
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-fill m-0 p-0">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item['id'] }}">
                            <input type="hidden" name="name" value="{{ $item['name'] }}">
                            <input type="hidden" name="price" value="{{ $item['new_price'] }}">
                            <input type="hidden" name="old_price" value="{{ $item['old_price'] }}">
                            <input type="hidden" name="image" value="{{ $item['image'] }}">

                            <button type="submit" class="btn-cart w-100 d-flex align-items-center justify-content-center">
                                Buy Now
                            </button>
                        </form>

                        <a href="https://wa.me/254791446968?text={{ urlencode("Hello JM Innovatech 👋 I want to order:\n\nProduct: " . $item['name'] . "\nPrice: KES " . number_format($item['new_price']) . "\n\nKindly confirm availability.") }}" target="_blank" class="btn-whatsapp flex-fill d-flex align-items-center justify-content-center">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ================= TONERS ON SALE ================= -->
<section class="hot-deals-section">
    <div class="container">
        <div class="section-top" style="display: flex; justify-content: space-between; align-items: center;">
            <div class="section-title">
                <h2>Original And Compatible Toners</h2>
                <p>Save 20% On Your Print Cost</p>
            </div>
            <a href="{{ route('shop', ['category' => 'Toners']) }}" style="color: #0B4FA3; font-weight: 600; text-decoration: none; white-space: nowrap;">
                View All <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="deals-grid">
            @foreach($toners as $toner)
            <div class="deal-card">
                @php
                    $discount = round((($toner['old_price'] - $toner['new_price']) / $toner['old_price']) * 100);
                @endphp

                <span class="discount-badge">-{{ $discount }}%</span>

                <form action="{{ route('wishlist.add') }}" method="POST" class="wishlist-btn m-0">
                    @csrf
                    <input type="hidden" name="id" value="{{ $toner['id'] }}">
                    <input type="hidden" name="name" value="{{ $toner['name'] }}">
                    <input type="hidden" name="price" value="{{ $toner['new_price'] }}">
                    <input type="hidden" name="old_price" value="{{ $toner['old_price'] }}">
                    <input type="hidden" name="image" value="{{ $toner['image'] }}">

                    <button type="submit" style="background:none;border:0;">
                        <i class="far fa-heart"></i>
                    </button>
                </form>

                <a href="{{ route('product.show', $toner['id']) }}" class="deal-image">
                    <img src="{{ $toner['image'] }}" alt="{{ $toner['name'] }}">
                </a>

                <div class="deal-content">
                    <div class="deal-category">{{ $toner['brand'] }}</div>
                    <h4 class="deal-name">{{ $toner['name'] }}</h4>
                    <div class="deal-features">{{ $toner['features'] }}</div>

                    <div class="deal-price">
                        <span class="new-price">KSh {{ number_format($toner['new_price']) }}</span>
                        <span class="old-price">KSh {{ number_format($toner['old_price']) }}</span>
                    </div>

                    <div class="deal-actions d-flex gap-2">
                        <!-- FIXED CART FORM (Using accurate $toner['id']) -->
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-fill m-0 p-0">
                            @csrf
                            <input type="hidden" name="id" value="{{ $toner['id'] }}">
                            <input type="hidden" name="name" value="{{ $toner['name'] }}">
                            <input type="hidden" name="price" value="{{ $toner['new_price'] }}">
                            <input type="hidden" name="old_price" value="{{ $toner['old_price'] }}">
                            <input type="hidden" name="image" value="{{ $toner['image'] }}">

                            <button type="submit" class="btn-cart w-100 d-flex align-items-center justify-content-center">
                                Add To Cart
                            </button>
                        </form>

                        <a href="https://wa.me/254791446968?text={{ urlencode("Hello JM Innovatech 👋 I want to order:\n\nProduct: " . $toner['name'] . "\nPrice: KES " . number_format($toner['new_price']) . "\n\nKindly assist me with availability.") }}" target="_blank" class="btn-whatsapp flex-fill d-flex align-items-center justify-content-center">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection