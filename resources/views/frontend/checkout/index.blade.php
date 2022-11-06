@extends('layouts.master')

@section('title', 'Checkout')

@section('content')
    <!--main area-->
    <main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="/" class="link">home</a></li>
                    <li class="item-link"><span>Checkout</span></li>
                </ul>
            </div>

            <div class=" main-content-area">
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrap-address-billing">
                            <form action="{{ url('/place-order') }}" method="post" name="frm-billing">
                                @csrf
                                <h3 class="box-title">Billing Address</h3>
                                <p class="row-in-form">
                                    <label for="name">Name<span>*</span></label>
                                    <input id="name" type="text" name="name" value="{{ Auth::user()->name }}"
                                        placeholder="Your name">
                                </p>
                                <p class="row-in-form">
                                    <label for="address">Address<span>*</span></label>
                                    <input id="address" type="text" name="address" value="{{ Auth::user()->address }}"
                                        placeholder="Street at apartment number">
                                </p>
                                <p class="row-in-form">
                                    <label for="email">Email Address:</label>
                                    <input id="email" type="email" name="email" value="{{ Auth::user()->email }}"
                                        placeholder="Type your email">
                                </p>
                                <p class="row-in-form">
                                    <label for="phone">Phone number<span>*</span></label>
                                    <input id="phone" type="text" name="phone" value="{{ Auth::user()->phone }}"
                                        placeholder="10 digits format">
                                </p>
                                <p class="row-in-form">
                                    <label for="province">Province<span>*</span></label>
                                    <input id="province" type="text" name="province"
                                        value="{{ Auth::user()->province }}" placeholder="Province name">
                                </p>
                                <p class="row-in-form">
                                    <label for="city">City<span>*</span></label>
                                    <input id="city" type="text" name="city" value="{{ Auth::user()->city }}"
                                        placeholder="City name">
                                </p>
                                <p class="row-in-form">
                                    <label for="district">District<span>*</span></label>
                                    <input id="district" type="text" name="district"
                                        value="{{ Auth::user()->district }}" placeholder="District name">
                                </p>
                                <p class="row-in-form">
                                    <label for="message">Note</label>
                                    <input id="message" type="text" name="message" value="{{ old('message') }}"
                                        placeholder="Your notes">
                                </p>

                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="text-center"><strong>Items</strong></h3>
                                            <br>
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Product name</th>
                                                        <th class="text-center">Quantity</th>
                                                        <th class="text-center">Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $sub_total = 0;
                                                        $shipping_fee = 30000;
                                                        $total = 0;
                                                    @endphp
                                                    @foreach ($cartItems as $item)
                                                        @if ($item->products->sale_price > 0)
                                                            @php
                                                                $sub_total += $item->products->sale_price * $item->product_qty;
                                                            @endphp
                                                        @else
                                                            @php
                                                                $sub_total += $item->products->original_price * $item->product_qty;
                                                            @endphp
                                                        @endif
                                                        <tr>
                                                            <td>{{ $item->products->name }}</td>
                                                            <td class="text-center">{{ $item->product_qty }}</td>
                                                            <td class="text-right"> <strong>{{ number_format($sub_total) }}
                                                                </strong>VNĐ</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="summary summary-checkout">
                                    <div class="summary-item payment-method">
                                        <h4 class="title-box">Payment Method</h4>
                                        <p class="summary-info"><span class="title">Check / Money order</span></p>
                                        <p class="summary-info"><span class="title">Credit Cart (saved)</span></p>
                                        <div class="choose-payment-methods">
                                            <label class="payment-method">
                                                <input name="payment-method" id="payment-method-bank" value="bank"
                                                    type="radio">
                                                <span>Direct Bank Transder</span>
                                                <span class="payment-desc">But the majority have suffered alteration in some
                                                    form, by
                                                    injected humour, or randomised words which don't look even slightly
                                                    believable</span>
                                            </label>
                                            <label class="payment-method">
                                                <input name="payment-method" id="payment-method-visa" value="visa"
                                                    type="radio">
                                                <span>visa</span>
                                                <span class="payment-desc">There are many variations of passages of Lorem
                                                    Ipsum
                                                    available</span>
                                            </label>
                                            <label class="payment-method">
                                                <input name="payment-method" id="payment-method-paypal" value="paypal"
                                                    type="radio">
                                                <span>Paypal</span>
                                                <span class="payment-desc">You can pay with your credit</span>
                                                <span class="payment-desc">card if you don't have a paypal account</span>
                                            </label>
                                        </div>
                                        <p class="summary-info grand-total"><span>Grand Total</span> <span
                                                class="grand-total-price">{{ number_format($total = $sub_total + $shipping_fee) }}
                                                VNĐ</span></p>
                                        <button type="submit" class="btn btn-medium">Place order now</button>
                                    </div>
                                    <div class="summary-item shipping-method">
                                        <h4 class="title-box f-title">Shipping method</h4>
                                        <p class="summary-info"><span class="title">Flat Rate</span></p>
                                        <p class="summary-info"><span class="title">{{ number_format($shipping_fee) }}
                                                VNĐ</span></p>
                                        {{-- <h4 class="title-box">Discount Codes</h4>
                                        <p class="row-in-form">
                                            <label for="coupon-code">Enter Your Coupon code:</label>
                                            <input id="coupon-code" type="text" name="coupon-code" value=""
                                                placeholder="">
                                        </p>
                                        <button class="btn btn-small">Apply</button> --}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
                                        <figure><img src="assets/images/products/digital_15.jpg" width="214"
                                                height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        </figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">new</span>
                                        <span class="flash-item sale-label">sale</span>
                                        <span class="flash-item bestseller-label">Bestseller</span>

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



        </div>

    </main>
    <!--main area-->
@endsection
