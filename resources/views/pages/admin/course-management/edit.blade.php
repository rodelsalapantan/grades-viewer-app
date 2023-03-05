@extends('layouts.admin')

@section('title', 'Edit Course | Admin')

@section('content')

    <div class="row justify-content-center mx-0">
        <div>
            @if (session('alert'))
                @php $alert = session('alert') @endphp
                <x-alert :type="$alert['type']" :message="$alert['message']" />
            @endif

            <div class="card">
                <div class="card-header fw-bold fs-2">Manage Courses</div>

                <div class="card-body">
                    Courses Count: <span
                        class="badge rounded-pill text-bg-success py-2 px-3">{{ count($courses) > 0 ? count($courses) : 0 }}</span>
                </div>
            </div>
            <div class="mt-5 mb-2">
                <form action="{{ route('admin.delete-course', $course->id) }}" method="post" id="delete_form">
                    @csrf
                    @method('DELETE')
                </form>

                <form action="{{ route('admin.update-course') }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $course->id }}">

                    <div class="mb-3 mt-4">
                        <label for="course_name" class="form-label fw-bold">Course Name: </label>
                        <input id="course_name" type="text" class="form-control" name="course_name"
                            placeholder="Enter academic year" value="{{ old('course_name') ?? $course->course_name }}">
                        @error('course_name')
                            <small class="form-text text-danger fw-bold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Department: </label>
                        <select class="form-select" name="department_id">
                            <option selected disabled>Select one</option>
                            @if ($departments)
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" @if($department->id == $course->department_id) selected @endif>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('department_id')
                            <small class="form-text text-danger fw-bold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="d-flex">
                        <button class="btn btn-danger px-5 me-4"
                            onclick="
                                event.preventDefault(); 
                                getElementById('delete_form').submit();
                            ">Delete</button>
                        <button type="submit" class="btn btn-primary px-5">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
