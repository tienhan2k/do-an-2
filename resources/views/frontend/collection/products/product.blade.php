@extends('layouts.master')

@section('title', 'Product')

@include('partials.breadcrumb')

@section('content')

    <!--main area-->
    <main id="main" class="main-site">

        <style>
            .original_price {
                font-weight: 300;
                font-size: 13px !important;
                color: #aaaaaa !important;
                text-decoration: line-through;
                padding-left: 10px;
            }
        </style>

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="#" class="link">home</a></li>
                    <li class="item-link"><span>detail</span></li>
                </ul>
            </div>
            <div class="row product_data">

                <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
                    <div class="wrap-product-detail">
                        <div class="detail-media">
                            <div class="product-gallery">
                                <ul class="slides">

                                    @forelse ($product_details->productImages as $image)
                                        <li data-thumb="{{ asset('uploads/products/' . $image->image) }}">
                                            <img src="{{ asset('uploads/products/' . $image->image) }}"
                                                alt="{{ $image->image }}" />
                                        </li>
                                    @empty
                                        <h5>Không tìm thấy hình ảnh nàp</h5>
                                    @endforelse

                                </ul>
                            </div>
                        </div>
                        <div class="detail-info">
                            <div class="product-rating">
                                <style>
                                    .color-gray {
                                        color: #e6e6e6 !important;
                                    }
                                </style>
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review_count_star)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-star color-gray" aria-hidden="true"></i>
                                    @endif
                                @endfor
                                <a href="#" class="count-review">({{ count($reviews) }} review)</a>
                            </div>
                            <h2 class="product-name">{{ $product_details->name }}</h2>
                            <div class="short-desc">
                                <ul>
                                    {!! $product_details->small_description !!}
                                </ul>
                            </div>
                            <div class="wrap-social">
                                <a class="link-socail" href="#"><img
                                        src="{{ asset('assets/images/social-list.png') }}" alt=""></a>
                            </div>
                            @if ($product_details->sale_price > 0 && $sale_time->status == 0 && $sale_time->sale_date > Carbon\Carbon::now())
                                <div class="wrap-price">
                                    <span class="product-price">{{ number_format($product_details->sale_price) }} VNĐ</span>
                                    <del><span
                                            class="product-price original_price">{{ number_format($product_details->original_price) }}
                                            VNĐ</span></del>
                                </div>
                            @else
                                <div class="wrap-price">
                                    <span class="product-price">{{ number_format($product_details->original_price) }}
                                        VNĐ</span>
                                </div>
                            @endif

                            @if ($product_details->quantity > 0)
                                <div class="stock-info in-stock">
                                    <p class="availability">Availability: <b>In Stock</b></p>
                                </div>
                            @else
                                <div class="stock-info">
                                    <p class="availability">Availability: <b>Out Stock</b></p>
                                </div>
                            @endif

                            <div class="quantity">
                                <input type="hidden" value="{{ $product_details->id }}" class="product_id">
                                <span>Quantity:</span>
                                <div class="quantity-input">
                                    <input class="qty-input" type="text" name="quatity" value="1" data-max="120"
                                        pattern="[0-9]*">
                                    <button class="btn btn-reduce"></button>
                                    <button class="btn btn-increase"></button>
                                </div>
                            </div>
                            <div class="wrap-butons">
                                <a class="btn add-to-cart addToCartBtn">Add to Cart</a><br>
                                <div class="wrap-btn">
                                    <button type="button" class="btn btn-compare">Add Compare</button>
                                    <a href="#" class="btn btn-wishlist addToWishlist">Add Wishlist</a>
                                </div>
                            </div>
                        </div>
                        <div class="advance-info">
                            <div class="tab-control normal">
                                <a href="#description" class="tab-control-item active">description</a>
                                <a href="#add_infomation" class="tab-control-item">Addtional Infomation</a>
                                <a href="#review" class="tab-control-item">Reviews</a>
                            </div>
                            <div class="tab-contents">
                                <div class="tab-content-item active" id="description">
                                    {{ $product_details->description }}
                                </div>
                                <div class="tab-content-item " id="add_infomation">
                                    <table class="shop_attributes">
                                        <tbody>
                                            <tr>
                                                <th>Weight</th>
                                                <td class="product_weight">1 kg</td>
                                            </tr>
                                            <tr>
                                                <th>Dimensions</th>
                                                <td class="product_dimensions">12 x 15 x 23 cm</td>
                                            </tr>
                                            <tr>
                                                <th>Color</th>
                                                <td>
                                                    <p>Black, Blue, Grey, Violet, Yellow</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-content-item " id="review">

                                    <div class="wrap-review-form">

                                        <div id="comments">
                                            <h2 class="woocommerce-Reviews-title">{{ $reviews->count() }} review for
                                                <span>{{ $product_details->name }}</span>
                                            </h2>
                                            <ol class="commentlist">
                                                <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1"
                                                    id="li-comment-20">
                                                    <div id="comment-20" class="comment_container">
                                                        @foreach ($reviews as $item)
                                                            @if ($item->user->image)
                                                                <img src="{{ asset('uploads/profile') }}/{{ $item->user->image }}"
                                                                    height="80" width="80" alt="">
                                                            @else
                                                                <img src="{{ asset('uploads/profile/avata-dummy.png') }}"
                                                                    height="80" width="80" alt="">
                                                            @endif
                                                            <div class="comment-text">
                                                                <div class="star-rating">
                                                                    <span
                                                                        class="width-{{ $item->rating * 20 }}-percent">Rated
                                                                        <strong class="rating">{{ $item->rating }}</strong>
                                                                        out of 5</span>
                                                                </div>
                                                                <p class="meta">
                                                                    <strong
                                                                        class="woocommerce-review__author">{{ $item->user->name }}</strong>
                                                                    <span class="woocommerce-review__dash">–</span>
                                                                    <time class="woocommerce-review__published-date"
                                                                        datetime="2008-02-14 20:00">{{ Carbon\Carbon::parse($item->created_at)->format('d F Y g:i A') }}</time>
                                                                </p>
                                                                <div class="description">
                                                                    <p>{{ $item->review }}</p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </li>
                                            </ol>
                                        </div><!-- #comments -->


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end main products area-->

                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                    <div class="widget widget-our-services ">
                        <div class="widget-content">
                            <ul class="our-services">

                                <li class="service">
                                    <a class="link-to-service" href="#">
                                        <i class="fa fa-truck" aria-hidden="true"></i>
                                        <div class="right-content">
                                            <b class="title">Free Shipping</b>
                                            <span class="subtitle">On Oder Over $99</span>
                                            <p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
                                        </div>
                                    </a>
                                </li>

                                <li class="service">
                                    <a class="link-to-service" href="#">
                                        <i class="fa fa-gift" aria-hidden="true"></i>
                                        <div class="right-content">
                                            <b class="title">Special Offer</b>
                                            <span class="subtitle">Get a gift!</span>
                                            <p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
                                        </div>
                                    </a>
                                </li>

                                <li class="service">
                                    <a class="link-to-service" href="#">
                                        <i class="fa fa-reply" aria-hidden="true"></i>
                                        <div class="right-content">
                                            <b class="title">Order Return</b>
                                            <span class="subtitle">Return within 7 days</span>
                                            <p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- Categories widget-->

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


                            </ul>
                        </div>
                    </div>

                </div>
                <!--end sitebar-->
                <style>
                    .pro-rela-img {
                        height: 214px;
                    }
                </style>
                <div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="wrap-show-advance-info-box style-1 box-in-site">
                        <h3 class="title-box">Related Products</h3>
                        <div class="wrap-products">
                            <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5"
                                data-loop="false" data-nav="true" data-dots="false"
                                >

                                @forelse ($products as $related_pro)
                                    <div class="product product-style-2 equal-elem ">
                                        <div class="product-thumnail">
                                            <a href="{{ url('/collections/' . $category->slug . '/' . $related_pro->slug) }}"
                                                title="{{ $related_pro->name }}">
                                                <figure><img
                                                        src="{{ asset('uploads/products/' . $related_pro->productImages[0]->image) }}"
                                                        class="pro-rela-img" alt="{{ $related_pro->name }}">
                                                </figure>
                                            </a>
                                            {{-- <div class="group-flash">
                                            <span class="flash-item new-label">new</span>
                                        </div>
                                        <div class="wrap-btn">
                                            <a href="#" class="function-link">quick view</a>
                                        </div> --}}
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ url($category->slug . '/' . $related_pro->slug) }}"
                                                class="product-name"><span>{{ $related_pro->name }}</span></a>
                                            <div class="wrap-price"><span
                                                    class="product-price">{{ number_format($related_pro->original_price) }}
                                                    VNĐ</span></div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-md-12 text-center">
                                        <h6>No products found.</h6>
                                    </div>
                                @endforelse


                            </div>
                        </div>
                        <!--End wrap-products-->
                    </div>
                </div>

            </div>
            <!--end row-->

        </div>
        <!--end container-->

    </main>
    <!--main area-->
@endsection

{{-- @section('scripts')
    <script>
        $(document).ready(function() {

            $('.addToCartBtn').click(function(e) {
                e.preventDefault();

                var prod_id = $(this).closest('.product_data').find('.product_id').val();
                var prod_qty = $(this).closest('.product_data ').find('.qty-input').val();

                // alert(prod_id);
                // alert(prod_qty);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: "POST",
                    url: "/add-to-cart",
                    data: {
                        'prod_id': prod_id,
                        'prod_qty': prod_qty,
                    },
                    success: function(response) {
                        alert(response.status);
                    }

                });
            });


            $('.btn-increase').click(function(e) {
                e.preventDefault();

                var inc_value = $('.qty-input').val();
                var value = parseInt(inc_value, 10);
                value = isNaN(value) ? 0 : value;
                if (value < 10) {
                    value++;
                    $('.qty-input').val(value);
                }
            });

            $('.btn-reduce').click(function(e) {
                e.preventDefault();

                var dec_value = $('.qty-input').val();
                var value = parseInt(dec_value, 10);
                value = isNaN(value) ? 0 : value;
                if (value > 1) {
                    value--;
                    $('.qty-input').val(value);
                }
            });
        })
    </script>
@endsection --}}
