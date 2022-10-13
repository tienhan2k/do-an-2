@extends('layouts.master')

@section('title', 'Checkout')

@section('content')

<div class="container py-5">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-danger">
                    <h2 class="text-white text-center"><strong >Orders View</strong>
                        <a href="{{ route('frontend.order.view') }}" class="btn btn-success float-end">Back</a>
                    </h2>
                </div><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="text-center"><strong>Customer Information</strong></h4>
                            <hr>
                            <label for="">Name</label>
                            <div class="border p-2">{{ $order->name }}</div>
                            <label for="">Email</label>
                            <div class="border p-2">{{ $order->email }}</div>
                            <label for="">Phone Number</label>
                            <div class="border p-2">{{ $order->phone }}</div>
                            <label for="">Address</label>
                            <div class="border p-2">
                                {{ $order->address }}, Phường
                                {{ $order->district }}, Quận
                                {{ $order->province }}, Thành phố
                                {{ $order->city }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="text-center"><strong>Order Information</strong></h4>
                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Product Name</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Product Image</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orederItems as $item)
                                        <tr>
                                            <td>{{ $item->products->name }}</td>
                                            <td class="text-center">{{ $item->qty }}</td>
                                            <td> <strong>{{ number_format($item->price) }}</strong> VNĐ</td>
                                            <td class="text-center">
                                                <img src="{{ asset('uploads/products/'.$item->products->productImages[0]->image) }}" title="Sản phẩm {{ $item->products->name }}" style="width: 70px; height: 70px;" >
                                            </td>
                                            <td class="text-center">
                                                @if ($order->status == '1' && $item->review_status == false)
                                                    <a href="{{ url('/review-item/'.$item->id) }}" class="float-end ">Write review</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h4>Total: <strong>{{ number_format($order->total_price) }}</strong>  VNĐ</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
