<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        $prod_id = $request->input('prod_id');
        $prod_qty = $request->input('prod_qty');

        if (Auth::check()) {
            $prod_check = Product::where('id', $prod_id)->first();
            if ($prod_check) {
                if (Cart::where('product_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                    return response()->json(['status' => $prod_check->name . " is available in your cart."]);
                } else {
                    $cart_item = new Cart();
                    $cart_item->product_id = $prod_id;
                    $cart_item->user_id = Auth::id();
                    $cart_item->product_qty = $prod_qty;
                    $cart_item->save();
                    return response()->json(['status' => $prod_check->name . " added successfully. Congrats!"]);
                }
            }
        } else {
            return response()->json(['status' => "Please login to add this item."]);
        }
    }

    public function addProductInAllProductPage($id)
    {
        // $prod_id = $request->input('prod_id');
        // dd($request->input('prod_qty'));

        $prod_qty = 1;

        if (Auth::check()) {
            $prod_check = Product::where('id', $id)->first();
            if ($prod_check) {
                if (Cart::where('product_id', $id)->where('user_id', Auth::id())->exists()) {
                    return response()->json(['status' => $prod_check->name . " is available in your cart."]);
                } else {
                    $cart_item = new Cart();
                    $cart_item->product_id = $id;
                    $cart_item->user_id = Auth::id();
                    $cart_item->product_qty = $prod_qty;
                    $cart_item->save();
                    return response()->json(['status' => $prod_check->name . " added successfully. Congrats!"]);
                }
            }
        } else {
            return response()->json(['status' => "Please login to add this item."]);
        }
    }

    public function viewCart()
    {
        $carts_item = Cart::where('user_id', Auth::id())->get();
        // dd($carts_item);
        return view('frontend.cart.index', compact('carts_item'));
    }

    public function updateProduct(Request $request)
    {
        $prod_id = $request->input('prod_id');
        $qty = $request->input('qty');
        if (Auth::check()) {
            if (Cart::where('product_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $cartItem = Cart::where('product_id', $prod_id)->where('user_id', Auth::id())->first();
                $cartItem->product_qty = $qty;
                $cartItem->update();
                return response()->json(['status' => "We just updated your product quantity."]);
            }
        }
    }

    public function deleteProduct(Request $request)
    {
        if (Auth::check()) {
            $prod_id = $request->input("prod_id");
            if (Cart::where('product_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $cartItem = Cart::where('product_id', $prod_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status' => "Delete successfully."]);
            }
        } else {
            return response()->json(['status' => "Please login to delete this item."]);
        }
    }
}
