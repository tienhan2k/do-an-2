@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">

                    <h2>Color

                        <a href="{{ route('color.create') }}" class="text-white btn btn-primary btn-sm float-end">Add
                            color</a>
                    </h2>

                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Color Name</th>
                                <th>Color Code</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($colors as $color)
                                <tr>
                                    <td>{{ $color->id }}</td>
                                    <td>{{ $color->name }}</td>
                                    <td>{{ $color->code }}</td>
                                    <td>{{ $color->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td>
                                        <a href="{{ route('color.edit', $color->id) }}" class="btn btn-success btn-sm">Edit</a>
                                        <a href="{{ route('color.delete', $color->id) }}"
                                            onclick="return confirm('Bạn có chắc không?')"
                                            class="btn  btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        Không tìm thấy
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    {{ $colors->links() }}
                </div>


            </div>
        </div>
    @endsection
