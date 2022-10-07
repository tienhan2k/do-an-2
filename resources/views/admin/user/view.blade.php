@extends('layouts.admin')

@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center"><strong>Users Details</strong>
                            <a href="{{ route('user.index') }}" class="btn btn-success float-end">Back</a>
                        </h2>
                    </div><br>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <label for="">Role</label>
                                <div class="border p-2">{{ $user->role == '0' ? 'user' : 'admin' }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">Name</label>
                                <div class="border p-2">{{ $user->name }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">Email</label>
                                <div class="border p-2">{{ $user->email }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">Phone Number</label>
                                <div class="border p-2">{{ $user->phone }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">Address</label>
                                <div class="border p-2">{{ $user->address }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">District</label>
                                <div class="border p-2">{{ $user->district }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">Province</label>
                                <div class="border p-2">{{ $user->province }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">City</label>
                                <div class="border p-2">{{ $user->city }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
