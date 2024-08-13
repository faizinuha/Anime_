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
    @include('layouts.nav12')
    <!-- BANNER-SLIDER -->
    <div id="banner-slider">
        <div class="myslider fade" style="display: block;">
            <div class="txt">
                <h1>Attack on Titan</h1>
                <p>Shingeki no Kyojin<br>Genre: Action, Drama, Fantasy, Mystery</p>
            </div>
            <img src="{{asset('./img/banner-aot.jpg')}}" alt="">
        </div>
        <div class="myslider fade banner-kny">
            <div class="txt">
                <h1>Demon Slayer</h1>
                <p>Kimetsu no Yaiba<br>Genre: Action, Supernatural</p>
            </div>
            <img src="{{asset('./img/banner-kny-3.jpg')}}" alt="">
        </div>
        <div class="myslider fade">
            <div class="txt">
                <h1>One Piece</h1>
                <p>One Piece<br>Genre: Action, Adventure, Comedy, Drama, Fantasy</p>
            </div>
            <img src="{{asset('./img/banner-op-2.jpg')}}" alt="">
        </div>
        <div class="myslider fade banner-bnha">
            <div class="txt">
                <h1>My Hero Academia</h1>
                <p>Boku no Hero Academia<br>Genre: Action, Comedy</p>
            </div>
            <img src="{{asset('./img/banner-bnh.jpg')}}" alt="">
        </div>
        <div class="myslider fade banner-boruto">
            <div class="txt">
                <h1>Boruto: Naruto Next Generation</h1>
                <p>Boruto: Naruto Next Generation<br>Genre: Action, Adventure</p>
            </div>
            <img src="{{asset('./img/banner-boruto.jpg')}}" alt="">
        </div>
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

        <!-- circle dot -->
        <div class="dotsbox">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            <span class="dot" onclick="currentSlide(4)"></span>
            <span class="dot" onclick="currentSlide(5)"></span>
        </div>
    </div>

    <!-- TOP-3 ANIME -->
  @foreach ($animes as $anim)
  <div id="top-anime">
    <div class="top123 container">
        <div class="top-item">
            <img src="{{ asset('storage/' . $anim->image) }}" alt="top 1">
            <div class="top-text">
                <h1>1</h1>
                <div class="top-title">
                    <h3>{{ $anim->name }}</h3>
                    <p> {{ $anim->category->name}} </p>
                </div>
            </div>
        </div>
  @endforeach
            {{-- <div class="top-item">
                <img src="{{asset('./img/top-2.jpg')}}" alt="top 2">
                <div class="top-text">
                    <h1>2</h1>
                    <div class="top-title">
                        <h3>One Piece</h3>
                        <p>Genre: Action, Adventure, Comedy, Drama, Fantasy</p>
                    </div>
                </div>

            </div>
            <div class="top-item">
                <img src="{{asset('./img/top-3.jpg')}}" alt="top 3">
                <div class="top-text">
                    <h1>3</h1>
                    <div class="top-title">
                        <h3>Demon Slayer</h3>
                        <p>Genre: Action, Supernatural</p>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <!-- LATEST RELEASE -->
   @foreach ($animes as $vite)
   <div id="latest-release container">
    <div class="latest">
        <div class="title">
            <h1>Akan<br>Rilis</h1>
        </div>
        <div class="video-slider">
            <a class="prev-videoslide">&#10094;</a>
            <div class="video video1">
                <iframe width="360" height="210" src="{{ asset('storage/' . $vite->video) }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            {{-- <div class="video video2">
                <iframe width="360" height="210" src="https://www.youtube.com/embed/g1ARRcK4LVs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div> --}}
            <a class="next-videoslide">&#10095;</a>
        </div>
    </div>
</div>
   @endforeach

    <!-- ON-GOING -->
    <div id="on-going">
        <h1>ON-GOING</h1>
        <div class="anime-slide container ">
            <a href="#">
                <div class="ongo-item">
                    <img src="{{asset('./img/ongoing/img1.jpg')}}" alt="">
                    <div class="ongo-text">
                        <h3>Komi-san wa, Comyushou desu</h3>
                        <p>Genre: Comedy, School, Slice of Life</p>
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="ongo-item">
                    <img src="{{asset('./img/ongoing/img2.jpg')}}" alt=" ">
                    <div class="ongo-text ">
                        <h3>Demon Slayer</h3>
                        <p>Genre: Action, Supernatural</p>
                    </div>
                </div>
            </a>

            <a href="# ">
                <div class="ongo-item ">
                    <img src="{{asset('./img/ongoing/img3.jpg ')}}" alt="">
                    <div class="ongo-text">
                        <h3>Boruto: Naruto Next Generations</h3>
                        <p>Genre: Action, Adventure</p>
                    </div>
                </div>
            </a>
            <a href="">
                <div class="ongo-item">
                    <img src="{{asset('./img/ongoing/img4.jpg')}}" alt=" ">
                    <div class="ongo-text ">
                        <h3>Saihate no Paladin</h3>
                        <p>Genre: Adventure, Fantasy</p>
                    </div>
                </div>
            </a>
        </div>
        <a class="prev-ongoslide ">&#10094;</a>
        <a class="next-ongoslide ">&#10095;</a>
    </div>

    <!-- COMPLETE -->
    <div class="complete ">
        <h1>COMPLETE</h1>
        <div class="anime-complete container ">
            <div class="complete-item ">
                <a href="# ">
                    <img src="{{asset('')}}./img/complete/img1.jpg " alt=" ">
                    <div class="complete-text ">
                        <h3>Nanatsu no Taizai</h3>
                        <p>Genre: Action, Adventure, Fantasy</p>
                    </div>
                </a>
            </div>
            <div class="complete-item ">
                <a href="# ">
                    <img src="{{asset('')}}./img/complete/img2.jpg " alt=" ">
                    <div class="complete-text ">
                        <h3>Tokyo Revengers</h3>
                        <p>Genre: Action, Drama, Supernatural</p>
                    </div>
                </a>
            </div>
            <div class="complete-item ">
                <a href="# ">
                    <img src="{{asset('')}}./img/complete/img3.jpg " alt=" ">
                    <div class="complete-text ">
                        <h3>Black Clover</h3>
                        <p>Genre: Action, Comedy, Fantasy</p>
                    </div>
                </a>
            </div>
            <div class="complete-item ">
                <a href="# ">
                    <img src="{{asset('')}}./img/complete/img4.jpg " alt=" ">
                    <div class="complete-text ">
                        <h3>My Hero Academia</h3>
                        <p>Genre: Action, Comedy</p>
                    </div>
                </a>
            </div>
            <div class="complete-item ">
                <a href="# ">
                    <img src="{{asset('')}}./img/complete/img5.jpg " alt=" ">
                    <div class="complete-text ">
                        <h3>Tensei shitara Slime Datta Ken</h3>
                        <p>Genre: Action, Adventure, Comedy, Fantasy</p>
                    </div>
                </a>
            </div>
            <div class="complete-item ">
                <a href="# ">
                    <img src="{{asset('')}}./img/complete/img6.jpg " alt=" ">
                    <div class="complete-text ">
                        <h3>Tonikaku Kawaii</h3>
                        <p>Genre: Comedy, Romance</p>
                    </div>
                </a>
            </div>
            <div class="complete-item ">
                <a href="# ">
                    <img src="{{asset('')}}./img/complete/img7.jpg " alt=" ">
                    <div class="complete-text ">
                        <h3>Kaizoku Oujo</h3>
                        <p>Genre: Action, Adventure</p>
                    </div>
                </a>
            </div>
            <div class="complete-item ">
                <a href="# ">
                    <img src="{{asset('')}}./img/complete/img8.jpg " alt=" ">
                    <div class="complete-text ">
                        <h3>Fruit Basket</h3>
                        <p>Genre: Comedy, Drama, Romance, Slice of Life</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="top-footer ">
            <div class="column-item logo ">
                <div class="logo ">
                    <div class="logo-bawah "></div>

                    <div class="icons ">
                        <a href="# "><i class="fa fa-facebook fa-lg " aria-hidden="true "></i></a>
                        <a href="# "><i class="fa fa-instagram fa-lg " aria-hidden="true "></i></a>
                        <a href="# "><i class="fa fa-twitter fa-lg " aria-hidden="true "></i></a>
                        <a href="# "><i class="fa fa-youtube fa-lg " aria-hidden="true "></i></a>
                    </div>
                </div>
            </div>
            <div class="column-item link ">
                <h3>Support</h3>
                <p><a href="# ">Contact Us</a> </p>
                <p><a href="# ">FAQ</a> </p>
                <p><a href="# ">Feedback</a></p>
                <p><a href="# ">Advertise</a></p>
            </div>
            <div class="column-item link ">
                <h3>videf</h3>
                <p><a href="# ">About Us</a> </p>
                <p><a href="# ">Product and Services</a> </p>
                <p><a href="# ">Privacy Policy</a></p>
                <p><a href="# ">Terms of Service</a></p>

            </div>
            <div class="column-item email ">
                <div class="email-title ">
                    <i class="fas fa-envelope "></i>
                    <p>Stay up to date on the latest from videf.</p>
                </div>
                <div class="sign-up ">
                    <input type="email " name=" " id=" " placeholder="Enter your e-mail address ">
                    <button>SIGN UP</button>
                </div>
            </div>
        </div>
        <div class="copyright ">
            <p>Copyright <i class="fa fa-copyright " aria-hidden="true "></i> 2021</p>
        </div>
    </footer>

    <!-- JS FILE -->
    <script src="{{asset('js/index.js')}}"></script>
    <!-- FONTAWESOME ICONS -->
    <script src="https://kit.fontawesome.com/7009cf2d19.js " crossorigin="anonymous "></script>
</body>

</html>