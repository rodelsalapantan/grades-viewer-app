@extends('layouts.admin')

@section('title', 'Home | Admin')

@section('content')

    @isset($alert)
        <x-alert :type="$alert['type']" :message="$alert['message']" />
    @endisset

    <div class="row justify-content-center mx-0">
        <div class="card mb-3 bg-secondary text-light">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <span class="fs-3 fw-bold p-3 text-center">Admin Dashboard</span>
        </div>
        <div class="col-md-8 ">
            
            <div class="d-flex justify-content-center align-items-center flex-wrap text-center">
                <div class="card text-bg-success mb-3 w-100">
                    <div class="card-header fs-4">Teachers</div>
                    <div class="card-body">
                        <h5 class="card-title"><strong>Current Count:</strong> {{ $counts['teachers']}} </h5>
                    </div>
                </div>
                <div class="card text-bg-warning mb-3 w-100">
                    <div class="card-header fs-4">Students</div>
                    <div class="card-body">
                        <h5 class="card-title"><strong>Current Count:</strong> {{ $counts['students']}} </h5>
                    </div>
                </div>
                <div class="card text-bg-info mb-3 w-100">
                    <div class="card-header fs-4">Departments</div>
                    <div class="card-body">
                        <h5 class="card-title"><strong>Current Count:</strong> {{ $counts['departments']}} </h5>
                    </div>
                </div>
                <div class="card text-bg-primary mb-3 w-100">
                    <div class="card-header fs-4">Academic Year</div>
                    <div class="card-body">
                        <h5 class="card-title"><strong>Current Count:</strong> {{ $counts['academic_years']}} </h5>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
