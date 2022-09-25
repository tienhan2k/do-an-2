@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">

                    <h2>Product

                        <a href="{{ route('product.create') }}" class="text-white btn btn-primary btn-sm float-end">Add
                            product</a>
                    </h2>

                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        @if ($product->category)
                                            {{ $product->category->name }}
                                        @else
                                            Không có thể loại nào
                                        @endif
                                    </td>

                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->original_price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td>
                                        <a href="{{ route('product.edit', $product->id) }}"
                                            class="btn btn-sm btn-success">Edit</a>
                                        <a href="{{ route('product.delete', $product->id) }}"
                                            onclick="return confirm('Bạn có chắc muốn xoá sản phẩm này không?')"
                                            class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        Không tìm thấy sản phẩm nào
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    {{ $products->links() }}
                </div>


            </div>
        </div>
    @endsection
