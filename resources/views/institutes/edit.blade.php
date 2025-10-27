@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header"><h3>Edit Institute</h3></div>

        <div class="card-body">
            <form action="{{ route('institutes.update', $institute->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label>Description</label>
                    <input type="text" name="description" value="{{ $institute->description }}" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label>Number of Students</label>
                    <input type="number" name="number_of_students" value="{{ $institute->number_of_students }}" class="form-control">
                </div>

                <button class="btn btn-primary">Update</button>
                <a href="{{ route('institutes.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
