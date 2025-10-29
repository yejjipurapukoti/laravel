@extends('layouts.app')

@section('title', 'Add Slider Image')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Add New Slider Image</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data" class="card shadow p-4">
        @csrf

        <div class="mb-3">
            <label class="form-label">Title:</label>
            <input type="text" name="title" class="form-control" placeholder="Enter title" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Image:</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status:</label>
            <select name="status" class="form-select">
                <option value="active" selected>Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('slider.index') }}" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </form>
</div>
@endsection
