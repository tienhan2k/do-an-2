@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        {{-- @if (session('message'))
                <h2 class="alert alert-success" >{{ session('message') }}</h2>
            @endif --}}
          <div class="me-md-3 me-xl-5">

            <h2>Dashboard</h2>

            <p class="mb-md-0">Your analytics dashboard template.</p>

        </div>

        <hr>

         <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                    <label for="">Total Orders</label>
                    <h1>{{ $totalOrder }}</h1>
                    <a href="{{ route('order.index') }}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label for="">Today Orders</label>
                    <h1>{{ $todayOrder }}</h1>
                    <a href="{{ route('order.index') }}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <label for="">This month Orders</label>
                    <h1>{{ $thisMonthOrder }}</h1>
                    <a href="{{ route('order.index') }}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-danger text-white mb-3">
                    <label for="">Year Orders</label>
                    <h1>{{ $thisYearOrder }}</h1>
                    <a href="{{ route('order.index') }}" class="text-white">View</a>
                </div>
            </div>

         </div>

         <hr>

         <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                    <label for="">Total products</label>
                    <h1>{{ $totalProducts }}</h1>
                    <a href="{{ route('product.index') }}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label for="">Total categories</label>
                    <h1>{{ $totalCategories }}</h1>
                    <a href="{{ route('category.index') }}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <label for="">Total brands</label>
                    <h1>{{ $totalBrands }}</h1>
                    <a href="{{ route('brand.index') }}" class="text-white">View</a>
                </div>
            </div>

         </div>
         <hr>
         <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                    <label for="">Total all users</label>
                    <h1>{{ $totalAllUsers }}</h1>
                    <a href="{{ route('user.index') }}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label for="">Total admin</label>
                    <h1>{{ $totalUser }}</h1>
                    <a href="{{ route('user.index') }}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <label for="">Total user</label>
                    <h1>{{ $totalAdmin }}</h1>
                    <a href="{{ route('user.index') }}" class="text-white">View</a>
                </div>
            </div>

         </div>


    </div>
  </div>
@endsection
