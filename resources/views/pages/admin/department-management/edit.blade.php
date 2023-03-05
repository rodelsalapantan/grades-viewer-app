@extends('layouts.admin')

@section('title', 'Edit Department | Admin')

@section('content')

    <div class="row justify-content-center mx-0">
        <div>
            @if (Session::has('alert'))
                @php $alert = Session::get('alert') @endphp
                <x-alert :type="$alert['type']" :message="$alert['message']" />
            @endif

            <div class="card">
                <div class="card-header fw-bold fs-2">Manage Department</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Department Count: <span
                        class="badge rounded-pill text-bg-success py-2 px-3">{{ count($dept_list) > 0 ? count($dept_list) : 0 }}</span>
                </div>
            </div>
            <div class="mt-5 mb-2">
                <form action="{{ route('admin.delete-department', $dept->id) }}" method="post" id="delete_form">
                    @csrf
                    @method('DELETE')
                </form>

                <form action="{{ route('admin.update-department') }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$dept->id}}">

                    <div class="mb-3">
                        <h4 class="form-label fw-bold">Update Department: </h4>
                        <input type="text" class="form-control" name="name" aria-describedby="helpId"
                            placeholder="Enter Department" value="{{ old('name') ?? $dept->name }}">
                        @error('name')
                            <small id="helpId" class="form-text text-danger fw-bold">{{ $message }}</small>
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
