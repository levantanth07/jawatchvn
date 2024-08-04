<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') - JawatchVn</title>
    <meta name="description" content="@yield('description')">
    <meta name="author" content="">
    <meta name="keywords" content="@yield('keywords')">
    <meta property="og:site_name" content="https://jawatchvn.com" />
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:locale" content="{{app()->getLocale()}}" />
    <meta property="og:image" content="@yield('img')" />
    <link rel="shortcut icon" href="{{ asset('').'public/public/'.$configIndex->logo }}">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
    />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link rel="stylesheet" href="{{ asset('jawatchvn') }}/header.css" />
    <link rel="stylesheet" href="{{ asset('jawatchvn') }}/home.css" />
    <link rel="stylesheet" href="{{ asset('jawatchvn') }}/footer.css" />
    <link rel="stylesheet" href="{{ asset('jawatchvn') }}/styles-global.css" />
    <link rel="stylesheet" href="{{ asset('jawatchvn') }}/seiko.css" />
    <link rel="stylesheet" href="{{ asset('jawatchvn') }}/detail-item.css" />
    <link rel="stylesheet" href="{{ asset('jawatchvn') }}/cart.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
  <style>
      .card-body {
          min-height:150px;
      }
  </style>
    @yield('style')

</head>

<body>
<!-- header -->
<header class="bg-main">
    <div
        class="container box-header justify-content-between align-items-center pt-3 pe-sm-5 ps-sm-5 pb-0"
    >
        <div
            class="zoom cursor-pointer d-md-block d-none"
            onclick="toggleSearchBox()"
        >
            <i class="bi bi-search fs-4 text-white"></i>
        </div>
        <div
            onclick="toggleSidebar()"
            class="zoom cursor-pointer d-block d-md-none"
        >
            <i
                class="bi bi-list text-white toggle-icon"
                style="font-size: 28px"
            ></i>
        </div>

        <div
            class="d-flex flex-column justify-content-center align-items-center"
        >
            <div>
                <a href="{{ route('frontend.home') }}"><img width="120px" src="{{ asset('').'public/public/'.$configIndex->logo }}" alt="Jawatchvn"></a>
            </div>
            <div class="d-md-block d-none">
                <ul
                    class="d-inline-flex menu-links justify-content-center flex-wrap list-unstyled gap-3 pt-4 pb-3"
                >
                    <li>
                        <a href="{{ route('frontend.home') }}">Home</a>
                    </li>
                    <!--@foreach($categoriesIndex as $category)
                        <li class="position-relative">
                            <div class="box-seiko">
                                <a href="#" class="seiko">{{ $category->name }}</a>
                                <i
                                    class="bi bi-chevron-down"
                                    style="cursor: pointer"
                                    onclick="toggleSubmenu(event)"
                                ></i>
                            </div>
                            <div class="sub-menu">
                                @foreach($category->children as $child)
                                    <a href="{{ route('frontend.category', $child->slug) }}">{{ $child->name }}</a>
                                @endforeach
                            </div>
                        </li>
                    @endforeach-->
                    @foreach($campaignIndex as $campaign)
                        <li>
                            <a href="{{ route('frontend.campaign', $campaign->slug) }}">{{ $campaign->name }}</a>
                        </li>
                    @endforeach
                   <!-- <li>
                        <a href="{{ route('frontend.pageSearch') }}">Search</a>
                    </li>-->
                    <li>
                        <a href="{{ route('frontend.pageAboutUs') }}">About Us</a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.pageShipping') }}">Shipping</a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.pageContact') }}">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="sidebar" style="display: none" id="mySidebar">
                <ul class="menu-mobile">
                    <div class="menu-mobile-default" style="display: block">
                        <li>
                            <a href="{{ route('frontend.home') }}">Home</a>
                        </li>
                        <!--@foreach($categoriesIndex as $category)
                            <li
                                onclick="toggleSubMenuSeiko()"
                                class="d-flex justify-content-between align-items-center"
                            >
                                <a href="#">{{ $category->name }}</a>
                                <i class="bi bi-arrow-right"></i>
                            </li>
                        @endforeach-->
                        @foreach($campaignIndex as $campaign)
                            <li>
                                <a href="{{ route('frontend.campaign', $campaign->slug) }}">{{ $campaign->name }}</a>
                            </li>
                        @endforeach
                        <!--<li>
                            <a href="{{ route('frontend.pageSearch') }}">Search</a>
                        </li>-->
                        <li>
                            <a href="{{ route('frontend.pageAboutUs') }}">About Us</a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.pageShipping') }}">Shipping</a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.pageContact') }}">Contact</a>
                        </li>
                    </div>
                   <!-- <div
                        style="overflow-y: scroll; max-height: 80vh; display: none"
                        class="menu-mobile-selected-seiko"
                    >
                        @foreach($categoriesIndex as $category)
                        <li
                            onclick="toggleSubMenuSeiko()"
                            class="d-flex gap-2 align-items-center"
                        >
                            <i class="bi bi-arrow-left"></i>
                            <a href="#">{{ $category->name }}</a>
                        </li>
                            @foreach($category->children as $child)
                                <li><a href="{{ route('frontend.category', $child->slug) }}">{{ $child->name }}</a></li>
                            @endforeach
                        @endforeach
                    </div>-->
                </ul>
            </div>
        </div>
        <div class="d-flex gap-4 align-items-center">
            <div class="zoom cursor-pointer" onclick="toggleSearchBox()">
                <i class="bi bi-search fs-4 text-white d-block d-md-none"></i>
            </div>
            <div class="zoom cursor-pointer">
                <a href="{{ route('frontend.listCart') }}" class="position-relative">
                    <i class="bi bi-bag fs-4 text-white"></i>
                    <span id="cart"
                        style="
                          text-align: center;
                          width: 16px;
                          position: absolute;
                          height: 16px;
                          background: white;
                          color: black;
                          border-radius: 100%;
                          top: 6px;
                          left: 12px;
                        "
                    >
                @php
                    $carts = \Illuminate\Support\Facades\Session::get('cart', []);
                @endphp
                {{ sizeof($carts) }}
              </span>
                </a>
            </div>
        </div>
    </div>
    <!-- start search section -->
    <div class="search-component">
        <div
            class="container justify-content-between align-items-center pt-3 pe-sm-5 ps-sm-5 pb-0"
        >
            <div class="row justify-content-center" style="padding: 90px 0">
                <div class="col-lg-6" style="max-width: 476px">
                    <div
                        class="search-container search-product d-flex align-items-center gap-2"
                    >
                        <form style="width: 100%" method="GET" action="{{ route('frontend.getSearch') }}">
                            <div class="input-group mb-3">
                                <input type="text" value="" name="search" class="form-control button-search-header" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="submit" id="button-search-header" style="
                        border-top-right-radius: 5px;
                        border-bottom-right-radius: 5px;
                      "><i class="bi bi-search text-white"></i></button>
                                <i
                                    class="bi bi-x-lg"
                                    onclick="toggleSearchBox1()"
                                    style="
                        font-size: 24px;
                        color: rgba(239, 236, 236, 0.75);
                        cursor: pointer; padding-top: 7px; margin-left: 5px;
                      "
                                ></i>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end search section -->
