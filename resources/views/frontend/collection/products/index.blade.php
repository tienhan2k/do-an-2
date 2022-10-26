@extends('layouts.master')

@section('title', 'Products')

@include('partials.breadcrumb')

@section('content')


    <main id="main" class="main-site left-sidebar">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="#" class="link">home</a></li>
                    <li class="item-link"><span>{{ $category->name }}</span></li>
                </ul>
            </div>
            <div class="row">

                <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">

                    <div class="banner-shop">
                        <a href="#" class="banner-link">
                            <figure><img src="{{ asset('assets/images/shop-banner.jpg') }}" alt=""></figure>
                        </a>
                    </div>

                    <div class="wrap-shop-control">

                        <h1 class="shop-title">{{ $category->name }}</h1>

                        <div class="wrap-right">
                            <form>
                                <div class="sort-item orderby">
                                    <select name="sort" class="use-chosen" id="sort">
                                        <option value="" selected="selected">Default sorting</option>
                                        <option value="name_a_z" @if ($_GET['sort'] == 'name_a_z') selected='' @endif>Sort
                                            by name: A - Z</option>
                                        <option value="name_z_a" @if ($_GET['sort'] == 'name_z_a') selected='' @endif>Sort
                                            by name: Z - A</option>
                                        <option value="product_lastest"
                                            @if ($_GET['sort'] == 'product_lastest') selected='' @endif>Sort by lastest</option>
                                        <option value="price_low_high" @if ($_GET['sort'] == 'price_low_high') selected='' @endif>
                                            Sort by price: low to high</option>
                                        <option value="price_high_low" @if ($_GET['sort'] == 'price_high_low') selected='' @endif>
                                            Sort by price: high to low</option>
                                    </select>
                                </div>
                            </form>
                            {{-- <div class="change-display-mode">
                                <a href="#" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
                                <a href="list.html" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a>
                            </div> --}}

                        </div>

                    </div>
                    <!--end wrap shop control-->
                    <style>
                        .product-wish {
                            position: absolute;
                            top: 10%;
                            left: 0;
                            z-index: 99;
                            right: 30px;
                            text-align: right;
                            padding-top: 0;
                        }

                        .product-wish .fa {

                            color: #cbcbcb;
                            font-size: 32px;
                        }

                        .product-wish .fa:hover {
                            color: red !important;
                        }

                        .product-wish .fa1 {
                            font-size: 32px;
                            color: red;
                        }
                    </style>
                    <div class="row product_data productItem">

                        <ul class="product-list grid-products equal-container">
                            @forelse ($products as $item)
                                <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                                    <div class="product product-style-3 equal-elem">
                                        <div class="product-thumnail">
                                            {{-- <input type="hidden" value="1" class="qty-input">
                                            <input type="hidden" value="{{ $item->id }}" class="product_id"> --}}
                                            <a href="{{ url('/collections/' . $category->slug . '/' . $item->slug) }}"
                                                title="{{ $item->name }}">
                                                <figure><img
                                                        src="{{ asset('uploads/products/' . $item->productImages[0]->image) }}"
                                                        alt="{{ $item->name }}"></figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ url('/collections/' . $category->slug . '/' . $item->slug) }}"
                                                class="product-name"><span>{{ $item->name }}</span></a>
                                            <div class="wrap-price"><span
                                                    class="product-price">{{ number_format($item->original_price) }}
                                                    VNĐ</span></div>
                                            <a onClick="addProductInAllProductPage({{ $item->id }})"
                                                class="btn add-to-cart" href="javascript:0">Add To Cart</a>
                                            <div class="product-wish">
                                                @if ($wishlist->contains('product_id', $item->id))
                                                    <a href="javascript:0"
                                                        onclick="removeFromWishlist({{ $item->id }})"><i
                                                            class="fa1 fa-heart"></i></a>
                                                @else
                                                    <a href="javascript:0"
                                                        onclick="addToWishlistInProductPage({{ $item->id }})">
                                                        <i class="fa fa-heart"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <div class="col-md-12 text-center">
                                    <h6>No products found.</h6>
                                </div>
                            @endforelse
                        </ul>
                    </div>

                    <div class="wrap-pagination-info">
                        <ul class="page-numbers text-center">
                            @if (isset($_GET['sort']))
                                {{ $products->appends(['sort' => $_GET['sort']])->links() }}
                            @else
                                {{ $products->links() }}
                            @endif
                        </ul>
                        {{-- <p class="result-count">Showing 1-8 of 12 result</p> --}}
                    </div>
                </div>
                <!--end main products area-->

                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                    <div class="widget mercado-widget categories-widget">
                        <h2 class="widget-title">All Categories</h2>
                        <div class="widget-content">
                            <ul class="list-category vertical-list" data-show="6">
                                @foreach ($cate_filters as $category_item)
                                    <li class="category-item">
                                        <a href="{{ $category_item->slug }}"
                                            class="cate-link {{ Request::is('collections/' . $category_item->slug) ? 'active' : '' }}">{{ $category_item->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div><!-- Categories widget-->

                    <div class="widget mercado-widget filter-widget brand-widget">
                        <h2 class="widget-title">Brand</h2>
                        <div class="widget-content">
                            <ul class="list-style vertical-list list-limited" data-show="6">
                                @foreach ($brands_filters as $brand)
                                    <li class="list-item">
                                        <a class="filter-link" href="#">{{ $brand->name }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div><!-- brand widget-->

                    {{-- <div class="widget mercado-widget filter-widget price-filter">
                        <h2 class="widget-title">Price</h2>
                        <div class="widget-content">
                            <form action="">
                                @csrf
                                <div id="slider-range"></div>
                                <p>
                                    <label for="amount">Price:</label>
                                    <input type="text" id="amount" readonly>
                                    <button class="filter-submit">Filter</button>
                                </p>
                            </form>
                        </div>
                    </div><!-- Price--> --}}

                    <div class="widget mercado-widget filter-widget">
                        <h2 class="widget-title">Color</h2>
                        <div class="widget-content">
                            <ul class="list-style vertical-list has-count-index">
                                @foreach ($colors as $color)
                                    <li class="list-item">
                                        <a class="filter-link " href="#">{{ $color->name }} <span>(217)</span></a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div><!-- Color -->

                    <div class="widget mercado-widget filter-widget">
                        <h2 class="widget-title">Size</h2>
                        <div class="widget-content">
                            <ul class="list-style inline-round ">
                                <li class="list-item"><a class="filter-link active" href="#">s</a></li>
                                <li class="list-item"><a class="filter-link " href="#">M</a></li>
                                <li class="list-item"><a class="filter-link " href="#">l</a></li>
                                <li class="list-item"><a class="filter-link " href="#">xl</a></li>
                            </ul>
                            {{-- <div class="widget-banner">
                                <figure><img src="assets/images/size-banner-widget.jpg" width="270" height="331" alt=""></figure>
                            </div> --}}
                        </div>
                    </div><!-- Size -->

                    <div class="widget mercado-widget widget-product">
                        <h2 class="widget-title">Popular Products</h2>
                        <div class="widget-content">
                            <ul class="products">

                                <li class="product-item">
                                    <div class="product product-widget-style">
                                        <div class="thumbnnail">
                                            <a href="detail.html"
                                                title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                                <figure><img src="{{ asset('assets/images/products/digital_01.jpg') }}"
                                                        alt="">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless
                                                    Omnidirectional Speaker...</span></a>
                                            <div class="wrap-price"><span class="product-price">$168.00</span></div>
                                        </div>
                                    </div>
                                </li>

                                <li class="product-item">
                                    <div class="product product-widget-style">
                                        <div class="thumbnnail">
                                            <a href="detail.html"
                                                title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                                <figure><img src="{{ asset('assets/images/products/digital_17.jpg') }}"
                                                        alt="">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless
                                                    Omnidirectional Speaker...</span></a>
                                            <div class="wrap-price"><span class="product-price">$168.00</span></div>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div><!-- brand widget-->

                </div>
                <!--end sitebar-->

            </div>
            <!--end row-->

        </div>
        <!--end container-->

    </main>

    <script>
        function addProductInAllProductPage(id) {
            $.ajax({
                type: "get",
                url: "/add-to-cart/" + id,

            }).done(function(response) {
                swal('', response.status, 'success');
            });
        }

        function addToWishlistInProductPage(id) {
            $.ajax({
                type: "get",
                url: "/add-to-wishlist/" + id,

            }).done(function(response) {
                $('.productItem').load(location.href + " .productItem");
                swal('', response.status, 'success');
            });
        }

        function removeFromWishlist(id) {
            $.ajax({
                type: "get",
                url: "/delete-from-wishlist/" + id,

            }).done(function(response) {
                $('.productItem').load(location.href + " .productItem");
                swal('', response.status, 'success');
            });
        }
    </script>
@endsection
