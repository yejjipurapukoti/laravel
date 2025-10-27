@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3 px-4">
            <h4 class="mb-0">🎓 Students List</h4>
            <a href="{{ route('students.create') }}" class="btn btn-light text-primary fw-semibold">
                + Add Student
            </a>
        </div>

        <div class="card-body bg-light p-4">
            {{-- ✅ Success Message --}}
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
                            <th scope="col" style="width: 30%">Name</th>
                            <th scope="col" style="width: 25%">Email</th>
                            <th scope="col" style="width: 30%">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>
                                    @if($student->image)
                                        <img src="{{ asset('storage/' . $student->image) }}" 
                                             class="rounded-circle border" 
                                             alt="Student Image" 
                                             width="60" height="60">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>
                                    <a href="{{ route('students.edit', $student->id) }}" 
                                       class="btn btn-warning btn-sm me-2">
                                        ✏️ Edit
                                    </a>

                                    <form action="{{ route('students.destroy', $student->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this student?')">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-muted py-4">No students found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- ✅ Pagination --}}
            @if($students->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $students->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
