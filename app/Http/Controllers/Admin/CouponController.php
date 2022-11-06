<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.coupon.index', [
            'coupons' => Coupon::paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create', [
            'products' => Product::where('status', '0')->get(),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Coupon::create([
            'offer_name' => $request->offer_name,
            'product_id' => $request->product_id,
            'coupon_code' => $request->coupon_code,
            'coupon_limit' => $request->coupon_limit,
            'coupon_type' => $request->coupon_type,
            'coupon_price' => $request->coupon_price,
            'start_datetime' => $request->start_datetime,
            'end_datetime' => $request->end_datetime,
            'status' => $request->status == true ? '1' : '0',
            'visibility_status' => $request->visibility_status == true ? '1' : '0',
        ]);
        return redirect(route('coupon.index'))->withSuccessMessage('Add successful.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.coupon.edit',[
            'coupon' => Coupon::findOrFail($id),
            'products' => Product::where('status', '0')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Coupon::findOrFail($id)->update([
            'offer_name' => $request->offer_name,
            'product_id' => $request->product_id,
            'coupon_code' => $request->coupon_code,
            'coupon_limit' => $request->coupon_limit,
            'coupon_type' => $request->coupon_type,
            'coupon_price' => $request->coupon_price,
            'start_datetime' => $request->start_datetime,
            'end_datetime' => $request->end_datetime,
            'status' => $request->status == true ? '1' : '0',
            'visibility_status' => $request->visibility_status == true ? '1' : '0',
        ]);
        if (session('current_url')) {
            return redirect(session('current_url'))->withSuccessMessage('Update successful!');
        } else {
            return redirect(route('coupon.index'))->withSuccessMessage('Update successful.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
