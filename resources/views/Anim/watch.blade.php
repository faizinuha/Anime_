@extends('layouts.nav12')
@section('content')
<section class="anime-details spad">
  <div class="container">
      <div class="row">
          <div class="col-lg-12">
              <div class="anime__video__player">
                  <video id="player" playsinline controls data-poster="{{asset('assetanime/./videos/anime-watch.jpg')}}">
                      <source src="{{asset('storage/'.$episode->video)}}" type="video/mp4" />
                      <!-- Captions are optional -->
                      <track kind="captions" label="English captions" src="#" srclang="en" default />
                  </video>
              </div>
              <div class="anime__details__episodes">
                  <div class="section-title">
                      <h5>List Name</h5>
                  </div>
                 
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-lg-8">
              <div class="anime__details__review">
                  <div class="section-title">
                      <h5>Reviews</h5>
                  </div>
                  @forelse ($comments as $item)
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
                  @if (Auth::check())
                  <form action="{{ route('comment.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="anime_id" value="{{ $anime->id }}">
                    <textarea name="content" placeholder="Your Comment"></textarea>
                    <button type="submit">Review</button>
                </form>                
            
              @else
                  <span>Please login to comment. <a href="{{ route('login2') }}">Login</a></span>
              @endif
              <button class="btn btn-red" onclick="back()">Back</button>
              </div>
          </div>
      </div>
      <script>
        function back() {
        window.history.back();
    }
      </script>
  </div>
</section>
@endsection