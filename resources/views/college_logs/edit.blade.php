@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0">Edit College Log</h4>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('college_logs.update', $collegeLog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $collegeLog->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Image</label>
                    <input type="file" name="image" class="form-control">
                    @if($collegeLog->image)
                        <img src="{{ asset('storage/' . $collegeLog->image) }}" width="80" class="mt-2 rounded border">
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <input type="text" name="description" class="form-control" value="{{ $collegeLog->description }}">
                </div>

                <button type="submit" class="btn btn-warning">Update</button>
                <a href="{{ route('college_logs.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
