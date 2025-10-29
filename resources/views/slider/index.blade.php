@extends('layouts.app')

@section('title', 'Slider Images')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>🖼️ Slider Images</h3>
        <a href="{{ route('slider.create') }}" class="btn btn-success">+ Add Image</a>
    </div>

    {{-- ✅ Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($images as $index => $image)
                    <tr>
                        <td>{{ $images->firstItem() + $index }}</td>
                        <td>{{ $image->title }}</td>
                        <td>
                            @if($image->image_path)
                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                     alt="Slider Image" 
                                     class="rounded border" 
                                     width="120" height="70">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>{{ $image->order_index }}</td>
                        <td>
                            <span class="badge bg-{{ $image->status == 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($image->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('slider.edit', $image->id) }}" 
                               class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('slider.destroy', $image->id) }}" 
                                  method="POST" 
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Delete this image?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No slider images found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- ✅ Pagination --}}
            @if($images->hasPages())
                <div class="mt-3">
                    {{ $images->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
