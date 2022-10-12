@extends('layouts.master')

@section('title', 'Wishlist')

@section('content')
    <!--main area-->
    <main id="main" class="main-site left-sidebar">
        <div class="container">
            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="/" class="link">home</a></li>
                    <li class="item-link"><span>wishlist</span></li>
                </ul>
            </div>

            <div class="row">

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

                            @forelse ($wishlist as $item)
                                <input type="hidden" value="{{ $item->product_id }}" class="product_id">
                                <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                                    <div class="product product-style-3 equal-elem ">
                                        <div class="product-thumnail">
                                            <input type="hidden" value="1" class="qty-input">
                                            <a href="{{ url('/collections/' . $item->products->category->slug . '/' . $item->products->slug) }}"
                                                title="{{ $item->products->name }}">
                                                <figure><img
                                                        src="{{ asset('uploads/products/' . $item->products->productImages[0]->image) }}"
                                                        alt="{{ $item->products->name }}"></figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ url('/collections/' . $item->products->category->slug . '/' . $item->products->slug) }}"
                                                class="product-name"><span>{{ $item->products->name }}</span></a>
                                            <div class="wrap-price"><span
                                                    class="product-price">{{ number_format($item->products->original_price) }}
                                                    VNĐ</span></div>
                                            <a onClick="addProductInAllProductPage({{ $item->product_id }})" href="javascript:0"
                                                class="btn add-to-cart">Add To Cart</a>
                                            <div class="product-wish">
                                                {{-- @if ($wishlist->contains('product_id', $item->id)) --}}
                                                    <a href="javascript:0" onclick="removeFromWishlist({{ $item->product_id }})"><i
                                                            class="fa fa-trash"></i></a>
                                                {{-- @endif --}}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <div class="col-md-12 text-center">
                                    <h6>No wish item found.</h6>
                                </div>
                            @endforelse

                        </ul>
                    </div>

                    <div class="wrap-pagination-info">
                        <ul class="page-numbers text-center">
                            {{ $wishlist->links() }}
                        </ul>
                        {{-- <p class="result-count">Showing 1-8 of 12 result</p> --}}
                    </div>

                <!--end main products area-->

            </div>
            <!--end row-->
        </div>
    </main>
    <script>
        function addProductInAllProductPage(id) {
            $.ajax({
                type: "get",
                url: "/add-to-cart/" + id,
            }).done(function(response) {
                swal(response.status);
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
