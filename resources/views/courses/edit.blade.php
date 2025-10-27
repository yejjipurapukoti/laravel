@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Edit Course</h3>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back</a>
        </div>

        <div class="card-body">
            <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="name">Course Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $course->name) }}" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="short_course">Short Course</label>
                    <input type="text" name="short_course" id="short_course" value="{{ old('short_course', $course->short_course) }}" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="image">Image</label>
                    @if($course->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $course->image) }}" width="80" height="80" class="rounded" alt="Course Image">
                        </div>
                    @endif
                    <input type="file" name="image" id="image" class="form-control">
                    <small class="text-muted">Leave blank to keep existing image</small>
                </div>

                <button type="submit" class="btn btn-primary">Update Course</button>
            </form>
        </div>
    </div>
</div>
@endsection
