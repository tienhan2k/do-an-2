@extends('layouts.master')

@section('title', 'Checkout')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="review_form_wrapper">
                <div id="comments">
                    <h2 class="woocommerce-Reviews-title">Add review for our product:</h2>
                    <ol class="commentlist">
                        <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1"
                            id="li-comment-20">
                            <div id="comment-20" class="comment_container">
                                <img alt="" src="{{ asset('uploads/products/'.$order_item->products->productImages[0]->image) }}"
                                    height="80" width="80">
                                <div class="comment-text">
                                    <p class="meta">
                                        <strong class="woocommerce-review__author">{{ $order_item->products->name }}</strong>
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ol>
                </div>
                <div id="review_form">
                    <div id="respond" class="comment-respond">

                        <form action="{{ route('frontend.review.store') }}" method="post" id="commentform"
                            class="comment-form" novalidate="">
                            @csrf
                            <p class="comment-notes">
                                <span id="email-notes">Your email address will not be
                                    published.</span> Required fields are marked <span
                                    class="required">*</span>
                            </p>
                            <div class="comment-form-rating">
                                <span>Your rating</span>
                                <p class="stars">

                                    <label for="rated-1"></label>
                                    <input type="radio" id="rated-1" name="rating"
                                        value="1">
                                    <label for="rated-2"></label>
                                    <input type="radio" id="rated-2" name="rating"
                                        value="2">
                                    <label for="rated-3"></label>
                                    <input type="radio" id="rated-3" name="rating"
                                        value="3">
                                    <label for="rated-4"></label>
                                    <input type="radio" id="rated-4" name="rating"
                                        value="4">
                                    <label for="rated-5"></label>
                                    <input type="radio" id="rated-5" name="rating"
                                        value="5" checked="checked">
                                </p>
                            </div>
                            {{-- {{ dd($order_item->id) }} --}}
                            <input type="hidden" name='product_id' value="{{ $order_item->products->id }}">
                            <input type="hidden" name='order_item_id' value="{{ $order_item->id }}">
                            <p class="comment-form-comment">
                                <label for="comment">Your review <span
                                        class="required">*</span>
                                </label>
                                <textarea id="comment" name="review" cols="45" rows="8"></textarea>
                            </p>
                            <p class="form-submit">
                                <input name="submit" type="submit" id="submit"
                                    class="submit" value="Submit">
                            </p>
                        </form>

                    </div><!-- .comment-respond-->
                </div><!-- #review_form -->
            </div><!-- #review_form_wrapper -->

        </div>
    </div>
</div>

@endsection
