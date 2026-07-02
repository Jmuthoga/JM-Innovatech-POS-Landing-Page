@extends('frontend.layouts.app')

@section('content')

<section class="shop-page">
    <div class="container">
        <div class="shop-layout">

            <!-- SIDEBAR -->
            <aside class="shop-sidebar d-none d-lg-flex" style="display: flex; flex-direction: column; min-height: 100%; gap: 25px;">
                
                <!-- Categories -->
                <div class="filter-group" style="margin: 0;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
                        <h4 style="margin:0; border:0;">Categories</h4>
                        @if($selectedCategory || !empty($selectedBrands) || request('max_price'))
                            <a href="{{ route('shop') }}" style="font-size:0.7rem; color:red; text-decoration:none;">Clear All</a>
                        @endif
                    </div>

                    <!-- EXACT 7 ITEMS -->
                    <div style="max-height: calc(7 * 52px); overflow-y: auto; padding-right: 5px;">
                        <ul class="filter-list">
                            @foreach($categoriesList as $cat)
                                <li>
                                    <a href="{{ request()->fullUrlWithQuery(['category' => $cat, 'page' => 1]) }}" 
                                       class="{{ $selectedCategory == $cat ? 'active' : '' }}">
                                        {{ $cat }} 
                                        <span class="count">{{ $categoryCounts[$cat] ?? 0 }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Price Filter -->
                <div class="filter-group" style="margin: 0;">
                    <h4>Filter By Price</h4>
                    
                    <input type="range" 
                           id="priceRange" 
                           name="max_price" 
                           min="1000" 
                           max="100000" 
                           step="1000" 
                           value="{{ $maxPriceFilter }}" 
                           style="width:100%; accent-color: var(--brand-blue); cursor: pointer;">
                    
                    <div style="display: flex; justify-content: space-between; font-size: 0.8rem; margin-top: 10px;">
                        <span>KSh 1,000</span>
                        <span id="priceLabel" style="font-weight: bold; color: var(--brand-blue);">
                            KSh {{ number_format($maxPriceFilter) }}
                        </span>
                    </div>
                </div>

                <!-- Brands -->
                <div class="filter-group" style="margin: 0;">
                    <h4>Top Brands</h4>

                    <!-- Scrollable container -->
                    <div style="max-height: 260px; overflow-y: auto; padding-right: 5px;">
                        <div style="display:flex; flex-direction:column; gap:10px;">
                            @foreach($brandsList as $brandName)
                                <label style="font-size:0.9rem; cursor:pointer; display:flex; align-items:center; justify-content: space-between;">
                                    
                                    <div style="display:flex; align-items:center; gap:8px;">
                                        <input type="checkbox"
                                               class="brand-filter"
                                               value="{{ $brandName }}"
                                               {{ in_array($brandName, $selectedBrands) ? 'checked' : '' }}>
                                        {{ $brandName }}
                                    </div>

                                    <span class="count">{{ $brandCounts[$brandName] ?? 0 }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Latest Products -->
                <div class="filter-group" style="margin: 0;">
                    <h4>Latest Products</h4>

                    <!-- Container sized dynamically for 6 items max -->
                    <div style="max-height: calc(6 * 76px); overflow-y: auto; padding-right: 5px;">

                        @foreach($latestProducts as $latest)
                        <a href="{{ route('product.show', $latest['id']) }}" class="sidebar-product" style="display: flex; align-items: center; gap: 12px; padding: 8px 0; border-bottom: 1px solid var(--border-color, #e2e8f0); text-decoration: none;">
                            
                            <img src="{{ $latest['image'] }}" alt="{{ $latest['name'] }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px;">

                            <div class="sidebar-product-info" style="display: flex; flex-direction: column; gap: 4px;">
                                <span class="sidebar-product-name" style="font-size: 0.9rem; color: var(--text-dark, #1e293b); font-weight: 500; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $latest['name'] }}
                                </span>

                                <span class="sidebar-product-price" style="font-size: 0.85rem; font-weight: 700; color: var(--brand-blue);">
                                    KSh {{ number_format($latest['new_price']) }}
                                </span>
                            </div>
                        </a>
                        @endforeach

                    </div>
                </div>

                <!-- PINNED HIGH-END PLAY-THEN-SLIDE VIDEO BANNER -->
                <div class="premium-video-slider" style="
                    position: relative;
                    margin-top: auto; /* Forces the banner to live exclusively at the bottom */
                    height: 340px;
                    border-radius: var(--radius);
                    overflow: hidden;
                    box-shadow: 0 20px 45px rgba(1, 12, 38, 0.35);
                    border: 1px solid rgba(255, 255, 255, 0.1);
                    background: var(--brand-navy);
                ">
                    
                    <!-- SLIDE 1 CONTAINER -->
                    <div class="adv-slide slide-one" style="
                        position: absolute;
                        inset: 0;
                        padding: 30px 24px;
                        display: flex;
                        flex-direction: column;
                        justify-content: space-between;
                        z-index: 2;
                        animation: cycleSlideOne 14s infinite ease-in-out;
                    ">
                        <!-- Video GIF Layer 1: Cyber Scan lines -->
                        <div style="
                            position: absolute;
                            inset: 0;
                            background: linear-gradient(rgba(11, 79, 163, 0.15) 50%, rgba(0, 0, 0, 0.3) 50%);
                            background-size: 100% 4px;
                            z-index: 1;
                        "></div>
                        <div style="
                            position: absolute;
                            top: -100%; left: 0; width: 100%; height: 100%;
                            background: linear-gradient(to bottom, transparent, rgba(37, 211, 102, 0.2), transparent);
                            z-index: 1;
                            animation: videoScanner 2.5s infinite linear;
                        "></div>

                        <div style="position: relative; z-index: 2;">
                            <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 15px;">
                                <span style="width: 8px; height: 8px; background: var(--brand-green-light); border-radius: 50%; box-shadow: 0 0 12px var(--brand-green-light); animation: livePulse 1s infinite alternate;"></span>
                                <span style="font-size: 0.65rem; font-weight: 800; color: #fff; text-transform: uppercase; letter-spacing: 2px;">Flash Promo Live</span>
                            </div>
                            <h3 style="color: #ffffff; font-size: 1.6rem; font-weight: 800; line-height: 1.2; margin: 0 0 10px 0; border:0; padding:0;">
                                Premium <br><span style="color: var(--brand-green-light)">Tech Deals</span>
                            </h3>
                            <p style="color: #94a3b8; font-size: 0.85rem; line-height: 1.4; margin: 0;">Up to 30% off high-demand workspace additions. Ends tonight.</p>
                        </div>

                        <div style="position: relative; z-index: 2;">
                            <a href="#" class="banner-cta-btn" style="
                                display: block; text-align: center; width: 100%; padding: 13px 0;
                                background: var(--brand-blue); color: #ffffff; font-size: 0.85rem;
                                font-weight: 700; text-decoration: none; border-radius: 8px;
                                box-shadow: 0 8px 20px rgba(11, 79, 163, 0.4); transition: var(--transition);
                            ">Claim Offer</a>
                        </div>
                    </div>

                    <!-- SLIDE 2 CONTAINER -->
                    <div class="adv-slide slide-two" style="
                        position: absolute;
                        inset: 0;
                        padding: 30px 24px;
                        display: flex;
                        flex-direction: column;
                        justify-content: space-between;
                        z-index: 1;
                        animation: cycleSlideTwo 14s infinite ease-in-out;
                        background: radial-gradient(circle at 100% 100%, rgba(11, 79, 163, 0.4) 0%, transparent 60%);
                    ">
                        <!-- Video GIF Layer 2: Moving Fluid Nebula aura -->
                        <div style="
                            position: absolute;
                            top: -20%; right: -20%; width: 120%; height: 120%;
                            background: radial-gradient(circle, rgba(255,255,255,0.06) 0%, transparent 70%);
                            filter: blur(20px);
                            animation: auraFloat 6s infinite alternate ease-in-out;
                            z-index: 1;
                        "></div>

                        <div style="position: relative; z-index: 2;">
                            <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 15px;">
                                <span style="font-size: 0.65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px;">Verified Quality</span>
                            </div>
                            <h3 style="color: #ffffff; font-size: 1.6rem; font-weight: 800; line-height: 1.2; margin: 0 0 10px 0; border:0; padding:0;">
                                Official <br>Distributor
                            </h3>
                            <p style="color: #94a3b8; font-size: 0.85rem; line-height: 1.4; margin: 0;">100% Authentic products covered under local brand warranties.</p>
                        </div>

                        <div style="position: relative; z-index: 2;">
                            <a href="#" class="banner-cta-btn" style="
                                display: block; text-align: center; width: 100%; padding: 13px 0;
                                background: #ffffff; color: var(--brand-navy); font-size: 0.85rem;
                                font-weight: 700; text-decoration: none; border-radius: 8px;
                                box-shadow: 0 8px 20px rgba(255, 255, 255, 0.1); transition: var(--transition);
                            ">Browse Brands</a>
                        </div>
                    </div>

                    <!-- Visual Slider Tracking Progress Bar -->
                    <div style="
                        position: absolute;
                        bottom: 0; left: 0; height: 3px;
                        background: linear-gradient(90deg, var(--brand-blue), var(--brand-green-light));
                        z-index: 3;
                        animation: sliderProgress 7s infinite linear;
                    "></div>
                </div>

            </aside>

            <!-- MAIN CONTENT -->
            <main class="shop-main">
                <div class="shop-top-bar" style="background:white; padding:12px 15px; border-radius:12px; margin-bottom:20px; border:1px solid #e2e8f0; display:flex; justify-content:space-between; align-items:center;">
                    
                    <div style="font-size:0.85rem; color:var(--text-muted);">
                        @if($totalProducts > 0)
                            @php
                                $startItem = (($currentPage - 1) * $perPage) + 1;
                                $endItem = min($currentPage * $perPage, $totalProducts);
                            @endphp
                            Showing <strong>{{ $startItem }}-{{ $endItem }}</strong> of <strong>{{ $totalProducts }}</strong> items
                            @if($currentPage > 1) (Page {{ $currentPage }}) @endif
                        @else
                            <strong>0</strong> items
                        @endif
                        
                        @if($selectedCategory) 
                            <span class="d-none d-md-inline">in {{ $selectedCategory }}</span> 
                        @endif
                    </div>

                    <div class="grid-controls" style="display:flex; gap:8px;">
                        <a href="{{ request()->fullUrlWithQuery(['grid' => 3, 'page' => 1]) }}" 
                        title="3 Columns"
                        style="padding:6px 12px; font-size:1rem; text-decoration:none; border-radius:6px; border:1px solid {{ $currentGrid == 3 ? 'var(--brand-blue)' : '#e2e8f0' }}; background:{{ $currentGrid == 3 ? 'var(--brand-blue)' : '#fff' }}; color:{{ $currentGrid == 3 ? '#fff' : '#64748b' }}; transition: var(--transition);">
                            <i class="fas fa-th-large"></i>
                        </a>

                        <a href="{{ request()->fullUrlWithQuery(['grid' => 4, 'page' => 1]) }}" 
                        title="4 Columns"
                        style="padding:6px 12px; font-size:1rem; text-decoration:none; border-radius:6px; border:1px solid {{ $currentGrid == 4 ? 'var(--brand-blue)' : '#e2e8f0' }}; background:{{ $currentGrid == 4 ? 'var(--brand-blue)' : '#fff' }}; color:{{ $currentGrid == 4 ? '#fff' : '#64748b' }}; transition: var(--transition);">
                            <i class="fas fa-th"></i>
                        </a>
                    </div>
                </div>

                <div id="productGrid" class="product-grid grid-{{ $currentGrid }}">
                    @forelse($products as $product)
                    <div class="deal-card">
                        @php
                            $discount = 0;
                            if (($product['old_price'] ?? 0) > ($product['new_price'] ?? 0)) {
                                $discount = round((($product['old_price'] - $product['new_price']) / $product['old_price']) * 100);
                            }
                        @endphp

                        @if($discount > 0)
                            <div class="discount-badge">-{{ $discount }}%</div>
                        @endif

                        <form action="{{ route('wishlist.add') }}" method="POST" class="wishlist-btn">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product['id'] }}">
                            <input type="hidden" name="name" value="{{ $product['name'] }}">
                            <input type="hidden" name="price" value="{{ $product['new_price'] }}">
                            <input type="hidden" name="old_price" value="{{ $product['old_price'] ?? '' }}">
                            <input type="hidden" name="image" value="{{ $product['image'] }}">

                            <button type="submit" style="background:none;border:0;">
                                <i class="far fa-heart"></i>
                            </button>
                        </form>

                        @if(isset($product['id']))
                            <a href="{{ route('product.show', $product['id']) }}" class="deal-image">
                                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
                            </a>
                        @endif
                        
                        <div class="deal-content">
                            <div class="deal-category">{{ $product['brand'] ?? '' }}</div>
                            <h4 class="deal-name">
                                <a href="{{ route('product.show', $product['id'] ?? 0) }}" style="text-decoration:none; color:inherit;">
                                    {{ $product['name'] }}
                                </a>
                            </h4>
                            <div class="deal-price">
                                <span class="new-price">KSh {{ number_format($product['new_price']) }}</span>
                                @if(isset($product['old_price']) && $product['old_price'] > $product['new_price'])
                                    <span class="old-price">KSh {{ number_format($product['old_price']) }}</span>
                                @endif
                            </div>
                            <div class="deal-actions d-flex gap-2">

                                <!-- ADD TO CART -->
                                <form action="{{ route('cart.add') }}" method="POST" class="flex-fill m-0 p-0">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product['id'] }}">
                                    <input type="hidden" name="name" value="{{ $product['name'] }}">
                                    <input type="hidden" name="price" value="{{ $product['new_price'] }}">
                                    <input type="hidden" name="old_price" value="{{ $product['old_price'] ?? '' }}">
                                    <input type="hidden" name="image" value="{{ $product['image'] }}">

                                    <button type="submit" class="btn-cart w-100 d-flex align-items-center justify-content-center">
                                        Add to Cart
                                    </button>
                                </form>

                                <!-- WHATSAPP ORDER -->
                                <a href="https://wa.me/254791446968?text={{ urlencode(
                                    "Hello JPOS Systems 👋 I want to order this product:\n\n" .
                                    "Product: " . $product['name'] . "\n" .
                                    "Price: KES " . number_format($product['new_price']) . "\n" .
                                    "Link: " . url()->current() . "\n\n" .
                                    "Kindly confirm availability and delivery."
                                ) }}"
                                target="_blank"
                                class="btn-whatsapp flex-fill d-flex align-items-center justify-content-center">
                                    <i class="fab fa-whatsapp"></i>
                                </a>

                            </div>
                        </div>
                    </div>
                    @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 50px; color: var(--text-muted);">
                        <i class="fas fa-search mb-3" style="font-size: 3rem; opacity: 0.3;"></i>
                        <h4>No products found</h4>
                        <p>We couldn't find anything matching your filters.</p>
                        <a href="{{ route('shop') }}" 
                            class="btn btn-sm mt-2" 
                            style="background-color: #0B4FA3; color: white; border: none; padding: 8px 20px; border-radius: 8px; transition: all 0.3s ease;">
                            Reset Filters
                        </a>
                    </div>
                    @endforelse
                </div>

                @if($totalPages > 1)
                <div class="custom-pagination">
                    @if($currentPage > 1)
                        <a href="{{ request()->fullUrlWithQuery(['page' => $currentPage - 1]) }}">&laquo;</a>
                    @endif
                    @for($i = 1; $i <= $totalPages; $i++)
                        @if($i == 1 || $i == $totalPages || ($i >= $currentPage - 1 && $i <= $currentPage + 1))
                            <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}" class="{{ $i == $currentPage ? 'active' : '' }}">{{ $i }}</a>
                        @endif
                    @endfor
                    @if($currentPage < $totalPages)
                        <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">&raquo;</a>
                    @endif
                </div>
                @endif

                <!-- ================= POS BANNER ================= -->
                <section class="pos-banner mt-4">
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
            </main>
        </div>
    </div>
</section>


<script>
    function updateFilters() {
        const urlParams = new URLSearchParams(window.location.search);
        
        // Preserve category search if present
        const currentCategory = "{{ $selectedCategory }}";
        if(currentCategory) {
            urlParams.set('category', currentCategory);
        }

        urlParams.set('max_price', document.getElementById('priceRange').value);
        
        urlParams.delete('brands[]'); 
        document.querySelectorAll('.brand-filter:checked').forEach(cb => {
            urlParams.append('brands[]', cb.value);
        });

        urlParams.set('page', 1);
        window.location.search = urlParams.toString();
    }

    const priceRange = document.getElementById('priceRange');
    const priceLabel = document.getElementById('priceLabel');

    if(priceRange) {
        priceRange.addEventListener('input', function() {
            priceLabel.innerText = 'KSh ' + Number(this.value).toLocaleString();
        });
        priceRange.addEventListener('change', updateFilters);
    }
    
    document.querySelectorAll('.brand-filter').forEach(checkbox => {
        checkbox.addEventListener('change', updateFilters);
    });
</script>
@endsection