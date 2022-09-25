@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">

                    <h2>Slider

                        <a href="{{ route('slider.create') }}" class="text-white btn btn-primary btn-sm float-end">Add
                            slider</a>
                    </h2>

                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sliders as $slider)
                                <tr>
                                    <td>{{ $slider->id }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td>
                                        @if ($slider->image)
                                            <img src="{{ asset('uploads/sliders') . '/' . $slider->image}}"
                                            style="width: 70px; height: 70px;" />
                                        @else
                                            <h6>Không có hình ảnh nào</h6>
                                        @endif

                                    </td>
                                    <td>{{ $slider->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td>

                                        <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-success">Edit</a>

                                        <a href="{{ route('slider.delete', $slider->id) }}"
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
                    {{ $sliders->links() }}
                </div>


            </div>
        </div>
    @endsection
