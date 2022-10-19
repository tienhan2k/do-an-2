@extends('layouts.master')

@section('title', 'Wishlist')


@section('content')

    <div>
        <div class="container" style="padding: 30px 0">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Profile
                    </div>
                    <div class="panel-body">
                        <div class="col-md-4">
                            @if ($user->image)
                                <img src="{{ asset('uploads/profile') }}/{{ $user->image }}" alt="">
                            @else
                                <img src="{{ asset('uploads/profile/avata-dummy.png') }}" width="100%" alt="">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <p><b>Name: </b>{{ $user->name }}</p>
                            <p><b>Email: </b>{{ $user->email }}</p>
                            <p><b>Phone Number: </b>{{ $user->phone }}</p>
                            <p><b>Address: </b>{{ $user->address }}</p>
                            <p><b>District: </b>{{ $user->district }}</p>
                            <p><b>City: </b>{{ $user->city }}</p>
                            <p><b>Province: </b>{{ $user->province }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
