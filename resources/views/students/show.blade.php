@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Student Details</h2>

    <div class="card mt-3 shadow-sm" style="max-width: 500px;">
        <div class="card-body text-center">
            @if($student->image)
                <img src="{{ asset('storage/' . $student->image) }}" 
                     alt="Student Image" 
                     class="img-fluid rounded mb-3" 
                     width="150">
            @else
                <img src="https://via.placeholder.com/150" 
                     alt="No Image" 
                     class="img-fluid rounded mb-3">
            @endif

            <h4 class="mb-2">{{ $student->name }}</h4>
            <p class="text-muted mb-2">{{ $student->email }}</p>

            <div class="d-flex justify-content-center gap-2 mt-3">
                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm">
                    Edit
                </a>

                <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>

                <a href="{{ route('students.index') }}" class="btn btn-secondary btn-sm">
                    Back
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
