@extends('layouts.master')

@section('title', 'Category')

@include('partials.breadcrumb')

@section('content')
<div class="container">

    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="#" class="link">home</a></li>
            <li class="item-link"><span>Collections</span></li>
        </ul>
    </div>
<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="shop-title" style="text-align: center"><strong>OUR CATEGORY</strong> </h1><br>
            </div>
            @forelse ($categories as $cateItem)
                <div class="col-6 col-md-3">
                    <div class="category-card">
                        <a href="{{url('/collections/'.$cateItem->slug)}}">
                            <div class="category-card-img">
                                <img src="{{ asset($cateItem->image) }}" class="w-100" alt="Laptop">
                            </div>
                            <div class="category-card-body">
                                <h5>{{ $cateItem->name }}</h5>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-md-12 text-center">
                    <h6>No categories found.</h6>
                </div>
            @endforelse

        </div>
    </div>
</div>
</div>
@endsection







