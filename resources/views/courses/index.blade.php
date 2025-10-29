@extends('layouts.app')
@section('title', 'Courses')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>📚 Courses List</h3>
        <a href="{{ route('courses.create') }}" class="btn btn-success">+ Add Course</a>
    </div>

    {{-- ✅ Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-success">
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 10%">Image</th>
                        <th style="width: 30%">Course Name</th>
                        <th style="width: 25%">Short Name</th>
                        <th style="width: 30%">Action</th>
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
                            <td colspan="5" class="text-center text-muted py-4">No courses found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- ✅ Pagination --}}
            @if($courses instanceof \Illuminate\Pagination\LengthAwarePaginator && $courses->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $courses->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
