@extends('layouts.admin')

@section('title', 'Manage Courses | Admin')

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
                <form action="{{ route('admin.store-course') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <h4 class="form-label fw-bold">Create New Course: </h4>
                        <div class="mb-3 mt-4">
                            <label for="course_name" class="form-label fw-bold">Course Name: </label>
                            <input id="course_name" type="text" class="form-control" name="course_name"
                                placeholder="Enter academic year" value="{{ old('course_name') }}" required>
                            @error('course_name')
                                <small class="form-text text-danger fw-bold">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Department: </label>
                            <select class="form-select" name="department_id">
                                <option selected disabled>Select one</option>
                                @if($departments && count($departments) > 0)
                                    @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('department_id')
                                <small class="form-text text-danger fw-bold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary px-5">Submit</button>
                    </div>
                </form>
            </div>

            @if (isset($courses) && count($courses) > 0)
                <hr />
                <div>
                    <h4 class="fw-bold">Academic Year List: </h4>
                    <div class="table-responsive ">
                        <table class="table table-bordered table-striped table-hover table-primary align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>ID</th>
                                    <th>Academic Year</th>
                                    <th>Department</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <form action="">
                                    @foreach ($courses as $course)
                                        <tr class="table-primary">
                                            <td>{{ $course->id }}</td>
                                            <td>{{ $course->course_name }}</td>
                                            <td>{{ $course->department_name }}</td>
                                            <td class="text-center"><a
                                                    href="{{ route('admin.edit-course', $course->id) }}"
                                                    class="btn btn-primary btn-sm px-4">Edit</a></td>
                                        </tr>
                                    @endforeach
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
