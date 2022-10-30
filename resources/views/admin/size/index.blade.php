@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">

                    <h2>Size

                        <a href="{{ route('size.create') }}" class="text-white btn btn-primary btn-sm float-end">Add
                            size</a>
                    </h2>

                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Size Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sizes as $index => $size)
                                <tr>
                                    <td>{{$index + $sizes->firstItem()}}</td>
                                    <td>{{ $size->name }}</td>
                                    <td>{{ $size->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td>
                                        <a href="{{ route('size.edit', $size->id) }}" class="btn btn-success btn-sm">Edit</a>
                                        <a href="{{ route('size.delete', $size->id) }}"
                                            onclick="return confirm('Are you sure?')"
                                            class="btn  btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        No size found.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    {{ $sizes->links() }}
                </div>


            </div>
        </div>
    @endsection
