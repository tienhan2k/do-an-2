@extends('layouts.master')

@section('title', 'Checkout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center"><strong>My Orders</strong></h2>
                </div><br>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Tracking number</th>
                                <th class="text-center">Total price</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                                <tr>
                                    <td>{{ $item->tracking_no }}</td>
                                    <td>{{ number_format($item->total_price) }} VNĐ</td>
                                    <td>{{ $item->status == '0' ? 'pending' : 'completed' }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('/view-orders/'.$item->id) }}" class="btn tbtn-sm btn-primary">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
