@extends('layouts.admin')

@section('title', 'Home | Admin')

@section('content')

    @isset($alert)
    <x-alert :type="$alert['type']" :message="$alert['message']" />
    @endisset

    <div class="row justify-content-center mx-0">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Accounts View
                </div>
            </div>
        </div>
    </div>
@endsection
