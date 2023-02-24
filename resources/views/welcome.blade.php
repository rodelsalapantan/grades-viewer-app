@extends('layouts.app')

@section('content')
<div class="container col-xxl-8 px-4 py-5 mt-xl-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
            <img src="{{ asset('img/grade-sheet.png') }}" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy" style="transform: rotate(20deg);">
        </div>
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold lh-1 mb-3">Grades Viewer App</h1>
            <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a class="btn btn-primary btn-lg px-4 py-2 me-md-2" href="{{ url('/login') }}">Login</a>
            </div>
        </div>
    </div>
</div>
@endsection