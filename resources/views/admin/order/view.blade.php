@extends('layouts.admin')

@section('content')
    {{-- <div class="container "> --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-danger">
                    <h2 class="text-white text-center"><strong>Orders View</strong>
                        <a href="{{ route('order.index') }}" class="btn btn-success float-end">Back</a>
                    </h2>
                </div><br>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="text-center"><strong>Customer Information</strong></h4>
                            <hr>
                            <label for="">Name:</label>
                            <div class="border p-2"><strong>{{ $orders->name }}</strong></div>
                            <label for="">Email:</label>
                            <div class="border p-2"><strong>{{ $orders->email }}</strong></div>
                            <label for="">Phone Number:</label>
                            <div class="border p-2"><strong>{{ $orders->phone }}</strong></div>
                            <label for="">Address:</label>
                            <div class="border p-2"><strong>{{ $orders->address }}, Phường
                                    {{ $orders->district }}, Quận
                                    {{ $orders->province }}, Thành phố
                                    {{ $orders->city }}</strong>

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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders->orederItems as $item)
                                        <tr>
                                            <td>{{ $item->products->name }}</td>
                                            <td class="text-center">{{ $item->qty }}</td>
                                            <td> <strong>{{ number_format($item->price) }}</strong> VNĐ</td>
                                            <td class="text-center">
                                                <img src="{{ asset('uploads/products/' . $item->products->productImages[0]->image) }}"
                                                    title="Sản phẩm {{ $item->products->name }}"
                                                    style="width: 70px; height: 70px;">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h4 class="px-2">Total: <strong>{{ number_format($orders->total_price) }}</strong> VNĐ</h4>
                            <div class="mt-5 px-2">
                                <label><strong>Order Status:</strong></label>
                                <form action="{{ route('order.update', $orders->id) }}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <select name="order_status" class="form-select mt-1" id="">
                                        {{-- <option selected>Select</option> --}}
                                        <option style="color: red" {{ $orders->status == '0' ? 'selected' : '' }}
                                            value="0">Pending</option>
                                        <option style="color: orange" {{ $orders->status == '1' ? 'selected' : '' }}
                                            value="1">Complete</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary mt-3 float-end">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- </div> --}}
@endsection
