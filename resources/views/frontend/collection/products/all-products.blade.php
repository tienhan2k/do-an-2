@extends('layouts.master')

@section('title', 'All products')

@include('partials.breadcrumb')

@section('content')

    <main id="main" class="main-site left-sidebar">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="/" class="link">home</a></li>
                    <li class="item-link"><span>All Product</span></li>
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

                        <h1 class="shop-title">All Product</h1>

                        <div class="wrap-right">

                            <div class="sort-item orderby ">
                                <select name="orderby" class="use-chosen">
                                    <option value="menu_order" selected="selected">Default sorting</option>
                                    <option value="popularity">Sort by popularity</option>
                                    <option value="rating">Sort by average rating</option>
                                    <option value="date">Sort by newness</option>
                                    <option value="price">Sort by price: low to high</option>
                                    <option value="price-desc">Sort by price: high to low</option>
                                </select>
                            </div>

                            {{-- <div class="sort-item product-per-page">
                                <select name="post-per-page" class="use-chosen" >
                                    <option value="12" selected="selected">12 per page</option>
                                    <option value="16">16 per page</option>
                                    <option value="18">18 per page</option>
                                    <option value="21">21 per page</option>
                                    <option value="24">24 per page</option>
                                    <option value="30">30 per page</option>
                                    <option value="32">32 per page</option>
                                </select>
                            </div> --}}

                            {{-- <div class="change-display-mode">
                                <a href="#" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
                                <a href="list.html" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a>
                            </div> --}}

                        </div>

                    </div>
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
                                {{-- <input type="hidden" value="{{ $item->id }}" class="product_id"> --}}
                                <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                                    <div class="product product-style-3 equal-elem ">
                                        <div class="product-thumnail">
                                            {{-- <input type="hidden" value="1" class="qty-input"> --}}
                                            <a href="{{ url('/collections/' . $item->category->slug . '/' . $item->slug) }}"
                                                title="{{ $item->name }}">
                                                <figure><img
                                                        src="{{ asset('uploads/products/' . $item->productImages[0]->image) }}"
                                                        alt="{{ $item->name }}"></figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ url('/collections/' . $item->category->slug . '/' . $item->slug) }}"
                                                class="product-name"><span>{{ $item->name }}</span></a>
                                            <div class="wrap-price"><span
                                                    class="product-price">{{ number_format($item->original_price) }}
                                                    VNĐ</span></div>
                                            <a onClick="addProductInAllProductPage({{ $item->id }})" href="javascript:0"
                                                class="btn add-to-cart">Add To Cart</a>
                                            <div class="product-wish">
                                                @if ($wishlist->contains('product_id', $item->id))
                                                    <a href="javascript:0" onclick="removeFromWishlist({{ $item->id }})"><i
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
                            {{ $products->links() }}
                        </ul>
                        {{-- <p class="result-count">Showing 1-8 of 12 result</p> --}}
                    </div>
                </div>
                <!--end main products area-->

                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                    <div class="widget mercado-widget categories-widget">
                        <h2 class="widget-title">All Categories</h2>
                        <div class="widget-content">
                            <ul class="list-category">
                                <li class="category-item has-child-cate">
                                    <a href="#" class="cate-link">Fashion & Accessories</a>
                                    <span class="toggle-control">+</span>
                                    <ul class="sub-cate">
                                        <li class="category-item"><a href="#" class="cate-link">Batteries (22)</a>
                                        </li>
                                        <li class="category-item"><a href="#" class="cate-link">Headsets (16)</a></li>
                                        <li class="category-item"><a href="#" class="cate-link">Screen (28)</a></li>
                                    </ul>
                                </li>
                                <li class="category-item has-child-cate">
                                    <a href="#" class="cate-link">Furnitures & Home Decors</a>
                                    <span class="toggle-control">+</span>
                                    <ul class="sub-cate">
                                        <li class="category-item"><a href="#" class="cate-link">Batteries (22)</a>
                                        </li>
                                        <li class="category-item"><a href="#" class="cate-link">Headsets (16)</a></li>
                                        <li class="category-item"><a href="#" class="cate-link">Screen (28)</a></li>
                                    </ul>
                                </li>
                                <li class="category-item">
                                    <a href="#" class="cate-link">Tools & Equipments</a>
                                </li>
                                <li class="category-item">
                            </ul>
                        </div>
                    </div><!-- Categories widget-->

                    <div class="widget mercado-widget filter-widget brand-widget">
                        <h2 class="widget-title">Brand</h2>
                        <div class="widget-content">
                            <ul class="list-style vertical-list list-limited" data-show="6">
                                <li class="list-item"><a class="filter-link active" href="#">Fashion Clothings</a>
                                </li>
                                <li class="list-item"><a class="filter-link " href="#">Laptop Batteries</a></li>
                                <li class="list-item default-hiden"><a class="filter-link " href="#">Printer &
                                        Ink</a></li>
                                <li class="list-item default-hiden"><a class="filter-link " href="#">CPUs &
                                        Prosecsors</a></li>
                                <li class="list-item"><a
                                        data-label='Show less<i class="fa fa-angle-up" aria-hidden="true"></i>'
                                        class="btn-control control-show-more" href="#">Show more<i
                                            class="fa fa-angle-down" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div><!-- brand widget-->

                    {{-- <div class="widget mercado-widget filter-widget price-filter">
                        <h2 class="widget-title">Price</h2>
                        <div class="widget-content">
                            <div id="slider-range"></div>
                            <p>
                                <label for="amount">Price:</label>
                                <input type="text" id="amount" readonly>
                                <button class="filter-submit">Filter</button>
                            </p>
                        </div>
                    </div><!-- Price--> --}}

                    <div class="widget mercado-widget filter-widget">
                        <h2 class="widget-title">Color</h2>
                        <div class="widget-content">
                            <ul class="list-style vertical-list has-count-index">
                                <li class="list-item"><a class="filter-link " href="#">Red <span>(217)</span></a>
                                </li>
                                <li class="list-item"><a class="filter-link " href="#">Yellow
                                        <span>(179)</span></a></li>
                                <li class="list-item"><a class="filter-link " href="#">Black <span>(79)</span></a>
                                </li>
                                <li class="list-item"><a class="filter-link " href="#">Blue <span>(283)</span></a>
                                </li>
                                <li class="list-item"><a class="filter-link " href="#">Grey <span>(116)</span></a>
                                </li>
                                <li class="list-item"><a class="filter-link " href="#">Pink <span>(29)</span></a>
                                </li>
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
                                                <figure><img src="assets/images/products/digital_01.jpg" alt="">
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
                                                <figure><img src="assets/images/products/digital_17.jpg" alt="">
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
                type: "post",
                url: "/add-to-cart/" + id,
            }).done(function(response) {
                swal(response.status);
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
