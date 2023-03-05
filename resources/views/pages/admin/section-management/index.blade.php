@extends('layouts.admin')

@section('title', 'Manage Sections | Admin')

@section('content')

    <div class="row justify-content-center mx-0">
        <div>
            @if (session('alert'))
                @php $alert = session('alert') @endphp
                <x-alert :type="$alert['type']" :message="$alert['message']" />
            @endif

            <div class="card">
                <div class="card-header fw-bold fs-2">Manage Sections</div>

                <div class="card-body">
                    Academic Year Count: <span
                        class="badge rounded-pill text-bg-success py-2 px-3">{{ count($sections) > 0 ? count($sections) : 0 }}</span>
                </div>
            </div>
            <div class="mt-5 mb-2">
                <form action="{{ route('admin.store-section') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <h4 class="form-label fw-bold">Create New Section: </h4>
                        <div class="mb-3 mt-4">
                            <label for="section_name" class="form-label fw-bold">Section Name: </label>
                            <input id="section_name" type="text" class="form-control" name="section_name"
                                placeholder="Enter academic year" value="{{ old('section_name') }}">
                            @error('section_name')
                                <small class="form-text text-danger fw-bold">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="semester" class="form-label fw-bold">Semester: </label>
                            <input id="semester"type="text" class="form-control" name="semester" 
                                placeholder="Enter Semester" value="{{ old('semester') }}">
                            @error('semester')
                                <small class="form-text text-danger fw-bold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary px-5">Submit</button>
                    </div>
                </form>
            </div>

            @if (isset($sections) && count($sections) > 0)
                <hr />
                <div>
                    <h4 class="fw-bold">Academic Year List: </h4>
                    <div class="table-responsive ">
                        <table class="table table-bordered table-striped table-hover table-primary align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>ID</th>
                                    <th>Academic Year</th>
                                    <th>Semester</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <form action="">
                                    @foreach ($sections as $section)
                                        <tr class="table-primary">
                                            <td>{{ $section->id }}</td>
                                            <td>{{ $section->section_name }}</td>
                                            <td>{{ $section->semester }}</td>
                                            <td class="text-center"><a
                                                    href="{{ route('admin.edit-sections', $section->id) }}"
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
