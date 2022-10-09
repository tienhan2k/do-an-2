<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    public function index()
    {
        return view('frontend.wishlist.index', [
            'wishlist' => Wishlist::where('user_id', Auth::id())->paginate(9),
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        if (Auth::check()) {
            $prod_id = $request->input('prod_id');
            if (Product::find($prod_id)) {
                Wishlist::create([
                    'product_id' => $prod_id,
                    'user_id' => Auth::id()
                ]);
                return response()->json(['status' => "Added to wishlist!"]);
            } else {
                return response()->json(['status' => "This product is not available now. Sorry!"]);
            }
        } else {
            return response()->json(['status' => "Please login to add this item."]);
        }
    }
    public function storeInProductPage($id)
    {
        if (Auth::check()) {
            if (Product::find($id)) {
                Wishlist::create([
                    'product_id' => $id,
                    'user_id' => Auth::id()
                ]);
                return response()->json(['status' => "Added to wishlist!"]);
            } else {
                return response()->json(['status' => "This product is not available now. Sorry!"]);
            }
        } else {
            return response()->json(['status' => "Please login to add this item."]);
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        if (Auth::check()) {
            if (Wishlist::where('product_id', $id)->where('user_id', Auth::id())->exists()) {
                $wishItem = Wishlist::where('product_id', $id)->where('user_id', Auth::id())->first();
                $wishItem->delete();
                return response()->json(['status' => "Delete successfully."]);
            }
        } else {
            return response()->json(['status' => "Please login to delete this item."]);
        }
    }
}
