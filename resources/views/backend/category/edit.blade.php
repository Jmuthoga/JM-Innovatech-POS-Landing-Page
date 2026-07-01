@extends('backend.layouts.admin')

@section('title', 'JPOS Systems Edit Categories')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="card shadow border-0 mx-auto" style="max-width: 600px;">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">Edit Category: {{ $category->name }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="form-label fw-semibold">Category Name *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
                    @error('name') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('categories.index') }}" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection