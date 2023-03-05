@extends('layouts.admin')

@section('title', 'Manage Year Level | Admin')

@section('content')

    <div class="row justify-content-center mx-0">
        <div>
            @if (session('alert'))
                @php $alert = session('alert') @endphp
                <x-alert :type="$alert['type']" :message="$alert['message']" />
            @endif

            <div class="card">
                <div class="card-header fw-bold fs-2">Manage Year Level</div>

                <div class="card-body">
                    Year Level Count: <span
                        class="badge rounded-pill text-bg-success py-2 px-3">{{ count($year_levels) > 0 ? count($year_levels) : 0 }}</span>
                </div>
            </div>
            <div class="mt-5 mb-2">
                <form action="{{ route('admin.store-year-level') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <h4 class="form-label fw-bold">Create New Year Level: </h4>
                        <div class="mb-3 mt-4">
                            <label for="year_level" class="form-label fw-bold">Year Level: </label>
                            <input id="year_level" type="text" class="form-control" name="year_level"
                                placeholder="Enter year level" value="{{ old('year_level') }}">
                            @error('year_level')
                                <small class="form-text text-danger fw-bold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary px-5">Submit</button>
                    </div>
                </form>
            </div>

            @if (isset($year_levels) && count($year_levels) > 0)
                <hr />
                <div>
                    <h4 class="fw-bold">Academic Year List: </h4>
                    <div class="table-responsive ">
                        <table class="table table-bordered table-striped table-hover table-primary align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>ID</th>
                                    <th>Year Level</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <form action="">
                                    @foreach ($year_levels as $year_level)
                                        <tr class="table-primary">
                                            <td>{{ $year_level->id }}</td>
                                            <td>{{ $year_level->year_level }}</td>
                                            <td class="text-center"><a
                                                    href="{{ route('admin.edit-year-level', $year_level->id) }}"
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
