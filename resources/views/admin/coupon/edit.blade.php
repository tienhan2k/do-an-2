@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {{-- @if ($errors->any())
                <div class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif --}}
            <div class="card">
                <div class="card-header">


                    <h2>Edit coupon

                        <a href="{{ route('coupon.index') }}" class="text-white btn btn-primary btn-sm float-end">Back</a>
                    </h2>

                </div>
                <div class="card-body">

                    <form action="{{ route('coupon.update', $coupon->id) }}"  method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Offer name</label>
                                <input type="text" value="{{ $coupon->offer_name }}" name="offer_name" class="form-control"/>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Product (optional)</label>
                                <select class="form-control select2-products" name="product_id">
                                    <option value="">Select</option>
                                    @foreach ($products as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Coupon code</label>
                                <input type="text" value="{{ $coupon->coupon_code }}" name="coupon_code" class="form-control"/>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Coupon limit</label>
                                <input type="text" value="{{ $coupon->coupon_limit }}" name="coupon_limit" class="form-control"/>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Coupon type</label>
                                <select class="form-control" name="coupon_type" id="">
                                    <option value="">Select</option>
                                    <option value="1" {{ $coupon->coupon_type == '1' ? 'selected' : '' }}>Percent</option>
                                    <option value="2" {{ $coupon->coupon_type == '2' ? 'selected' : '' }}>Amount</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Coupon price</label>
                                <input type="text" value="{{ $coupon->coupon_price }}" name="coupon_price" class="form-control"/>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Start date</label>
                                <input type="datetime-local" name="start_datetime" value="{{ date('Y-m-d\TH:i', strtotime($coupon->start_datetime)) }}" class="form-control"/>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">End date</label>
                                <input type="datetime-local" name="end_datetime" value="{{ date('Y-m-d\TH:i', strtotime($coupon->end_datetime)) }}" class="form-control"/>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Status</label><br>
                                <input type="checkbox" name="status" value="{{ $coupon->status == '1' ? 'checked' : '' }}" style="width: 20px; height: 20px"/> Check = Block, Uncheck = Active
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Visibility Status</label><br>
                                <input type="checkbox" name="visibility_status" value="{{ $coupon->visibility_status == '1' ? 'checked' : '' }}" style="width: 20px; height: 20px"/> Check = Hidden, Uncheck = Show
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
