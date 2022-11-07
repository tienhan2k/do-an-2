<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\OrderItems;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckoutFormRequest;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        if ($cartItems->count() == 0) {
            return redirect('/cart')->with('error', 'YOU MUST CHOICE A PRODUCT!');
        } else {
            return view('frontend.checkout.index', compact('cartItems'));
        }
    }

    public function checkCoupon(Request $request)
    {
        $couponCode = $request->input('coupon_code');
        if (Coupon::where('coupon_code', $couponCode)->exists()) {
            $coupon = Coupon::where('coupon_code', $couponCode)->first();
            if ($coupon->start_datetime <= Carbon::today()->format('Y-m-d') && Carbon::today()->format('Y-m-d') <= $coupon->end_datetime) {
                $total = 0;
                $cartItemsTotal = Cart::where('user_id', Auth::id())->get();
                foreach ($cartItemsTotal as $product) {
                    if ($product->products->sale_price > 0) {
                        $total += ($product->products->sale_price * $product->product_qty);
                    } else {
                        $total += ($product->products->original_price * $product->product_qty);
                    }
                }

                if ($coupon->coupon_type == '1') {
                    $discount_price = ($total / 100) * $coupon->coupon_price;
                } elseif ($coupon->coupon_type == '2') {
                    $discount_price = $coupon->coupon_price;
                }

                $grandTotal = $total - $discount_price;
                return response()->json([
                    'status' => 'Applied.',
                    'discount_price' => $discount_price,
                    'grandTotal' => $grandTotal
                ]);
            } else {
                return response()->json([
                    'status' => 'Coupon has been expired.',
                    'error_status' => 'error'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'Coupon does not exists.',
                'error_status' => 'error'
            ]);
        }
    }

    public function placeOrder(CheckoutFormRequest $request)
    {
        $request->validated();
        if (Coupon::where('coupon_code', $request->coupon_code)->exists()) {
            $coupon = Coupon::where('coupon_code', $request->coupon_code)->firstOrFail();
            if ($coupon->start_datetime <= Carbon::today()->format('Y-m-d') && Carbon::today()->format('Y-m-d') <= $coupon->end_datetime) {
                $total = 0;
                $cartItemsTotal = Cart::where('user_id', Auth::id())->get();
                foreach ($cartItemsTotal as $product) {
                    if ($product->products->sale_price > 0) {
                        $total += ($product->products->sale_price * $product->product_qty);
                    } else {
                        $total += ($product->products->original_price * $product->product_qty);
                    }
                }

                if ($coupon->coupon_type == '1') {
                    $discount_price = ($total / 100) * $coupon->coupon_price;
                } elseif ($coupon->coupon_type == '2') {
                    $discount_price = $coupon->coupon_price;
                }

                $grandTotal = $total - $discount_price;
                $grandTotal += 30000; // add shipping fee

                $order = Order::create([
                    'user_id' => Auth::id(),
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'city' => $request->city,
                    'province' => $request->province,
                    'district' => $request->district,
                    'message' => $request->message,
                    'total_price' => $grandTotal,
                    'tracking_no' => Str::camel($request->name . rand(0000, 9999)),
                    'status' => 0,
                    'payment_mode' => $request->payment_mode,
                    'payment_id' => $request->payment_id,
                ]);

                $cartItems = Cart::where('user_id', Auth::id())->get();
                foreach ($cartItemsTotal as $item) {
                    if ($product->products->sale_price > 0) {
                        OrderItems::create([
                            'order_id' => $order->id,
                            'product_id' => $item->product_id,
                            'qty' => $item->product_qty,
                            'price' => $item->products->sale_price,
                            'color' => $item->color,
                            'size' => $item->size,
                        ]);
                    } else {
                        OrderItems::create([
                            'order_id' => $order->id,
                            'product_id' => $item->product_id,
                            'qty' => $item->product_qty,
                            'price' => $item->products->original_price,
                            'color' => $item->color,
                            'size' => $item->size,
                        ]);
                    }
                    $product = Product::where('id', $item->product_id)->first();
                    $product->quantity = $product->quantity - $item->product_qty;
                    $product->update();
                }

                if (Auth::user()->address == NULL) {
                    User::where('id', Auth::id())->first()->update([
                        // 'name' => $request->name,
                        // 'email' => $request->email,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'city' => $request->city,
                        'province' => $request->province,
                        'district' => $request->district,
                    ]);
                }
                $cartItems = Cart::where('user_id', Auth::id())->get();
                Cart::destroy($cartItems);

                return redirect('/shop')->with('success', 'Successfully! Thank you for your order.');
            }
        } else {
            $total = 0;
            $cartItemsTotal = Cart::where('user_id', Auth::id())->get();
            foreach ($cartItemsTotal as $product) {
                if ($product->products->sale_price > 0) {
                    $total += ($product->products->sale_price * $product->product_qty);
                } else {
                    $total += ($product->products->original_price * $product->product_qty);
                }
            }
            $total += 30000;
            // dd($total);
            $order = Order::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'province' => $request->province,
                'district' => $request->district,
                'message' => $request->message,
                'total_price' => $total,
                'tracking_no' => Str::camel($request->name . rand(0000, 9999)),
                'status' => 0,
                'payment_mode' => $request->payment_mode,
                'payment_id' => $request->payment_id,

            ]);

            $cartItems = Cart::where('user_id', Auth::id())->get();
            foreach ($cartItems as $item) {
                if ($product->products->sale_price > 0) {
                    OrderItems::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'qty' => $item->product_qty,
                        'price' => $item->products->sale_price,
                        'color' => $item->color,
                        'size' => $item->size,
                    ]);
                } else {
                    OrderItems::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'qty' => $item->product_qty,
                        'price' => $item->products->original_price,
                        'color' => $item->color,
                        'size' => $item->size,
                    ]);
                }
                $product = Product::where('id', $item->product_id)->first();
                $product->quantity = $product->quantity - $item->product_qty;
                $product->update();
            }

            if (Auth::user()->address == NULL) {
                User::where('id', Auth::id())->first()->update([
                    // 'name' => $request->name,
                    // 'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'city' => $request->city,
                    'province' => $request->province,
                    'district' => $request->district,
                ]);
            }
            $cartItems = Cart::where('user_id', Auth::id())->get();
            Cart::destroy($cartItems);

            if ($request->input('payment_mode') == 'Paid by Paypal') {
                return response()->json(['status' => 'Successfully! Thank you for your order.']);
            } else {
                return redirect(route('frontend.order.view'))->with('success', 'Successfully! Thank you for your order.');
            }
        }
    }
}
