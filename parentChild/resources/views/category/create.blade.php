@extends('layouts.app')

@section('title', isset($category) ? 'Edit Category' : 'Create Category')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <h1>{{ isset($category) ? 'Edit Category' : 'Create Category' }}</h1>

    <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
        @csrf
        @if (isset($category)) @method('PUT') @endif

        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name ?? '') }}" required>
        </div>

        <!-- Parent Category (Select2 Dropdown) -->
        <div class="mb-3">
            <label for="parent_id" class="form-label">Parent Category</label>
            <select class="form-control select2" id="parent_id" name="parent_id">
                <option value="">Select Parent Category</option>
                @foreach($listOfCategories as $parentCategory)
                    <option value="{{ $parentCategory->id }}" 
                        {{ old('parent_id', $category->parent_id ?? '') == $parentCategory->id ? 'selected' : '' }}>
                        {{ $parentCategory->hierarchyName() }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Update Category' : 'Create Category' }}</button>
    </form>

    <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">Back to Categories</a>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2 for the parent category dropdown
            $('#parent_id').select2({
                placeholder: "Select Parent Category",
                allowClear: true
            });
        });
    </script>
@endpush
