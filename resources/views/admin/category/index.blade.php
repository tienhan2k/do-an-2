@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">

                    <h2>Category

                        <a href="{{ route('category.create') }}" class="text-white btn btn-primary btn-sm float-end">Add
                            category</a>
                    </h2>

                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $index => $category)
                                <tr>
                                    <td>{{ $index }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td>
                                        <a href="{{ route('category.edit', $category->id) }}"
                                            class="btn btn-success">Edit</a>
                                        <a href="{{ route('category.delete', $category->id) }}"
                                            onclick="return confirm('Bạn có chắc muốn xoá sản phẩm này không?')"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        Không tìm thấy thương hiệu
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>


            </div>
        </div>
    @endsection
