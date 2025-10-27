@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header"><h3>Add New Institute</h3></div>

        <div class="card-body">
            <form action="{{ route('institutes.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label>Description</label>
                    <input type="text" name="description" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label>Number of Students</label>
                    <input type="number" name="number_of_students" class="form-control">
                </div>

                <button class="btn btn-success">Save</button>
                <a href="{{ route('institutes.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
