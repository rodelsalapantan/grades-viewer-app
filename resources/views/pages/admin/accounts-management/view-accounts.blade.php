@extends('layouts.admin')

@section('title', 'View Accounts | Admin')

@section('content')

    <div class="row justify-content-center mx-0">
        <div>
            @if (Session::has('alert'))
                @php $alert = Session::get('alert') @endphp
                <x-alert :type="$alert['type']" :message="$alert['message']" />
            @endif

            <div class="card mb-2">
                <div class="card-header fw-bold fs-2">Manage Accounts</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Accounts Count: <span
                        class="badge rounded-pill text-bg-success py-2 px-3">{{ count($users) > 0 ? count($users) : 0 }}</span>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-end align-items-center">
                <span>Create new account?</span>
                <a class="btn btn-primary ms-2" href="{{route('admin.create-student')}}">New Student</a>
                <a class="btn btn-success ms-2" href="{{route('admin.create-teacher')}}">New Teacher</a>
            </div>

            @if (isset($users) && count($users) > 0)
                <div>
                    <h4 class="fw-bold">Users: </h4>
                    <div class="table-responsive ">
                        <table class="table table-bordered table-striped table-hover table-warning align-middle">
                            <thead class="table-warning">
                                <tr>
                                    <th>ID</th>
                                    <th>Account Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <form action="">
                                    @foreach ($users as $user)
                                        <tr class="table-secondary">
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td class="text-center"><a href="/"
                                                    class="btn btn-primary btn-sm px-4">Edit</a></td>
                                        </tr>
                                    @endforeach
                                </form>
                            </tbody>
                        </table>

                        {{ $users->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
