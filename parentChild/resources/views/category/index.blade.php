@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    {{-- <h1>Categories</h1> --}}

    <!-- Table to display categories -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Categories</span>
            <!-- Add Category Button -->
            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">
                Add Category
            </a>
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection

@push('scripts')
    <!-- SweetAlert2 for confirmation (optional but nice) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{ $dataTable->scripts() }}
    <script>
       $(document).ready(function () {
            // Use event delegation for dynamically added elements
            $(document).on('click', '.delete-category', function () {
                var categoryId = $(this).data('id');
                var deleteUrl = '{{ route('categories.destroy', ':id') }}';
                deleteUrl = deleteUrl.replace(':id', categoryId);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: deleteUrl,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                Swal.fire('Deleted!', 'The category has been deleted.', 'success');
                                // Reload the data table after deletion
                                $('#category-table').DataTable().ajax.reload();
                            },
                            error: function (xhr, status, error) {
                                Swal.fire('Error!', 'There was an issue deleting the category.', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
