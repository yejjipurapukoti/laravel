@extends('layouts.app')

@section('content')
<div class="container mt-5">

    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>🎓 Students List</h3>
        <a href="{{ route('students.create') }}" class="btn btn-success">+ Add Student</a>
    </div>

    {{-- ✅ Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Card Container --}}
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <table class="table table-hover align-middle text-center">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
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
                                         width="50" height="50">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm me-2">
                                    ✏️ Edit
                                </a>

                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this student?')">
                                        🗑️ Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-muted py-3">No students found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

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
