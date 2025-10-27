@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded" style="max-width: 700px; margin:auto;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Edit Student</h4>
            <a href="{{ route('students.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
        </div>

        <div class="card-body">
            {{-- Validation Errors --}}
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
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name', $student->name) }}" 
                        class="form-control @error('name') is-invalid @enderror" 
                        placeholder="Enter student name" 
                        required
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email', $student->email) }}" 
                        class="form-control @error('email') is-invalid @enderror" 
                        placeholder="Enter email address" 
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Image --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Profile Image:</label>
                    @if ($student->image)
                        <div class="mb-2">
                            <img 
                                src="{{ asset('storage/' . $student->image) }}" 
                                alt="Current Image" 
                                class="img-thumbnail rounded" 
                                width="120"
                            >
                        </div>
                    @endif

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
                    <small class="text-muted">Leave blank if you don’t want to change the image.</small>
                </div>

                {{-- Submit Buttons --}}
                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-success px-4">Update Student</button>
                    <a href="{{ route('students.index') }}" class="btn btn-secondary px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
