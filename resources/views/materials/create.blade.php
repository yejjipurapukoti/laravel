@extends('layouts.app')

@section('title', 'Add Study Material')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-success text-white py-3 px-4">
            <h4 class="mb-0">➕ Add Study Material</h4>
        </div>

        <div class="card-body bg-light p-4">
            <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Exam Type</label>
                    <input type="text" name="exam_type" class="form-control" placeholder="e.g., UPSC, NEET">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Upload PDF (Optional)</label>
                    <input type="file" name="file" class="form-control" accept="application/pdf">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">External Link (Optional)</label>
                    <input type="url" name="link" class="form-control" placeholder="https://example.com/material.pdf">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-control">
                        <option value="active" selected>Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('materials.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
