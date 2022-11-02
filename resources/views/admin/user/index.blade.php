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

                        <a href="{{ route('user.create') }}" class="text-white btn btn-primary btn-sm float-end">Add
                            user</a>
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
                                <th>Role</th>
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
                                        @if ($user->role == '0')
                                            <label for="" class="badge badge-pill btn-sm btn-success">User</label>
                                        @elseif ($user->role == '1')
                                            <label for="" class="badge badge-pill btn-danger">Admin</label>
                                        @else
                                            <label for="" class="badge badge-pill btn-info">None</label>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('user.view', $user->id) }}"
                                            class="badge btn-info">View</a>
                                        <a href="{{ route('user.edit', $user->id) }}"
                                            class="badge btn-primary">Edit</a>
                                        <a href="{{ route('user.delete', $user->id) }}"
                                            onclick="return confirm('Are you sure?')"
                                            class="badge btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        Not found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>


            </div>
        </div>
@endsection
