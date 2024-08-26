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
                                            {{-- <li><span>Hari:</span>{{ $anime->tayangHari->nama }}</li> --}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                <a href="#" class="follow-btn"><i class="fa fa-heart-o"></i> Follow</a>
                                <a href="{{ route('anime.watch', ['watch' => $anime->name]) }}" class="watch-btn">
                                    <span>Watch Now</span> <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div class="anime__details__review">
                            <div class="section-title">
                                <h5>Reviews</h5>
                            </div>
                            @forelse ($anime->comments as $item)
                            <div class="anime__review__item">
                                <div class="anime__review__item__pic">
                                    <img src="{{ asset('assetanime/img/anime/review-1.jpg') }}" alt="">
                                </div>
                                <div class="anime__review__item__text">
                                    {{-- <h2>{{ $item->user->name }} <span>1 Menit Yang? Lalu..</span></h2> --}}
                                    <h6>{{$item->user->name}} - <span>1 Hour ago</span></h6>
                                    <p>Pesan:{{ $item->content }}</p>
                                    <form action="{{ route('comment.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" name="delete" class="btn btn-secondary d-flex justify-content-start align-items-start p-1" id="delete">
                                            <i class="fa fa-trash"></i> 
                                        </button>
                                    </form>                                                                      
                                </div>
                            @empty
                                <span>Not Found Comment</span>
                            @endforelse
                            </div>
                        </div>
                        </div>
                        <div class="anime__details__form">
                            <div class="section-title">
                                <h5>Your Comment</h5>
                            </div>
                            <div class="">
                                <div class="">
                                    <h5></h5>
                                </div>

                                @if (Auth::check())
                                    <form action="{{ route('comment.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="anime_id" value="{{ $anime->id }}">
                                        <textarea name="content" placeholder="Your Comment"></textarea>
                                        <button type="submit" name="comment" id="comment"><i class="fa fa-location-arrow"></i> Review</button>
                                    </form>
                                @else
                                    <span>Please login to comment. <a href="{{ route('login2') }}">Login</a></span>
                                @endif
                            </div>

                        </div>
                    </div>
                    @php
                        $anime = App\Models\Anime::all();
                        // $categories = App\Models\Category::all();
                    @endphp
                    <div class="col-lg-4 col-md-4">
                        <div class="anime__details__sidebar">
                            <div class="section-title">
                                <h5>you might anime...</h5>
                            </div>
                            @foreach ($anime as $anime)
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
                                <h5><a href="#">Sword art online alicization war of underworld</a></h5>
                            </div>
                            <div class="product__sidebar__view__item set-bg"
                                data-setbg="{{ asset('assetanime/img/sidebar/tv-4.jpg') }}">
                                <div class="ep">18 / ?</div>
                                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                <h5><a href="#">Fate/stay night: Heaven's Feel I. presage flower</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
