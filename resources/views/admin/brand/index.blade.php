@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {{-- @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif --}}
            <div class="card">
                <div class="card-header">

                    <h2>Brand

                        <a href="{{ route('brand.create') }}" class="text-white btn btn-primary btn-sm float-end">Add
                            brand</a>
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
                            @forelse ($brands as $index => $brand)
                                <tr>
                                    <td>{{$index + $brands->firstItem()}}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td>{{ $brand->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td>
                                        <a href="{{ route('brand.edit', $brand->id) }}" class="badge btn-success">Edit</a>
                                        <a href="{{ route('brand.delete', $brand->id) }}"
                                            onclick="return confirm('Are you sure?')"
                                            class="badge btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        Brands not found.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    <br>
                    {{ $brands->links() }}
                </div>


            </div>
        </div>
    @endsection
