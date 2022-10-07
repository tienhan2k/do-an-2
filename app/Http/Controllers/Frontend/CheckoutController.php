<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
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
        // dd($cartItems->count());
        if ($cartItems->count() == 0) {
            return redirect('/cart')->with('error', 'YOU MUST CHOICE A PRODUCT!');
        } else {
            return view('frontend.checkout.index', compact('cartItems'));
        }
    }

    public function placeOrder(CheckoutFormRequest $request)
    {
        $request->validated();
        // $str = Str::camel($request->name.rand(0000, 9999));
        // dd($str);
        $total = 0;
        $cartItemsTotal = Cart::where('user_id', Auth::id())->get();
        // dd($cartItemsTotal);
        foreach($cartItemsTotal as $product)
        {
            $total += ($product->products->original_price * $product->product_qty);
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
            'tracking_no' => Str::camel($request->name.rand(0000, 9999)),
            'status' => 0,
        ]);

        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItems as $item) {
            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'qty' => $item->product_qty,
                'price' => $item->products->original_price,
            ]);
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

        return redirect('/')->with('success', 'Successfully! Thank you for your order.');
    }

}
