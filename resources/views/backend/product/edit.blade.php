@extends('backend.layouts.admin')

@section('title', 'Edit Product')

@push('styles')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<style>
    :root {
        --sidebar-width: var(--sidebar-width, 260px);
        --sidebar-collapsed-width: var(--sidebar-collapsed-width, 70px);
        --transition-speed: .25s;
        --page-bg: #f8fafc;
    }

    /* ===============================
       GLOBAL
    =============================== */

    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    html,
    body {
        width: 100%;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        background: var(--page-bg);
    }

    /* ===============================
       PAGE LAYOUT
    =============================== */

    #main-wrapper {
        margin-left: var(--sidebar-width);
        min-height: 100vh;
        background: var(--page-bg);
        transition: margin-left var(--transition-speed) cubic-bezier(.4,0,.2,1);
    }

    body.sidebar-collapsed #main-wrapper {
        margin-left: var(--sidebar-collapsed-width);
    }

    .main-content {
        width: 100%;
        padding: 20px;
        margin-top: 20px;
    }

    .container-fluid {
        width: 100%;
        max-width: 100%;
        padding-left: 0;
        padding-right: 0;
    }

    .row {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 1.5rem;
    }

    /* ===============================
       CARDS
    =============================== */

    .card {
        width: 100%;
        border: 0;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 4px 16px rgba(15,23,42,.06);
    }

    .card-body {
        padding: 1.5rem;
    }

    .form-section-title {
        font-size: .9rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #64748b;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: .75rem;
        margin-bottom: 1.5rem;
    }

    /* ===============================
       FORM CONTROLS
    =============================== */

    .form-control,
    .form-select {
        min-height: 46px;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        padding: .65rem .9rem;
        font-size: .95rem;
        transition: .2s;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 .2rem rgba(59,130,246,.15);
    }

    .input-group-text {
        background: #f8fafc;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        color: #64748b;
    }

    /* ===============================
       SUMMERNOTE
    =============================== */

    .note-editor.note-frame {
        border: 1px solid #cbd5e1 !important;
        border-radius: 10px !important;
        overflow: hidden;
    }

    .note-toolbar {
        background: #f8fafc !important;
        border-bottom: 1px solid #e2e8f0 !important;
    }

    .note-editor .note-editable {
        min-height: 260px;
    }

    .note-toolbar,
    .note-popover {
        z-index: 1055 !important;
    }

    /* ===============================
       IMAGE PREVIEW
    =============================== */

    .preview-thumbnail-wrapper {
        position: relative;
        width: 80px;
        height: 80px;
    }

    .preview-thumbnail {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        background: #fff;
        cursor: pointer;
        transition: .2s ease;
    }

    .preview-thumbnail:hover {
        transform: translateY(-3px);
        border-color: #3b82f6;
        box-shadow: 0 8px 18px rgba(0,0,0,.12);
    }

    /* ===============================
       LIGHTBOX
    =============================== */

    .image-lightbox-overlay {
        position: fixed;
        inset: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(15,23,42,.8);
        backdrop-filter: blur(5px);
        opacity: 0;
        visibility: hidden;
        transition: .2s;
        z-index: 99999;
    }

    .image-lightbox-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .image-lightbox-img {
        max-width: 85%;
        max-height: 85vh;
        border-radius: 12px;
        object-fit: contain;
        transform: scale(.95);
        transition: .2s;
    }

    .image-lightbox-overlay.active .image-lightbox-img {
        transform: scale(1);
    }

    /* ===============================
       BADGES
    =============================== */

    .cursor-pointer {
        cursor: pointer;
    }

    .transition-all {
        transition: .2s;
    }

    .p-2\.5 {
        padding: .65rem .9rem !important;
    }

    .badge-toggle-card {
        background: #fff;
        border: 1px solid #cbd5e1;
    }

    .badge-toggle-card:hover {
        background: #f8fafc;
        border-color: #94a3b8;
    }

    .badge-status-indicator {
        padding: .2rem .55rem;
        border-radius: 6px;
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .05em;
        background: #f1f5f9;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    .badge-status-indicator::after {
        content: "Inactive";
    }

    .badge-toggle-input:checked + .badge-toggle-card {
        background: #f0fdf4;
        border-color: #16a34a;
    }

    .badge-toggle-input:checked + .badge-toggle-card .badge-title-text {
        color: #166534;
    }

    .badge-toggle-input:checked + .badge-toggle-card .badge-status-indicator {
        background: #16a34a;
        color: #fff;
        border-color: #16a34a;
    }

    .badge-toggle-input:checked + .badge-toggle-card .badge-status-indicator::after {
        content: "Active";
    }

    /* ===============================
       TABLET & MOBILE
    =============================== */

    @media (max-width: 991.98px) {

        #main-wrapper {
            margin-left: 0 !important;
            width: 100%;
        }

        .main-content {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
        }

        .container-fluid {
            width: 100%;
            max-width: 100%;
            padding-left: 0;
            padding-right: 0;
        }

        .row {
            margin-left: 0;
            margin-right: 0;
        }

        .col-xl-8,
        .col-xl-4,
        .col-lg-12,
        .col-md-12,
        .col-12 {
            width: 100%;
            max-width: 100%;
            flex: 0 0 100%;
        }

        .card {
            width: 100%;
            border-radius: 14px;
        }

        .card-body {
            padding: 1rem;
        }

        .preview-thumbnail-wrapper {
            width: 70px;
            height: 70px;
        }
    }

    /* ===============================
       SMALL PHONES
    =============================== */

    @media (max-width: 576px) {

        .main-content {
            padding: 10px;
            margin-top: 20px;
        }

        .card {
            border-radius: 12px;
        }

        .card-body {
            padding: .9rem;
        }

        .preview-thumbnail-wrapper {
            width: 60px;
            height: 60px;
        }
    }
