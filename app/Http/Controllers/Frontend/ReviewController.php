<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Review;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($order_item_id)
    {
        $order_item = OrderItems::findOrFail($order_item_id);
        $check = Order::where('user_id', Auth::id())->get();

        if ($check->isEmpty()) {

            return redirect('/')->with('error', 'There is something wrong!');
        } else {
            $verify_purchase = Order::where('user_id', Auth::id())
                            ->where('status', '1')
                            ->join('order_items', 'orders.id', 'order_id')
                            ->where('order_items.product_id', $order_item->products->id)
                            ->get();
            if ($verify_purchase->isEmpty()) {
                return redirect('/')->with('error', 'You did not buy this to make review!');
            } else {
                if ($order_item->review_status == 0) {
                    return view('frontend.review.index', compact('order_item', 'verify_purchase'));
                } else {
                    return redirect()->back()->with('error', 'You have reviewed this product before!');
                }
            }
        }
    }

    public function store(Request $resquest)
    {
        $order_item = OrderItems::findOrFail($resquest->order_item_id);

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $resquest->product_id,
            'review' => $resquest->review,
            'rating' => $resquest->rating,
        ]);

        $order_item->review_status = true;
        $order_item->save();
        return redirect(route('frontend.index'))->with('success', 'Write review done. Thank you!');
    }
}
