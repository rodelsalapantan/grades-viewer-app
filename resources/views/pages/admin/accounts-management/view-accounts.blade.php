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
                    Accounts Count:
                    <span
                        class="badge rounded-pill text-bg-success py-2 px-3">{{ count($users) > 0 ? count($users) : 0 }}</span>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-end align-items-center">
                <span>Create new account?</span>
                <a class="btn btn-primary ms-2" href="{{ route('admin.create-student') }}">New Student</a>
                <a class="btn btn-success ms-2" href="{{ route('admin.create-teacher') }}">New Teacher</a>
            </div>

            {{-- No result --}}
            @if (isset($users) && count($users) == 0)
                <div class="alert alert-primary mt-5" role="alert">
                    <strong>No account exists.</strong>
                </div>
            @endif

            {{-- teachers --}}
            @if (isset($teachers) && count($teachers) > 0)
                <div>
                    <h4 class="fw-bold">Teachers: </h4>
                    <div class="table-responsive ">
                        <table class="table table-bordered table-striped table-hover table-warning align-middle">
                            <thead class="table-warning">
                                <tr>
                                    <th>ID</th>
                                    <th>Account Name</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <form action="">
                                    @foreach ($teachers as $teacher)
                                        <tr class="table-light">
                                            <td>{{ $teacher->id }}</td>
                                            <td>{{ $teacher->name }}</td>
                                        </tr>
                                    @endforeach
                                </form>
                            </tbody>
                        </table>

                        {{ $teachers->links() }}
                    </div>
                </div>
            @endif
            {{-- teachers --}}
            @if (isset($students) && count($students) > 0)
                <div>
                    <h4 class="fw-bold">Students: </h4>
                    <div class="table-responsive ">
                        <table class="table table-bordered table-striped table-hover table-info align-middle">
                            <thead class="table-info">
                                <tr>
                                    <th>ID</th>
                                    <th>Account Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <form action="">
                                    @foreach ($students as $student)
                                        <tr class="table-light">
                                            <td>{{ $student->id }}</td>
                                            <td>{{ $student->name }}</td>>
                                        </tr>
                                    @endforeach
                                </form>
                            </tbody>
                        </table>

                        {{ $students->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
