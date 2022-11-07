@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {{-- @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif --}}
            <div class="card">
                <div class="card-header">

                    <h2>Coupon

                        <a href="{{ route('coupon.create') }}" class="text-white btn btn-primary btn-sm float-end">Add
                            coupon</a>
                    </h2>

                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Offer</th>
                                <th>Coupon Code</th>
                                <th>Expiry time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($coupons as $index => $coupon)
                                <tr>
                                    <td>{{$index + $coupons->firstItem()}}</td>
                                    <td>{{ $coupon->offer_name }}</td>
                                    <td>{{ $coupon->coupon_code }}</td>
                                    <td>{{ $coupon->end_datetime }}</td>
                                    <td>
                                        @if ($coupon->status == '1')
                                                <label class="badge badge-pill btn-secondary">Disable</label>
                                        @else
                                            <label class="badge badge-pill btn-primary">Active</label>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('coupon.edit', $coupon->id) }}" class="badge btn-success ">Edit</a>
                                        <a href="{{ route('coupon.delete', $coupon->id) }}"
                                            onclick="return confirm('Are you sure?')"
                                            class="badge btn-danger ">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        No coupon found.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table><br>
                    {{ $coupons->links() }}
                </div>


            </div>
        </div>
    @endsection
