<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AnimeHub</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('assetanime/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assetanime/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assetanime/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assetanime/css/plyr.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assetanime/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assetanime/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assetanime/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assetanime/css/style.css') }}" type="text/css">
</head>
<meta name="theme-color" content="#6777ef" />
<link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
<link rel="manifest" href="{{ asset('/manifest.json') }}">

<script src="{{ asset('/sw.js') }}"></script>
<script>
   if ("serviceWorker" in navigator) {
      // Register a service worker hosted at the root of the
      // site using the default scope.
      navigator.serviceWorker.register("/sw.js").then(
      (registration) => {
         console.log("Service worker registration succeeded:", registration);
      },
      (error) => {
         console.error(`Service worker registration failed: ${error}`);
      },
    );
  } else {
     console.error("Service workers are not supported.");
  }
</script>
<body>
    <!-- Page Preloder -->
    {{-- <div id="preloder">
        <div class="loader"></div>
    </div> --}}

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="{{route('Anim')}}">
                            <img src="{{ asset('assetanime/img/logo.png') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                {{-- <li class="active"><a href="{{ route('Anim') }}">Homepage</a></li> --}}
                                <li class="active">
                                    @if (auth()->check())
                                        @if (auth()->user()->role == 'is_admin')
                                            <a href="{{ route('home') }}">Homepage</a>
                                        @else
                                            <a href="{{ route('Anim') }}">Homepage</a>
                                        @endif
                                    @else
                                        <a href="{{ route('Anim') }}">Homepage</a>
                                        <!-- Route untuk pengguna yang belum login -->
                                    @endif
                                </li>

                                <li><a href="./categories.html">All <span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        <li><a href="{{ route('list') }}">Anime Details</a></li>
                                        {{-- <li><a href="{{route('login2')}}">Login</a></li> --}}
                                    </ul>
                                </li>
                                <li><a href="{{route('roms.index')}}" id="nobar">Nobar</a></li>
                                <li><a href="#">Customer</a></li>
                                <li>
                                    <a href="#" class="search-switch"><span class="icon_search"></span></a>

                                </li>
                                {{-- <li> --}}
                                {{-- <a href="#">Categories <span class="arrow_carrot-down"></span></a> --}}
                                {{-- @php
                                        $categories = App\Models\Category::all();
                                    @endphp

                                    <ul class="dropdown">
                                        @foreach ($categories as $category)
                                            <li >
                                                <a href="{{ route('Anim', ['category' => $category->id]) }}" class="card" >
                                                    {{ $category->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul> --}}
                                {{-- </li> --}}

                            </ul>
                        </nav>
                    </div>
                </div>
                <nav class="header__menu mobile-menu">
                    <div class="col-lg-12">
                        <div class="header__right">
                            <div class="auth-links">
                                @auth
                                    <div class="user-name">
                                        {{-- <a href="#">{{ auth()->user()->name }}</a> --}}
                                        <button onclick="myFunction()" class="dropbtn"> {{ auth()->user()->name }}
                                        </button>
                                        <ul id="myDropdown" class="dropdown-menu">
                                            <li>
                                                <a href="#"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    Logout
                                                </a>
                                                <a href="{{route('account')}}">Profile</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                @else
                                    <a href="{{ route('login') }}">Login</a>
                                    <a href="{{ route('register') }}">Register</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <!-- Search model Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="icon_close"></i></div>
            <form class="search-model-form" action="{{ route('search') }}">
                <input type="text" id="search-input" name="query" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Header End -->
    @yield('content')

    <style>
        /* .user-name .dropdown li {
            margin: 0;
        } */

        /* CSS untuk Dropdown User Name */
        .user-name a {
            color: white;
            font-weight: 600;
            padding: 5px 10px;
            display: inline-block;
            text-decoration: none;
        }

        .user-name:hover .dropdown {
            display: block;
        }

        .user-name .dropdown {
            background: #333;
            position: absolute;
            display: none;
            list-style-type: none;
            padding: 10px;
            border-radius: 5px;
        }

        .user-name .dropdown a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 5px 0;
        }

        .user-name .dropdown a:hover {
            background-color: #444;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userDropdown = document.querySelector('.user-name li a');

            userDropdown.addEventListener('click', function(e) {
                const dropdown = this.nextElementSibling;
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                e.stopPropagation();
            });

            document.addEventListener('click', function() {
                document.querySelectorAll('.user-name .dropdown').forEach(function(dropdown) {
                    dropdown.style.display = 'none';
                });
            });
        });

        // minta notit
        document.addEventListener('DOMContentLoaded', function() {
            if (Notification.permission === 'granted') {
                new Notification('Selamat Datang!', {
                    body: '{{ session('notification') }}',
                    icon: 'path/to/icon.png' // Ganti dengan path ikon Anda
                });
            }
        })
        Notification.requestPermission().then(function(permission) {
            if (permission === 'granted') {
                console.log('Izin notifikasi diberikan.');
            } else {
                console.log('Izin notifikasi ditolak.');
            }
        });


        

        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
    <!-- Js Plugins -->
    <script src="{{ asset('assetanime/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assetanime/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assetanime/js/player.js') }}"></script>
    <script src="{{ asset('assetanime/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assetanime/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('assetanime/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('assetanime/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assetanime/js/main.js') }}"></script>
