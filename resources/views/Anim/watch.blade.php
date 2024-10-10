@extends('layouts.nav12')
@section('content')
    <section class="anime-details spad">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="anime__video__player">
                        <video id="player" playsinline controls data-poster="{{ asset('storage/' . $anime->image) }}">
                            <source src="{{ asset('storage/' . $episode->video) }}" type="video/mp4" />
                            <track kind="captions" label="English capt  ions" src="#" srclang="en" default />
                            <track kind="captions" label="Jepang" src="#" srclang="jp" default />
                        </video>
                        <button id="pipButton" class="btn btn-primary" aria-keyshortcuts="i">
                            <img src="{{ asset('assetanime/img/image.png') }}" sizes="10" alt="Miniplayer(i)">
                        </button>
                    </div>
                    {{-- <div class="anime__details__episodes">
                        <div class="section-title">
                            <h5>Eps</h5>
                        </div>
                    </div> --}}
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="anime__details__review">
                        <div class="section-title">
                            <h5>Reviews</h5>
                        </div>
                        <div class="anime__review__item">
                            @forelse ($comments as $item)
                                <div data-id-comment="{{ $item->id }}" class="position-relative">
                                    <div class="ml-3">
                                        <div class="anime__review__item__pic">
                                            <img src="{{ asset('assetanime/img/anime/review-1.jpg') }}" alt="">
                                        </div>
                                        <div class="anime__review__item__text">
                                            {{-- <h2>{{ $item->user->name }} <span>1 Menit Yang? Lalu..</span></h2> --}}
                                            @isset($item->parent_id)
                                                <button class="btn text-info btn p-0"
                                                    onclick="showReply({{ $item->parent_id }})"><small><i
                                                            class="fa fa-reply-all"></i>
                                                        Reply From
                                                        {{ $item->parent->user->name }}</small></button>
                                            @endisset
                                            <p>Pesan:{{ $item->content }}</p>
                                            <small style="color: white;">Posted by {{ $item->user->name }} on
                                                {{ $item->created_at->diffForHumans() }}</small>
                                            @auth
                                                <div class="d-flex justify-content-between gap-2">
                                                    <button class="text-light btn p-1 py-0"
                                                        onclick="replyFrom(this.parentElement.parentElement, '{{ route('reply.store') }}', '{{ $item->id }}', '{{ $anime->id }}')">
                                                        <small><i class="fa fa-reply "></i> Balas</small>
                                                    </button>

                                                    @if ($item->user_id == auth()->user()->id)
                                                        <form action="{{ route('comment.destroy', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" name="delete"
                                                                class="btn btn-secondary d-flex justify-content-start align-items-start p-1"
                                                                id="delete">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            @endauth
                                        </div>
                                    </div>


                                </div>
                            @empty
                                <div class="text-light">
                                    <span>Not Found Comment</span>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="anime__details__form">
                        <div class="section-title">
                            <h5>Your Comment</h5>
                        </div>
                        @if (Auth::check())
                            <form action="{{ route('comment.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="anime_id" value="{{ $anime->id }}">
                                <textarea name="content" placeholder="Your Comment" required></textarea>
                                <button type="submit">Review</button>
                            </form>
                        @else
                            <span>Please login to comment. <a href="{{ route('login2') }}">Login</a></span>
                        @endif
                        <button class="btn btn-danger mt-3 d-flex" onclick="back()">Back</button>
                    </div>
                </div>
            </div>
    </section>

    <script>
        const idComment = document.querySelectorAll('[data-id-comment]');

        const templateReply = `
                                    <div class="position-absolute top-0 left-0 bottom-0 right-0 bg-danger h-100"
                                        style="width: 5px;">
                                    </div>`

        const templateFormReply = (url, id, anime_id) => ` <div class="anime__details__form my-3" id="balasKomentar">
                                        <form action="${url}" method="POST">
                                            @csrf
                                            <input type="hidden" name="anime_id" value="${anime_id}">
                                            <input type="hidden" name="parent_id" value="${id}">
                                            <textarea name="content" placeholder="Your Reply" required></textarea>
                                            <button type="submit">Send</button>
                                        </form>
                                    </div>
                                </div>`

        function showReply(id) {
            idComment.forEach(function(item) {
                if (item.dataset.idComment == id) {
                    item.insertAdjacentHTML('afterBegin', templateReply);
                }
            });
        }

        function replyFrom(item, url, id, anime_id) {
            const balasKomentar = document.getElementById('balasKomentar');
            if (balasKomentar) {
                balasKomentar.remove();
            }
            item.insertAdjacentHTML('afterEnd', templateFormReply(url, id, anime_id));
        }
    </script>
@endsection
