@extends('backend.layouts.admin')

@section('title', 'JPOS Systems - Create Product')

@push('styles')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
  <style>
    :root {
        --sidebar-width: var(--sidebar-width, 260px);
        --transition-speed: .25s;
    }

    #main-wrapper {
        margin-left: var(--sidebar-width);
        transition: margin-left var(--transition-speed) cubic-bezier(.4, 0, .2, 1);
        min-height: 100vh;
        background: #f8fafc;
    }

    body.sidebar-collapsed #main-wrapper {
        margin-left: var(--sidebar-collapsed-width, 70px);
    }

    .main-content {
        padding: 2rem;
        margin-top: 10px;
    }

    .form-section-title {
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.05rem;
        color: #64748b;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 0.5rem;
        margin-bottom: 1.25rem;
    }

    .card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    }

    .form-control, .form-select {
        border-color: #cbd5e1;
        padding: 0.6rem 0.85rem;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus, .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }

    .input-group-text {
        background-color: #f8fafc;
        border-color: #cbd5e1;
        color: #64748b;
        border-radius: 8px;
    }

    /* Seamless Summernote Integration */
    .note-editor.note-frame {
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        overflow: hidden;
    }
    .note-toolbar {
        background-color: #f8fafc !important;
        border-bottom: 1px solid #e2e8f0 !important;
    }
    .note-editor.note-frame .note-editing-area .note-editable { 
        min-height: 250px; 
        background: #fff;
    }
    .note-popover, .note-toolbar { 
        z-index: 1055 !important; 
    }

    /* Image Preview Containers */
    .preview-thumbnail-wrapper {
        position: relative;
        width: 80px;
        height: 80px;
    }

    .preview-thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background-color: #fff;
        transition: transform 0.2s, box-shadow 0.2s;
        cursor: pointer;
    }

    .preview-thumbnail:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        border-color: #3b82f6;
    }

    /* Centered Screen Lightbox Overlay */
    .image-lightbox-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(15, 23, 42, 0.8); 
        backdrop-filter: blur(4px);
        z-index: 99999;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.2s ease;
    }

    .image-lightbox-overlay.active {
        opacity: 1;
    }

    .image-lightbox-img {
        max-width: 85%;
        max-height: 85vh;
        object-fit: contain;
        border-radius: 12px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        transform: scale(0.95);
        transition: transform 0.2s ease;
    }

    .image-lightbox-overlay.active .image-lightbox-img {
        transform: scale(1);
    }

    /* Professional Functional Turn On/Off Toggle Framework */
    .cursor-pointer {
        cursor: pointer;
    }
    .p-2\.5 {
        padding: 0.65rem 0.85rem !important;
    }
    .transition-all {
        transition: all 0.15s ease-in-out;
    }
    
    /* Inactive State (Default/Off State) */
    .badge-toggle-card {
        background-color: #fff;
        border: 1px solid #cbd5e1 !important;
    }
    .badge-toggle-card:hover {
        background-color: #f8fafc;
        border-color: #94a3b8 !important;
    }
    .badge-status-indicator {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.05rem;
        padding: 0.2rem 0.5rem;
        border-radius: 6px;
        background-color: #f1f5f9;
        color: #64748b;
        font-weight: 700;
        border: 1px solid #e2e8f0;
    }
    
    /* Default Text Injectors for Inactive Flagging */
    .badge-status-indicator::after {
        content: "Inactive";
    }
    
    /* Active State (Checked/On State Mapping) */
    .badge-toggle-input:checked + .badge-toggle-card {
        background-color: #f0fdf4;
        border-color: #16a34a !important;
    }
    .badge-toggle-input:checked + .badge-toggle-card .badge-title-text {
        color: #14532d !important;
    }
    .badge-toggle-input:checked + .badge-toggle-card .badge-status-indicator {
        background-color: #16a34a;
        color: #fff;
        border-color: #15803d;
    }
    
    /* Modify Text Injector Context dynamically when Input Value updates */
    .badge-toggle-input:checked + .badge-toggle-card .badge-status-indicator::after {
        content: "Active";
    }

    @media(max-width: 991.98px) {
        #main-wrapper {
            margin-left: 0 !important;
        }
        .main-content {
            padding: 1rem;
            margin-top: 25px;
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
                    <h3 class="fw-bold text-dark mb-1">Create New Product</h3>
                    <p class="text-muted small mb-0">Add a new item to your product catalog.</p>
                </div>
                <a href="{{ route('admin.products.index') }}" class="btn btn-white border bg-white px-3 py-2 text-secondary font-medium rounded-3 shadow-sm">
                    Back to List
                </a>
            </div>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-4">
                    <div class="col-xl-8">
                        <div class="card mb-4">
                            <div class="card-body p-4">
                                <h6 class="form-section-title fw-bold">Product Information</h6>
                                
                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-secondary">Product Name *</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter product name" value="{{ old('name') }}" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary">Category *</label>
                                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary">Brand</label>
                                        <select name="brand_id" class="form-select @error('brand_id') is-invalid @enderror">
                                            <option value="">Select Brand (Optional)</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-secondary">Description</label>
                                    <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                    @error('description') <div class="invalid-feedback text-block d-block">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-2">
                                    <label class="form-label fw-semibold text-secondary">Features</label>
                                    <input type="text" name="features" class="form-control @error('features') is-invalid @enderror" placeholder="e.g., Wireless, Waterproof, 4K Display" value="{{ old('features') }}">
                                    @error('features') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body p-4">
                                <h6 class="form-section-title fw-bold">Product Images</h6>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary">Featured Image *</label>
                                        <input type="file" id="product_main_image" name="image" class="form-control @error('image') is-invalid @enderror" required>
                                        <div class="form-text small text-muted mb-2">Main image for the product. Max file size: 2MB.</div>
                                        @error('image') <div class="invalid-feedback d-block mb-2">{{ $message }}</div> @enderror
                                        
                                        <div id="main-image-preview-wrapper" class="mt-2" style="display: none;">
                                            <div class="preview-thumbnail-wrapper">
                                                <img id="main-image-preview" src="#" alt="Featured Preview" class="preview-thumbnail shadow-sm">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary">Gallery Images</label>
                                        <input type="file" id="product_gallery_images" name="thumbnails[]" class="form-control @error('thumbnails.*') is-invalid @enderror" multiple>
                                        <div class="form-text small text-muted mb-2">Select and add multiple gallery images over multiple tries.</div>
                                        @error('thumbnails.*') <div class="invalid-feedback d-block mb-2">{{ $message }}</div> @enderror
                                        
                                        <div id="gallery-preview-wrapper" class="d-flex flex-wrap gap-3 mt-3"></div>
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
                                        <input type="number" step="0.01" name="new_price" class="form-control @error('new_price') is-invalid @enderror" placeholder="0.00" value="{{ old('new_price') }}" required>
                                        @error('new_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-secondary">Original Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold">Ksh.</span>
                                        <input type="number" step="0.01" name="old_price" class="form-control @error('old_price') is-invalid @enderror" placeholder="0.00" value="{{ old('old_price') }}">
                                        @error('old_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <label class="form-label fw-semibold text-secondary">Stock Quantity *</label>
                                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', 0) }}" required>
                                    @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Professional Interactive Product Badges Toggles -->
                        <div class="card mb-4">
                            <div class="card-body p-4">
                            <h5 class="mb-1">Product Badges</h5>
                            <p class="text-muted small mb-3">Click a button to select product badge to appear on the storefront</p>
                                
                                <div class="row g-2">
                                    <!-- Hot Deal Badge Button -->
                                    <div class="col-6">
                                        <input type="checkbox" name="is_hot_deal" id="hot" class="badge-toggle-input d-none" {{ old('is_hot_deal') ? 'checked' : '' }}>
                                        <label for="hot" class="badge-toggle-card d-flex align-items-center justify-content-between p-2.5 rounded-3 w-100 h-100 cursor-pointer transition-all">
                                            <span class="badge-title-text fw-semibold small text-secondary">Hot</span>
                                            <span class="badge-status-indicator"></span>
                                        </label>
                                    </div>

                                    <!-- POS Equipment Badge Button -->
                                    <div class="col-6">
                                        <input type="checkbox" name="is_pos_equipment" id="pos" class="badge-toggle-input d-none" {{ old('is_pos_equipment') ? 'checked' : '' }}>
                                        <label for="pos" class="badge-toggle-card d-flex align-items-center justify-content-between p-2.5 rounded-3 w-100 h-100 cursor-pointer transition-all">
                                            <span class="badge-title-text fw-semibold small text-secondary">POS</span>
                                            <span class="badge-status-indicator"></span>
                                        </label>
                                    </div>

                                    <!-- Supply Item Badge Button -->
                                    <div class="col-6">
                                        <input type="checkbox" name="is_supply_item" id="supply" class="badge-toggle-input d-none" {{ old('is_supply_item') ? 'checked' : '' }}>
                                        <label for="supply" class="badge-toggle-card d-flex align-items-center justify-content-between p-2.5 rounded-3 w-100 h-100 cursor-pointer transition-all">
                                            <span class="badge-title-text fw-semibold small text-secondary">Supply</span>
                                            <span class="badge-status-indicator"></span>
                                        </label>
                                    </div>

                                    <!-- Ink or Toner Badge Button -->
                                    <div class="col-6">
                                        <input type="checkbox" name="is_toner" id="toner" class="badge-toggle-input d-none" {{ old('is_toner') ? 'checked' : '' }}>
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
                                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-semibold shadow-sm">Save Product</button>
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
            } else {
                $('#main-image-preview-wrapper').fadeOut(200);
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
                        const htmlNode = `
                            <div class="preview-thumbnail-wrapper">
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