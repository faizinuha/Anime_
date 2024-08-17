<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anime</title>

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
                        <a href="./index.html">
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
                                        <li><a href="{{ route('genre') }}">Categories</a></li>
                                        <li><a href="./anime-watching.html">Anime Watching</a></li>
                                        <li><a href="./blog-details.html">Blog Details</a></li>
                                        <li><a href="./signup.html">Sign Up</a></li>
                                        {{-- <li><a href="{{route('login2')}}">Login</a></li> --}}
                                    </ul>
                                </li>
                                <li><a href="./blog.html">Our Blog</a></li>
                                <li><a href="#">Contacts</a></li>


                                <li>
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
                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>
                <nav class="header__menu mobile-menu">
                    <div class="col-lg-2">
                        <div class="header__right">
                            <a href="#" class="search-switch"><span class="icon_search"></span></a>
                            <a href="{{ route('login2') }}"><span class="icon_profile"></span></a>
                            @auth()
                                <div class="user-name">
                                    <li style="list-style: none; margin:0%; position:relative;">
                                        <a href="javascript:void(0);">{{ auth()->user()->name }}</a>
                                        <ul class="dropdown"
                                            style="display:none; position:absolute; top:100%; left:0; background:#333; padding:10px 0; min-width:150px;">
                                            <li><a href="#">Profile</a></li>
                                            <li><a href="{{ route('logout') }}">Logout</a></li>
                                        </ul>
                                    </li>
                                </div>
                            @endauth
                        </div>
                    </div>
            </div>

            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <!-- Header End -->
    @yield('content')

    <style>
        .user-name .dropdown {
            display: none;
            position: absolute;
            background-color: #333;
            top: 100%;
            left: 0;
            padding: 10px 0;
            min-width: 150px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .user-name .dropdown li {
            margin: 0;
        }

        .user-name .dropdown li a {
            color: #fff;
            padding: 10px 20px;
            display: block;
        }

        .user-name .dropdown li a:hover {
            background-color: #444;
        }

        /* Show dropdown on hover */
        .user-name:hover .dropdown {
            display: block;
        }

        .header__right {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .header__right .user-name p {
            color: blue margin-left: 10px;
            /* Jarak antara ikon profil dan nama user */
            margin-bottom: 0;
            /* Menghilangkan margin bawah pada paragraf */
            font-weight: 600;
            /* Memberikan penekanan pada nama user */
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
