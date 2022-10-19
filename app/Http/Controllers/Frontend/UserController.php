<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function showProfile()
    {
        return view('frontend.user.profile', [
            'user' => User::findOrFail(Auth::user()->id),
        ]);
    }

    public function listOrders()
    {
        // $orders = Order::where('user_id', Auth::id())->get();
        return view('frontend.order.index', [
            'orders' => Order::where('user_id', Auth::id())->get()
        ]);
    }

    public function viewOrder($id)
    {
        $order = Order::where('id', $id)
                        ->where('user_id', Auth::id())
                        ->firstOrFail();
        return view('frontend.order.view', compact('order'));
    }
}
