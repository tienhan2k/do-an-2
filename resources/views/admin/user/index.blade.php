@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">

                    <h2>Users

                        {{-- <a href="{{ route('slider.create') }}" class="text-white btn btn-primary btn-sm float-end">Add
                            slider</a> --}}
                        {{-- <a href="{{ route('order.history') }}" class="btn text-white btn-sm btn-info float-end">Order history</a> --}}

                    </h2>

                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $key => $user)
                                <tr>
                                    <td>{{$key + $users->firstItem()}}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        <a href="{{ route('user.view', $user->id) }}"
                                            class="btn btn-sm btn-info">View</a>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>


            </div>
        </div>
@endsection
