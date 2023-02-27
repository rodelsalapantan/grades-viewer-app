<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title', 'Grades Viewer App')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/grade-sheet.png') }}" type="image/x-icon">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin-layout.css') }}">

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script> 
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper" aria-labelledby="offcanvasResponsiveLabel">
            <div class="sidebar-heading border-bottom bg-light">
                {{-- Base Link --}}
                <a class="navbar-brand" href="{{ url('/admin') }}">
                    <img src="{{ asset('img/grade-sheet.png') }}" alt="Logo" style="width: 30px;">
                    Grades Viewer App
                </a>
            </div>
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ url()->current() == route('admin.home') ? 'active' : '' }}"
                    href="/admin">
                    <span class="bi-menu-button-wide-fill me-2"></span> Dashboard</a>
                <button
                    class="list-group-item list-group-item-action list-group-item-light p-3 
                    {{ in_array(url()->current(), [
                        route('admin.view-accounts'),
                        route('admin.create-teacher'),
                        route('admin.create-student'),
                    ])
                        ? 'active'
                        : '' }}"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="bi-people-fill me-2"></span> Account Management <span
                        class="bi-caret-right-fill ms-auto"></span>
                </button>
                <ul class="dropdown-menu ms-2">
                    <li><a class="dropdown-item" href="{{ route('admin.view-accounts') }}">View Accounts</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.create-teacher') }}">Create New Teacher</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.create-student') }}">Create New Student</a></li>
                </ul>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 
                    {{ url()->current() == route('admin.manage-department') || request()->is('admin/edit-dept/*') ? 'active' : '' }}"
                    href="{{ route('admin.manage-department') }}">
                    <span class="bi-building me-2"></span> Department Management
                </a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 
                    {{ url()->current() == route('admin.manage-acad-year') || request()->is('admin/edit-acad-year/*')
                        ? 'active'
                        : '' }}"
                    href="{{ route('admin.manage-acad-year') }}">
                    <span class="bi-calendar-date me-2"></span> Manage Academic Year
                </a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Profile</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Status</a>
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    {{-- Humberger Icon --}}
                    <div id="sidebarToggle">
                        <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    {{-- Base Link --}}
                    <a class="navbar-brand d-md-none" href="{{ url('/') }}">
                        <img src="{{ asset('img/grade-sheet.png') }}" alt="Logo" style="width: 30px;">
                        Grades Viewer App
                    </a>

                    {{-- Caret Icon --}}

                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="bi-caret-down-fill"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">{{ Auth::user()->name }}</a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page content-->
            <div class="container-fluid mt-3">
                @yield('content')
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', event => {

            // Toggle the side navigation
            const sidebarToggle = document.body.querySelector('#sidebarToggle');
            if (sidebarToggle) {
                // Uncomment Below to persist sidebar toggle between refreshes
                // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
                //     document.body.classList.toggle('sb-sidenav-toggled');
                // }
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    document.body.classList.toggle('sb-sidenav-toggled');
                    localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains(
                        'sb-sidenav-toggled'));
                });
            }

        });
    </script>
</body>

</html>
