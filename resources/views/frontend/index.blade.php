@extends('layouts.master')

@section('title', 'Shop')

@section('content')

    <main id="main">
        <div class="container">

            {{-- <br>
        <div class="row">
            <div class="col-md-12">
                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
            </div>
        </div>
        <br> --}}

            <!--MAIN SLIDE-->
            <div class="wrap-main-slide">
                <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true"
                    data-dots="false">
                    @foreach ($sliders as $slider)
                        <div class="item-slide">
                            <img src="{{ asset('uploads/sliders/' . $slider->image) }}" alt="" class="img-slide">
                            <div class="slide-info slide-1">
                                <h2 class="f-title">{!! $slider->title !!}</h2>
                                <span class="subtitle">{!! $slider->description !!}</span>
                                <p class="sale-info">Only price: <span class="price">$59.99</span></p>
                                <a href="#" class="btn-link">Shop Now</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!--BANNER-->
            <div class="wrap-banner style-twin-default">
                <div class="banner-item">
                    <a href="#" class="link-banner banner-effect-1">
                        <figure><img src="assets/images/home-1-banner-1.jpg" alt="" width="580" height="190">
                        </figure>
                    </a>
                </div>
                <div class="banner-item">
                    <a href="#" class="link-banner banner-effect-1">
                        <figure><img src="assets/images/home-1-banner-2.jpg" alt="" width="580" height="190">
                        </figure>
                    </a>
                </div>
            </div>

            <!--On Sale-->
            @if ($sale_products->count() > 0 && $sale_time->status == 0 && $sale_time->sale_date > Carbon\Carbon::now())
                <div class="wrap-show-advance-info-box style-1 has-countdown">
                    <h3 class="title-box">On Sale</h3>
                    <div class="wrap-countdown mercado-countdown"
                        data-expire="{{ Carbon\Carbon::parse($sale_time->sale_date)->format('Y/m/d h:m:s') }}"></div>
                    <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5"
                        data-loop="false" data-nav="true" data-dots="false"
                        data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                        @foreach ($sale_products as $s_item)
                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="{{ url('/shop/' . $s_item->category->slug . '/' . $s_item->sCategory->slug . '/' . $s_item->slug) }}"
                                        title="{{ $s_item->name }}">
                                        <figure><img
                                                src="{{ asset('uploads/products/' . $s_item->productImages[0]->image) }}"
                                                width="800" height="800" alt="{{ $s_item->name }}"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item sale-label">sale</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="{{ url('/shop/' . $s_item->category->slug . '/' . $s_item->sCategory->slug . '/' . $s_item->slug) }}"
                                        class="product-name"><span>{{ $s_item->name }}</span></a>
                                    <div class="wrap-price"><ins>
                                            <p class="product-price">{{ number_format($s_item->sale_price) }} đ</p>
                                        </ins> <del>
                                            <p class="product-price">{{ number_format($s_item->original_price) }} đ</p>
                                        </del></div>

                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            @endif
            @if ($latest_products->count() > 0)
                <!--Latest Products-->
                <div class="wrap-show-advance-info-box style-1">
                    <h3 class="title-box">Latest Products</h3>
                    <div class="wrap-top-banner">
                        <a href="#" class="link-banner banner-effect-2">
                            <figure><img src="assets/images/digital-electronic-banner.jpg" width="1170" height="240"
                                    alt=""></figure>
                        </a>
                    </div>
                    <div class="wrap-products">
                        <div class="wrap-product-tab tab-style-1">
                            <div class="tab-contents">
                                <div class="tab-content-item active" id="digital_1a">
                                    <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container"
                                        data-items="5" data-loop="false" data-nav="true" data-dots="false"
                                        data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>

                                        @foreach ($latest_products as $latest)
                                            <div class="product product-style-2 equal-elem ">
                                                <div class="product-thumnail">
                                                    <a href="{{ url('/shop') . '/' . $latest->category->slug . '/' . $latest->sCategory->slug . '/' . $latest->slug }}"
                                                        title="{{ $latest->name }}">
                                                        <figure><img
                                                                src="{{ asset('uploads/products/' . $latest->productImages[0]->image) }}"
                                                                width="800" height="800" alt="{{ $latest->name }}">
                                                        </figure>
                                                    </a>
                                                    {{-- <div class="group-flash">
                                    <span class="flash-item new-label">new</span>
                                </div> --}}
                                                </div>
                                                <div class="product-info">
                                                    <a href="#"
                                                        class="product-name"><span>{{ $latest->name }}</span></a>
                                                    <div class="wrap-price"><span
                                                            class="product-price">{{ number_format($latest->original_price) }}
                                                            VNĐ</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endif

            <!--Product Categories-->
            <div class="wrap-show-advance-info-box style-1">
                <h3 class="title-box">Product Categories</h3>
                <div class="wrap-top-banner">
                    <a href="#" class="link-banner banner-effect-2">
                        <figure><img src="{{ asset('assets/images/fashion-accesories-banner.jpg') }}" width="1170"
                                height="240" alt=""></figure>
                    </a>
                </div>
                <div class="wrap-products">
                    <div class="wrap-product-tab tab-style-1">
                        <div class="tab-control">
                            @foreach ($categories as $index => $cate)
                                <a href="#{{ $cate->name }}"
                                    class="tab-control-item {{ $index == 0 ? 'active' : '' }}">{{ $cate->name }}</a>
                            @endforeach
                        </div>
                        <div class="tab-contents">
                            @foreach ($categories as $index => $cate)
                                <div class="tab-content-item {{ $index == 0 ? 'active' : '' }}"
                                    id="{{ $cate->name }}">
                                    <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container"
                                        data-items="5" data-loop="false" data-nav="true" data-dots="false"
                                        data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>

                                        @if (count($cate->subCategories) > 0)
                                        @foreach ($cate->subCategories as $s_cate)
                                            <div class="product product-style-2 equal-elem ">
                                                <div class="product-thumnail">
                                                    <a href="{{ url('shop/'.$s_cate->category->slug.'/'.$s_cate->slug) }}"
                                                        title="{{ $s_cate->name }}">
                                                        <figure><img src="{{ asset('uploads/categories/'.$s_cate->image) }}"
                                                                width="800" height="800"
                                                                alt="{{ $s_cate->name }}">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <div class="product-info">
                                                    <a href="#" class="product-name"><span>{{ $s_cate->name }}</span></a>
                                                </div>
                                            </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>

@endsection
