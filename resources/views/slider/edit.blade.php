@extends('layouts.app')

@section('title', 'Edit Slider Image')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Edit Slider Image</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('slider.update', $image->id) }}" method="POST" enctype="multipart/form-data" class="card shadow p-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title:</label>
            <input type="text" name="title" value="{{ old('title', $image->title) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image:</label><br>
            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Current Image" class="rounded mb-3" width="150">
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">Status:</label>
            <select name="status" class="form-select">
                <option value="active" {{ $image->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $image->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('slider.index') }}" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection
