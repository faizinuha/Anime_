<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- CSS-FILE -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- WEB TITLE ICON -->
    <link rel="shortcut icon" href="{{asset('./img/iconatas.svg')}}" type="image/x-icon">

</head>

<body>
<div class="full-width-header">
    <header class="container">
        <div class="web-logo">
            <!-- <h1>vi<span>def</span></h1> -->
            <div class="logo-svg">
            </div>
            <div class="search-bar">
                <input type="text" name="search" id="search" placeholder="Search...">
                <i class="fas fa-search fa-1x"></i>
                <i class="far fa-user-circle fa-lg"></i>
            </div>
        </div>
        <nav>
            <ul>
                <li class="active-tab"><a href="{{route('Anim')}}">HOME</a></li>
                <li><a href="{{route('list')}}">ANIME LIST</a></li>
                <li><a href="#">GENRE <i class="fas fa-caret-down"></i></a>
                    <div class="dropdown-menu">
                        @php
                        $categories = App\Models\Category::all();
                    @endphp
                    @forelse ($categories as $category)
                        <ul>
                            <li><a href="{{ route('Anim') }}">{{ $category->name }}</a></li>
                        </ul>
                    @empty
                        <p>Category Maising</p>
                    @endforelse
                    </div>
                </li>
                <li><a href="jadwal.html">JADWAL RILIS</a></li>
            </ul>
        </nav>
    </header>
    @yield('content')
     <!-- JS FILE -->
     <script src="{{asset('js/main.js')}} "></script>
     <!-- FONTAWESOME ICONS -->
     <script src="https://kit.fontawesome.com/7009cf2d19.js " crossorigin="anonymous "></script>
</div>