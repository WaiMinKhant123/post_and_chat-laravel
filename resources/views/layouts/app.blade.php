<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>
<style>
    .dropdown-name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: inline-block;
        max-width: 150px; 
    }
</style>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   <b>POST AND CHAT</b>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <li class="nav-item position-relative">
                            <a class="nav-link text-success" href="{{ route('post.index') }}"><b>All Posts</b></a>
                        </li>
                        <li class="nav-item position-relative">
                            <a class="nav-link text-success" href="{{ route('post.following') }}"><b>Following</b></a>
                        </li>
                       
                        <li class="nav-item position-relative">
                            <a class="nav-link text-success" href="{{ route('chat.active') }}"><b>Chat</b>
                                <span id="unread-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none">
                                    0
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item position-relative">
                            <a class="nav-link text-success" href="{{ route('friends.index') }}"><b>Friends</b></a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="{{ url("/profileU/" . Auth::id()) }}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="/avatars/{{ Auth::user()->avatar }}" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 8px;">
                        <span class="dropdown-name" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ Auth::user()->name }}">
                        {{ Str::limit(Auth::user()->name, 15) }} 
                        </span>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @auth
                                <a class="dropdown-item" href="{{ url('/post/createAndUpload') }}">
                                    Add Post
                                </a>
                                @endauth
                                @if(Auth::check())
                                    @if(Auth::user()->is_admin)
                                        <a href="{{ url('/admin') }}" class="dropdown-item">Admin Dashboard</a>
                                    @else
                                        
                                    @endif
                                @endif

                                <a class="dropdown-item" href="{{ url("/profileU/" . Auth::user()->id) }}">Profile</a>
                                <a href="{{ url('/profileC') }}" class="dropdown-item">Edit Profile</a>                              
                                <a class="dropdown-item" href="{{ route('chat.index') }}">
                                User
                                </a>
                                 <a class="dropdown-item" href="{{ route('user.blocked') }}">Blocked Users</a>
                                 

                                <a class="dropdown-item" href="{{ route('login') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function updateUnreadCount() {
            fetch('{{ route('unread.count') }}')
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('unread-count');
                    if (data.count > 0) {
                        badge.textContent = data.count > 99 ? '99+' : data.count;
                        badge.classList.remove('d-none');
                    } else {
                        badge.textContent = '0';
                        badge.classList.add('d-none');
                    }
                })
                .catch(error => console.error('Error fetching unread count:', error));
        }
        updateUnreadCount();
    });
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
    </script>
</body>
</html>