</style>
@endpush

@section('content')
<div id="main-wrapper">
    <main class="main-content">
        <div class="container-fluid">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Edit Product</h3>
                    <p class="text-muted small mb-0">Modify details for: <strong>{{ $product->name }}</strong></p>
                </div>
                <a href="{{ route('admin.products.index') }}" class="btn btn-white border bg-white px-3 py-2 text-secondary font-medium rounded-3 shadow-sm">
                    Back to List
                </a>
            </div>

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row g-4">
                    <div class="col-xl-8">
                        <div class="card mb-4">
                            <div class="card-body p-4">
                                <h6 class="form-section-title fw-bold">Product Information</h6>
                                
                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-secondary">Product Name *</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter product name" value="{{ old('name', $product->name) }}" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary">Category *</label>
                                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary">Brand</label>
                                        <select name="brand_id" class="form-select @error('brand_id') is-invalid @enderror">
                                            <option value="">Select Brand (Optional)</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-secondary">Description</label>
                                    <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                                    @error('description') <div class="invalid-feedback text-block d-block">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-2">
                                    <label class="form-label fw-semibold text-secondary">Features</label>
                                    <input type="text" name="features" class="form-control @error('features') is-invalid @enderror" placeholder="e.g., Wireless, Waterproof, 4K Display" value="{{ old('features', $product->features) }}">
                                    @error('features') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body p-4">
                                <h6 class="form-section-title fw-bold">Product Images</h6>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary">Featured Image</label>
                                        <input type="file" id="product_main_image" name="image" class="form-control @error('image') is-invalid @enderror">
                                        <div class="form-text small text-muted mb-2">Upload to change the main image. Max file size: 2MB.</div>
                                        @error('image') <div class="invalid-feedback d-block mb-2">{{ $message }}</div> @enderror
                                        
                                        <!-- FIX: Added 'storage/' inside asset helper mapping -->
                                        <div id="main-image-preview-wrapper" class="mt-2" style="{{ $product->image ? '' : 'display: none;' }}">
                                            <div class="preview-thumbnail-wrapper">
                                                <img id="main-image-preview" src="{{ $product->image ? asset('storage/' . $product->image) : '#' }}" alt="Featured Preview" class="preview-thumbnail shadow-sm">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary">Gallery Images</label>
                                        <input type="file" id="product_gallery_images" name="thumbnails[]" class="form-control @error('thumbnails.*') is-invalid @enderror" multiple>
                                        <div class="form-text small text-muted mb-2">Select files to upload additional gallery items.</div>
                                        @error('thumbnails.*') <div class="invalid-feedback d-block mb-2">{{ $message }}</div> @enderror
                                        
                                        <div id="gallery-preview-wrapper" class="d-flex flex-wrap gap-3 mt-3">
                                            <!-- FIX: Checking and looping through the database json/array column 'thumbnails' safely -->
                                            @php
                                                $galleryImages = is_array($product->thumbnails) ? $product->thumbnails : json_decode($product->thumbnails, true);
                                            @endphp

                                            @if(!empty($galleryImages))
                                                @foreach($galleryImages as $imgSrc)
                                                    <div class="preview-thumbnail-wrapper">
                                                        <img src="{{ asset('storage/' . $imgSrc) }}" alt="Gallery Miniature" class="preview-thumbnail shadow-sm">
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card mb-4">
                            <div class="card-body p-4">
                                <h6 class="form-section-title fw-bold">Pricing and Stock</h6>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-secondary">Selling Price *</label>
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold">Ksh.</span>
                                        <input type="number" step="0.01" name="new_price" class="form-control @error('new_price') is-invalid @enderror" placeholder="0.00" value="{{ old('new_price', $product->new_price) }}" required>
                                        @error('new_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-secondary">Original Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold">Ksh.</span>
                                        <input type="number" step="0.01" name="old_price" class="form-control @error('old_price') is-invalid @enderror" placeholder="0.00" value="{{ old('old_price', $product->old_price) }}">
                                        @error('old_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <label class="form-label fw-semibold text-secondary">Stock Quantity *</label>
                                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock ?? 0) }}" required>
                                    @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body p-4">
                            <h5 class="mb-1">Product Badges</h5>
                            <p class="text-muted small mb-3">Click a button to select product badge to appear on the storefront</p>
                                
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="checkbox" name="is_hot_deal" id="hot" class="badge-toggle-input d-none" {{ old('is_hot_deal', $product->is_hot_deal) ? 'checked' : '' }}>
                                        <label for="hot" class="badge-toggle-card d-flex align-items-center justify-content-between p-2.5 rounded-3 w-100 h-100 cursor-pointer transition-all">
                                            <span class="badge-title-text fw-semibold small text-secondary">Hot</span>
                                            <span class="badge-status-indicator"></span>
                                        </label>
                                    </div>

                                    <div class="col-6">
                                        <input type="checkbox" name="is_pos_equipment" id="pos" class="badge-toggle-input d-none" {{ old('is_pos_equipment', $product->is_pos_equipment) ? 'checked' : '' }}>
                                        <label for="pos" class="badge-toggle-card d-flex align-items-center justify-content-between p-2.5 rounded-3 w-100 h-100 cursor-pointer transition-all">
                                            <span class="badge-title-text fw-semibold small text-secondary">POS</span>
                                            <span class="badge-status-indicator"></span>
                                        </label>
                                    </div>

                                    <div class="col-6">
                                        <input type="checkbox" name="is_supply_item" id="supply" class="badge-toggle-input d-none" {{ old('is_supply_item', $product->is_supply_item) ? 'checked' : '' }}>
                                        <label for="supply" class="badge-toggle-card d-flex align-items-center justify-content-between p-2.5 rounded-3 w-100 h-100 cursor-pointer transition-all">
                                            <span class="badge-title-text fw-semibold small text-secondary">Supply</span>
                                            <span class="badge-status-indicator"></span>
                                        </label>
                                    </div>

                                    <div class="col-6">
                                        <input type="checkbox" name="is_toner" id="toner" class="badge-toggle-input d-none" {{ old('is_toner', $product->is_toner) ? 'checked' : '' }}>
                                        <label for="toner" class="badge-toggle-card d-flex align-items-center justify-content-between p-2.5 rounded-3 w-100 h-100 cursor-pointer transition-all">
                                            <span class="badge-title-text fw-semibold small text-secondary">Toner</span>
                                            <span class="badge-status-indicator"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row gx-2">
                                    <div class="col-6">
                                        <a href="{{ route('admin.products.index') }}" class="btn btn-light w-100 py-2 border rounded-3 fw-semibold text-secondary">Cancel</a>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-semibold shadow-sm">Update Product</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </main>
