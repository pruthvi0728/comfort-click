<!-- Edit button -->
<a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
<!-- Delete button -->
<button class="btn btn-danger btn-sm delete-category" data-id="{{ $category->id }}">Delete</button>
