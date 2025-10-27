@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Add New Course</h4>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
        </div>

        <div class="card-body">
            {{-- Display Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Success Message --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Create Course Form --}}
            <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Course Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Course Name:</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        placeholder="Enter course name"
                        required
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Short Course --}}
                <div class="mb-3">
                    <label for="short_course" class="form-label">Short Course Code:</label>
                    <input 
                        type="text" 
                        name="short_course" 
                        id="short_course" 
                        class="form-control @error('short_course') is-invalid @enderror"
                        value="{{ old('short_course') }}"
                        placeholder="Enter short course code (e.g. CSE101)"
                        required
                    >
                    @error('short_course')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Image Upload --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Course Image:</label>
                    <input 
                        type="file" 
                        name="image" 
                        id="image" 
                        class="form-control @error('image') is-invalid @enderror"
                        accept="image/*"
                    >
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success px-4">Save Course</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
