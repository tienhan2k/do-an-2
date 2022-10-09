@extends('layouts.master')

@section('title', 'Wishlist')

@section('content')
    <!--main area-->
    <main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="/" class="link">home</a></li>
                    <li class="item-link"><span>wishlist</span></li>
                </ul>
            </div>

            <div class="main-content-area cartitems">

                <div class="wrap-iten-in-cart">
                    <h3 class="box-title">Wishlist</h3>
                    <ul class="products-cart ">
                        @forelse ($wishlist as $item)
                            <li class="pr-cart-item product_data">
                                <div class="product-image">
                                    <figure><img
                                            src="{{ asset('/uploads/products/' . $item->products->productImages[0]->image) }}"
                                            alt="{{ $item->products->name }}"></figure>
                                </div>
                                <div class="product-name">
                                    <a class="link-to-product" href="#">{{ $item->products->name }}</a>
                                </div>
                                <div class="price-field produtc-price">
                                    <p class="price">{{ number_format($item->products->original_price) }} VNĐ</p>
                                </div>
                                <div class="quantity">
                                    <input type="hidden" value="{{ $item->product_id }}" class="product_id">
                                    @if ($item->products->quantity >= 0)
                                        <div class="quantity-input">
                                            <input class="qty-input" type="text" name="quatity" value="1"
                                                data-max="120" pattern="[0-9]*">
                                            <button class="btn changeQuantity btn-increase"></button>
                                            <button class="btn changeQuantity btn-reduce"></button>
                                        </div>
                                    @else
                                        <h4 class="text-center">Out of stock</h4>
                                    @endif
                                </div>
                                {{-- <div class="float-end">
                                    <div class="wrap-butons ">
                                        <button class="btn btn-success" title="">
                                            Add to cart
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        </button>
                                        <button class="btn btn-danger" title="">
                                            Delete
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div> --}}
                                
                            </li>

                        @empty
                            <h4 style="text-align: center">No wishlist found.</h4>
                        @endforelse

                    </ul>
                </div>

                <div class="wrap-show-advance-info-box style-1 box-in-site">
                    <h3 class="title-box">Most Viewed Products</h3>
                    <div class="wrap-products">
                        <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5"
                            data-loop="false" data-nav="true" data-dots="false"
                            data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}'>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_04.jpg" width="214"
                                                height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">new</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional
                                            Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_17.jpg" width="214"
                                                height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        </figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item sale-label">sale</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional
                                            Speaker [White]</span></a>
                                    <div class="wrap-price"><ins>
                                            <p class="product-price">$168.00</p>
                                        </ins> <del>
                                            <p class="product-price">$250.00</p>
                                        </del></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End wrap-products-->
                </div>

            </div>
            <!--end main content area-->

        </div>
        <!--end container-->

    </main>
    <!--main area-->
@endsection