</div>

<div class="image-lightbox-overlay" id="globalImageLightbox">
    <img class="image-lightbox-img" src="" alt="Zoomed View">
</div>
@endsection

@push('scripts')
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

  <script>
    $(document).ready(function() {
        // Initialize Summernote HTML Editor
        $('#summernote').summernote({
            height: 280,
            placeholder: 'Enter rich text product description...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        // Live Main Featured Image Selector Logic
        $('#product_main_image').on('change', function() {
            const file = this.files && this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#main-image-preview').attr('src', e.target.result);
                    $('#main-image-preview-wrapper').fadeIn(200);
                };
                reader.readAsDataURL(file);
            }
        });

        // Global file collection container
        let accumulatedGalleryFiles = new DataTransfer();

        $('#product_gallery_images').on('change', function() {
            const wrapper = $('#gallery-preview-wrapper');
            
            if (this.files && this.files.length > 0) {
                Array.from(this.files).forEach(file => {
                    accumulatedGalleryFiles.items.add(file);

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Notice the class helper added to safely separate new uploads vs database strings if needed
                        const htmlNode = `
                            <div class="preview-thumbnail-wrapper dynamic-new-preview">
                                <img src="${e.target.result}" alt="Gallery Miniature" class="preview-thumbnail shadow-sm">
                            </div>
                        `;
                        wrapper.append(htmlNode);
                    };
                    reader.readAsDataURL(file);
                });

                this.files = accumulatedGalleryFiles.files;
            }
        });

        /* --- Lightbox Trigger Handlers (Hover zoom behavior) --- */
        $(document).on('mouseenter', '.preview-thumbnail', function() {
            const imgSrc = $(this).attr('src');
            if(imgSrc && imgSrc !== '#') {
                $('#globalImageLightbox img').attr('src', imgSrc);
                $('#globalImageLightbox').addClass('active');
            }
        });

        $(document).on('mouseleave', '.preview-thumbnail', function() {
            $('#globalImageLightbox').removeClass('active');
        });
    });
  </script>
@endpush