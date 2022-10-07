@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">

                    <h2>Orders

                        {{-- <a href="{{ route('slider.create') }}" class="text-white btn btn-primary btn-sm float-end">Add
                            slider</a> --}}
                        <a href="{{ route('order.history') }}" class="btn text-white btn-sm btn-info float-end">Order history</a>

                    </h2>

                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Order date</th>
                                <th>Tracking number</th>
                                <th>Total price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $item)
                                <tr>
                                    <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                    <td>{{ $item->tracking_no }}</td>
                                    <td>{{ $item->total_price }}</td>
                                    <td>{!! $item->status == '0' ? '<h6 style="color: red">Pending</h6>' : '<h6 style="color: orange">No information</h6>' !!}</td>
                                    <td>
                                        <a href="{{ route('order.view', $item->id) }}"
                                            class="btn btn-sm btn-success">View</a>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>


            </div>
        </div>
@endsection
