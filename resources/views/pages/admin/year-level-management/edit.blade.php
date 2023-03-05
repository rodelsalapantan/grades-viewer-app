@extends('layouts.admin')

@section('title', 'Edit Year Level | Admin')

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
                <form action="{{ route('admin.delete-year-level', $year_level->id) }}" method="post" id="delete_form">
                    @csrf
                    @method('DELETE')
                </form>

                <form action="{{ route('admin.update-year-level') }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $year_level->id }}">

                    <div class="mb-3 mt-4">
                        <label for="year_level" class="form-label fw-bold">Year Level: </label>
                        <input id="year_level" type="text" class="form-control" name="year_level"
                            placeholder="Enter Year Level" value="{{ old('year_level') ?? $year_level->year_level }}">
                        @error('year_level')
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
