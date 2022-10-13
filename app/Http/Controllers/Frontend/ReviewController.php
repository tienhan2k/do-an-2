<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Review;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($order_item_id)
    {
        return view('frontend.review.index', [
            'order_item' => OrderItems::findOrFail($order_item_id),
        ]);
    }

    public function store(Request $resquest)
    {
        $order_item = OrderItems::findOrFail($resquest->order_item_id);
        // dd($order_item);
        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $resquest->product_id,
            'review' => $resquest->review,
            'rating' => $resquest->rating,
        ]);

        $order_item->review_status = true;
        $order_item->save();
        // $order_item->update([
        //     'review_status' => 1,
        // ]);
        return redirect(route('frontend.index'))->with('message', 'Thêm thành công.');
    }
}
