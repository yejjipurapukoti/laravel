@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3 px-4">
            <h4 class="mb-0">📚 Courses List</h4>
            <a href="{{ route('courses.create') }}" class="btn btn-light text-primary fw-semibold">
                + Add Course
            </a>
        </div>

        <div class="card-body bg-light p-4">
            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center table-bordered">
                    <thead class="table-primary text-dark">
                        <tr>
                            <th scope="col" style="width: 5%">#</th>
                            <th scope="col" style="width: 10%">Image</th>
                            <th scope="col" style="width: 30%">Course Name</th>
                            <th scope="col" style="width: 25%">Short Name</th>
                            <th scope="col" style="width: 30%">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($courses as $course)
                            <tr>
                                <td>{{ $course->id }}</td>
                                <td>
                                    @if($course->image)
                                        <img src="{{ asset('storage/' . $course->image) }}" 
                                             class="rounded-circle border" 
                                             alt="Course Image" width="60" height="60">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $course->name }}</td>
                                <td>{{ $course->short_course }}</td>
                                <td>
                                    <a href="{{ route('courses.edit', $course->id) }}" 
                                       class="btn btn-warning btn-sm me-2">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('courses.destroy', $course->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this course?')">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-muted py-4">No courses found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($courses->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $courses->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
