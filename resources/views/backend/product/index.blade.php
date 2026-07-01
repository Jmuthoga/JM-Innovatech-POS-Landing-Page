@extends('backend.layouts.admin')

@section('title', 'JPOS Systems Products')

@section('content')
<style>
    :root {
        --sidebar-width: var(--sidebar-width, 260px);
        --transition-speed: .25s;
    }

    #main-wrapper {
        margin-left: var(--sidebar-width);
        transition: margin-left var(--transition-speed) cubic-bezier(.4, 0, .2, 1);
        min-height: 100vh;
        background: #f1f5f9;
    }

    body.sidebar-collapsed #main-wrapper {
        margin-left: var(--sidebar-collapsed-width, 70px);
    }

    .main-content {
        padding: 2rem;
        margin-top: 10px;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 .125rem .5rem rgba(0, 0, 0, .08);
    }

    .table-responsive {
        overflow-x: auto;
        width: 100%;
    }

    #products-table {
        width: 100% !important;
    }

    table.dataTable {
        width: 100% !important;
    }

    .dataTables_wrapper {
        width: 100%;
    }

    .dataTables_filter input {
        margin-left: .5rem;
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