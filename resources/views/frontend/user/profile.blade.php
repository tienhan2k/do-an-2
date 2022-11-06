@extends('layouts.master')

@section('title', 'Profile')

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
                            {{-- {{ dd($user->image) }} --}}
                            @if ($user->image != null)
                            <img src="{{ asset('uploads/profile') }}/{{ $user->image }}" width="100%" alt="">
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
                            <a href="{{ route('frontend.user.profile-edit', Auth::user()->id) }}" class="btn btn-info pull-right">Update</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
