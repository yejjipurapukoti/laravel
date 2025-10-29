@extends('layouts.app')

@section('title', 'Institutes')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>🏫 Institutes</h3>
        <a href="{{ route('institutes.create') }}" class="btn btn-success">+ Add Institute</a>
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
                        <th>#</th>
                        <th>Description</th>
                        <th>Number of Students</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($institutes as $index => $institute)
                    <tr>
                        <td>{{ $institutes->firstItem() + $index }}</td>
                        <td class="text-start">{{ $institute->description }}</td>
                        <td>{{ $institute->number_of_students ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('institutes.edit', $institute->id) }}" 
                               class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('institutes.destroy', $institute->id) }}" 
                                  method="POST" 
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this institute?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No institutes found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- ✅ Pagination --}}
            @if($institutes->hasPages())
                <div class="mt-3">
                    {{ $institutes->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
