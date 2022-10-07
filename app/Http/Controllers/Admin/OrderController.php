<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {

        return view('admin.order.index', [
            'orders' => Order::where('status', '0')->paginate(5),
        ]);
    }


    public function show($id)
    {
        return view('admin.order.view', [
            'orders' => Order::where('id', $id)->first(),
        ]);
    }


    public function update(Request $request, $id)
    {
        Order::findOrFail($id)->update([
            'status' => $request->order_status,
        ]);
        return redirect(route('order.index'))->with('message', 'Update success!');
    }


    public function viewHistory()
    {
        return view('admin.order.history', [
            'orders' => Order::where('status', '1')->paginate(5),
        ]);
    }

    public function destroy($id)
    {

    }
}