</header>
<!-- header -->

<!-- main -->
<main>
    <div class="image-right">
        <div class="float-right" style="position: fixed; left: 80px; z-index: 99999">
            <a style="display: flex; text-decoration: none" href="https://www.instagram.com/jawatch.vietnam/?igsh=MXNpNW16bTdqcms2dQ%3D%3D&utm_source=qr" target="_blank" style="text-decoration: none; color: #0f0f0f">
                <img title="Contact us !" width="50px" style="border-radius: 12px" src="{{ asset('jawatchvn') }}/images/logo/instagram.jpg" alt="instagram">
                <span style="padding-left: 5px; margin-top: 15px; font-weight: bold; font-size: 18px">Contact us !</span></a>
        </div>
    </div>
    <div class="container">
        @yield('content')
    </div>
</main>

<!-- main -->
<footer class="footer">
    <div class="container">
        <div class="footer-first">
            <h2 style="color: rgb(239, 236, 236); font-size: 24px">
                Quick links
            </h2>
            <div class="d-flex flex-column flex-sm-row gap-4">
                <a href="{{ route('frontend.home') }}">Home</a>
                <a href="{{ route('frontend.pageAboutUs') }}">About Us</a>
                <a href="{{ route('frontend.pageShipping') }}">Shipping</a>
            </div>
        </div>
        <div class="footer-second">
            <div class="footer-selection">
                <p>Country/region</p>
                <select class="form-select" aria-label="Default select example">
                    <option selected>USA (USD $)</option>
                </select>
            </div>
            <div class="footer-payment">
                <p><img src="{{ asset('') }}logo/paypal-logo.png" alt="" width="20px"></p>
                <p>
                    © 2024,
                    <a href="{{ route('frontend.home') }}" title="">Jawatchvn</a>
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- add script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSubmenu(event){
        console.log(event)
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
@yield('script')
<script src="{{ asset('jawatchvn') }}/index.js"></script>
</body>
</html>
