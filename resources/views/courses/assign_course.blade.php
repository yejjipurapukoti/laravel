@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-journal-text me-2"></i>Assign Courses to Student</h4>
                    <a href="{{ route('students.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>

                <div class="card-body p-4">
                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Form --}}
                    <form method="POST" action="{{ route('student.course.assign') }}">
                        @csrf

                        {{-- Student Dropdown --}}
                        <div class="mb-4">
                            <label for="student_id" class="form-label fw-semibold">
                                <i class="bi bi-person-fill me-2"></i>Select Student
                            </label>
                            <select name="student_id" id="student_id" class="form-select select2" required>
                                <option value="">-- Choose Student --</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Courses Dropdown --}}
                        <div class="mb-4">
                            <label for="course_ids" class="form-label fw-semibold">
                                <i class="bi bi-book-half me-2"></i>Select Courses
                            </label>
                            <select name="course_ids[]" id="course_ids" class="form-select select2" multiple required>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-check-circle me-2"></i>Assign Courses
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Include Select2 JS (if not already in layout) -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            placeholder: "Select options",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endsection

@section('styles')
<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
