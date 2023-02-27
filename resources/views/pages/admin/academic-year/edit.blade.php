@extends('layouts.admin')

@section('title', 'Edit Academic Year | Admin')

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
                <form action="{{ route('admin.delete-acad-year', $year->id) }}" method="post" id="delete_form">
                    @csrf
                    @method('DELETE')
                </form>

                <form action="{{ route('admin.update-acad-year', $year->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3 mt-4">
                        <label for="academic_year" class="form-label fw-bold">Academic Year: </label>
                        <input id="academic_year" type="text" class="form-control" name="academic_year"
                            placeholder="Enter academic year" value="{{ old('academic_year') ?? $year->academic_year }}">
                        @error('academic_year')
                            <small class="form-text text-danger fw-bold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="semester" class="form-label fw-bold">Semester: </label>
                        <input id="semester"type="text" class="form-control" name="semester" 
                            placeholder="Enter Semester" value="{{ old('semester') ?? $year->semester }}">
                        @error('semester')
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
