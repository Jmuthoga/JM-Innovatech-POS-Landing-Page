@extends('frontend.layouts.app')

@section('content')

<section class="shop-page">
    <div class="container">
        <div class="shop-layout">

            <!-- SIDEBAR -->
            <aside class="shop-sidebar">
                <!-- Categories -->
                <div class="filter-group">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
                        <h4 style="margin:0; border:0;">Categories</h4>
                        @if($selectedCategory || !empty($selectedBrands))
                            <a href="{{ request()->url() }}" style="font-size:0.7rem; color:red; text-decoration:none;">Clear All</a>
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
                <div class="filter-group">
                    <h4>Filter By Price</h4>
                    <input type="range" id="priceRange" min="1000" max="100000" step="1000" value="{{ $maxPriceFilter }}" style="width:100%; accent-color: var(--brand-blue);">
                    <div style="display: flex; justify-content: space-between; font-size: 0.8rem; margin-top: 10px;">
                        <span>KSh 1,000</span>
                        <span id="priceLabel" style="font-weight: bold; color: var(--brand-blue);">KSh {{ number_format($maxPriceFilter) }}</span>
                    </div>
                </div>

                <!-- Brands -->
                <div class="filter-group">
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
                <div class="filter-group">
                    <h4>Latest Products</h4>

                    <!-- Scrollable container -->
                    <div style="max-height: 240px; overflow-y: auto; padding-right: 5px;">

                        @foreach($latestProducts as $latest)
                        <a href="{{ route('product.show', $latest['id']) }}" class="sidebar-product">
                            
                            <img src="{{ $latest['image'] }}" alt="{{ $latest['name'] }}">

                            <div class="sidebar-product-info">
                                <span class="sidebar-product-name">
                                    {{ $latest['name'] }}
                                </span>

                                <span class="sidebar-product-price">
                                    KSh {{ number_format($latest['new_price']) }}
                                </span>
                            </div>
                        </a>
                        @endforeach

                    </div>
                </div>
            </aside>

            <!-- MAIN CONTENT -->
            <main class="shop-main">
                <div class="shop-top-bar" style="background:white; padding:12px 15px; border-radius:12px; margin-bottom:20px; border:1px solid #e2e8f0; display:flex; justify-content:space-between; align-items:center;">
                    <div style="font-size:0.85rem; color:var(--text-muted);">
                        <strong>{{ count($products) }}</strong> items 
                        @if($selectedCategory) <span class="d-none d-md-inline">in {{ $selectedCategory }}</span> @endif
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
                            if ($product['old_price'] > $product['new_price']) {
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
                            <input type="hidden" name="old_price" value="{{ $product['old_price'] }}">
                            <input type="hidden" name="image" value="{{ $product['image'] }}">

                            <button type="submit" style="background:none;border:0;">
                                <i class="far fa-heart"></i>
                            </button>
                        </form>

                        @if(isset($product['id']))
                            <a href="{{ route('product.show', $product['id']) }}" class="deal-image">
                                <img src="{{ $product['image'] }}" alt="">
                            </a>
                        @endif
                        
                        <div class="deal-content">
                            <div class="deal-category">{{ $product['brand'] }}</div>
                            <h4 class="deal-name">
                                <a href="{{ route('product.show', $product['id'] ?? 0) }}" style="text-decoration:none; color:inherit;">
                                    {{ $product['name'] }}
                                </a>
                            </h4>
                            <div class="deal-price">
                                <span class="new-price">KSh {{ number_format($product['new_price']) }}</span>
                                <span class="old-price">KSh {{ number_format($product['old_price']) }}</span>
                            </div>
                            <div class="deal-actions d-flex gap-2">

                                <!-- ADD TO CART -->
                                <form action="{{ route('cart.add') }}"
                                    method="POST"
                                    class="flex-fill m-0 p-0">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $product['id'] }}">
                                    <input type="hidden" name="name" value="{{ $product['name'] }}">
                                    <input type="hidden" name="price" value="{{ $product['new_price'] }}">
                                    <input type="hidden" name="old_price" value="{{ $product['old_price'] }}">
                                    <input type="hidden" name="image" value="{{ $product['image'] }}">

                                    <button type="submit"
                                            class="btn-cart w-100 d-flex align-items-center justify-content-center">
                                        Add to Cart
                                    </button>
                                </form>

                                <!-- WHATSAPP ORDER -->
                                <a href="https://wa.me/254700000000?text={{ urlencode(
                                    "Hello JM Innovatech 👋 I want to order:\n\n" .
                                    "Product: " . $product['name'] . "\n" .
                                    "Price: KES " . number_format($product['new_price']) . "\n" .
                                    "Product ID: " . $product['id'] . "\n\n" .
                                    "Kindly assist me with availability and delivery."
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
                            <p>We couldn't find anything matching "<strong>{{ request('search') }}</strong>"</p>
                            <a href="{{ route('shop') }}" 
                                class="btn btn-sm mt-2" 
                                style="background-color: #0B4FA3; color: white; border: none; padding: 8px 20px; border-radius: 8px; transition: all 0.3s ease;">
                                Clear Search
                            </a>
                        </div>
                        @endforelse
                </div>

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
                        <a href="{{ request()->fullUrlWithQuery(['page' => $currentPage + 1]) }}">&raquo;</a>
                    @endif
                </div>
            </main>
        </div>
    </div>
</section>

<script>
    function updateFilters() {
        const urlParams = new URLSearchParams(window.location.search);
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