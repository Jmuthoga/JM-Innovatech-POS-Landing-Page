@extends('backend.layouts.admin')

@section('title', 'Products')

@section('content')
<style>
    :root {
        --sidebar-width: var(--sidebar-width, 260px);
        --sidebar-collapsed-width: var(--sidebar-collapsed-width, 70px);
        --transition-speed: .25s;
        --page-bg: #f1f5f9;
    }

    /* ===============================
       PAGE LAYOUT
    =============================== */

    html,
    body {
        overflow-x: hidden;
        background: var(--page-bg);
    }

    #main-wrapper {
        margin-left: var(--sidebar-width);
        min-height: 100vh;
        background: var(--page-bg);
        transition: margin-left var(--transition-speed) cubic-bezier(.4, 0, .2, 1);
    }

    body.sidebar-collapsed #main-wrapper {
        margin-left: var(--sidebar-collapsed-width);
    }

    .main-content {
        padding: 2rem;
        margin-top: 10px;
    }

    .container-fluid {
        width: 100%;
        max-width: 100%;
    }

    /* ===============================
       CARD
    =============================== */

    .card {
        border: 0;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .08);
    }

    .card-body {
        padding: 1.25rem;
    }

    /* ===============================
       TABLE
    =============================== */

    .table-responsive {
        width: 100%;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
    }

    #products-table {
        width: 100% !important;
        min-width: 1100px;
        border-collapse: collapse;
    }

    table.dataTable {
        width: 100% !important;
        margin: 0 !important;
    }

    .dataTables_wrapper {
        width: 100%;
        overflow: hidden;
    }

    .dataTables_scroll {
        width: 100%;
    }

    .dataTables_scrollHead,
    .dataTables_scrollBody {
        width: 100% !important;
    }

    .dataTables_scrollBody {
        overflow-x: auto !important;
        overflow-y: auto !important;
    }

    /* ===============================
       DATATABLE CONTROLS
    =============================== */

    .dataTables_length,
    .dataTables_filter,
    .dataTables_info,
    .dataTables_paginate {
        margin-top: .5rem;
    }

    .dataTables_filter input {
        margin-left: .5rem;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        padding: .4rem .75rem;
    }

    .dataTables_length select {
        border-radius: 8px;
        border: 1px solid #d1d5db;
        padding: .35rem 2rem .35rem .5rem;
    }

    /* ===============================
       MOBILE & TABLET
    =============================== */

    @media (max-width: 991.98px) {

        #main-wrapper {
            margin-left: 0 !important;
            width: 100%;
        }

        .main-content {
            padding: .75rem;
            margin-top: 20px;
        }

        .container-fluid {
            padding-left: 0;
            padding-right: 0;
            max-width: 100%;
        }

        .card {
            border-radius: 0;
            box-shadow: none;
        }

        .card-body {
            padding: .75rem;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        #products-table {
            min-width: 1100px;
        }

        .dataTables_wrapper {
            width: 100%;
        }

        .dataTables_filter,
        .dataTables_length,
        .dataTables_info,
        .dataTables_paginate {
            width: 100%;
            text-align: left !important;
            margin-bottom: .75rem;
        }

        .dataTables_filter input {
            width: 100%;
            margin-left: 0;
            margin-top: .5rem;
        }
    }

    /* ===============================
       SMALL PHONES
    =============================== */

    @media (max-width: 576px) {

        .main-content {
            padding: .5rem;
            margin-top: 30px;
        }

        .card-body {
            padding: .5rem;
        }

        #products-table {
            min-width: 1000px;
        }
    }
</style>

<div id="main-wrapper">
    <main class="main-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0">Manage Products</h3>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> Add Product
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="products-table" class="table table-hover align-middle w-100">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Pricing</th>
                                    <th>Stock</th>
                                    <th>Badges</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    const table = $('#products-table').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: false,
        scrollX: true,
        ajax: "{{ route('admin.products.data') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'image', name: 'image', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'category.name', name: 'category.name', defaultContent: '-' },
            { data: 'brand.name', name: 'brand.name', defaultContent: 'None' },
            { data: 'prices', name: 'prices', orderable: false, searchable: false },
            { data: 'stock', name: 'stock' },
            { data: 'badges', name: 'badges', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        initComplete: function() {
            table.columns.adjust();
        },
        drawCallback: function() {
            table.columns.adjust();
        }
    });

    $(window).on('resize', function() {
        table.columns.adjust();
    });

    const observer = new MutationObserver(function() {
        setTimeout(function() {
            table.columns.adjust();
        }, 250);
    });

    observer.observe(document.body, {
        attributes: true,
        attributeFilter: ['class']
    });
});
</script>
@endpush