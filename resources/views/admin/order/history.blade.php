@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {{-- @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif --}}
            <div class="card">
                <div class="card-header">

                    <h2>Orders history

                        <a href="{{ route('order.index') }}" class="btn text-white btn-sm btn-info float-end">Newest Orders</a>

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
                                    <td>{!! $item->status == '1' ? '<h6 style="color: orange">Completed</h6>' : '<h6 style="color: green">No information</h6>' !!}</td>
                                    <td>
                                        <a href="{{ route('order.view', $item->id) }}"
                                            class="badge btn-success">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        No order found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>


            </div>
        </div>
@endsection
