@extends('layouts.nav12')
@section('navbar')
<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="trending__product">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Trending Now</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="btn__all">
                                <a href="#" class="primary-btn">View All <span
                                        class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        @forelse ($animes as $item)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg">
                                    @if ($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="img-fluid" style="width: 100%; height: 250px; object-fit: cover;">
                                    @endif
                                </div>
                                <div class="product__item__text">
                                    <ul>
                                        <li>{{ $item->name }}</li>
                                        <li>{{ \Carbon\Carbon::parse($item->release_date)->format('d-m-Y') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p>No anime available.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

@endsection
