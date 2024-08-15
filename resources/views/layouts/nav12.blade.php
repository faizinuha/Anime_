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
    <div id="preloder">
        <div class="loader"></div>
    </div>

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
                                <li class="active"><a href="{{route('Anim')}}">Homepage</a></li>
                                <li><a href="./categories.html">Categories <span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                      <li><a href="{{route('list')}}">Anime Details</a></li>
                                        <li><a href="./categories.html">Categories</a></li>
                                        <li><a href="./anime-watching.html">Anime Watching</a></li>
                                        <li><a href="./blog-details.html">Blog Details</a></li>
                                        <li><a href="./signup.html">Sign Up</a></li>
                                        <li><a href="./login.html">Login</a></li>
                                    </ul>
                                </li>
                                <li><a href="./blog.html">Our Blog</a></li>
                                <li><a href="#">Contacts</a></li>
                                <li>
                                    <a href="#">Categories <span class="arrow_carrot-down"></span></a>
                                    @php
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
                                    </ul>
                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="header__right">
                        <a href="#" class="search-switch"><span class="icon_search"></span></a>
                        <a href="./login.html"><span class="icon_profile"></span></a>
                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <!-- Header End -->
    @yield('content')


    <!-- Js Plugins -->
    <script src="{{ asset('assetanime/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assetanime/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assetanime/js/player.js') }}"></script>
    <script src="{{ asset('assetanime/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assetanime/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('assetanime/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('assetanime/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assetanime/js/main.js') }}"></script>
