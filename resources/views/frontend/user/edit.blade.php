@extends('layouts.master')

@section('title', 'Edit Profile')


@section('content')

    <div>
        <div class="container" style="padding: 30px 0">
            <div class="row">
                @if ($errors->any())
                <div class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Update Profile
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('frontend.user.profile-update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="col-md-4">
                                @if ($user->image != null)
                                    <img src="{{ asset('uploads/profile') }}/{{ $user->image }}" alt="">
                                @else
                                    <img src="{{ asset('uploads/profile/avata-dummy.png') }}" width="100%" alt="">
                                @endif
                                <input type="file" class="form-control" name="image" id="">
                            </div>
                            <div class="col-md-8">
                                <p><b>Name: </b><input value="{{ $user->name }}" type="text" name="name" class="form-control"></p>
                                <p><b>Email: </b><input value="{{ $user->email }}" readonly type="text" name="email" class="form-control"></p>
                                <p><b>Phone Number: </b><input value="{{ $user->phone }}" type="text" name="phone" class="form-control"></p>
                                <p><b>Address: </b><input value="{{ $user->address }}" type="text" name="address" class="form-control"></p>
                                <p><b>District: </b><input value="{{ $user->district }}" type="text" name="district" class="form-control"></p>
                                <p><b>City: </b><input value="{{ $user->city }}" type="text" name="city" class="form-control"></p>
                                <p><b>Province: </b><input value="{{ $user->province }}" type="text" name="province" class="form-control"></p>
                                <button type="submit" class="btn btn-info pull-right">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
