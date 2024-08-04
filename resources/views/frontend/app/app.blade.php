@extends('frontend.app.index')
@section('title', 'Home')
@section('content')
    <div class="text-center section">
        <div class="title_field_1">
            <h1 class="h1" style="color: #252525">
                {{ $configIndex->field_1 }}
            </h1>
            <p class="mt-4 fs-6" style="color: #252525bf">
                {{ $configIndex->field_2 }}
            </p>
        </div>
        <div class="row">
            @foreach($campaignBody as $value)
                <div class="col-12 col-lg-4 py-2">
                    <h3 class="campaign" style="background: #f2f4f1; padding: 5px"><a style="text-decoration: none; text-transform: uppercase; font-size: 23px; color:#252525" href="{{ route('frontend.campaign', $value->slug) }}">{{ $value->name }}</a></h3>
                </div>
            @endforeach
        </div>
    </div>
    <div class="section">
        <div class="d-flex row mt-2 slider-promotion">
            @foreach($promotions as $promotion)
                <div class="col-md-4">
                    <div class="p-4">
                        @if($promotion->image)
                            <a href="{{ $promotion->title }}" target="_blank">
                                <img class="img-fluid" src="{{ asset('').'public/public/'.$promotion->image }}" alt="icon-product"/>
                            </a>
                        @else
                            <a href="" target="_blank">
                                <img class="img-fluid" src="https://placehold.co/600x400" alt="icon-product"/>
                            </a>
                        @endif

                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="section">
        <h2 class="h1">{{ $configIndex->field_3 }}</h2>
        <div class="row g-4 mt-4">
            @foreach($products as $item)
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="card">
                        <div class="card-box">
                            <a href="{{ route('frontend.detailProduct', $item->slug) }}">
                                <img style="width: 100%" src="{{ asset('').'public/public/'.$item->image }}" alt="image" />
                            </a>
                        </div>
                        @if($item->is_stock == 1)
                            <div style="color:#ffffff; background-color:#204D6C; text-align:center; font-weight:800; padding:5px">STOCK</div>
                        @else
                            <div style="color:#ffffff; background-color:red; text-align:center; font-weight:800; padding:5px">SOLD</div>
                        @endif
                        <div class="card-body d-flex gap-2 align-items-center py-4">
                            <div class="d-flex flex-column flex-wrap">
                                <a href="{{ route('frontend.detailProduct', $item->slug) }}" title="{{ $item->name }}">{{ \Illuminate\Support\Str::limit($item->name, 30) }}</a>
                                <h3 class="py-3 mb-2">${{ $item->sale_price > 0 ? number_format($item->sale_price) : number_format($item->price) }} US</h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if($products->count() >= 20)
            <div class="text-center mt-4">
                <div
                    class="btn btn-primary px-4 py-2"
                    style="background: #252525; border: none"
                >
                    <a href="{{ route('frontend.productAll') }}" style="text-decoration: none; color: #FFFFFF">View all</a>
                </div>
            </div>
        @endif
    </div>
    <div class="section px-4">
        <div class="d-flex flex-column align-items-center gap-3">
            <h2 style="font-size: 32px; color: #252525">
                Feedback from customers
            </h2>
            <div class="d-flex gap-1">
                <i
                    style="color: #5e660b; font-size: 18px"
                    class="bi bi-star-fill"
                ></i>
                <i
                    style="color: #5e660b; font-size: 18px"
                    class="bi bi-star-fill"
                ></i>
                <i
                    style="color: #5e660b; font-size: 18px"
                    class="bi bi-star-fill"
                ></i>
                <i
                    style="color: #5e660b; font-size: 18px"
                    class="bi bi-star-fill"
                ></i>
                <i
                    style="color: #5e660b; font-size: 18px"
                    class="bi bi-star-fill"
                ></i>
            </div>
            <p style="font-size: 18px; color: #252525bf">from 143 reviews</p>
            <p style="font-size: 16px; color: #5e660b">
                Verified by
                <span
                    style="
                  padding: 2px 5px;
                  font-size: 20px;
                  background: #5e660b;
                  color: #fff;
                "
                >
                J
              </span>
                <span
                    style="
                  text-decoration: none;
                  font-weight: 600;
                  font-size: 16px;
                  color: #5e660b;
                "
                >
                Judge.me
              </span>
            </p>
        </div>
        <!-- carousel reviews -->
        <div class="d-flex row mt-5 slider-reviews">
            @foreach($feedbacks as $feedback)
                <div class="col-lg-4">
                    <div class="card-feedback">
                      <div class="card-feedback-header">
                        <div class="d-flex gap-1">
                          <i style="color: #5e660b; font-size: 18px" class="bi bi-star-fill"></i>
                          <i style="color: #5e660b; font-size: 18px" class="bi bi-star-fill"></i>
                          <i style="color: #5e660b; font-size: 18px" class="bi bi-star-fill"></i>
                          <i style="color: #5e660b; font-size: 18px" class="bi bi-star-fill"></i>
                          <i style="color: #5e660b; font-size: 18px" class="bi bi-star-fill"></i>
                        </div>
                        <p title="{{ $feedback->content }}" class='flex-wrap' style="font-size: 16px; color: #252525bf">
                          {{ \Illuminate\Support\Str::limit($feedback->content, 40) }}
                        </p>
                      </div>
                      <div class="card-feedback-body">
                        <p class='flex-wrap' style="
                              font-size: 16px;
                              color: #252525bf;
                              text-align: center;
                            ">
                          {{ $feedback->title }}
                        </p>
                        <div>
                             @if($feedback->image)
                                <img width="100%"
                                    src="{{ asset('').'public/public/'.$feedback->image }}"
                                    alt="icon-product"
                                />
                            @else
                                <img class="img-responsive"
                                    src="https://placehold.co/600x400"
                                    alt="icon-product"
                                />
                            @endif
                        </div>
                      </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- carousel reviews -->
    </div>
@endsection
@section('style')
    <style>
        .title_field_1 {
            padding: 24px 0 68px 0;
        }
        @media screen and (max-width: 768px){
            h3.campaign {
                background: #C5C7CB;
                padding: 5px;
                text-align: left;
            }
            
            .section {
                padding: 0 !important;
            }
            
            .title_field_1 {
                padding: 10px 0;
            }
            
        }
    </style>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>
        $('.slider-reviews').slick({
            dots: false,
            infinite: true,
            speed: 500,
            slidesToShow: 3,
            slidesToScroll: 1,
            initialSlide: 0,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        initialSlide: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
        $('.slider-promotion').slick({
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 3,
            slidesToScroll: 1,
            initialSlide: 0,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        initialSlide: 2,
                        dots: true
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true
                    }
                }
            ]
        });
    </script>
@endsection
