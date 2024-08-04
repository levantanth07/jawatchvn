@extends('frontend.app.index')
@section('title', $product->name)
@section('content')
    <div class="container">
        <div class="row mt-5">
        <!-- Left column -->
            <div class="col-md-6 left-side">
                <div id="wrap">
                    <ul id="slider">
                        @foreach($product->productDetail as $detail)
                            <div class="box-img">
                                <div class="zoom">
                                    <li class="slide-item"><img class="image-parent" width="100%" src="{{ asset('').'public/public/'.$detail->image }}" alt="img" /></li>
                                </div>
                            </div>
                        @endforeach

                    </ul>
                    <ul id="thumbnail_slider">
                        @foreach($product->productDetail as $detail)
                            <div class="box-img">
                                <div class="zoom">
                                    <li class="thumbnail-item"><img class="image-child" data-id="{{ $detail->id }}" style="width: 100%" src="{{ asset('').'public/public/'.$detail->image }}" data-img="{{ asset('').'public/public/'.$detail->image }}" alt="img" /></li>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        <!-- Right column -->
        <div class="col-md-6 right-side">
            <div>
                <h2 style="font-size: 35px; color: #252525">
                    {{ $product->name }}
                </h2>
                <p class="mt-4" style="font-size: 18px; color: #252525">
                    ${{ $product->sale_price > 0 ? number_format($product->sale_price) : number_format($product->price) }} US
                </p>
                @if($product->is_stock == 1)
                    <div class="btn-add-cart" data-id="{{ $product->id }}">Add to cart</div>
                @else
                    <div style="
                        background-color:red; 
                        border:1px solid red; 
                        font-size:18px; 
                        padding: 12px 0px; 
                        border-radius: 8px; 
                        font-weight: 500; 
                        text-align: center; 
                        margin: 12px 0; 
                        color :#ffffff"
                    >SOLD OUT</div>
                @endif
                
                
                <div class="btn-buy">Buy with PayPal</div>
                <div class="infor-checking">
                    <p>Shipping is usually available within 24 hours of payment</p>
                </div>
                <div class="box-des">
                    {!! $product->content !!}
                </div>
            </div>
        </div>
        <div style="padding: 36px 0">
            <h2 style="font-size: 28px; color: #252525">You may also like</h2>
            <div class="row mt-4">
                @foreach($productSameCategory as $item)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6">
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
        </div>
        </div>
    </div>
    <div class="modal fade" id="myModalCheckOut">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add to cart Success!</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p class="mb-3"><a style="text-decoration: none; color: #0f0f0f" href="{{ route('frontend.home') }}">Continue shopping!</a></p>
                    <p><a style="text-decoration: none; color: #0f0f0f" href="{{ route('frontend.listCart') }}">Checkout</a></p>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('style')
     <style>
        .slider {
            width: 100%;
        }
        .slider-nav .slick-slide {
            cursor: pointer;
        }
        /*.slick-next {
            right: 10px;
            display: none !important;
        }*/
        .slick-next:before {
            color: rgb(44, 51, 47);
        }
        .slick-slide {
            margin: 12px 8px;
        }

        .slick-prev {
            left: -25px;
        }

        .slick-prev:before {
            color: rgb(44, 51, 47);
        }

        #wrap{
           /* background-color: #ddd;*/
            padding: 50px 0;
        }
        #slider,#thumbnail_slider{
            width: 90%;
            margin: 0 auto 10px;
        }
        .slide-item img{
            width: 100%;
        }
        .thumbnail-item img{
            width: 98%;
            margin: 0 auto;
        }
    </style>
@endsection
@section('script')
    <script>
        $(function(){
            $("#slider").slick({
                autoplay: true,
                speed: 1000,
                arrows: true,
                asNavFor: "#thumbnail_slider"
            });
            $("#thumbnail_slider").slick({
                slidesToShow: 3,
                speed: 1000,
                arrows: false,
                asNavFor: "#slider"
            });
        });
        
        $(document).ready(function () {
            $('.btn-add-cart').on('click', function () {
                let product_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "/add-to-cart/"+product_id,
                    success: function (response) {
                        $('#cart').html(response.data.count)
                        new bootstrap.Modal(document.getElementById("myModalCheckOut"), {}).show();
                    }
                });
            });
            $('.image-child').on('click', function () {
                let url = $(this).data('img');
                $(this).parents('.left-side').find('.image-parent').attr('src',url);
            })
            
            $('.btn-buy').click(function(){
                alert("Info Paypal: Linhaichii@gmail.com( Price + fee PayPal 4,6% if transfer Goods and Services )")
            })
        })
    </script>
@endsection
