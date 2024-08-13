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
                <li class="active-tab"><a href="#">HOME</a></li>
                <li><a href="list.html">ANIME LIST</a></li>
                <li><a href="#">GENRE <i class="fas fa-caret-down"></i></a>
                    <div class="dropdown-menu">
                        <ul>
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Adventure</a></li>
                            <li><a href="#">Comedy</a></li>
                            <li><a href="#">Drama</a></li>
                            <li><a href="#">Fantasy</a></li>
                            <li><a href="#">Horror</a></li>
                            <li><a href="#">Music</a></li>
                            <li><a href="#">Parody</a></li>
                            <li><a href="#">Romance</a></li>
                            <li><a href="#">School</a></li>
                            <li><a href="#">Sci-fi</a></li>
                            <li><a href="#">Slice of life</a></li>
                            <li><a href="#">Sports</a></li>
                            <li><a href="#">Thriller</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="jadwal.html">JADWAL RILIS</a></li>
            </ul>
        </nav>
    </header>


     <!-- JS FILE -->
     <script src="{{asset('js/main.js')}} "></script>
     <!-- FONTAWESOME ICONS -->
     <script src="https://kit.fontawesome.com/7009cf2d19.js " crossorigin="anonymous "></script>
</div>