@extends('layouts.app')

@section('title', 'Study Materials')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>📚 Study Materials</h3>
        <a href="{{ route('materials.create') }}" class="btn btn-success">+ Add Material</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Exam Type</th>
                        <th>Download</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($materials as $index => $material)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $material->title }}</td>
                        <td>{{ $material->exam_type }}</td>
                        <td>
                            @if($material->file_path)
                                <a href="{{ asset('storage/'.$material->file_path) }}" target="_blank" class="btn btn-outline-primary btn-sm">PDF</a>
                            @elseif($material->link)
                                <a href="{{ $material->link }}" target="_blank" class="btn btn-outline-info btn-sm">Link</a>
                            @else
                                <span class="text-muted">No file</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-{{ $material->status == 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($material->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('materials.destroy', $material->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this material?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted">No study materials found.</td></tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $materials->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
