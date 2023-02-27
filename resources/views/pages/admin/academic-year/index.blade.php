@extends('layouts.admin')

@section('title', 'Manage Academic Year| Admin')

@section('content')

    <div class="row justify-content-center mx-0">
        <div>
            @if (Session::has('alert'))
                @php $alert = Session::get('alert') @endphp
                <x-alert :type="$alert['type']" :message="$alert['message']" />
            @endif

            <div class="card">
                <div class="card-header fw-bold fs-2">Manage Academic Year</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Academic Year Count: <span
                        class="badge rounded-pill text-bg-success py-2 px-3">{{ count($year_list) > 0 ? count($year_list) : 0 }}</span>
                </div>
            </div>
            <div class="mt-5 mb-2">
                <form action="{{ route('admin.store-acad-year') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <h4 class="form-label fw-bold">Create New Academic Year: </h4>
                        <div class="mb-3 mt-4">
                            <label for="academic_year" class="form-label fw-bold">Academic Year: </label>
                            <input id="academic_year" type="text" class="form-control" name="academic_year"
                                placeholder="Enter academic year" value="{{ old('academic_year') }}">
                            @error('academic_year')
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

            @if (isset($year_list) && count($year_list) > 0)
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
                                    @foreach ($year_list as $year)
                                        <tr class="table-primary">
                                            <td>{{ $year->id }}</td>
                                            <td>{{ $year->academic_year }}</td>
                                            <td>{{ $year->semester }}</td>
                                            <td class="text-center"><a
                                                    href="{{ route('admin.edit-acad-year', $year->id) }}"
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
