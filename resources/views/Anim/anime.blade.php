@extends('layouts.nav12')
@section('content')
    <section class="anime-details spad">
        <div class="container">
            <div class="anime__details__content">
                <div class="row mb-4">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg" data-setbg="{{ asset('storage/' . $anime->image) }}">
                            <div class="comment"><i class="fa fa-comments" style="color: red;"></i>
                                {{ $anime->comments->count() }}</div>
                            <div class="view"><i class="fa fa-eye"></i> {{ $anime->views_count }}</div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{ $anime->name }}</h3>
                                <span>{{ $anime->alternative_title }}</span>
                            </div>
                            <div class="anime__details__rating">
                                <div class="rating">
                                    @for ($i = 0; $i < $anime->rating; $i++)
                                        <a href="#"><i class="fa fa-star"></i></a>
                                    @endfor
                                    @if (floor($anime->rating) < $anime->rating)
                                        <a href="#"><i class="fa fa-star-half-o"></i></a>
                                    @endif
                                    @for ($i = 0; $i < 5 - ceil($anime->rating); $i++)
                                        <a href="#"><i class="fa fa-star-o"></i></a>
                                    @endfor
                                </div>
                                <span>{{ $anime->votes_count }} Votes</span>
                            </div>
                            <p>{{ $anime->description }}</p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Type:</span> {{ $anime->type }}</li>
                                            <li><span>Studios:</span> {{ $anime->studio }}</li>
                                            <li><span>Date aired:</span>
                                                {{ \Carbon\Carbon::parse($anime->aired_from)->format('M d, Y') }} to
                                                {{ $anime->aired_to ? \Carbon\Carbon::parse($anime->aired_to)->format('M d, Y') : '?' }}
                                            </li>
                                            <li><span>Status:</span> {{ $anime->status }}</li>
                                            <li><span>Genre:</span> {{ $anime->category->name }} </li>
                                            <li><span>Rilis:</span>{{ $anime->release_date }} </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Scores:</span> {{ $anime->scores }} / {{ $anime->scores_count }}
                                            </li>
                                            <li><span>Rating:</span> {{ $anime->rating }} / {{ $anime->ratings_count }}
                                                times</li>
                                            <li><span>Duration:</span> {{ $anime->duration }} min/ep</li>
                                            <li><span>Quality:</span>1040{{ $anime->quality }}</li>
                                            <li><span>Views:</span>240K{{ $anime->views_count }}</li>
                                            <li><span>Episode:</span>{{ $anime->TotalEps }}</li>
                                            {{-- <li><span>Episode:</span>{{ $anime->episodes }}</li> --}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                <form action="{{ route('bookmarks.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="anime_id" value="{{ $anime->id }}">
                                    <!-- Menyertakan anime_id -->
                                    <button type="submit" class="follow-btn"><i class="fa fa-heart-o"></i>
                                        bookmark</button>
                                </form>
                                @if (session('message'))
                                    <div class="bs-toast toast fade show bg-success" role="alert" aria-live="assertive"
                                        aria-atomic="true">
                                        <div class="toast-header">
                                            <i class="bx bx-bell me-2"></i>
                                            <div class="me-auto fw-semibold">Anime</div>
                                            <small></small>
                                            <button type="button" class="btn-close" data-bs-dismiss="toast"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="toast-body">
                                            {{ session('message') }}
                                        </div>
                                    </div>
                                    <style>
                                        .toast {
                                            position: fixed;
                                            top: 20px;
                                            right: 20px;
                                            z-index: 1055;
                                            background-color: #28a745;
                                            color: #fff;
                                            border-radius: 0.25rem;
                                        }

                                        .toast .toast-body {
                                            padding: 0.75rem;
                                        }

                                        .toast .close {
                                            color: #fff;
                                            opacity: 0.8;
                                        }
                                    </style>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var toastElList = [].slice.call(document.querySelectorAll('.toast'));
                                            var toastList = toastElList.map(function(toastEl) {
                                                return new bootstrap.Toast(toastEl, {
                                                    delay: 3000
                                                });
                                            });
                                            toastList.forEach(toast => toast.show());
                                        });
                                    </script>
                                @endif
                                @if ($anime->animeEpisodes->isNotEmpty())
                                    <a href="{{ route('anime.show', ['watch' => $anime->name, 'episode' => $anime->animeEpisodes->first()->id]) }}"
                                        class="watch-btn">
                                        <span>Watch Now</span> <i class="fa fa-angle-right"></i>
                                    </a>
                                @else
                                    <p>No episodes available</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div class="anime__details__episodes">
                            <div class="section-title">
                                <h5>Episodes</h5>
                            </div>
                            <div class="episode-cards">
                                {{-- @for ($i = 1; $i <= $anime->episodes; $i++)
                                    <div class="episode-card">
                                        <a href="#episode-{{ $i }}">Ep: {{ $i }}</a>
                                    </div>
                                    @endfor --}}

                                {{-- @if ($anime->animeEpisodes->isNotEmpty())
                                        @forelse ($anime->animeEpisodes as $index => $episode)
                                        <a href="{{ route('anime.show', ['watch' => $anime->name, 'episode' => $episode->id]) }}">Ep: {{ $episode->episode }}</a>
                                        @empty
                                            <div class="card">
                                                <div class="card-body">
                                                    <p>Episode Tidak ada</p>
                                                </div>
                                            </div>
                                        @endforelse
                                    @endif --}}
                                @forelse ($anime->animeEpisodes as $index => $episode)
                                    <div class="episode-card">
                                        <a
                                            href="{{ route('anime.show', ['watch' => $anime->name, 'episode' => $episode->id]) }}">Ep:
                                            {{ $episode->episode }}</a>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>

                    </div>
                    @php
                        $animeList = App\Models\Anime::all();
                    @endphp
                    <div class="col-lg-4 col-md-4">
                        <div class="anime__details__sidebar">
                            <div class="section-title">
                                <h5>You might like...</h5>
                            </div>
                            @foreach ($animeList as $anime)
                                <div class="product__sidebar__view__item set-bg"
                                    data-setbg="{{ asset('storage/' . $anime->image) }}">
                                    <div class="ep">18 / ?</div>
                                    <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                    <h5><a
                                            href="{{ route('animes.show', ['anime' => $anime->name]) }}">{{ $anime->name }}</a>
                                    </h5>
                                </div>
                            @endforeach
                            <div class="product__sidebar__view__item set-bg"
                                data-setbg="{{ asset('assetanime/img/sidebar/tv-2.jpg') }}">
                                <div class="ep">18 / ?</div>
                                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                <h5><a href="#">The Seven Deadly Sins: Wrath of the Gods</a></h5>
                            </div>
                            <div class="product__sidebar__view__item set-bg"
                                data-setbg="{{ asset('assetanime/img/sidebar/tv-3.jpg') }}">
                                <div class="ep">18 / ?</div>
                                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                <h5><a href="#">Sword Art Online Alicization War of Underworld</a></h5>
                            </div>
                            <div class="product__sidebar__view__item set-bg"
                                data-setbg="{{ asset('assetanime/img/sidebar/tv-4.jpg') }}">
                                <div class="ep">18 / ?</div>
                                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                <h5><a href="#">Fate/Stay Night: Heaven's Feel I. Presage Flower</a></h5>
                            </div>
                        </div>
                    </div>
                    {{-- not  found --}}
                    {{-- <div class="col-12">
                        <div id="disqus_thread"></div>
                        <script>
                            /**
                             *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                             *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
                            /*
                            var disqus_config = function () {
                            this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                            this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                            };
                            */
                            (function() { // DON'T EDIT BELOW THIS LINE
                                var d = document,
                                    s = d.createElement('script');
                                s.src = 'https://laranime.disqus.com/embed.js';
                                s.setAttribute('data-timestamp', +new Date());
                                (d.head || d.body).appendChild(s);
                            })();
                        </script>
                        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments
                                powered by Disqus.</a></noscript>
                    </div> --}}
                </div>
            </div>
    </section>
    {{-- not found --}}
    {{-- <script id="dsq-count-scr" src="//laranime.disqus.com/count.js" async></script> --}}
@endsection
