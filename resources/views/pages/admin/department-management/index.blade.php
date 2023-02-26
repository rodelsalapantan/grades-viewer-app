@extends('layouts.admin')

@section('title', 'Manage Department | Admin')

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
                    Department Count: <span class="badge rounded-pill text-bg-success py-2 px-3">{{ count($dept_list) > 0 ? count($dept_list) : 0}}</span>
                </div>
            </div>
            <div class="mt-5 mb-2">
                <form action="{{ route('admin.store-department') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <h4 class="form-label fw-bold">Create New Department: </h4>
                        <input type="text" class="form-control" name="name" aria-describedby="helpId"
                            placeholder="Enter Department" value="{{ old('name') }}">
                        @error('name')
                            <small id="helpId" class="form-text text-danger fw-bold">{{ $message }}</small>
                        @enderror

                    </div>
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary px-5">Submit</button>
                    </div>
                </form>
            </div>
            
            @if(isset($dept_list) && count($dept_list) > 0)
            <hr />
                <div>
                    <h4 class="fw-bold">Department List: </h4>
                    <div class="table-responsive ">
                        <table class="table table-bordered table-striped table-hover table-primary align-middle">
                            <thead class="table-dark" >
                                <tr>
                                    <th>ID</th>
                                    <th>Department Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <form action="">
                                @foreach ($dept_list as $dept)
                                    <tr class="table-primary">
                                        <td>{{ $dept->id }}</td>
                                        <td>{{ $dept->name }}</td>
                                        <td class="text-center"><a href="{{ route('admin.edit-department', $dept->id ) }}" class="btn btn-primary btn-sm px-4">Edit</a></td>
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
