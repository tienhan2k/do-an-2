@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Sale Setting</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('sale.update', $sale->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Status</label>
                                <div class="col-md-4">
                                    <select name="status" class="form-control" id="">
                                        <option value="0" {{ $sale->status == 0 ? 'selected' : ''  }}>Active</option>
                                        <option value="1" {{ $sale->status == 1 ? 'selected' : ''  }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Sale Date</label>
                                <div class="col-md-6">
                                    <input type="datetime-local" value="{{ $sale->sale_date }}" name="sale_date" />
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary float-end text-white">Save</button>
                            </div>
                        </div>


                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection
