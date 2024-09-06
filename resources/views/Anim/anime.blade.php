@extends('layouts.nav12')
@section('content')
    <section class="anime-details spad">
        <div class="container">
            <div class="anime__details__content">
                <div class="row mb-4">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg" data-setbg="{{ asset('storage/' . $anime->image) }}">
                            <div class="comment"><i class="fa fa-comments"></i> {{ $anime->comments_count }}</div>
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
                                            <li><span>Episode:</span>{{ $anime->episodes }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                <a href="#" class="follow-btn"><i class="fa fa-heart-o"></i> Follow</a>
                                <a href="{{ route('anime.show', ['watch' => $anime->name, 'episode' => $anime->animeEpisodes->first()->id]) }}" class="watch-btn">
                                    <span>Watch Now</span> <i class="fa fa-angle-right"></i>
                                </a>
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

                                @forelse ($anime->animeEpisodes as $index => $episode)
                                    <a href="{{ route('anime.show', ['watch' => $anime->name, 'episode' => $episode->id]) }}">Ep: {{ $episode->episode }}</a>
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
                </div>
            </div>
    </section>
@endsection
