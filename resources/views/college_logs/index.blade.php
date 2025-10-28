@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3 px-4">
            <h4 class="mb-0">🏫 College Logs</h4>
            <a href="{{ route('college_logs.create') }}" class="btn btn-light text-primary fw-semibold">
                + Add Log
            </a>
        </div>

        <div class="card-body bg-light p-4">
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
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($collegeLogs as $log)
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>
                                    @if($log->image)
                                        <img src="{{ asset('storage/' . $log->image) }}" 
                                             alt="Image" width="60" height="60" class="rounded border">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $log->name }}</td>
                                <td>{{ $log->description ?? '—' }}</td>
                                <td>
                                    <a href="{{ route('college_logs.edit', $log->id) }}" 
                                       class="btn btn-warning btn-sm me-2">✏️ Edit</a>
                                    <form action="{{ route('college_logs.destroy', $log->id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this log?')">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-muted py-4">No logs found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($collegeLogs->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $collegeLogs->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
