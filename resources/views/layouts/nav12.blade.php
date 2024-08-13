<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<!-- WEB TITLE ICON -->
<link rel="shortcut icon" href="{{ asset('./img/iconatas.svg') }}" type="image/x-icon">
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
            <li class="active-tab"><a href="{{ route('Anim') }}">Home</a></li>
            <li><a href="{{ route('list') }}">Anime List</a></li>
            <li><a href="#">Genre <i class="fas fa-caret-down"></i></a>
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
            @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-user-circle fa-lg"></i> Profile <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Settings</a></li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <!-- Form Logout menggunakan metode POST -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            @endauth
            @guest
                <li><a href="{{ route('login') }}">Login</a></li>
            @endguest
            <li><a href="jadwal.html">Anime</a></li>
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                role="button">-Logout</a>

            <!-- Form Logout menggunakan metode POST -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>
    </nav>
</header>
<script src="{{ asset('js/index.js') }}"></script>
<!-- FONTAWESOME ICONS -->
<script src="https://kit.fontawesome.com/7009cf2d19.js " crossorigin="anonymous "></script>
