@extends('layouts.app')

@section('title', 'Edit Study Material')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-warning text-white py-3 px-4">
            <h4 class="mb-0">✏️ Edit Study Material</h4>
        </div>

        <div class="card-body bg-light p-4">
            <form action="{{ route('materials.update', $material->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Title</label>
                    <input type="text" name="title" class="form-control" 
                           value="{{ old('title', $material->title) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Exam Type</label>
                    <input type="text" name="exam_type" class="form-control" 
                           value="{{ old('exam_type', $material->exam_type) }}" 
                           placeholder="e.g., UPSC, NEET">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Current File / Link</label>
                    <div>
                        @if($material->file_path)
                            <a href="{{ asset('storage/'.$material->file_path) }}" 
                               target="_blank" class="btn btn-outline-primary btn-sm">View Current PDF</a>
                        @elseif($material->link)
                            <a href="{{ $material->link }}" 
                               target="_blank" class="btn btn-outline-info btn-sm">Open Current Link</a>
                        @else
                            <span class="text-muted">No file or link</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Upload New PDF (Optional)</label>
                    <input type="file" name="file" class="form-control" accept="application/pdf">
                    <small class="text-muted">Leave empty to keep existing file.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">External Link (Optional)</label>
                    <input type="url" name="link" class="form-control" 
                           value="{{ old('link', $material->link) }}" 
                           placeholder="https://example.com/material.pdf">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $material->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $material->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-warning text-white">Update</button>
                <a href="{{ route('materials.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
