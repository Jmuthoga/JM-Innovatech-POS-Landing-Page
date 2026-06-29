@extends('backend.layouts.admin')

@section('title', 'Overview')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card admin-card p-4 border-start border-4" style="border-color: var(--jpos-blue) !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted text-uppercase mb-1 small fw-bold">Gross Sales</h6>
                    <h3 class="mb-0 fw-bold">$24,150</h3>
                </div>
                <div class="fs-1 text-muted opacity-50"><i class="bi bi-currency-dollar text-primary"></i></div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card admin-card p-4 border-start border-4" style="border-color: var(--jpos-green) !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted text-uppercase mb-1 small fw-bold">Active Licenses</h6>
                    <h3 class="mb-0 fw-bold">1,482</h3>
                </div>
                <div class="fs-1 text-muted opacity-50"><i class="bi bi-hdd-network text-success"></i></div>
            </div>
        </div>
    </div>
</div>
@endsection