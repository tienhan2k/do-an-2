@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">

                    <h2>Sale</h2>

                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sale date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($sale->count()>0)
                                <tr>
                                    <td>1</td>
                                    <td>{{ $sale->sale_date }}</td>
                                    <td>{{ $sale->status == '1' ? 'Inactive' : 'Active' }}</td>
                                    <td>
                                        <a href="{{ route('sale.edit', $sale->id) }}" class="btn btn-success btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">
                                        Not found.
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    @endsection
