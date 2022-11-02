@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {{-- @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif --}}
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
                                <th>Sub Category</th>
                                <th>Product</th>
                                {{-- <th>Brand</th> --}}
                                <th>Price</th>
                                <th>Sale price</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $index => $product)
                                <tr>
                                    <td>{{$index + $products->firstItem()}}</td>
                                    <td>
                                        @if ($product->category)
                                            {{ $product->category->name }}
                                        @else
                                            No category found.
                                        @endif
                                    </td>

                                    <td>
                                        @if ($product->sCategory)
                                            {{ $product->sCategory->name }}
                                        @else
                                            No category found.
                                        @endif
                                    </td>

                                    <td>{{ $product->name }}</td>
                                    {{-- <td>{{ $product->brand }}</td> --}}
                                    <td><strong>{{ number_format($product->original_price) }}</strong>đ</td>
                                    <td><strong>{{ number_format($product->sale_price) }}</strong>đ</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td>
                                        <a href="{{ route('product.edit', $product->id) }}"
                                            class="badge btn-success">Edit</a>
                                        <a href="{{ route('product.delete', $product->id) }}"
                                            onclick="return confirm('Are you sure?')"
                                            class="badge btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">
                                        Products not found.
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
