@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3 px-4">
            <h4 class="mb-0">🏫 Institutes List</h4>
            <a href="{{ route('institutes.create') }}" class="btn btn-light text-primary fw-semibold">
                + Add Institute
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
                            <th scope="col" style="width: 10%">#</th>
                            <th scope="col" style="width: 50%">Description</th>
                            <th scope="col" style="width: 20%">Number of Students</th>
                            <th scope="col" style="width: 20%">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($institutes as $institute)
                            <tr>
                                <td>{{ $institute->id }}</td>
                                <td class="fw-semibold text-start">{{ $institute->description }}</td>
                                <td>{{ $institute->number_of_students ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('institutes.edit', $institute->id) }}" 
                                       class="btn btn-warning btn-sm me-2">
                                        ✏️ Edit
                                    </a>

                                    <form action="{{ route('institutes.destroy', $institute->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this institute?')">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted py-4">No institutes found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- ✅ Pagination --}}
            @if($institutes->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $institutes->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
