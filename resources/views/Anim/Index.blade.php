@extends('layouts.nav12')
@section('navbar')
<style>
    /* Global Styles */
    body {
        font-family: 'Mulish', sans-serif;
        background-color: #f8f9fa;
        color: #343a40;
    }

    /* Section Title */
    .section-title h4 {
        font-size: 24px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 15px;
    }

    /* Button Styles */
    .btn__all a {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn__all a:hover {
        background-color: #0056b3;
    }

    /* Product Item Styles */
    .product__item {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        margin-bottom: 30px;
        overflow: hidden;
    }

    .product__item:hover {
        transform: translateY(-5px);
    }

    .product__item__pic img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        transition: transform 0.3s ease;
    }

    .product__item:hover .product__item__pic img {
        transform: scale(1.05);
    }

    .product__item__details {
        padding: 15px;
        text-align: center;
    }

    .product__item__details ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .product__item__details ul li {
        margin-bottom: 5px;
        color: #495057;
        font-size: 16px;
    }

    .product__item__details ul li:first-child {
        font-weight: bold;
        color: #007bff;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .section-title h4 {
            font-size: 20px;
        }

        .btn__all a {
            padding: 8px 16px;
            font-size: 14px;
        }

        .product__item__details ul li {
            font-size: 14px;
        }
    }
</style>

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
                                <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @forelse ($animes as $item)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic">
                                    @if ($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="img-fluid">
                                    @endif
                                </div>
                                <div class="product__item__details">
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
